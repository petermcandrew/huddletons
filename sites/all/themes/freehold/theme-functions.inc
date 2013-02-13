<?php

/**
 * Freehold Font Sizes
 */
function freehold_get_font_sizes(){
  $output = array();
  
  for($i = 8; $i <= 50; $i++){
    //if($i % 2 == 0) { $output[$i] = $i; }
    $output[$i] = $i;
  }
  
  return $output;
}

/**
 * Freehold Backgrounds
 */
function freehold_get_background_images(){
  
  $styles = array();
  $output = array();
	$images = drupal_get_path('theme', 'freehold') . '/img/backgrounds';
	if(is_dir($images)) {
		$styles = file_scan_directory($images, '/\.jpg$/i');
	}
	
	$output['none'] = "Blank";
	foreach($styles as $style) {
		$output[$style->uri] = $style->filename;
  }
	
	return $output;
}

/** 
 * Freehold Get @fontyourface Fonts.
 */
function freehold_fontface_get_enabled_fonts() {

  $fonts = array();
  $fonts['default'] = "Default";

	if (module_exists("fontyourface")) {
		
		//note, it's most ideal to enable your font's through the module interface, then use them for our selection since there are so many to choose from. 
		$enabled_fonts = fontyourface_get_fonts($where = "enabled = 1", $order_by = 'name ASC');
		
				
		foreach ($enabled_fonts as $font) {
			$font_css = fontyourface_font_css($font);
			
			$fonts[$font_css] = $font->name;
		}
	}
	
	return $fonts;
}

/**
 * Freehold write custom CSS file.
 * Interate through array and write an oranized file for use.
 */
function freehold_write_css_file($styles){

  //echo "<pre>"; print_r($styles); die();
  
  $output = NULL;
  $css = array();
  
  foreach($styles as $k => $v){
    
    $k = str_replace("freehold_css_", "", $k);
    $parser = explode("_", $k);
    
    $data = freehold_get_selectors($k, $v);
    
    foreach($data as $dk => $dv){
      $css[$dk][] = $dv;
    }
  }
  
  foreach($css as $sk => $sv){
    $css_row = NULL;
    foreach ($sv as $css_line){
      $css_row .= $css_line;
    }
    $output .= $sk."{" . $css_row . "}\n";
  }
 
 	$file = drupal_get_path('theme', 'freehold') . '/css/freehold.css';	
	$fp = @fopen($file, 'wb'); //write utf-8 file with our new styles
	@fwrite($fp, $output);
	
	@fclose($fp);   
}

/**
 * Freehold Selectors
 *
 * Doing it this way will allow room for growth in the admin settings, incase we need more selectors or attributes in a selector
 * Note: body at the top and bottom, yet the construction remains organized and clean.
 */
function freehold_get_selectors($k, $v){
  
  $path = $GLOBALS['base_url'];
  
  $fontfamily = $v.";";
  $fontsize = "font-size: ".$v."px;";
  $fontcolor = "color: $v;";
  $backgroundimage = "background:url('".$path."/".$v."') repeat top left;";
  $backgroundcolor = "background:".$v.";";
  
  if($v == "default" || $v == "none" || $v == "blank"){
    $fontfamily = NULL;
    $backgroundimage = NULL;
  }
  
  $selectors = array(
    "body_fontcolor" => array("body" => $fontcolor),
    "body_fontsize" => array("body" => $fontsize),
    "body_fontfamily" => array("body" => $fontfamily),

    "navigation_fontcolor" => array(".sf-menu a, .sf-menu a:visited" => $fontcolor),
    "navigation_fontfamily" => array(".sf-menu a, .sf-menu a:visited" => $fontfamily),
    "navigation_fontsize" => array(".sf-menu a, .sf-menu a:visited" => $fontsize),
    
    "headings_h1_fontcolor" => array("h1" => $fontcolor),
    "headings_h1_fontfamily" => array("h1" => $fontfamily),
    "headings_h1_fontsize" => array("h1" => $fontsize),
    "headings_h2_fontcolor" => array("h2" => $fontcolor),
    "headings_h2_fontfamily" => array("h2" => $fontfamily),
    "headings_h2_fontsize" => array("h2" => $fontsize),
    "headings_h3_fontcolor" => array("h3" => $fontcolor),
    "headings_h3_fontfamily" => array("h3" => $fontfamily),
    "headings_h3_fontsize" => array("h3" => $fontsize),
    "headings_h4_fontcolor" => array("h4" => $fontcolor),
    "headings_h4_fontfamily" => array("h4" => $fontfamily),
    "headings_h4_fontsize" => array("h4" => $fontsize),
    "headings_h5_fontcolor" => array("h5" => $fontcolor),
    "headings_h5_fontfamily" => array("h5" => $fontfamily),
    "headings_h5_fontsize" => array("h5" => $fontsize),
    
    "links_fontcolor" => array("a" => $fontcolor),

    "header_bgcolor" => array("header" => $backgroundcolor),
    "inputbuttons_bgcolor" => array("input.submit, input.submit-advanced, .button, #webform-client-form-5 input.form-submit, #edit-submit" => $backgroundcolor),
    "linkbuttons_bgcolor" => array("a.secondary-button, .notification-listing" => $backgroundcolor),            

  );
  
  return $selectors[$k];
}  

