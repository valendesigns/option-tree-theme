<?php
/**
 * Enqueue theme styles.
 *
 * @since     2.5.0
 */
function ot_theme_styles() {

  wp_enqueue_style( 'ot-theme', get_stylesheet_uri() );

}
add_action( 'wp_enqueue_scripts', 'ot_theme_styles' );

/**
 * Helper function to format the options return value.
 *
 * @param     string    $option ID of the option to retrieve
 * @param     boolean   $css Whether the option type is CSS, deafult false.
 * @return    string
 *
 * @since     2.3.0
 */
function demo_get_option( $option, $css = false ) {
  
  $default = 'no value';
  $return = function_exists( 'ot_get_option' ) ? ot_get_option( $option, $default ) : $default;
  
  if ( $return !== $default ) {
    
    if ( true == $css ) {
      $parse = demo_parse_css( $option, $return );
      $return = str_replace( 'no value', '<span class="note note-danger">' . __( 'no value', 'option-tree-theme' ) . '</span>', $parse );
    }
    
    echo '<pre>';
      print_r( $return );
    echo '</pre>';
    
  } else {
  
    echo '<span class="note note-danger">' . $return . '</span>';
    
  }
  
}

/**
 * Helper function to parse and return properly formated CSS.
 *
 * @param     string    $field_id ID of the option to retrieve.
 * @param     string    $insertion The string to parse into CSS.
 * @param     boolean   $meta Whether the ID is of a meta option or regular theme option.
 * @return    string
 *
 * @since     2.3.0
 */
