<?php
/**
 * The main template file.
 *
 * This theme is purely for the purpose of testing theme options in OptionTree.
 *
 * @package WordPress
 * @subpackage OptionTree Theme
 */

get_header(); ?>

  <article>
  
    <header class="entry-header">
    
      <h1><i class="option-tree-icon"></i> <?php _e( 'OptionTree Theme', 'option-tree-theme' ); ?> <small><?php echo OT_THEME_VERSION; ?></small></h1>
      
    </header><!-- .entry-header -->

    <div class="entry-content">
    
      <h2><?php _e( 'About', 'option-tree-theme' ); ?></h2>
      
      <p><?php printf( __( 'The %s simply demonstrates how to integrate %s with any theme. In this demo, I\'ll show you how to setup OptionTree in your own theme, and for whichever installation mode you feel best suits your projects needs.', 'option-tree-theme' ), '<strong>' . __( 'OptionTree Theme', 'option-tree-theme' ) . '</strong>', '<strong>' . __( 'OptionTree', 'option-tree-theme' ) . '</strong>' ); ?></p>
      
      <p class="note note-danger"><?php printf( __( '%s This theme is not meant for production use, and is strictly for demonstration purposes only.', 'option-tree-theme' ), '<tt>' . __( 'WARNING', 'option-tree-theme' ) . ':</tt>' ); ?></p>
      
      <hr>

      <h2><?php _e( 'Installation', 'option-tree-theme' ); ?></h2>
      
      <p><?php printf( __( 'There are two possible installation modes when using OptionTree. The first option is %s, which is going to be the traditional way WordPress would like you to use plugins. Which means, OptionTree is installed and activated through the Plugins page and upgraded via the WordPress Plugins Directory. The second option is %s, this is where you include OptionTree somewhere within the directory of your theme and take advantage of the flexibility and control you\'ll have over your themes upgrade path.', 'option-tree-theme' ), '<strong>' . __( 'Plugin Mode', 'option-tree-theme' ) . '</strong>', '<strong>' . __( 'Theme Mode', 'option-tree-theme' ) . '</strong>' ); ?></p>
      
      <p><?php _e( 'Below, I\'ll walk you through setting up OptionTree for each installation mode.', 'option-tree-theme' ); ?></p>
      
      <h3><?php _e( 'Plugin Mode', 'option-tree-theme' ); ?></h3>
      
      <ol>
        <li><?php printf( __( 'Install %s and activate the plugin. For help with this refer to the %s page in the WordPress Codex.', 'option-tree-theme' ), '<a href="http://wordpress.org/plugins/option-tree/" target="_blank">' . __( 'OptionTree', 'option-tree-theme' ) . '</a>', '<a href="http://codex.wordpress.org/Managing_Plugins" target="_blank">' . __( 'Manage Plugins', 'option-tree-theme' ) . '</a>' ); ?></li>
        <li><?php _e( 'Create the Theme Options.', 'option-tree-theme' ); ?>
          <ul>
            <li><?php printf( __( 'Theme Options UI Builder %s.', 'option-tree-theme' ), '(<strong>' . __( 'not recommended for premium themes', 'option-tree-theme' ) . '</strong>)' ); ?>
              <ul>
                <li><?php printf( __( 'Simply create your Theme Options with the Theme Options UI Builder %s an easy to use drag & drop interface.', 'option-tree-theme' ), '&mdash;' ); ?></li>
              </ul>
            </li>
            <li><?php _e( 'Hand Built.', 'option-tree-theme' ); ?>
              <ul>
                <li><?php printf( __( 'Create an %s directory in your theme.', 'option-tree-theme' ), '<tt>inc</tt>' ); ?></li>
                <li><?php printf( __( 'Create a %s file in the new %s directory.', 'option-tree-theme' ), '<tt>theme-options.php</tt>', '<tt>inc</tt>' ); ?></li>
                <li><?php printf( __( 'Copy and paste the contents of %s found in this themes %s directory into your new %s.', 'option-tree-theme' ), '<tt>theme-options.php</tt>', '<tt>inc</tt>', '<tt>theme-options.php</tt>' ); ?></li>
                <li><?php printf( __( 'Load the %s file by adding the following code to your %s.', 'option-tree-theme' ), '<tt>theme-options.php</tt>', '<tt>functions.php</tt>' ); ?>
