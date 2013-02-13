<?php

/**
 * @file
 * Contains theme override functions and preprocess functions for the theme.
 *
 * ABOUT THE TEMPLATE.PHP FILE
 *
 *   The template.php file is one of the most useful files when creating or
 *   modifying Drupal themes. You can modify or override Drupal's theme
 *   functions, intercept or make additional variables available to your theme,
 *   and create custom PHP logic. For more information, please visit the Theme
 *   Developer's Guide on Drupal.org: http://drupal.org/theme-guide
 *
 * OVERRIDING THEME FUNCTIONS
 *
 *   The Drupal theme system uses special theme functions to generate HTML
 *   output automatically. Often we wish to customize this HTML output. To do
 *   this, we have to override the theme function. You have to first find the
 *   theme function that generates the output, and then "catch" it and modify it
 *   here. The easiest way to do it is to copy the original function in its
 *   entirety and paste it here, changing the prefix from theme_ to STARTERKIT_.
 *   For example:
 *
 *     original: theme_breadcrumb()
 *     theme override: STARTERKIT_breadcrumb()
 *
 *   where STARTERKIT is the name of your sub-theme. For example, the
 *   zen_classic theme would define a zen_classic_breadcrumb() function.
 *
 *   If you would like to override either of the two theme functions used in Zen
 *   core, you should first look at how Zen core implements those functions:
 *     theme_breadcrumbs()      in zen/template.php
 *     theme_menu_local_tasks() in zen/template.php
 *
 *   For more information, please visit the Theme Developer's Guide on
 *   Drupal.org: http://drupal.org/node/173880
 *
 * CREATE OR MODIFY VARIABLES FOR YOUR THEME
 *
 *   Each tpl.php template file has several variables which hold various pieces
 *   of content. You can modify those variables (or add new ones) before they
 *   are used in the template files by using preprocess functions.
 *
 *   This makes THEME_preprocess_HOOK() functions the most powerful functions
 *   available to themers.
 *
 *   It works by having one preprocess function for each template file or its
 *   derivatives (called template suggestions). For example:
 *     THEME_preprocess_page    alters the variables for page.tpl.php
 *     THEME_preprocess_node    alters the variables for node.tpl.php or
 *                              for node-forum.tpl.php
 *     THEME_preprocess_comment alters the variables for comment.tpl.php
 *     THEME_preprocess_block   alters the variables for block.tpl.php
 *
 *   For more information on preprocess functions and template suggestions,
 *   please visit the Theme Developer's Guide on Drupal.org:
 *   http://drupal.org/node/223440
 *   and http://drupal.org/node/190815#template-suggestions
 */


/**
 * Override or insert variables into the html templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("html" in this case.)
 */
/* -- Delete this line if you want to use this function
function STARTERKIT_preprocess_html(&$variables, $hook) {
  $variables['sample_variable'] = t('Lorem ipsum.');

  // The body tag's classes are controlled by the $classes_array variable. To
  // remove a class from $classes_array, use array_diff().
  //$variables['classes_array'] = array_diff($variables['classes_array'], array('class-to-remove'));
}
// */

/**
 * Override or insert variables into the page templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("page" in this case.)
 */ 
