<?php
/**
 * @file
 * Zen theme's implementation to display a single Drupal page.
 *
 * Available variables:
 *
 * General utility variables:
 * - $base_path: The base URL path of the Drupal installation. At the very
 *   least, this will always default to /.
 * - $directory: The directory the template is located in, e.g. modules/system
 *   or themes/garland.
 * - $is_front: TRUE if the current page is the front page.
 * - $logged_in: TRUE if the user is registered and signed in.
 * - $is_admin: TRUE if the user has permission to access administration pages.
 *
 * Site identity:
 * - $front_page: The URL of the front page. Use this instead of $base_path,
 *   when linking to the front page. This includes the language domain or
 *   prefix.
 * - $logo: The path to the logo image, as defined in theme configuration.
 * - $site_name: The name of the site, empty when display has been disabled
 *   in theme settings.
 * - $site_slogan: The slogan of the site, empty when display has been disabled
 *   in theme settings.
 *
 * Navigation:
 * - $main_menu (array): An array containing the Main menu links for the
 *   site, if they have been configured.
 * - $secondary_menu (array): An array containing the Secondary menu links for
 *   the site, if they have been configured.
 * - $secondary_menu_heading: The title of the menu used by the secondary links.
 * - $breadcrumb: The breadcrumb trail for the current page.
 *
 * Page content (in order of occurrence in the default page.tpl.php):
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title: The page title, for use in the actual HTML content.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 * - $messages: HTML for status and error messages. Should be displayed
 *   prominently.
 * - $tabs (array): Tabs linking to any sub-pages beneath the current page
 *   (e.g., the view and edit tabs when displaying a node).
 * - $action_links (array): Actions local to the page, such as 'Add menu' on the
 *   menu administration interface.
 * - $feed_icons: A string of all feed icons for the current page.
 * - $node: The node object, if there is an automatically-loaded node
 *   associated with the page, and the node ID is the second argument
 *   in the page's path (e.g. node/12345 and node/12345/revisions, but not
 *   comment/reply/12345).
 *
 * Regions:
 * - $page['help']: Dynamic help text, mostly for admin pages.
 * - $page['highlighted']: Items for the highlighted content region.
 * - $page['content']: The main content of the current page.
 * - $page['sidebar_first']: Items for the first sidebar.
 * - $page['sidebar_second']: Items for the second sidebar.
 * - $page['header']: Items for the header region.
 * - $page['footer']: Items for the footer region.
 * - $page['bottom']: Items to appear at the bottom of the page below the footer.
 *
 * @see template_preprocess()
 * @see template_preprocess_page()
 * @see zen_preprocess_page()
 * @see template_process()
 */

$slides = NULL;
$property_map = NULL;
if(drupal_is_front_page()):

  $query = db_select('node', 'n');
  
  /* get nodes for this particular slideshow */
  $query->join('nodequeue_nodes', 'nn', 'n.nid = nn.nid');
  $query->join('nodequeue_queue', 'nq', 'nn.qid = nq.qid');
  
  /* get image */
  $query->leftJoin('field_data_field_slider_image', 's', 'n.nid = s.entity_id');
  $query->leftJoin('file_managed', 'f', 's.field_slider_image_fid = f.fid');
  
  /* get address, city state, zip and prive */
  $query->leftJoin('field_data_field_address', 'a', 'nn.nid = a.entity_id');
  $query->leftJoin('field_data_field_city', 'c', 'nn.nid = c.entity_id');
  $query->leftJoin('field_data_field_state', 'ss', 'nn.nid = ss.entity_id');
  $query->leftJoin('field_data_field_zip', 'z', 'nn.nid = z.entity_id');
  $query->leftJoin('field_data_field_price', 'p', 'nn.nid = p.entity_id');
  
  /* only for featured slideshow */
  $query->condition('nq.name', 'slideshow', '=');
  
  /* get all fields */
  $query->fields('n',array('title','nid'))
  ->fields('a',array('field_address_value'))
  ->fields('c',array('field_city_value'))
  ->fields('ss',array('field_state_value'))
  ->fields('z',array('field_zip_value'))
  ->fields('p',array('field_price_value'))
  ->fields('f',array('uri'))
  ->orderBy('nn.position', 'asc');
  
  $result = $query->execute();

  if($result->rowCount() >= 1):
    $slides = '<div id="featured-slider"><div class="flexslider" id="homeslideshow"><ul class="slides">';
    foreach ($result as $results){
    
      $options = array('absolute' => TRUE);
      $url = url('node/' . $results->nid, $options);
    
      //$image_url = file_create_url($results->uri);
      $image_url = image_style_url("slideshow", $results->uri);
      
      $slides .= '
      <li>
        <a href="' . $url . '">
      	<img src="' . $image_url . '" alt="" />
      	<div class="flex-caption">
      		<div class="featured-address-number">' . $results->field_address_value . '</div>
      		<div class="featured-address-city">' . $results->field_city_value .' ' . $results->field_state_value . ' ' . $results->field_zip_value . '</div>
      		<div class="featured-price">' . $results->field_price_value . '</div>
      	</div>
      	</a>
      </li>';
    }
    $slides .= '</ul></div></div><div class="clearfix"></div>';
  endif;
