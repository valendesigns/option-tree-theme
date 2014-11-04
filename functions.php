<?php
/**
 * OptionTree Theme version
 */
define( 'OT_THEME_VERSION', '2.4.3' );

/**
 * Register Theme Features
 */
function option_tree_theme_setup()  {

  /**
   * Add support for i18n Theme Translation
   * See http://codex.wordpress.org/I18n_for_WordPress_Developers
   */
  load_theme_textdomain( 'option-tree-theme', get_template_directory() . '/languages' );
  
  // Enable support for Post Thumbnails.
  add_theme_support( 'post-thumbnails' );

  /**
   * Enable support for all Post Formats.
   * See http://codex.wordpress.org/Post_Formats
   */
  add_theme_support( 'post-formats', array(
    'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat'
  ) );
  
}
add_action( 'after_setup_theme', 'option_tree_theme_setup' );

/**
 * Filters the Theme Options ID
 */
function filter_demo_options_id() {
  return 'demo_option_tree';
}
add_filter( 'ot_options_id', 'filter_demo_options_id' );

/**
 * Filters the Settings ID
 */
function filter_demo_settings_id() {
  return 'demo_option_tree_settings';
}
add_filter( 'ot_settings_id', 'filter_demo_settings_id' );

/**
 * Filters the Layouts ID
 */
function filter_demo_layouts_id() {
  return 'demo_option_tree_layouts';
}
add_filter( 'ot_layouts_id', 'filter_demo_layouts_id' );

/**
 * Filters the Theme Option header list.
 */
function filter_demo_header_list() {
   echo '<li id="theme-version"><span>OptionTree Theme ' . OT_THEME_VERSION . '</span></li>';
}
add_action( 'ot_header_list', 'filter_demo_header_list' );

/**
 * Theme Mode
 */
add_filter( 'ot_theme_mode', '__return_false' );

/**
 * Child Theme Mode
 */
add_filter( 'ot_child_theme_mode', '__return_false' );

/**
 * Show Settings Pages
 */
add_filter( 'ot_show_pages', '__return_true' );

/**
 * Show Theme Options UI Builder
 */
add_filter( 'ot_show_options_ui', '__return_true' );

/**
 * Show Settings Import
 */
add_filter( 'ot_show_settings_import', '__return_true' );

/**
 * Show Settings Export
 */
add_filter( 'ot_show_settings_export', '__return_true' );

/**
 * Show New Layout
 */
add_filter( 'ot_show_new_layout', '__return_true' );

/**
 * Show Documentation
 */
add_filter( 'ot_show_docs', '__return_true' );

/**
 * Custom Theme Option page
 */
add_filter( 'ot_use_theme_options', '__return_true' );

/**
 * Meta Boxes
 */
add_filter( 'ot_meta_boxes', '__return_true' );

/**
 * Allow Unfiltered HTML in textareas options
 */
add_filter( 'ot_allow_unfiltered_html', '__return_false' );

/**
 * Loads the meta boxes for post formats
 */
add_filter( 'ot_post_formats', '__return_true' );

/**
 * OptionTree in Theme Mode
 */
# require( trailingslashit( get_template_directory() ) . 'option-tree/ot-loader.php' );

/**
 * Theme Options
 */
require( trailingslashit( get_template_directory() ) . 'inc/theme-options.php' );

/**
 * Meta Boxes
 */
require( trailingslashit( get_template_directory() ) . 'inc/meta-boxes.php' );

/**
 * Theme Customizer
 */
require( trailingslashit( get_template_directory() ) . 'inc/customizer.php' );

/**
 * Demo Functions (for demonstration purposes only!)
 */
require( trailingslashit( get_template_directory() ) . 'inc/functions.php' );