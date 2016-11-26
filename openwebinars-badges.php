<?php

/*
 * Plugin Name: Official OpenWebinars Badges Plugin
 * Plugin URI: http://openwebinars.net/cursos/crear-plugins-para-wordpress/
 * Description: Provides both widgets and shortcodes to help you display your OpenWebinars profile badges on your website
 * Version: 1.0
 * Author: José Arcos
 * Author URI: http://josearcos.me
 * License: GPL2
 *
 */

/*
 * Assign global variables
 */

$plugin_url = WP_PLUGIN_URL . '/openwebinars-badges';
$options = array();

/*
 * Add a link to our plugin in the admin menu
 * under 'Settings > OpenWebinars Badges'
 */

function openwebinars_badges_menu() {

  /*
   * Use the add_options page function
   * add_options_page( $page_title, $menu_title, $capability, $menu-slug, $function );
   */

  add_options_page(
    'Official OpenWebinars Badges Plugins',
    'OpenWebinars Badges',
    'manage_options',
    'openwebinars-badges',
    'openwebinars_badges_options_page'
  );
}
add_action( 'admin_menu', 'openwebinars_badges_menu' );

/*
 * Limiting the plugin usage to Editor or Admins.
 * Incluiding other plugin files needed to work.
 */
function openwebinars_badges_options_page() {
  if( !current_user_can( 'manage_options' ) ) {
    wp_die( 'You do not have sufficient permissions to access this page.' );
  }

  global $plugin_url;
  global $options;

  /*
   * Check that our form has been submitted
   */
  if ( isset( $_POST['openwebinars_form_submitted'] ) ) {
    $hidden_field = esc_html( $_POST['openwebinars_form_submitted'] );

    if ( $hidden_field == 'Y' ) {
      $openwebinars_email = esc_html( $_POST['openwebinars_email'] );

      $openwebinars_badges = openwebinars_badges_get_badges( $openwebinars_email );

      /*
       * Store form options in database
       */
      $options['openwebinars_email']    = $openwebinars_email;
      $options['openwebinars_badges']    = $openwebinars_badges;
      $options['last_updated']          = time();

      update_option( 'openwebinars_badges', $options );

      // echo $openwebinars_email;
    }
  }

  $options = get_option( 'openwebinars_badges' );

  if( $options != '' ) {
    $openwebinars_email = $options['openwebinars_email'];
    $openwebinars_badges = $options['openwebinars_badges'];
  }

  // if ( isset($openwebinars_badges) ) {
  //   var_dump( $openwebinars_badges );
  // }

  require( 'inc/options-page-wrapper.php' );

}

/*
 * Get the badges from Mozilla Backpack
 */

function openwebinars_badges_get_badges( $openwebinars_email ) {
  $json_feed_url= 'https://backpack.openbadges.org/displayer/convert/email';
  $args = array( 'body' => array( 'email' => $openwebinars_email ) );

  $json_feed = wp_remote_post( $json_feed_url, $args );

  // $openwebinars_api_object = json_decode( $json_feed['body'] );
  // $openwebinars_api_groups = wp_remote_get( 'http://backpack.openbadges.org/displayer/343384/groups.json' );

  $openwebinars_api_badges = wp_remote_get( 'http://backpack.openbadges.org/displayer/343384/group/116325.json' );

  $openwebinars_api_badges_json = json_decode( $openwebinars_api_badges['body'] );

  return $openwebinars_api_badges_json;
}

/*
 * Addind custom styles to our plugin
 */
function openwebinars_badges_styles() {
  wp_enqueue_style( 'openwebinars_badges_styles', plugins_url( 'openwebinars-badges/openwebinars-badges.css' ) );
}
add_action( 'admin_head', 'openwebinars_badges_styles' );