endif;


if(arg(0) == 'property-search'){

  $get_address = array();

  //fields we may or may query on
  $address_string = check_plain($_GET['title']);
  $rooms = check_plain($_GET['rooms']);
  $baths = check_plain($_GET['baths']);
  $garage = check_plain($_GET['garage']);    
  $type = check_plain($_GET['type']);
  $status = check_plain($_GET['status']);
  
  $result = db_select('node', 'n');
  
  /* address info and house information */
  $result->leftJoin('field_data_field_address', 'a', 'n.nid = a.entity_id');
  $result->leftJoin('field_data_field_city', 'c', 'n.nid = c.entity_id');
  $result->leftJoin('field_data_field_state', 's', 'n.nid = s.entity_id');
  $result->leftJoin('field_data_field_zip', 'z', 'n.nid = z.entity_id');
  $result->leftJoin('field_data_field_bedrooms', 'r', 'n.nid = r.entity_id');
  $result->leftJoin('field_data_field_bathrooms', 'b', 'n.nid = b.entity_id');
  $result->leftJoin('field_data_field_garage', 'g', 'n.nid = g.entity_id');
  $result->leftJoin('field_data_field_property_types', 'pt', 'n.nid = pt.entity_id');
  $result->leftJoin('field_data_field_property_status', 'ps', 'n.nid = ps.entity_id');
  $result->leftJoin('field_data_field_price', 'p', 'n.nid = p.entity_id');
          
  $result->fields('n', array('title', 'nid'));
  $result->fields('a', array('field_address_value'));
  $result->fields('c', array('field_city_value'));
  $result->fields('s', array('field_state_value'));
  $result->fields('z', array('field_zip_value')); 
  $result->fields('p', array('field_price_value'));  

  /* apply filters, static for all, dynamic for custom conditionals below */
  $result->condition('n.type', 'listing', '=');
  $result->condition('status', 1, '=');
  
  if(strlen($address_string) > 3){
    $result->condition('n.title', '%' . $address_string . '%', 'LIKE');
  }
  
  if(intval($rooms)){
    $result->condition('r.field_bedrooms_value', $rooms, '=');
  }
  
  if(intval($baths)){
    $result->condition('b.field_bathrooms_value', $baths, '=');
  }
  
  if(intval($garage)){
    $result->condition('g.field_garage_value', $garage, '=');
  }
  
  if(intval($type)){
    $result->condition('pt.field_property_types_tid', $type, '=');
  }
  
  if(intval($status)){
    $result->condition('ps.field_property_status_tid', $status, '=');
  }    
  
  $range = 0;
  if(@$_GET['page']){
    $range = check_plain($_GET['page']) * 6;
  }
  
  $result->orderBy('n.created', 'DESC');
  $result->range($range, 6);
  
  $address_result = $result->execute(); 
  
  //echo "<pre>"; print_r($address_result); die();
  
  $ctr = 0;
  foreach ($address_result as $address){
  
    /* we only dig up the first image */
    $image = db_select('field_data_field_image', 'i');
    $image->join('file_managed', 'f', 'i.field_image_fid = f.fid');
    $image->condition('i.entity_id', $address->nid, '=');
    $image->range(0,1);
    $image->orderBy('i.delta', 'ASC'); //take first image
    $image->fields('f', array('uri'));
    $single_image = $image->execute()->fetchObject();;
  
    $options = array('absolute' => TRUE);
    $url = url('node/' . $address->nid, $options);
    
    //$image_thumbnail = image_style_url("maps_thumb", $single_image->uri);
    $image_thumbnail = file_create_url($single_image->uri);
  
    /* populate array of useful information we will use to handoff to google maps */
    array_push($get_address, array(
      'address' => $address->field_address_value." ".$address->field_city_value." ".$address->field_state_value." ".$address->field_zip_value,
      'title' => 'marker title 1' ,
  		'icon' => 'sites/all/themes/freehold/images/home.png',
  		'html' => array(
  		  'content' => '
  		  <a href="' . $url . '">
  		    <img src="' . $image_thumbnail . '" class="alignright" alt="" height="40" width="70">
  		  </a>
  		  <div class="property-information-address">
  		    <a href="' . $url . '">' . $address->field_address_value . '</a>
  		  </div>
  		  <div class="property-information-location">
  		    <a href="' . $url . '">' . $address->field_city_value . ', ' . $address->field_state_value . ' ' . $address->field_zip_value . '</a>
  		  </div>
  		  <div class="property-information-price">
  		    <a href="' . $url . '">' . $address->field_price_value . '</a>
  		  </div>
  		  <a href="' . $url . '" class="view-listing-map">View Listing</a>'
  		),
    ));
    
    if($ctr == 1){
      $first_address = $address->field_address_value ." ".$address->field_city_value." ".$address->field_state_value." ".$address->field_zip_value;
    }
    
    $ctr++;
  }
  
  /* google maps likes a json object, so we transform the array */
  $get_address = json_encode($get_address);
  
  if($address_result->rowCount() > 0){
    $property_map = '
    <div id="map-container">
      <div id="map-listing"></div>
    </div>
    
    <script src="http://maps.google.com/maps/api/js?sensor=true" type="text/javascript"></script>
    <script src="sites/all/themes/freehold/js/jquery.gomap-1.3.2.min.js"></script>
    <script type="text/javascript"> 
    jQuery(document).ready(function($) {
      $("#map-listing").goMap({ 
        markers: '. $get_address .',
        disableDoubleClickZoom: true,
        zoom: 12,
        maptype: "ROADMAP" 
      }); 
    });
    </script>
    ';
  }
}
?>