<pre>/**
 * Loads Theme Options
 */
require( trailingslashit( get_template_directory() ) . 'inc/theme-options.php' );
</pre>                
                </li>
              </ul>
            </li>
          </ul>
        </li>
        <li><?php printf( __( 'Integrate your custom Theme Options into your theme with %s.', 'option-tree-theme' ), '<tt>ot_get_option()</tt>' ); ?></li>
      </ol>

      <h3><?php _e( 'Theme Mode', 'option-tree-theme' ); ?></h3>
      
      <p><?php printf( __( 'The two installation modes share some of the same steps, but Theme Mode has %s key differences.', 'option-tree-theme' ), '<strong>3</strong>' ); ?></p>
      
      <ol>
        <li><?php _e( 'OptionTree is included in the directory of your theme.', 'option-tree-theme' ); ?></li>
        <li><?php printf( __( 'You must filter %s so it returns true.', 'option-tree-theme' ), '<tt>ot_theme_mode</tt>' ); ?></li>
        <li><?php _e( 'You must deactivate and/or delete the plugin version of OptionTree.', 'option-tree-theme' ); ?></li>
      </ol>
      
      <p><?php _e( 'I\'ll walk you through the step below.', 'option-tree-theme' ); ?></p>
      
      <ol>
        <li><?php printf( __( 'Download the latest version of %s and unarchive the %s directory.', 'option-tree-theme' ), '<a href="http://wordpress.org/plugins/option-tree/" target="_blank">' . __( 'OptionTree', 'option-tree-theme' ) . '</a>', '<tt>.zip</tt>' ); ?></li>
        <li><?php printf( __( 'Put the %s directory in the root of your theme. For example, the server path would be %s.', 'option-tree-theme' ), '<tt>option-tree</tt>', '<tt>/wp-content/themes/your-theme/option-tree/</tt>' ); ?></li>
        <li><?php printf( __( 'Add the following code to the very beginning of your %s so it is executed before anything else.', 'option-tree-theme' ), '<tt>functions.php</tt>' ); ?>
<pre>/**
 * Activates Theme Mode
 */
add_filter( 'ot_theme_mode', '__return_true' );

/**
 * Loads OptionTree
 */
require( trailingslashit( get_template_directory() ) . 'option-tree/ot-loader.php' );
</pre>
        </li>
        <li><?php _e( 'Create the Theme Options.', 'option-tree-theme' ); ?>
          <ul>
            <li><?php printf( __( 'Theme Options UI Builder %s.', 'option-tree-theme' ), '(<strong>' . __( 'not recommended for premium themes', 'option-tree-theme' ) . '</strong>)' ); ?>
              <ul>
                <li><?php printf( __( 'Simply create your Theme Options with the Theme Options UI Builder %s an easy to use drag & drop interface.', 'option-tree-theme' ), '&mdash;' ); ?></li>
              </ul>
            </li>
            <li><?php _e( 'Hand Built.', 'option-tree-theme' ); ?>
              <ul>
                <li><?php printf( __( 'Create an %s directory in your theme.', 'option-tree-theme' ), '<tt>inc</tt>' ); ?></li>
                <li><?php printf( __( 'Create a %s file in the new <tt>inc</tt> directory.', 'option-tree-theme' ), '<tt>theme-options.php</tt>' ); ?></li>
                <li><?php printf( __( 'Copy and paste the contents of %s found in this themes %s directory into your new %s.', 'option-tree-theme' ), '<tt>theme-options.php</tt>', '<tt>inc</tt>', '<tt>theme-options.php</tt>' ); ?></li>
                <li><?php printf( __( 'Load the %s file by adding the following code to your %s.', 'option-tree-theme' ), '<tt>theme-options.php</tt>', '<tt>functions.php</tt>' ); ?>
<pre>/**
 * Loads Theme Options
 */
