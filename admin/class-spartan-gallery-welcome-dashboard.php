<?php

/**
 * Welcome Logic
 *
 * @since 1.0.0
 * @package WPW
 */

if ( ! defined( 'WPINC' ) ) {

    die;

}

/**
 * Welcome page redirect.
 *
 * Only happens once and if the site is not a network or multisite.
 *
 * @since 1.0.0
 */
function wpw_safe_welcome_redirect() {

    // Bail if no activation redirect transient is present.
    if ( ! get_transient( '_welcome_redirect_wpw' ) ) {

        return;

    }

  // Delete the redirect transient.
  delete_transient( '_welcome_redirect_wpw' );

  // Bail if activating from network or bulk sites.
  if ( is_network_admin() || isset( $_GET['activate-multi'] ) ) {

    return;

  }

  // Redirect to Welcome Page.
  // Redirects to `your-domain.com/wp-admin/plugin.php?page=wpw_welcome_page`.
  wp_safe_redirect( add_query_arg( array( 'page' => 'wpw_welcome_page' ), admin_url( 'edit.php?post_type=spartan_gallery_type' ) ) );

}

add_action( 'admin_init', 'wpw_safe_welcome_redirect' );

/**
 * Adds welcome page sub menu.
 *
 * @since 1.0.0
 */
function wpw_welcome_page() {

  global $wpw_sub_menu;

  $wpw_sub_menu = add_submenu_page(
      'edit.php?post_type=spartan_gallery_type', // The slug name for the parent menu (or the file name of a standard WordPress admin page).
      __( 'Welcome Page', 'spartan_gallery' ), // The text to be displayed in the title tags of the page when the menu is selected.
      __( 'Welcome Page', 'spartan_gallery' ), // The text to be used for the menu.
      'read', // The capability required for this menu to be displayed to the user.
      'wpw_welcome_page', // The slug name to refer to this menu by (should be unique for this menu).
      'wpw_welcome_page_content' // The function to be called to output the content for this page.
  );

}

add_action( 'admin_menu', 'wpw_welcome_page' );

/**
 * Welcome page content.
 *
 * @since 1.0.0
 */
function wpw_welcome_page_content() {  ?>

        <style>
          .svg .wp-badge.welcome__logo {
            background: url('<?php echo plugin_dir_url( __FILE__ ) . "img/spartan-logo.png" ; ?>') center 24px no-repeat;
            background-size: contain;
            color: #fff;
            width: 50%;
          }

          /* Responsive Youtube Video*/
          .embed-container {
            height: 0;
            max-width: 100%;
            overflow: hidden;
            padding-bottom: 56.25%;
            position: relative;
          }

          .embed-container iframe,
          .embed-container object,
          .embed-container embed {
            top: 0;
            height: 100%;
            left: 0;
            position: absolute;
            width: 100%;
          }
        </style>

        <div class="wrap about-wrap">

        <h1><?php printf( __( 'Spartan Gallery &nbsp; %s', 'spartan_gallery' ), PLUGIN_NAME_VERSION ); ?></h1>

        <div class="about-text">
            <?php printf( __( "Spartan Gallery Welcome Page.", 'spartan_gallery' ), PLUGIN_NAME_VERSION ); ?>
        </div>

        <div class="wp-badge welcome__logo"></div>

        <div class="feature-section one-col">
            <h3><?php _e( 'Get Started', 'spartan_gallery' ); ?></h3>
            <ul>
                <h4><a href="<?php echo admin_url(); ?>themes.php?page=tgmpa-install-plugins">1. Install required Settings and Activate these</a></h4>
                <li><strong><?php _e( '1. To start setting up your plugin go to menu "Dashboard" > Select Spartan Gallery > "<a href="'.admin_url().'post-new.php?post_type=spartan_gallery_type" >Create New Gallery</a>".', 'spartan_gallery' ); ?></strong></li>
                <li><strong><?php _e( '2. Create New Gallery', 'spartan_gallery' ); ?></strong></li>
                <li><strong><?php _e( '3. Upload Images', 'spartan_gallery' ); ?></strong></li>
                <li><strong><?php _e( '4. Choose Image Layout Options', 'spartan_gallery' ); ?></strong></li>
                <li><strong><?php _e( '5. Select Image Settings', 'spartan_gallery' ); ?></strong></li>
                <li><strong><?php _e( '8. Copy and Paste shortcode where do you wish', 'spartan_gallery' ); ?></strong></li>


            </ul>

         </div>

        <div class="feature-section one-col">
            <h3><?php _e( 'What is Inside?', 'spartan_gallery' ); ?></h3>
            <div class="headline-feature feature-video">
                <div class='embed-container'>
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/VF1u_1SLHjs" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
            </div>
        </div>






      </div>
      <?php
}

/**
 * Enqueue Styles.
 *
 * @since 1.0.0
 */
function wpw_styles( $hook ) {

    global $wpw_sub_menu;

    // Add style to the welcome page only.
    if ( $hook != $wpw_sub_menu ) {

      return;

    }

    // Welcome page styles.
    wp_enqueue_style(
      'wpw_style',
       __FILE__ . '/welcome/css/style.css',
      array(),
       __FILE__,
      'all'
    );

}

// Enqueue the styles.
add_action( 'admin_enqueue_scripts', 'wpw_styles' );
