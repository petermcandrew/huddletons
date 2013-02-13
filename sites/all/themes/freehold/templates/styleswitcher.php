<?php

if(theme_get_setting("freehold_styleswitcher") == 1):

  $path = drupal_get_path('theme', 'freehold');
  include_once($path . '/theme-functions.inc');
  
  drupal_add_js($path . "/js/stylepicker.js");
	drupal_add_js($path . "/js/jquery.miniColors.js");
	  
  drupal_add_css($path . "/css/jquery.miniColors.css");	
  drupal_add_css($path . "/css/stylepicker.css");
  
  drupal_add_js(array(
    'stylepicker' => array(
      'base' => $GLOBALS['base_url'],
    )
  ), 'setting'); 
  
  $sizes = freehold_get_font_sizes(); 
  $families = freehold_fontface_get_enabled_fonts();  
  
  $sizeoptions = "<select class='font-size'>";
  foreach($sizes as $size){
    $sizeoptions .= "<option value='$size'>$size</option>";
  }
  $sizeoptions .= "</select>";
  
  $fontfams = "<select class='font-family'>";
  foreach($families as $fk => $fv){
    $fontfams .= '<option value="'.$fk.'">'.$fv.'</option>';
  }
  $fontfams .= "</select>";  
  
?>
<div id="stylepicker">
  <div id="gear"></div>
  <div id="desc">
    <span>Style Picker</span>
    <p>Easily customize your site from top to bottom. 40+ customizations and unlimited style / color variations</p>
  </div>
  
  <div class='style-container'>
    <span>Header</span><br />
    <input class="color-picker" type="text" id="styleswitcher-header-bgcolor" value="<?php print theme_get_setting('freehold_css_header_bgcolor');?>" size="10" maxlength="7" autocomplete="off"><br />
    <span>Navigation Color</span><br />
    <input class="color-picker" type="text" id="styleswitcher-navigation-color" value="<?php print theme_get_setting('freehold_css_navigation_bgcolor');?>" size="10" maxlength="7" autocomplete="off"><br />    
    <span>Input Buttons</span><br />
    <input class="color-picker" type="text" id="styleswitcher-input-color" value="<?php print theme_get_setting('freehold_css_inputbuttons_bgcolor');?>" size="10" maxlength="7" autocomplete="off"><br />
    <span>Link Buttons</span><br />
    <input class="color-picker" type="text" id="styleswitcher-link-color" value="<?php print theme_get_setting('freehold_css_linkbuttons_bgcolor');?>" size="10" maxlength="7" autocomplete="off"><br />
    
    <div id="nav-font-change">
      <span>Navigation Font Family: </span><br><?php print $fontfams;?>
    </div>
    <div id="body-font-change">
      <span>Body Font Family: </span><br><?php print $fontfams;?>
    </div> 
    <div id="headings-font-change">
      <span>Headings Font Family: </span><br><?php print $fontfams;?>
    </div>            
  </div>    
</div>

<?php 
endif;
?>