function demo_parse_css( $field_id = '', $insertion = '', $meta = false ) {

  /* missing $field_id or $insertion exit early */
  if ( '' == $field_id || '' == $insertion )
    return;

  $insertion   = demo_normalize_css( $insertion );
  $regex       = "/{{([a-zA-Z0-9\_\-\#\|\=]+)}}/";

  /* Match custom CSS */
  preg_match_all( $regex, $insertion, $matches );

  /* Loop through CSS */
  foreach( $matches[0] as $option ) {

    $value        = '';
    $option_array = explode( '|', str_replace( array( '{{', '}}' ), '', $option ) );
    $option_id    = isset( $option_array[0] ) ? $option_array[0] : '';
    $option_key   = isset( $option_array[1] ) ? $option_array[1] : '';
    $option_type  = demo_get_option_type_by_id( $option_id );
    $fallback     = '';

    // Get the meta array value
    if ( $meta ) {
      global $post;

      $value = get_post_meta( $post->ID, $option_id, true );

    // Get the options array value
    } else {

      $options = get_option( ot_options_id() );

      if ( isset( $options[$option_id] ) ) {

        $value = $options[$option_id];

      }

    }

    // This in an array of values
    if ( is_array( $value ) ) {

      if ( empty( $option_key ) ) {

        // Measurement
        if ( $option_type == 'measurement' ) {

          // Set $value with measurement properties
          if ( isset( $value[0] ) && isset( $value[1] ) )
            $value = $value[0].$value[1];

        // Border
        } else if ( $option_type == 'border' ) {
          $border = array();

          $unit = ! empty( $value['unit'] ) ? $value['unit'] : 'px';

          if ( ! empty( $value['width'] ) )
            $border[] = $value['width'].$unit;

          if ( ! empty( $value['style'] ) )
            $border[] = $value['style'];

          if ( ! empty( $value['color'] ) )
            $border[] = $value['color'];

          /* set $value with border properties or empty string */
          $value = ! empty( $border ) ? implode( ' ', $border ) : '';

        // Box Shadow
        } else if ( $option_type == 'box-shadow' ) {

          /* set $value with box-shadow properties or empty string */
          $value = ! empty( $value ) ? implode( ' ', $value ) : '';

        // Dimension
        } else if ( $option_type == 'dimension' ) {
          $dimension = array();

          $unit = ! empty( $value['unit'] ) ? $value['unit'] : 'px';

          if ( ! empty( $value['width'] ) )
            $dimension[] = $value['width'].$unit;

          if ( ! empty( $value['height'] ) )
            $dimension[] = $value['height'].$unit;

          // Set $value with dimension properties or empty string
          $value = ! empty( $dimension ) ? implode( ' ', $dimension ) : '';

        // Spacing
        } else if ( $option_type == 'spacing' ) {
          $spacing = array();

          $unit = ! empty( $value['unit'] ) ? $value['unit'] : 'px';

          if ( ! empty( $value['top'] ) )
            $spacing[] = $value['top'].$unit;

          if ( ! empty( $value['right'] ) )
            $spacing[] = $value['right'].$unit;

          if ( ! empty( $value['bottom'] ) )
            $spacing[] = $value['bottom'].$unit;

          if ( ! empty( $value['left'] ) )
            $spacing[] = $value['left'].$unit;

          // Set $value with spacing properties or empty string
          $value = ! empty( $spacing ) ? implode( ' ', $spacing ) : '';

        // Typography
        } else if ( $option_type == 'typography' ) {
          $font = array();

          if ( ! empty( $value['font-color'] ) )
            $font[] = "color: " . $value['font-color'] . ";";

          if ( ! empty( $value['font-family'] ) ) {
            foreach ( demo_recognized_font_families( $field_id ) as $key => $v ) {
              if ( $key == $value['font-family'] ) {
                $font[] = "font-family: " . $v . ";";
              }
            }
          }

          if ( ! empty( $value['font-size'] ) )
            $font[] = "font-size: " . $value['font-size'] . ";";

          if ( ! empty( $value['font-style'] ) )
            $font[] = "font-style: " . $value['font-style'] . ";";

          if ( ! empty( $value['font-variant'] ) )
            $font[] = "font-variant: " . $value['font-variant'] . ";";

          if ( ! empty( $value['font-weight'] ) )
            $font[] = "font-weight: " . $value['font-weight'] . ";";

          if ( ! empty( $value['letter-spacing'] ) )
            $font[] = "letter-spacing: " . $value['letter-spacing'] . ";";

          if ( ! empty( $value['line-height'] ) )
            $font[] = "line-height: " . $value['line-height'] . ";";

          if ( ! empty( $value['text-decoration'] ) )
            $font[] = "text-decoration: " . $value['text-decoration'] . ";";

          if ( ! empty( $value['text-transform'] ) )
            $font[] = "text-transform: " . $value['text-transform'] . ";";

          // Set $value with font properties or empty string
          $value = ! empty( $font ) ? implode( "\n", $font ) : '';

        // Background
        } else if ( $option_type == 'background' ) {
          $bg = array();

          if ( ! empty( $value['background-color'] ) )
            $bg[] = $value['background-color'];

          if ( ! empty( $value['background-image'] ) ) {

            // If an attachment ID is stored here fetch its URL and replace the value
            if ( wp_attachment_is_image( $value['background-image'] ) ) {

              $attachment_data = wp_get_attachment_image_src( $value['background-image'], 'original' );

              // Check for attachment data
              if ( $attachment_data ) {

                $value['background-image'] = $attachment_data[0];

              }

            }

            $bg[] = 'url("' . $value['background-image'] . '")';

          }

          if ( ! empty( $value['background-repeat'] ) )
            $bg[] = $value['background-repeat'];

          if ( ! empty( $value['background-attachment'] ) )
            $bg[] = $value['background-attachment'];

          if ( ! empty( $value['background-position'] ) )
            $bg[] = $value['background-position'];

          if ( ! empty( $value['background-size'] ) )
            $size = $value['background-size'];

          // Set $value with background properties or empty string
          $value = ! empty( $bg ) ? 'background: ' . implode( " ", $bg ) . ';' : '';

          if ( isset( $size ) ) {
            if ( ! empty( $bg ) ) {
              $value.= apply_filters( 'ot_demo_insert_css_with_markers_bg_size_white_space', "\n\x20\x20", $option_id );
            }
            $value.= "background-size: $size;";
          }

        }

      } else {

        $value = $value[$option_key];

      }

    }

    // If an attachment ID is stored here fetch its URL and replace the value
    if ( $option_type == 'upload' && wp_attachment_is_image( $value ) ) {

      $attachment_data = wp_get_attachment_image_src( $value, 'original' );

      // Check for attachment data
      if ( $attachment_data ) {

        $value = $attachment_data[0];

      }

    }

    // Attempt to fallback when `$value` is empty
    if ( empty( $value ) ) {

      // We're trying to access a single array key
      if ( ! empty( $option_key ) ) {

        // Link Color `inherit`
        if ( $option_type == 'link-color' ) {
          $fallback = 'inherit';
        }

      } else {

        // Border
        if ( $option_type == 'border' ) {
          $fallback = 'inherit';
        }

        // Box Shadow
        if ( $option_type == 'box-shadow' ) {
          $fallback = 'none';
        }

        // Colorpicker
        if ( $option_type == 'colorpicker' ) {
          $fallback = 'inherit';
        }

        // Colorpicker Opacity
        if ( $option_type == 'colorpicker-opacity' ) {
          $fallback = 'inherit';
        }

      }

      /**
       * Filter the `dynamic.css` fallback value.
       *
       * @since 2.5.3
       *
       * @param string $fallback The default CSS fallback value.
       * @param string $option_id The option ID.
       * @param string $option_type The option type.
       * @param string $option_key The option array key.
       */
      $fallback = apply_filters( 'ot_demo_insert_css_with_markers_fallback', $fallback, $option_id, $option_type, $option_key );

    }

    // Let's fallback!
    if ( ! empty( $fallback ) ) {
      $value = $fallback;
    }

    // Filter the CSS
    $value = apply_filters( 'ot_demo_insert_css_with_markers_value', $value, $option_id );

    // Insert CSS, even if the value is empty
    $insertion = stripslashes( str_replace( $option, $value, $insertion ) );
 
  }

  return $insertion;

}