<?php require("header.php"); ?>


	<div id="main">
		<div class="width-container">
			
      <?php print $slides; ?>
	    
	    <?php if($page['sidebar']):?>
      <div id="container-sidebar">
      <?php endif;?>
      
        <?php 
        if (drupal_is_front_page()) { 
          print render($page['newlistings']);
        }
        else{
          
          print '<div class="content-boxed">';
            print "<h2>" . $title . "</h2>";
          
            print $messages;
            if ($tabs = render($tabs)): ?>
            <div class="tabs"><?php print $tabs; ?></div>
            <?php endif; ?>
            <?php print render($page['help']); ?>
            <?php if ($action_links): ?>
            <ul class="action-links"><?php print render($action_links); ?></ul>
            <?php endif; ?>
            
            <?php
             print $property_map;  
             print render($page['content']);
          print '</div>';
        }
        ?>
      
      <?php if($page['sidebar']):?>
			</div><!-- close #container-sidebar -->
			<?php endif;?>
			
	    <?php if($page['sidebar']):?>		
			<div id="sidebar">
				<?php print render($page['sidebar']);?>
				
				<div class="content-boxed">
					<h2 class="title-bg">Social Networks</h2>
					<div class="social-icons-widget">
						
            <?php 
            $social_media['rss']['status'] == 1 ? print $social_media['rss']['sidebar'] : NULL;
            $social_media['facebook']['status'] == 1 ? print $social_media['facebook']['sidebar'] : NULL;
            $social_media['twitter']['status'] == 1 ? print $social_media['twitter']['sidebar'] : NULL;
            $social_media['skype']['status'] == 1 ? print $social_media['skype']['sidebar'] : NULL;
            $social_media['vimeo']['status'] == 1 ? print $social_media['vimeo']['sidebar'] : NULL;
            $social_media['linkedin']['status'] == 1 ? print $social_media['linkedin']['sidebar'] : NULL;
            $social_media['flickr']['status'] == 1 ? print $social_media['flickr']['sidebar'] : NULL;
            $social_media['google']['status'] == 1 ? print $social_media['google']['sidebar'] : NULL;
            $social_media['dribbble']['status'] == 1 ? print $social_media['dribbble']['sidebar'] : NULL;
            $social_media['youtube']['status'] == 1 ? print $social_media['youtube']['sidebar'] : NULL;
            ?>
						<div class="clearfix"></div>
						
					</div><!-- close .social-icons -->
				</div><!-- close .content-boxed -->
				<div class="clearfix"></div>				
				
			</div><!-- close #sidebar -->
			<?php endif;?>
			

		<div class="clearfix"></div>
		</div><!-- close .width-container -->
	</div><!-- close #main -->
	

<?php require("footer.php"); ?>