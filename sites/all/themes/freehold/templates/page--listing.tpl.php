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
 
/* get all node information that we need */ 
$query = db_select('node', 'n');

$query->join('field_data_body', 'b', 'n.nid = b.entity_id');
$query->leftJoin('field_data_field_price', 'p', 'n.nid = p.entity_id');

$query->leftJoin('field_data_field_bedrooms', 'be', 'n.nid = be.entity_id');
$query->leftJoin('field_data_field_bathrooms', 'ba', 'n.nid = ba.entity_id');
$query->leftJoin('field_data_field_property_types', 'pt', 'n.nid = pt.entity_id'); //field_property_types_tid
$query->leftJoin('taxonomy_term_data', 't', 't.tid = pt.field_property_types_tid');

$query->leftJoin('field_data_field_lot_size', 'ls', 'n.nid = ls.entity_id');
$query->leftJoin('field_data_field_property_size', 'ps', 'n.nid = ps.entity_id');

$query->leftJoin('field_data_field_year_built', 'yb', 'n.nid = yb.entity_id');
$query->leftJoin('field_data_field_address', 'a', 'n.nid = a.entity_id');
$query->leftJoin('field_data_field_city', 'c', 'n.nid = c.entity_id');
$query->leftJoin('field_data_field_state', 's', 'n.nid = s.entity_id'); //field_state_value
$query->leftJoin('field_data_field_zip', 'z', 'n.nid = z.entity_id');

$query->condition('n.nid', check_plain(arg(1)), '=');

/* get all fields */
$query->fields('n',array('title', 'created'))
->fields('p',array('field_price_value'))

->fields('a',array('field_address_value'))
->fields('c',array('field_city_value'))
->fields('s',array('field_state_value'))
->fields('z',array('field_zip_value'))
->fields('yb', array('field_year_built_value'))

->fields('ls', array('field_lot_size_value'))
->fields('ps', array('field_property_size_value'))

->fields('be',array('field_bedrooms_value'))
->fields('ba',array('field_bathrooms_value'))
->fields('t',array('name'))

->fields('b',array('body_value'));
$result = $query->execute()->fetchObject();

/* image query for slider and thumbs */
$iquery = db_select('file_managed', 'f');
$iquery->join('field_data_field_image', 'i', 'f.fid = i.field_image_fid');

$iquery->condition('i.entity_id', check_plain(arg(1)), '=');
$iquery->fields('f',array('uri'));
$image = $iquery->execute();

$slides = NULL;
$subslides = NULL;
$features_output = NULL;

/* if we have images for this node, start generating the ouput */
if($image->rowCount() > 0){
  $slides = '<div id="slider" class="flexslider"><ul class="slides">';
  $subslides = '<div id="carousel" class="flexslider"><ul class="slides">';
  foreach($image as $images){
    
    $image_listing_url = image_style_url("listing_big", $images->uri);
    $image_listing_thumb_url = image_style_url("listing_thumb", $images->uri);
    
    $slides .= '<li>
                  <a href="' . file_create_url($images->uri) . '" rel="prettyPhoto[gallery]">
                    <img src="' . $image_listing_url . '" />
                  </a>
                </li>';
                
    $subslides .= '<li>
                      <img src="' . $image_listing_thumb_url . '" />
                   </li>';            
  }
  $slides .= '</ul></div>';
  $subslides .= '</ul></div>';
}

/* lookup the features and generate output if more than 1 */
$fquery = db_select('field_data_field_features', 'f');
$fquery->condition('f.entity_id',check_plain(arg(1)),'=');
$fquery->fields('f',array('field_features_value'));
$features = $fquery->execute();

if($features->rowCount() > 0){
  $features_output = '
  <h5 class="additional-features-headline">Additional Features</h5>
  <ul class="additional-features">';
  foreach($features as $feature){
    $features_output .= '<li>' . $feature->field_features_value . '</li>';
  }
  $features_output .= '</ul>';
}

?>

