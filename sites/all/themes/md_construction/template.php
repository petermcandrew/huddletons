<?php
// Auto-rebuild the theme registry during theme development.
if (theme_get_setting('md_construction_rebuild_registry')) {
  drupal_rebuild_theme_registry();
}

/*
 *	 This function creates the body classes that are relative to each page
 *	
 *	@param $vars
 *	  A sequential array of variables to pass to the theme template.
 *	@param $hook
 *	  The name of the theme function being called ("page" in this case.)
 */

function md_construction_preprocess_page(&$vars, $hook) {
  $vars['md_construction_color'] = theme_get_setting('md_construction_color');
	$vars['md_construction_image_url'] = theme_get_setting('md_construction_image_url');
	$vars['md_construction_headtitle'] = theme_get_setting('md_construction_headtitle');
	$vars['md_construction_desc'] = theme_get_setting('md_construction_desc');
	$vars['md_construction_feedburner'] = theme_get_setting('md_construction_feedburner');
	$vars['md_construction_twitter'] = theme_get_setting('md_construction_twitter');
	$vars['md_construction_facebook'] = theme_get_setting('md_construction_facebook');
	$vars['md_construction_analytics'] = theme_get_setting('md_construction_analytics');
	$vars['md_construction_css'] = theme_get_setting('md_construction_css');
}

function md_construction_preprocess_html(&$vars, $hook) {
		global $base_path;
		$vars['theme_path'] = $base_path . path_to_theme();
		$vars['md_construction_color'] = theme_get_setting('md_construction_color');
		$vars['md_construction_css'] = theme_get_setting('md_construction_css');
}