<?php
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
    $option_id    = str_replace( array( '{{', '}}' ), '', $option );
    $option_array = explode( '|', $option_id );

    /* get the array value */
    if ( $meta ) {
      global $post;
      
      $value = get_post_meta( $post->ID, $option_array[0], true );
      
    } else {
    
      $options = get_option( 'demo_option_tree' );
      
      if ( isset( $options[$option_array[0]] ) ) {
        
        $value = $options[$option_array[0]];

      }
      
    }
    
    if ( is_array( $value ) ) {
      
      if ( ! isset( $option_array[1] ) ) {
      
        /* Measurement */
        if ( isset( $value[0] ) && isset( $value[1] ) ) {
          
          /* set $value with measurement properties */
          $value = $value[0].$value[1];
          
        /* typography */
        } else if ( demo_array_keys_exists( $value, array( 'font-color', 'font-family', 'font-size', 'font-style', 'font-variant', 'font-weight', 'letter-spacing', 'line-height', 'text-decoration', 'text-transform' ) ) ) {
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
          
          /* set $value with font properties or empty string */
          $value = ! empty( $font ) ? implode( "\n", $font ) : '';
          
        /* background */
        } else if ( demo_array_keys_exists( $value, array( 'background-color', 'background-image', 'background-repeat', 'background-attachment', 'background-position', 'background-size' ) ) ) {
          $bg = array();
          
          if ( ! empty( $value['background-color'] ) )
            $bg[] = $value['background-color'];
            
          if ( ! empty( $value['background-image'] ) )
            $bg[] = 'url("' . $value['background-image'] . '")';
            
          if ( ! empty( $value['background-repeat'] ) )
            $bg[] = $value['background-repeat'];
            
          if ( ! empty( $value['background-attachment'] ) )
            $bg[] = $value['background-attachment'];
            
          if ( ! empty( $value['background-position'] ) )
            $bg[] = $value['background-position'];
          
          if ( ! empty( $value['background-size'] ) )
            $size = $value['background-size'];
          
          /* set $value with background properties or empty string */
          $value = ! empty( $bg ) ? 'background: ' . implode( " ", $bg ) . ';' : '';
           
          if ( isset( $size ) ) {
            if ( ! empty( $bg ) ) {
              $value.= apply_filters( 'ot_demo_insert_css_with_markers_bg_size_white_space', "\n\x20\x20", $option_id );
            }
            $value.= "background-size: $size;";
          }
            
        }
      
      } else {
      
        $value = $value[$option_array[1]];
        
      }
     
    }
    
    // Filter the CSS
    $value = apply_filters( 'ot_demo_insert_css_with_markers_value', $value, $option_id );
       	
    /* insert CSS, even if the value is empty */
   	$insertion = stripslashes( str_replace( $option, $value, $insertion ) );
   	
  }
  
  return $insertion;
      
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