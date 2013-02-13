<?php

include_once(dirname(__FILE__) . '/theme-functions.inc');

/*
 * Implements hook_form_system_settings_alter().
 */
function freehold_form_system_theme_settings_alter(&$form, &$form_state) {  

  // we don't need these settings for this theme.
  unset($form['theme_settings']);
  
  $path = drupal_get_path('theme', 'freehold');
  $zoom = array();
  for($i = 1; $i <= 20; $i++){
    $zoom[$i] = $i;
  }
  
  drupal_add_css($path . "/css/admin.css");
  drupal_add_css($path . "/css/jquery.miniColors.css");	
  drupal_add_js($path . "/js/jquery.miniColors.js");
  drupal_add_js($path . "/js/admin.js");	
  
  $form['logo']['settings']['logo_path']['#description'] = t('The path to the file you would like to use as your logo file instead of the default logo. <br /> NOTE: Try and use these settings for a nice logo: 250px X 80px');
  
  /** output for the theme header
  -----------------------------------------------------------------------------**/
  $form['header'] = array(
    '#type'   =>  'item',
    '#markup' =>  '
      <div id="top">
      <a id="logo" href="http://www.splashedmarketing.com" target="_blank"></a>
      <div id="wrapper">
      <div class="desc">Freehold</span></div>
      <div class="support"><a target="_blank" href="http://support.splashedmarketing.com">Support</a></div>
      </div>	
      <p>Use the theme settings below to customize your website from top to bottom.  <br>For any additional customizations to your theme and / or website, feel free to contact us! <a href="mailto:kherda@splashedmarketing.com">kherda@splashedmarketing.com</a></p>
      </div>',
    '#weight' => -1000,
  );
  
  /** Vertical Tab Container
  -----------------------------------------------------------------------------**/
  $form['freehold_settings'] = array(
    '#type' => 'vertical_tabs',
    '#weight' => -999,
  );
  
  /** Theme Customization
  -----------------------------------------------------------------------------**/
  $form['freehold_settings']['settings']['theme'] = array(
    '#type' => 'fieldset',
    '#weight' => -990,
    '#title' => t('Theme Settings'),
    '#description' => t('Feel free to easily change out specific theme colors of your website by using the color picker below. <br /><br />'),
  );
  $form['freehold_settings']['settings']['theme']['header'] = array(
    '#type' => 'fieldset',
    '#weight' => -990,
    '#title' => t('Header'),
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
  );
  $form['freehold_settings']['settings']['theme']['header']['freehold_css_header_bgcolor'] = array(
    '#type' => 'textfield',
    '#weight' => -98,
    '#title' => t('Header Background Color'),
    '#default_value' => theme_get_setting('freehold_css_header_bgcolor'),
    '#size' => 10,
    '#attributes' => array(
      'class' => array('color-picker'),
    ),   
  );

  $form['freehold_settings']['settings']['theme']['header']['freehold_header_bgmarkup'] = array(
    '#type'   =>  'item',
    '#markup' =>  '<div id="freehold-header" style="background-color:'.theme_get_setting('freehold_css_header_bgcolor').'"></div>',
  );
  
  $form['freehold_settings']['settings']['theme']['inputbuttons'] = array(
    '#type' => 'fieldset',
    '#weight' => -970,
    '#title' => t('Inputs'),
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,  		
  );
  $form['freehold_settings']['settings']['theme']['inputbuttons']['freehold_css_inputbuttons_bgcolor'] = array(
    '#type' => 'textfield',
    '#weight' => -98,
    '#title' => t('Input Button Color'),
    '#default_value' => theme_get_setting('freehold_css_inputbuttons_bgcolor'),
    '#size' => 10,
    '#attributes' => array(
      'class' => array('color-picker'),
    ),   
  );
  $form['freehold_settings']['settings']['theme']['inputbuttons']['freehold_inputbuttons_bgmarkup'] = array(
    '#type'   =>  'item',
    '#markup' =>  '<div id="freehold-inputbuttons" style="background-color:'.theme_get_setting('freehold_css_inputbuttons_bgcolor').'"></div>',
  );
  $form['freehold_settings']['settings']['theme']['linkbuttons'] = array(
    '#type' => 'fieldset',
    '#weight' => -960,
    '#title' => t('Link Buttons'),
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,  		
  );
  $form['freehold_settings']['settings']['theme']['linkbuttons']['freehold_css_linkbuttons_bgcolor'] = array(
    '#type' => 'textfield',
    '#weight' => -98,
    '#title' => t('Link Button Color'),
    '#default_value' => theme_get_setting('freehold_css_linkbuttons_bgcolor'),
    '#size' => 10,
    '#attributes' => array(
      'class' => array('color-picker'),
    ),   
  );
  $form['freehold_settings']['settings']['theme']['linkbuttons']['freehold_linkbuttons_bgmarkup'] = array(
    '#type'   =>  'item',
    '#markup' =>  '<div id="freehold-linkbuttons" style="background-color:'.theme_get_setting('freehold_css_linkbuttons_bgcolor').'"></div>',
  );                  
  
  /** All Typography
  -----------------------------------------------------------------------------**/
  $form['freehold_settings']['settings']['typography'] = array(
    '#type' => 'fieldset',
    '#weight' => -990,
    '#title' => t('Typography'),
    '#description' => t('The typography settings allow you to change font family, font size and font color throughout your site.  <i>Note: If you would like to add more fonts, simply go to appearance -> @fontyourface</i><br /><br />'),
  );
  /** Body **/
  $form['freehold_settings']['settings']['typography']['body'] = array(
    '#type' => 'fieldset',
    '#title' => t('Body'),
    '#weight' => -999,
    '#description' => 'You can change the body font size, family and color here.',
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  );  
  $form['freehold_settings']['settings']['typography']['body']['freehold_css_body_fontfamily'] = array(
    '#type' => 'select',
    '#weight' => -97,
    '#title' => t('Font Family'),
    '#default_value' => theme_get_setting('freehold_css_body_fontfamily'),
    '#options' => freehold_fontface_get_enabled_fonts(),
  );
  $form['freehold_settings']['settings']['typography']['body']['freehold_css_body_fontsize'] = array(
    '#type' => 'select',
    '#weight' => -96,
    '#title' => t('Font Size'),
    '#default_value' => theme_get_setting('freehold_css_body_fontsize'),
    '#options' => freehold_get_font_sizes(),
  );  	  
  
  /** Navigation **/
  $form['freehold_settings']['settings']['typography']['navigation'] = array(
    '#type' => 'fieldset',
    '#title' => t('Navigation'),
    '#weight' => -980,
    '#description' => 'Settings for your navigation bar',
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  );
  $form['freehold_settings']['settings']['typography']['navigation']['freehold_css_navigation_fontcolor'] = array(
    '#type' => 'textfield',
    '#weight' => -98,
    '#title' => t('Logo Color'),
    '#default_value' => theme_get_setting('freehold_css_navigation_fontcolor'),
    '#size' => 10,
    '#attributes' => array(
      'class' => array('color-picker'),
    ),
  );
  $form['freehold_settings']['settings']['typography']['navigation']['freehold_css_navigation_fontfamily'] = array(
    '#type' => 'select',
    '#weight' => -97,
    '#title' => t('Font Family'),
    '#default_value' => theme_get_setting('freehold_css_navigation_fontfamily'),
    '#options' => freehold_fontface_get_enabled_fonts(),
  );
  $form['freehold_settings']['settings']['typography']['navigation']['freehold_css_navigation_fontsize'] = array(
    '#type' => 'select',
    '#weight' => -96,
    '#title' => t('Font Size'),
    '#default_value' => theme_get_setting('freehold_css_navigation_fontsize'),
    '#options' => freehold_get_font_sizes(),
  );  	  

  /** Headings **/
  $form['freehold_settings']['settings']['typography']['headings'] = array(
    '#type' => 'fieldset',
    '#title' => t('Headings'),
    '#weight' => -970,
    '#description' => 'Settings for all your headings (h1, h2, h3, h4, h5)',
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  );
  
  /** H1 **/
  $form['freehold_settings']['settings']['typography']['headings']['h1_styles'] = array(
    '#type' => 'fieldset',
    '#title' => t('H1'),
    '#weight' => -970,
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  ); 
  $form['freehold_settings']['settings']['typography']['headings']['h1_styles']['freehold_css_headings_h1_fontcolor'] = array(
    '#type' => 'textfield',
    '#weight' => -98,
    '#title' => t('Color'),
    '#default_value' => theme_get_setting('freehold_css_headings_h1_fontcolor'),
    '#size' => 10,
    '#attributes' => array(
      'class' => array('color-picker'),
    ),
  );
  $form['freehold_settings']['settings']['typography']['headings']['h1_styles']['freehold_css_headings_h1_fontfamily'] = array(
    '#type' => 'select',
    '#weight' => -96,
    '#title' => t('Font Family'),
    '#default_value' => theme_get_setting('freehold_css_headings_h1_fontfamily'),
    '#options' => freehold_fontface_get_enabled_fonts(),
  );
  $form['freehold_settings']['settings']['typography']['headings']['h1_styles']['freehold_css_headings_h1_fontsize'] = array(
    '#type' => 'select',
    '#weight' => -97,
    '#title' => t('Font Size'),
    '#default_value' => theme_get_setting('freehold_css_headings_h1_fontsize'),
    '#options' => freehold_get_font_sizes(),
  );    		    
  
  /** H2 **/
  $form['freehold_settings']['settings']['typography']['headings']['h2_styles'] = array(
    '#type' => 'fieldset',
    '#title' => t('H2'),
    '#weight' => -960,
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  ); 
  $form['freehold_settings']['settings']['typography']['headings']['h2_styles']['freehold_css_headings_h2_fontcolor'] = array(
    '#type' => 'textfield',
    '#weight' => -98,
    '#title' => t('Color'),
    '#default_value' => theme_get_setting('freehold_css_headings_h2_fontcolor'),
    '#size' => 10,
    '#attributes' => array(
      'class' => array('color-picker'),
    ),
  );
  $form['freehold_settings']['settings']['typography']['headings']['h2_styles']['freehold_css_headings_h2_fontfamily'] = array(
    '#type' => 'select',
    '#weight' => -96,
    '#title' => t('Font Family'),
    '#default_value' => theme_get_setting('freehold_css_headings_h2_fontfamily'),
    '#options' => freehold_fontface_get_enabled_fonts(),
  );
  $form['freehold_settings']['settings']['typography']['headings']['h2_styles']['freehold_css_headings_h2_fontsize'] = array(
    '#type' => 'select',
    '#weight' => -97,
    '#title' => t('Font Size'),
    '#default_value' => theme_get_setting('freehold_css_headings_h2_fontsize'),
    '#options' => freehold_get_font_sizes(),
  );    		    
  
  /** H3 **/
  $form['freehold_settings']['settings']['typography']['headings']['h3_styles'] = array(
    '#type' => 'fieldset',
    '#title' => t('H3'),
    '#weight' => -950,
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  ); 
  $form['freehold_settings']['settings']['typography']['headings']['h3_styles']['freehold_css_headings_h3_fontcolor'] = array(
    '#type' => 'textfield',
    '#weight' => -98,
    '#title' => t('Logo Color'),
    '#default_value' => theme_get_setting('freehold_css_headings_h3_fontcolor'),
    '#size' => 10,
    '#attributes' => array(
      'class' => array('color-picker'),
    ),
  );
  $form['freehold_settings']['settings']['typography']['headings']['h3_styles']['freehold_css_headings_h3_fontfamily'] = array(
    '#type' => 'select',
    '#weight' => -96,
    '#title' => t('Font Family'),
    '#default_value' => theme_get_setting('freehold_css_headings_h3_fontfamily'),
    '#options' => freehold_fontface_get_enabled_fonts(),
  );
  $form['freehold_settings']['settings']['typography']['headings']['h3_styles']['freehold_css_headings_h3_fontsize'] = array(
    '#type' => 'select',
    '#weight' => -97,
    '#title' => t('Font Size'),
    '#default_value' => theme_get_setting('freehold_css_headings_h3_fontsize'),
    '#options' => freehold_get_font_sizes(),
  );    		    
  
  /** H4 **/
  $form['freehold_settings']['settings']['typography']['headings']['h4_styles'] = array(
    '#type' => 'fieldset',
    '#title' => t('H4'),
    '#weight' => -940,
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  ); 
  $form['freehold_settings']['settings']['typography']['headings']['h4_styles']['freehold_css_headings_h4_fontcolor'] = array(
    '#type' => 'textfield',
    '#weight' => -98,
    '#title' => t('Logo Color'),
    '#default_value' => theme_get_setting('freehold_css_headings_h4_fontcolor'),
    '#size' => 10,
    '#attributes' => array(
      'class' => array('color-picker'),
    ),
  );
  $form['freehold_settings']['settings']['typography']['headings']['h4_styles']['freehold_css_headings_h4_fontfamily'] = array(
    '#type' => 'select',
    '#weight' => -96,
    '#title' => t('Font Family'),
    '#default_value' => theme_get_setting('freehold_css_headings_h4_fontfamily'),
    '#options' => freehold_fontface_get_enabled_fonts(),
  );
  $form['freehold_settings']['settings']['typography']['headings']['h4_styles']['freehold_css_headings_h4_fontsize'] = array(
    '#type' => 'select',
    '#weight' => -97,
    '#title' => t('Font Size'),
    '#default_value' => theme_get_setting('freehold_css_headings_h4_fontsize'),
    '#options' => freehold_get_font_sizes(),
  );    		    
  
  /** H5 **/
  $form['freehold_settings']['settings']['typography']['headings']['h5_styles'] = array(
    '#type' => 'fieldset',
    '#title' => t('H5'),
    '#weight' => -930,
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  ); 
  $form['freehold_settings']['settings']['typography']['headings']['h5_styles']['freehold_css_headings_h5_fontcolor'] = array(
    '#type' => 'textfield',
    '#weight' => -98,
    '#title' => t('Logo Color'),
    '#default_value' => theme_get_setting('freehold_css_headings_h5_fontcolor'),
    '#size' => 10,
    '#attributes' => array(
      'class' => array('color-picker'),
    ),
  );
  $form['freehold_settings']['settings']['typography']['headings']['h5_styles']['freehold_css_headings_h5_fontfamily'] = array(
    '#type' => 'select',
    '#weight' => -96,
    '#title' => t('Font Family'),
    '#default_value' => theme_get_setting('freehold_css_headings_h5_fontfamily'),
    '#options' => freehold_fontface_get_enabled_fonts(),
  );
  $form['freehold_settings']['settings']['typography']['headings']['h5_styles']['freehold_css_headings_h5_fontsize'] = array(
    '#type' => 'select',
    '#weight' => -97,
    '#title' => t('Font Size'),
    '#default_value' => theme_get_setting('freehold_css_headings_h5_fontsize'),
    '#options' => freehold_get_font_sizes(),
  );

  /** Links **/
  $form['freehold_settings']['settings']['typography']['links'] = array(
    '#type' => 'fieldset',
    '#title' => t('Links'),
    '#weight' => -960,
    '#description' => 'You can change the link color if you would like.',
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  );
  $form['freehold_settings']['settings']['typography']['links']['freehold_css_links_fontcolor'] = array(
    '#type' => 'textfield',
    '#weight' => -98,
    '#title' => t('Logo Color'),
    '#default_value' => theme_get_setting('freehold_css_links_fontcolor'),
    '#size' => 10,
    '#attributes' => array(
      'class' => array('color-picker'),
    ),
  );

  /** Social Media   
  -----------------------------------------------------------------------------**/
  $form['freehold_settings']['settings']['social'] = array(
    '#type' => 'fieldset',
    '#weight' => -970,
    '#title' => t('Social Media'),
    '#description' => t('Add social media to your site by altering these links.  If you don\'t wish to have a specific social media option on your website, just leave it empty!<br><br>'),
  );
  $form['freehold_settings']['settings']['social']['freehold_social_rss'] = array(
    '#type' => 'textfield',
    '#title' => t('RSS'),
    '#default_value' => theme_get_setting('freehold_social_rss'),
  );
  $form['freehold_settings']['settings']['social']['freehold_social_facebook'] = array(
    '#type' => 'textfield',
    '#title' => t('Facebook'),
    '#default_value' => theme_get_setting('freehold_social_facebook'),
  );
  $form['freehold_settings']['settings']['social']['freehold_social_twitter'] = array(
    '#type' => 'textfield',
    '#title' => t('Twitter'),
    '#default_value' => theme_get_setting('freehold_social_twitter'),
  );
  $form['freehold_settings']['settings']['social']['freehold_social_skype'] = array(
    '#type' => 'textfield',
    '#title' => t('Skype'),
    '#default_value' => theme_get_setting('freehold_social_skype'),
  );
  $form['freehold_settings']['settings']['social']['freehold_social_vimeo'] = array(
    '#type' => 'textfield',
    '#title' => t('Vimeo'),
    '#default_value' => theme_get_setting('freehold_social_vimeo'),
  );
  $form['freehold_settings']['settings']['social']['freehold_social_linkedin'] = array(
    '#type' => 'textfield',
    '#title' => t('LinkedIn'),
    '#default_value' => theme_get_setting('freehold_social_linkedin'),
  );
  $form['freehold_settings']['settings']['social']['freehold_social_dribbble'] = array(
    '#type' => 'textfield',
    '#title' => t('Dribbble'),
    '#default_value' => theme_get_setting('freehold_social_dribbble'),
  );
  $form['freehold_settings']['settings']['social']['freehold_social_youtube'] = array(
    '#type' => 'textfield',
    '#title' => t('Youtube'),
    '#default_value' => theme_get_setting('freehold_social_youtube'),
  );
  $form['freehold_settings']['settings']['social']['freehold_social_google'] = array(
    '#type' => 'textfield',
    '#title' => t('Google'),
    '#default_value' => theme_get_setting('freehold_social_google'),
  );
  $form['freehold_settings']['settings']['social']['freehold_social_flikr'] = array(
    '#type' => 'textfield',
    '#title' => t('Flickr'),
    '#default_value' => theme_get_setting('freehold_social_flikr'),
  );          

  /** Miscellaneous
  -----------------------------------------------------------------------------**/
  $form['freehold_settings']['settings']['miscellaneous'] = array(
    '#type' => 'fieldset',
    '#weight' => -960,
    '#title' => t('Miscellaneous'),
    '#description' => t('Other general website theme settings are available here.  <br><br>'),
  );
  $form['freehold_settings']['settings']['miscellaneous']['freehold_copywrite'] = array(
    '#type' => 'textfield',
    '#title' => t('Copywrite Text'),
    '#default_value' => theme_get_setting('freehold_copywrite'),
  );
  $form['freehold_settings']['settings']['miscellaneous']['freehold_company_name'] = array(
    '#type' => 'textfield',
    '#title' => t('Company Name'),
    '#description' => t('The company name will show in the google map in the contact page'),
    '#default_value' => theme_get_setting('freehold_company_name'),
  );  
  $form['freehold_settings']['settings']['miscellaneous']['freehold_address'] = array(
    '#type' => 'textfield',
    '#title' => t('Address'),
    '#default_value' => theme_get_setting('freehold_address'),
  );
  $form['freehold_settings']['settings']['miscellaneous']['freehold_city'] = array(
    '#type' => 'textfield',
    '#title' => t('City'),
    '#default_value' => theme_get_setting('freehold_city'),
  );
  $form['freehold_settings']['settings']['miscellaneous']['freehold_state'] = array(
    '#type' => 'textfield',
    '#title' => t('State'),
    '#default_value' => theme_get_setting('freehold_state'),
  );
  $form['freehold_settings']['settings']['miscellaneous']['freehold_zip'] = array(
    '#type' => 'textfield',
    '#title' => t('Zip'),
    '#default_value' => theme_get_setting('freehold_zip'),
  );        
  $form['freehold_settings']['settings']['miscellaneous']['freehold_phonenumber'] = array(
    '#type' => 'textfield',
    '#title' => t('Phone Number'),
    '#default_value' => theme_get_setting('freehold_phonenumber'),
  );
  $form['freehold_settings']['settings']['miscellaneous']['freehold_contact_email'] = array(
    '#type' => 'textfield',
    '#title' => t('Contact Email Address'),
    '#default_value' => theme_get_setting('freehold_contact_email'),
  );
  $form['freehold_settings']['settings']['miscellaneous']['freehold_styleswitcher'] = array(
    '#type' => 'radios',
    '#title' => t('Sidebar Style Switcher'),
    '#description' => t('This is generally used for testing... turn off in a production website.'),
    '#default_value' => theme_get_setting('freehold_styleswitcher'),
    '#options' => array(1 => 'On', 0 => 'Off')
  );
  $form['freehold_settings']['settings']['miscellaneous']['freehold_google_listing_zoom'] = array(
    '#type' => 'select',
    '#title' => t('Google Property Listing Zoom'),
    '#description' => t('How close in Google Maps should zoom by default'),
    '#default_value' => theme_get_setting('freehold_google_listing_zoom'),
    '#options' => $zoom,
  );
  $form['freehold_settings']['settings']['miscellaneous']['freehold_google_contact_zoom'] = array(
    '#type' => 'select',
    '#title' => t('Google Contact Zoom'),
    '#description' => t('How close in Google Maps should zoom by default'),    
    '#default_value' => theme_get_setting('freehold_google_contact_zoom'),
    '#options' => $zoom,
  );        

  $form['#submit'][] = 'freehold_custom_settings_submit';
  
  $form['reset'] = array(
  '#type' => 'submit',
  '#value' => t('Reset Theme'),
  '#name' => 'Submit',
  '#submit' => array('freehold_theme_reset'),
  '#weight' => 10000,
  );

  return $form;  
}

/*
 * Custom submit handler
 */
function freehold_custom_settings_submit($form, &$form_state){

  $styles = array();  
  
  $values = $form_state['values'];
  foreach($values as $key => $value) {
  
    if(stristr($key, "css")){
      $styles[$key] = $value;
    }
  }
    
  freehold_write_css_file($styles);
}

/*
 * Custom reset handler
 */
function freehold_theme_reset($form, &$form_state){

  $file = drupal_get_path('theme', 'freehold') . '/css/freehold.css';	
  $fp = @fopen($file, 'wb'); //write utf-8 file with our new styles
  @fwrite($fp, "");
  
  variable_del('theme_freehold_settings');
}