require( trailingslashit( get_template_directory() ) . 'inc/theme-options.php' );
</pre>                
                </li>
              </ul>
            </li>
          </ul>
        </li>
        <li><?php printf( __( 'Integrate your custom Theme Options into your theme with %s.', 'option-tree-theme' ), '<tt>ot_get_option()</tt>' ); ?></li>
      </ol>
      
      <p class="note"><?php printf( __( '%1$s Refer to the %2$s file found in the root directory of this theme for more information on the UI filters that can be set in your own %2$s.', 'option-tree-theme' ), '<tt>' . __( 'NOTE:', 'option-tree-theme' ) . '</tt>', '<tt>functions.php</tt>' ); ?></p>
      
      <p class="note"><?php printf( __( '%s If you\'re using the %s, know that some servers will stop saving your options after about a %s or so have been added with the UI Builder. This is why coding your own array is recommended for premium themes as they typically have a lot of options.', 'option-tree-theme' ), '<tt>' . __( 'NOTE:', 'option-tree-theme' ) . '</tt>', '<strong>' . __( 'Theme Option UI Builder', 'option-tree-theme' ) . '</strong>', '<tt><a href="https://github.com/valendesigns/option-tree/issues/39#issuecomment-17335478" target="_blank" title="' . __( 'Link to comment in issue', 'option-tree-theme' ) . ' #39">100</a></tt>' ); ?></p>

      <hr>
      
      <h2><?php _e( 'Integration', 'option-tree-theme' ); ?></h2>
      
      <p><?php printf( __( 'It\'s important to mention that the %s function is not available to your theme or plugin until the %s action has fired at priority %s. Which means you cannot use %s in your %s unless it\'s used inside a function being called at priority %s or later; however, you can use it inside your themes template files without issue, because they\'re being loaded after the action has been fired.', 'option-tree-theme' ), '<tt>ot_get_option()</tt>', '<tt>after_setup_theme</tt>', '<tt>1</tt>', '<tt>ot_get_option()</tt>', '<tt>functions.php</tt>', '<tt>2</tt>' ); ?></p>
      
      <h3><?php printf( __( 'Function Reference: %s', 'option-tree-theme' ), '<tt>ot_get_option()</tt>' ); ?></h3>
      
      <p><?php printf( __( 'A safe way of getting values for a named option from the saved Theme Options array. If no value has been saved, it returns $default or %s.', 'option-tree-theme' ), '<tt>false</tt>' ); ?></p>
      
      <h3><?php _e( 'Usage', 'option-tree-theme' ); ?></h3>
      
      <p><code>&lt;?php echo ot_get_option( <span>$option</span>, <span>$default</span> ); ?&gt;</code></p>
      
      <h3><?php _e( 'Parameters', 'option-tree-theme' ); ?></h3>
      
      <dl>
        <dt><tt>$option</tt></dt>
        <dd><?php printf( __( '(%s) (required) Name of the option to retrieve.', 'option-tree-theme' ), '<a href="http://codex.wordpress.org/How_to_Pass_Tag_Parameters#String" rel="nofollow">' . __( 'string', 'option-tree-theme' ) . '</a>' ); ?>
          <dl>
            <dd><?php printf( __( 'Default: %s', 'option-tree-theme' ), '<tt>None</tt>' ); ?></dd>
          </dl>
        </dd>
      </dl>
      
      <dl>
        <dt><tt>$default</tt></dt>
        <dd><?php printf( __( '(%s) (optional) The default value to return if no value is returned (ie. the option is not in the database).', 'option-tree-theme' ), '<a href="http://codex.wordpress.org/How_to_Pass_Tag_Parameters#Mixed" rel="nofollow">' . __( 'mixed', 'option-tree-theme' ) . '</a>' ); ?>
          <dl>
            <dd><?php printf( __( 'Default: %s', 'option-tree-theme' ), '<tt>false</tt>' ); ?></dd>
          </dl>
        </dd>
      </dl>
      
      <h3><?php _e( 'Return Values', 'option-tree-theme' ); ?></h3>
      
      <dl>
        <dt><tt>(<?php _e( 'mixed', 'option-tree-theme' ); ?>)</tt></dt>
        <dd><?php printf( __( 'Current value for the specified option. If the specified option does not exist, returns boolean %s.', 'option-tree-theme' ), '<tt>false</tt>' ); ?>
        </dd>
      </dl>
      
      <hr>
      
      <h2><?php _e( 'Option Types', 'option-tree-theme' ); ?></h2>
      
      <p><?php _e( 'This is a complete list of all the available option types that come shipped with OptionTree.', 'option-tree-theme' ); ?> 
        <?php 
        if ( ! function_exists( 'ot_get_option' ) ) {
          printf( __( 'However, without %s installed you\'re going to have a hard time changing the option type values below. Go back up to Installation Modes and get started installing OptionTree.', 'option-tree-theme' ), '<a href="http://wordpress.org/plugins/option-tree/" target="_blank">OptionTree</a>' );
        } else { 
          printf( __( 'Visit the %s page to update the returned values displayed below, and see first hand how each option type is saved in the database.', 'option-tree-theme' ), '<a href="' . admin_url( '/themes.php?page=ot-theme-options' ) . '">Theme Options</a>' );
        }
        ?>
      </p>
      
      <dl>
        <dt><tt>background</tt></dt>
        <dd><code>ot_get_option( 'demo_background' );</code> 
        <?php demo_get_option( 'demo_background' ); ?>
        </dd>
      </dl>
      
      <dl>
        <dt><tt>border</tt></dt>
        <dd><code>ot_get_option( 'demo_border' );</code> 
        <?php demo_get_option( 'demo_border' ); ?>
        </dd>
      </dl>
      
      <dl>
        <dt><tt>box-shadow</tt></dt>
        <dd><code>ot_get_option( 'demo_box_shadow' );</code> 
        <?php demo_get_option( 'demo_box_shadow' ); ?>
        </dd>
      </dl>
      
      <dl>
        <dt><tt>category-checkbox</tt></dt>
        <dd><code>ot_get_option( 'demo_category_checkbox' );</code> 
        <?php demo_get_option( 'demo_category_checkbox' ); ?>
        </dd>
      </dl>
      
      <dl>
        <dt><tt>category-select</tt></dt>
        <dd><code>ot_get_option( 'demo_category_select' );</code> 
        <?php demo_get_option( 'demo_category_select' ); ?>
        </dd>
      </dl>
      
      <dl>
        <dt><tt>checkbox</tt></dt>
        <dd><code>ot_get_option( 'demo_checkbox' );</code> 
        <?php demo_get_option( 'demo_checkbox' ); ?>
        </dd>
      </dl>
      
      <dl>
        <dt><tt>colorpicker</tt></dt>
        <dd><code>ot_get_option( 'demo_colorpicker' );</code> 
        <?php demo_get_option( 'demo_colorpicker' ); ?>
        </dd>
      </dl>
      
      <dl>
        <dt><tt>colorpicker-opacity</tt></dt>
        <dd><code>ot_get_option( 'demo_colorpicker_opacity' );</code> 
        <?php demo_get_option( 'demo_colorpicker_opacity' ); ?>
        </dd>
      </dl>
      
      <dl>
        <dt><tt>css</tt></dt>
        <dd><code>ot_get_option( 'demo_css' );</code>
        <?php demo_get_option( 'demo_css', true ); ?>
        </dd>
      </dl>
      
      <dl>
        <dt><tt>custom-post-type-checkbox</tt></dt>
        <dd><code>ot_get_option( 'demo_custom_post_type_checkbox' );</code> 
        <?php demo_get_option( 'demo_custom_post_type_checkbox' ); ?>
        </dd>
      </dl>
      
      <dl>
        <dt><tt>custom-post-type-select</tt></dt>
        <dd><code>ot_get_option( 'demo_custom_post_type_select' );</code> 
        <?php demo_get_option( 'demo_custom_post_type_select' ); ?>
        </dd>
      </dl>
      
      <dl>
        <dt><tt>date-picker</tt></dt>
        <dd><code>ot_get_option( 'demo_date_picker' );</code> 
        <?php demo_get_option( 'demo_date_picker' ); ?>
        </dd>
      </dl>
      
      <dl>
        <dt><tt>date-time-picker</tt></dt>
        <dd><code>ot_get_option( 'demo_date_time_picker' );</code> 
        <?php demo_get_option( 'demo_date_time_picker' ); ?>
        </dd>
      </dl>
      
      <dl>
        <dt><tt>dimension</tt></dt>
        <dd><code>ot_get_option( 'demo_dimension' );</code> 
        <?php demo_get_option( 'demo_dimension' ); ?>
        </dd>
      </dl>
      
      <dl>
        <dt><tt>gallery</tt></dt>
        <dd><code>ot_get_option( 'demo_gallery' );</code> 
        <?php demo_get_option( 'demo_gallery' ); ?>
        </dd>
      </dl>
      
      <dl>
        <dt><tt>gallery</tt></dt>
        <dd><code>ot_get_option( 'demo_gallery_shortcode' );</code> 
        <?php demo_get_option( 'demo_gallery_shortcode' ); ?>
        </dd>
      </dl>

      <dl>
        <dt><tt>google-fonts</tt></dt>
        <dd><code>ot_get_option( 'demo_google_fonts' );</code> 
        <?php demo_get_option( 'demo_google_fonts' ); ?>
        </dd>
      </dl>
      
      <dl>
        <dt><tt>javascript</tt></dt>
        <dd><code>ot_get_option( 'demo_javascript' );</code> 
        <?php demo_get_option( 'demo_javascript' ); ?>
        </dd>
      </dl>

      <dl>
        <dt><tt>link-color</tt></dt>
        <dd><code>ot_get_option( 'demo_link_color' );</code> 
        <?php demo_get_option( 'demo_link_color' ); ?>
        </dd>
      </dl>
      
      <dl>
        <dt><tt>list-item</tt></dt>
        <dd><code>ot_get_option( 'demo_list_item' );</code> 
        <?php demo_get_option( 'demo_list_item' ); ?>
        </dd>
      </dl>
      
      <dl>
        <dt><tt>measurement</tt></dt>
        <dd><code>ot_get_option( 'demo_measurement' );</code> 
        <?php demo_get_option( 'demo_measurement' ); ?>
        </dd>
      </dl>
      
      <dl>
        <dt><tt>numeric-slider</tt></dt>
        <dd><code>ot_get_option( 'demo_numeric_slider' );</code> 
        <?php demo_get_option( 'demo_numeric_slider' ); ?>
        </dd>
      </dl>
      
      <dl>
        <dt><tt>on-off</tt></dt>
        <dd><code>ot_get_option( 'demo_on_off' );</code> 
        <?php demo_get_option( 'demo_on_off' ); ?>
        </dd>
      </dl>
      
      <dl>
        <dt><tt>page-checkbox</tt></dt>
        <dd><code>ot_get_option( 'demo_page_checkbox' );</code> 
        <?php demo_get_option( 'demo_page_checkbox' ); ?>
        </dd>
      </dl>
      
      <dl>
        <dt><tt>page-select</tt></dt>
        <dd><code>ot_get_option( 'demo_page_select' );</code> 
        <?php demo_get_option( 'demo_page_select' ); ?>
        </dd>
      </dl>
      
      <dl>
        <dt><tt>post-checkbox</tt></dt>
        <dd><code>ot_get_option( 'demo_post_checkbox' );</code> 
        <?php demo_get_option( 'demo_post_checkbox' ); ?>
        </dd>
      </dl>
      
      <dl>
        <dt><tt>post-select</tt></dt>
        <dd><code>ot_get_option( 'demo_post_select' );</code> 
        <?php demo_get_option( 'demo_post_select' ); ?>
        </dd>
      </dl>
      
      <dl>
        <dt><tt>radio</tt></dt>
        <dd><code>ot_get_option( 'demo_radio' );</code> 
        <?php demo_get_option( 'demo_radio' ); ?>
        </dd>
      </dl>
      
      <dl>
        <dt><tt>radio-image</tt></dt>
        <dd><code>ot_get_option( 'demo_radio_image' );</code> 
        <?php demo_get_option( 'demo_radio_image' ); ?>
        </dd>
      </dl>
      
      <dl>
        <dt><tt>select</tt></dt>
        <dd><code>ot_get_option( 'demo_select' );</code> 
        <?php demo_get_option( 'demo_select' ); ?>
        </dd>
      </dl>
      
      <dl>
        <dt><tt>sidebar-select</tt></dt>
        <dd><code>ot_get_option( 'demo_sidebar_select' );</code> 
        <?php demo_get_option( 'demo_sidebar_select' ); ?>
        </dd>
      </dl>
      
      <dl>
        <dt><tt>slider</tt></dt>
        <dd><code>ot_get_option( 'demo_slider' );</code> 
        <?php demo_get_option( 'demo_slider' ); ?>
        </dd>
      </dl>
      
      <dl>
        <dt><tt>social-links</tt></dt>
        <dd><code>ot_get_option( 'demo_social_links' );</code> 
        <?php demo_get_option( 'demo_social_links' ); ?>
        </dd>
      </dl>
      
      <dl>
        <dt><tt>spacing</tt></dt>
        <dd><code>ot_get_option( 'demo_spacing' );</code> 
        <?php demo_get_option( 'demo_spacing' ); ?>
        </dd>
      </dl>
      
      <dl>
        <dt><tt>tag-checkbox</tt></dt>
        <dd><code>ot_get_option( 'demo_tag_checkbox' );</code> 
        <?php demo_get_option( 'demo_tag_checkbox' ); ?>
        </dd>
      </dl>
      
      <dl>
        <dt><tt>tag-select</tt></dt>
        <dd><code>ot_get_option( 'demo_tag_select' );</code> 
        <?php demo_get_option( 'demo_tag_select' ); ?>
        </dd>
      </dl>
      
      <dl>
        <dt><tt>taxonomy-checkbox</tt></dt>
        <dd><code>ot_get_option( 'demo_taxonomy_checkbox' );</code> 
        <?php demo_get_option( 'demo_taxonomy_checkbox' ); ?>
        </dd>
      </dl>
      
      <dl>
        <dt><tt>taxonomy-select</tt></dt>
        <dd><code>ot_get_option( 'demo_taxonomy_select' );</code> 
        <?php demo_get_option( 'demo_taxonomy_select' ); ?>
        </dd>
      </dl>
      
      <dl>
        <dt><tt>text</tt></dt>
        <dd><code>ot_get_option( 'demo_text' );</code> 
        <?php demo_get_option( 'demo_text' ); ?>
        </dd>
      </dl>
      
      <dl>
        <dt><tt>textarea</tt></dt>
        <dd><code>ot_get_option( 'demo_textarea' );</code> 
        <?php demo_get_option( 'demo_textarea' ); ?>
        </dd>
      </dl>
      
      <dl>
        <dt><tt>textarea-simple</tt></dt>
        <dd><code>ot_get_option( 'demo_textarea_simple' );</code> 
        <?php demo_get_option( 'demo_textarea_simple' ); ?>
        </dd>
      </dl>
      
      <dl>
        <dt><tt>textblock</tt></dt>
        <dd><code>ot_get_option( 'demo_textblock' );</code> 
        <?php demo_get_option( 'demo_textblock' ); ?>
        </dd>
      </dl>
      
      <dl>
        <dt><tt>textblock-titled</tt></dt>
        <dd><code>ot_get_option( 'demo_textblock_titled' );</code> 
        <?php demo_get_option( 'demo_textblock_titled' ); ?>
        </dd>
      </dl>
      
      <dl>
        <dt><tt>typography</tt></dt>
        <dd><code>ot_get_option( 'demo_typography' );</code> 
        <?php demo_get_option( 'demo_typography' ); ?>
        </dd>
      </dl>
      
      <dl>
        <dt><tt>upload</tt></dt>
        <dd><code>ot_get_option( 'demo_upload' );</code> 
        <?php demo_get_option( 'demo_upload' ); ?>
        </dd>
      </dl>
      
    </div><!-- .entry-content -->
    
  </article><!-- #post-0 -->

<?php get_footer(); ?>