/**
 * Returns the option type by ID.
 *
 * @param     string    $option_id The option ID
 * @return    string    $settings_id The settings array ID
 * @return    string    The option type.
 *
 * @access    public
 * @since     2.5.3
 */
if ( ! function_exists( 'demo_get_option_type_by_id' ) ) {

  function demo_get_option_type_by_id( $option_id, $settings_id = '' ) {

    if ( empty( $settings_id ) ) {

      $settings_id = ot_settings_id();

    }

    $settings = get_option( $settings_id, array() );

    if ( isset( $settings['settings'] ) ) {

      foreach( $settings['settings'] as $value ) {

        if ( $option_id == $value['id'] && isset( $value['type'] ) ) {

          return $value['type'];

        }

      }

    }

    return false;

  }
 
}

/**
 * Helper function to change the value if empty.
 *
 * @param     string    $value The options return value.
 * @param     string    $option ID of the option.
 * @return    string
 *
 * @since     2.3.0
 */
function demo_filter_css( $value, $option ) {
  
  if ( empty( $value ) )
    $value = 'no value'; 
  
  return $value;
  
}
add_filter( 'ot_demo_insert_css_with_markers_value', 'demo_filter_css', 10, 2 );

/**
 * Helper function to normalize the CSS.
 *
 * @param     string    $css The return value to normalize.
 * @return    string
 *
 * @since     2.3.0
 */
function demo_normalize_css( $css ) {
  
  /* Normalize & Convert */
  $css = str_replace( "\r\n", "\n", $css );
  $css = str_replace( "\r", "\n", $css );
  
  /* Don't allow out-of-control blank lines */
  $css = preg_replace( "/\n{2,}/", "\n\n", $css );
  
  return $css;
  
}

/**
 * Helper function to test if an array key exists.
 *
 * @param     array     $array The array to test against.
 * @param     array     $keys An array of keys to look for.
 * @return    bool
 *
 * @since     2.3.0
 */
function demo_array_keys_exists( $array, $keys ) {
  
  foreach( $keys as $k )
    if ( isset( $array[$k] ) )
      return true;
  
  return false;
  
}

/**
 * Recognized font families for the demo
 *
 * @return    array
 *
 * @access    public
 * @since     2.3.0
 */
function demo_recognized_font_families( $field_id = '' ) {

  return apply_filters( 'ot_demo_recognized_font_families', array(
    'arial'     => 'Arial',
    'georgia'   => 'Georgia',
    'helvetica' => 'Helvetica',
    'palatino'  => 'Palatino',
    'tahoma'    => 'Tahoma',
    'times'     => '"Times New Roman", sans-serif',
    'trebuchet' => 'Trebuchet',
    'verdana'   => 'Verdana'
  ), $field_id );
  
}