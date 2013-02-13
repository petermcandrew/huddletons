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
 
require('styleswitcher.php'); 
?>

<div class="header-top">
	<div class="width-container">
		<div class="header-top-left">
			<span class="phone-header-top"><?php print theme_get_setting('freehold_phonenumber');?></span>
			<a href="mailto:<?php print theme_get_setting('freehold_contact_email');?>" class="email-header-top"><?php print theme_get_setting('freehold_contact_email');?></a>
		</div><!-- close .header-top-left -->
		<div class="social-icons">
		
		  <?php 
  		  $social_media['rss']['status'] == 1 ? print $social_media['rss']['header'] : NULL;
  		  $social_media['facebook']['status'] == 1 ? print $social_media['facebook']['header'] : NULL;
  		  $social_media['twitter']['status'] == 1 ? print $social_media['twitter']['header'] : NULL;
  		  $social_media['skype']['status'] == 1 ? print $social_media['skype']['header'] : NULL;
  		  $social_media['vimeo']['status'] == 1 ? print $social_media['vimeo']['header'] : NULL;
  		  $social_media['linkedin']['status'] == 1 ? print $social_media['linkedin']['header'] : NULL;
  		  $social_media['flickr']['status'] == 1 ? print $social_media['flickr']['header'] : NULL;
  		  $social_media['google']['status'] == 1 ? print $social_media['google']['header'] : NULL;
  		  $social_media['dribbble']['status'] == 1 ? print $social_media['dribbble']['header'] : NULL;
  		  $social_media['youtube']['status'] == 1 ? print $social_media['youtube']['header'] : NULL;
		  ?>

		</div><!-- close .social-icons -->
	<div class="clearfix"></div>
	</div><!-- close .width-container -->
</div>

<header>
	<div class="header-border-top"></div>
	<div class="width-container">
		
		<h1 id="logo"><a href="<?php print $front_page;?>"><img src="<?php print $logo;?>" alt="Freehold Theme"></a></h1>
		
		<nav>
      <?php print render($page['navigation']); ?>
		</nav>
		
	<div class="clearfix"></div>
	</div><!-- close .width-container -->
	<div class="header-border-bottom"></div>
</header>




<div id="search-container">
	<div class="width-container">
		<form method="get" class="searchform" action="<?php print $front_page;?>property-search">
			<label for="s" class="assistive-text">Search:</label>
			<input type="text" class="field" name="title" id="s" placeholder="Enter an address, neighborhood, zip or city..." />
			<input type="submit" class="submit" id="searchsubmit" value="Search" />
			
			<div class="clearfix"></div>
			<div id="panel-search">
				
				<div class="header-advanced-bedbath">
					<select name="rooms"> 
						<option value="All" selected="selected">Beds</option> 
						<option value="1">1</option> 
						<option value="2">2</option> 
						<option value="3">3</option> 
						<option value="4">4</option> 
						<option value="5">5</option> 
						<option value="6">6</option>
						<option value="7">7</option>						
					</select>
				</div>		
				
				<div class="header-advanced-bedbath">
					<select name="baths"> 
						<option value="All" selected="selected">Baths</option> 
						<option value="1">1</option> 
						<option value="2">2</option> 
						<option value="3">3</option> 
						<option value="4">4</option>
						<option value="5">5</option>
						<option value="6">6</option>
						<option value="7">7</option>																		
					</select>
				</div>
				
				<div class="header-advanced-bedbath">
					<select name="garage"> 
						<option value="All" selected="selected">Garage</option> 
						<option value="1">1</option> 
						<option value="2">2</option> 
						<option value="3">3</option> 
						<option value="4">4</option>
						<option value="5">5</option>
						<option value="6">6</option>
						<option value="7">7</option>																		
					</select>
				</div>				
								
				<div class="header-prop-typestatus">
					<select name="type"> 
						<option value="All" selected="selected">Property Types</option> 
						<option value="5">Apartment</option>
						<option value="3">Condo</option>
						<option value="4">Mansion</option>
						<option value="2">Multi-Family</option>
						<option value="7">Other</option>
						<option value="1">Single Family</option>
						<option value="6">Villa</option>																								
					</select>
				</div>
				
				<div class="header-prop-typestatus hidden-value-tablet">
					<select name="status"> 
						<option value="All" selected="selected">Property Status</option> 
						<option value="9">For Rent</option> 
						<option value="8">For Sale</option> 
						<option value="10">Open House</option> 
						<option value="11">Sold</option> 						
					</select>
				</div>
				
				<a class="more-search-options" href="#blanksearch">More search options</a>
		
			</div>
			
		</form>
	</div><!-- close width-container -->
	
	
	
<div class="clearfix"></div>
</div><!-- close #search-container -->

<div class="width-container">
	<a href="#" class="search-drop-down">Search More</a>
</div>

