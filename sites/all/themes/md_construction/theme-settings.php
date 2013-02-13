<?php
function md_construction_form_system_theme_settings_alter(&$form, $form_state) {
  $form['options_settings'] = array(
    '#type' => 'fieldset',
    '#title' => t('Theme Specific Settings'),
    '#collapsible' => FALSE,
    '#collapsed' => FALSE
  );
	
	$form['options_settings']['md_construction_color'] = array(
    '#type'          => 'select',
    '#title'         => t('Colour Scheme'),
		'#description'   => t('Select the colour scheme for the theme'),
    '#default_value' => theme_get_setting('md_construction_color'),
    '#options'       => array(
                          'blue'   => t('Blue'),
													'orange'   => t('Orange'),
													'purple'   => t('Purple'),
													'green'   => t('Green'),
													'pink'   => t('Pink'),
													'brown'   => t('Brown'),
                        ),
  );

	
  $form['options_settings']['md_construction_image_url'] = array(
    '#type'          => 'textfield',
    '#title'         => t('Image URL'),
    '#description'   => t('Enter the link to your comingsoon images, image\'s dimension is more than 1100 × 939 pixels'),
    '#default_value' => theme_get_setting('md_construction_image_url'),
  );
	
	$form['options_settings']['md_construction_headtitle'] = array(
    '#type'          => 'textfield',
    '#title'         => t('Header title'),
    '#description'   => t('Enter title for your underconstruction page'),
    '#default_value' => theme_get_setting('md_construction_headtitle'),
  );
	
	$form['options_settings']['md_construction_desc'] = array(
    '#type'          => 'textarea',
    '#title'         => t('Description text'),
    '#description'   => t('Enter description text'),
    '#default_value' => theme_get_setting('md_construction_desc'),
  );
	
	$form['options_settings']['md_construction_feedburner'] = array(
    '#type'          => 'textfield',
    '#title'         => t('Mail feed Subscription'),
    '#description'   => t('Fill with Google FeedBurner account'),
    '#default_value' => theme_get_setting('md_construction_feedburner'),
  );
	
	$form['options_settings']['md_construction_twitter'] = array(
    '#type'          => 'textfield',
    '#title'         => t('Twitter username'),
    '#description'   => t('If you want to display twitter icon, fill this with your\'s twitter username'),
    '#default_value' => theme_get_setting('md_construction_twitter'),
  );
	
	$form['options_settings']['md_construction_facebook'] = array(
    '#type'          => 'textfield',
    '#title'         => t('Facebook link'),
    '#description'   => t('If you want to display facebook icon, fill this with your\'s facebook link without http://www.facebook.com/'),
    '#default_value' => theme_get_setting('md_construction_facebook'),
  );

	$form['options_settings']['md_construction_analytics'] = array(
    '#type'          => 'textarea',
    '#title'         => t('Google Analytics Code'),
    '#description'   => t('You can paste your Google Analytics or other tracking code in this box. This will be automatically added to the footer.'),
    '#default_value' => theme_get_setting('md_construction_analytics'),
  );
	
	$form['options_settings']['md_construction_css'] = array(
    '#type'          => 'textarea',
    '#title'         => t('Custom CSS'),
    '#description'   => t('Want to add any custom CSS code? Put in here, and the rest is taken care of. This overrides any other stylesheets. eg: a.button{color:green}'),
    '#default_value' => theme_get_setting('md_construction_css'),
  );

  // Return the form
  return $form;
}