function freehold_preprocess_page(&$variables) {
  
  $social = array();
  $social["rss"] = array(
    "status" => strlen(theme_get_setting('freehold_social_rss')) > 1 ? 1 : 0,
    "header" => '<a class="rss" href="' . theme_get_setting('freehold_social_rss') . '" target="_blank">r</a>',
    "sidebar" => '<a href="' . theme_get_setting('freehold_social_rss') . '" target="_blank" class="social-rss">RSS</a>',    
  );
  $social["facebook"] = array(
    "status" => strlen(theme_get_setting('freehold_social_facebook')) > 1 ? 1 : 0,
    "header" => '<a class="facebook" href="' . theme_get_setting('freehold_social_facebook') . '" target="_blank">f</a>',
    "sidebar" => '<a href="' . theme_get_setting('freehold_social_facebook') . '" target="_blank" class="social-facebook">Facebook</a>',
  );
  $social["twitter"] = array(
    "status" => strlen(theme_get_setting('freehold_social_twitter')) > 1 ? 1 : 0,
    "header" => '<a class="twitter" href="' . theme_get_setting('freehold_social_twitter') . '" target="_blank">t</a>',
    "sidebar" => '<a href="' . theme_get_setting('freehold_social_twitter') . '" target="_blank" class="social-twitter">Twitter</a>',
  );
  $social["skype"] = array(
    "status" => strlen(theme_get_setting('freehold_social_skype')) > 1 ? 1 : 0,
    "header" => '<a class="skype" href="' . theme_get_setting('freehold_social_skype') . '" target="_blank">s</a>',
    "sidebar" => '<a href="' . theme_get_setting('freehold_social_skype') . '" target="_blank" class="social-skype">skype</a>',
  );
  $social["vimeo"] = array(
    "status" => strlen(theme_get_setting('freehold_social_vimeo')) > 1 ? 1 : 0,
    "header" => '<a class="vimeo" href="' . theme_get_setting('freehold_social_vimeo') . '" target="_blank">v</a>',
    "sidebar" => '<a href="' . theme_get_setting('freehold_social_vimeo') . '" target="_blank" class="social-vimeo">Vimeo</a>',    
  );
  $social["linkedin"] = array(
    "status" => strlen(theme_get_setting('freehold_social_linkedin')) > 1 ? 1 : 0,
    "header" => '<a class="linkedin" href="' . theme_get_setting('freehold_social_linkedin') . '" target="_blank">l</a>',
    "sidebar" => '<a href="' . theme_get_setting('freehold_social_linkedin') . '" target="_blank" class="social-linkedin">linkedin</a>',    
  );
  $social["flickr"] = array(
    "status" => strlen(theme_get_setting('freehold_social_flickr')) > 1 ? 1 : 0,
    "header" => '<a class="flickr" href="' . theme_get_setting('freehold_social_flickr') . '" target="_blank">f</a>',
    "sidebar" => '<a href="' . theme_get_setting('freehold_social_flickr') . '" target="_blank" class="social-flickr">flickr</a>',    
  );
  $social["google"] = array(
    "status" => strlen(theme_get_setting('freehold_social_google')) > 1 ? 1 : 0,
    "header" => '<a class="google" href="' . theme_get_setting('freehold_social_google') . '" target="_blank">g</a>',
    "sidebar" => '<a href="' . theme_get_setting('freehold_social_google') . '" target="_blank" class="social-google">google</a>',    
  );
  $social["dribbble"] = array(
    "status" => strlen(theme_get_setting('freehold_social_dribbble')) > 1 ? 1 : 0,
    "header" => '<a class="dribbble" href="' . theme_get_setting('freehold_social_dribbble') . '" target="_blank">d</a>',
    "sidebar" => '<a href="' . theme_get_setting('freehold_social_dribbble') . '" target="_blank" class="social-dribbble">Dribbble</a>',    
  );
  $social["youtube"] = array(
    "status" => strlen(theme_get_setting('freehold_social_youtube')) > 1 ? 1 : 0,
    "header" => '<a class="youtube" href="' . theme_get_setting('freehold_social_youtube') . '" target="_blank">y</a>',
    "sidebar" => '<a href="' . theme_get_setting('freehold_social_youtube') . '" target="_blank" class="social-youtube">Youtube</a>',    
  );                  
  
  $variables['social_media'] = $social;
  
  if (isset($variables['node']->type)) {
    $variables['theme_hook_suggestions'][] = 'page__' . $variables['node']->type;
  }
}


/**
 * Override or insert variables into the node templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("node" in this case.)
 */
/* -- Delete this line if you want to use this function
function STARTERKIT_preprocess_node(&$variables, $hook) {
  $variables['sample_variable'] = t('Lorem ipsum.');

  // Optionally, run node-type-specific preprocess functions, like
  // STARTERKIT_preprocess_node_page() or STARTERKIT_preprocess_node_story().
  $function = __FUNCTION__ . '_' . $variables['node']->type;
  if (function_exists($function)) {
    $function($variables, $hook);
  }
}
// */


/**
 * Override or insert variables into the block templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("block" in this case.)
 */
/* -- Delete this line if you want to use this function
function STARTERKIT_preprocess_block(&$variables, $hook) {
  // Add a count to all the blocks in the region.
  $variables['classes_array'][] = 'count-' . $variables['block_id'];
}
// */

function freehold_css_alter(&$css) { 
    unset($css[drupal_get_path('module','system').'/system.menus.css']); 
    unset($css[drupal_get_path('module','system').'/system.theme.css']);     
}

function freehold_menu_tree(&$variables) {
  return '<ul class="sf-menu">' . $variables['tree'] . '</ul>';
}

/**
 * Override or insert variables into the block templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("block" in this case.)
 */
function freehold_process_block(&$variables, $hook) {
  // Drupal 7 should use a $title variable instead of $block->subject.
  $variables['title'] = $variables['block']->subject;
}
