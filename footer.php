<?php
/**
 * The template for displaying the footer.
 *
 * @package WordPress
 * @subpackage OptionTree Theme
 */
?>

  </div><!-- #page -->
  
  <footer id="colophon" class="site-footer" role="contentinfo">
  
    <div class="site-info">
      <p class="site-copy"><?php printf( __( '%s. All Rights Reserved.', 'option-tree-theme' ), '&copy; ' . date( 'Y' ) . ' <a href="' . esc_url( 'http://valendesigns.com/' ) . '">Derek Herman</a>' ); ?></p>
      <p><?php printf( __( 'Proudly powered by %s', 'option-tree-theme' ), '<a href="' . esc_url( 'http://wordpress.org/' ) . '">WordPress</a>' ); ?></p>
    </div><!-- .site-info -->
    
  </footer><!-- #colophon -->
  
  <?php
  /* Always have wp_footer() just before the closing </body>
   * tag of your theme, or you will break many plugins, which
   * generally use this hook to reference JavaScript files.
   */
  wp_footer();
  ?>
  
  </body>
  
</html>
