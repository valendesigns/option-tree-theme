<?php
/**
 * The template for displaying the header.
 *
 * @package WordPress
 * @subpackage OptionTree Theme
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>

  <head>
    
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <title><?php _e( 'OptionTree Theme', 'option-tree-theme' ); ?> <?php echo OT_THEME_VERSION; ?></title>
    <?php wp_head(); ?>
    
  </head>
  
<body <?php body_class(); ?>>

  <?php if ( ! function_exists( 'ot_get_option' ) ) { ?>
    
    <p class="note note-danger"><?php printf( __( '%s needs to be installed! Choose an installation mode, and follow the steps below to get everything setup.', 'option-tree-theme' ), '<a href="http://wordpress.org/plugins/option-tree/" target="_blank">' . __( 'OptionTree', 'option-tree-theme' ) . '</a>' ); ?></p>
  
  <?php } else if ( defined( 'OT_VERSION' ) && version_compare( OT_VERSION, OT_THEME_VERSION, '<' ) ) { ?>
    
    <p class="note note-danger"><?php printf( __( 'Please upgrade! This theme requires OptionTree %s or newer and you have %s installed.', 'option-tree-theme' ), '<small>' . OT_THEME_VERSION . '</small>', '<small>' . OT_VERSION . '</small>' ); ?></p>
  
  <?php } else if ( defined( 'OT_VERSION' ) ) { ?>
    
    <p class="note"><?php printf( __( 'Congratulations! You\'ve successfully installed OptionTree %s.', 'option-tree-theme' ), '<small>' . OT_VERSION . '</small>' ); ?></p>
    
  <?php } ?>
  
  <div id="page">