<?php require("header.php"); ?>

	<div id="main">
		<div class="width-container">

			<div id="container-sidebar">
				<div class="content-boxed">
					<h2 class="title-bg"><?php print $result->title;?> <span><?php print $result->field_price_value;?></span></h2>
					<div class="property-listing-single">
        		<?php print $messages; ?>
            <?php if ($tabs = render($tabs)): ?>
            <div class="tabs"><?php print $tabs; ?></div>
            <?php endif; ?>
            <?php print render($page['help']); ?>
            <?php if ($action_links): ?>
            <ul class="action-links"><?php print render($action_links); ?></ul>
            <?php endif; ?>
						
              <!-- <div class="notification-listing">Open House</div> -->
              <div id="property-single-slider">
                <?php print $slides; ?>
                <?php print $subslides; ?>
              </div>
						<div class="clearfix"></div>
					</div>
					
					<?php print $result->body_value;?>					
					
					<?php print $features_output; ?>
					
					<div class="clearfix"></div>

					<div class="share-section-listing">
						<span class="share-text">Share this:</span>
						<script type="text/javascript">var switchTo5x=true;</script>
						<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
						<script type="text/javascript">stLight.options({publisher: "b779a7d6-8947-431e-8a89-abe575e1b4b0"}); </script>
						<span class='st_facebook' displayText='Facebook'></span>
						<span class='st_twitter' displayText='Tweet'></span>
						<span class='st_pinterest' displayText='Pinterest'></span>
						<span class='st_email' displayText='Email'></span>
						<span class="st_print"><a href="javascript:window.print()">Print</a></span>
						<div class="clearfix"></div>
					</div>
					<div class="clearfix"></div>
				</div><!-- close .content-boxed -->
				<br>				
				
				<?php print render($page['listingagent']);?>
				
			</div><!-- close #container-sidebar -->
			
			<div id="sidebar">
				<div class="content-boxed">
					<h2 class="title-bg">Location & Information</h2>
					<div id="sidebar-map">
						
						<div id="map-listing-single"></div>
						<script src="http://maps.google.com/maps/api/js?sensor=true" type="text/javascript"></script>
						<script src="<?php print $front_page;?>sites/all/themes/freehold/js/jquery.gomap-1.3.2.min.js"></script>
						<script type="text/javascript"> 
						jQuery(document).ready(function($) {
              $("#map-listing-single").goMap({ 
                markers: [{  
                  address: '<?php print $result->field_address_value . ' ' . $result->field_city_value . ' ' . $result->field_state_value . ' ' . $result->field_zip_value;?>', 
                  title: 'marker title 1' ,
                  icon: '<?php print $front_page;?>sites/all/themes/freehold/images/home.png'
                }],
                disableDoubleClickZoom: true,
                zoom: 12,
                maptype: 'ROADMAP'
              });
						});
						</script>

						</div>
						<div id="more-map">
						  <?php 
						  $address_formatted = trim($result->field_address_value).' '.ucwords(trim($result->field_city_value)) . ', ' . strtoupper(trim($result->field_state_value)) . ' ' . trim($result->field_zip_value);
						  $address_show = ucwords(trim($result->field_city_value)) . ', ' . strtoupper(trim($result->field_state_value)) . ' ' . trim($result->field_zip_value);						  
						  ?>
							<a href="https://maps.google.com/maps?q=<?php echo urlencode($address_formatted);?>&hl=en&sll=39.757846,-121.805901&sspn=0.196892,0.293884&hnear=<?php echo urlencode($address_formatted);?>&t=m&z=16&amp;output=embed?iframe=true&width=90%&height=90%" rel="prettyPhoto[iframes]">Larger Map &uarr;</a><!-- just plug in the address and leave other options alone -->
						</div>
						<div class="clearfix"></div>
						
						<div class="property-meta-single">
							<div class="listings-address-widget"><?php print $result->field_address_value;?></div>
							<div class="listings-street-widget"><?php print $address_show;?></div>
							<div class="listings-price-widget"><?php print $result->field_price_value;?></div>				
						</div>
						
						<ul id="house-details-sidebar">
							<!-- <li>Open House: <span>Fri 2/18, 2pm - 4pm</span></li> -->
							<li>Bedrooms:	<span><?php print $result->field_bedrooms_value;?></span></li>
							<li>Bathrooms:	<span><?php print $result->field_bathrooms_value;?></span></li>
							<li>Property type:	<span><?php print $result->name;?></span></li>
							<li>Size:	<span><?php print $result->field_property_size_value;?></span></li>
							<li>Added: <span><?php print ago($result->created);?></span></li>
							<li>Postcode:	<span><?php print $result->field_zip_value;?></span></li>
						</ul>	
				</div><!-- close .content-boxed -->
				
				
				<?php print render($page['sidebar']);?>

			</div><!-- close #sidebar -->
			
		<div class="clearfix"></div>
		</div><!-- close .width-container -->
	</div><!-- close #main -->




<?php 
require("footer.php"); 

function ago($time)
{
  $periods = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
  $lengths = array("60","60","24","7","4.35","12","10");
  
  $now = time();
  
     $difference     = $now - $time;
     $tense         = "ago";
  
  for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
     $difference /= $lengths[$j];
  }
  
  $difference = round($difference);
  
  if($difference != 1) {
     $periods[$j].= "s";
  }
  
  return "$difference $periods[$j] ago ";
}
?>