<?php
/**
 * Initialize the Theme Customizer.
 */
add_action( 'customize_register', 'custom_customize_register' );

/**
 * Theme Customizer demo code.
 *
 * @return    void
 * @since     2.3.0
 */
function custom_customize_register( $wp_customize ) {
  
  /**
   * Remove built-in options
   */
  $wp_customize->remove_section( 'title_tagline' );
  $wp_customize->remove_section( 'static_front_page' );
  
}