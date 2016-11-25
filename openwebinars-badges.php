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

  /*
   * Check that our form has been submitted
   */
  if ( isset( $_POST['openwebinars_form_submitted'] ) ) {
    $hidden_field = esc_html( $_POST['openwebinars_form_submitted'] );

    if ( $hidden_field == 'Y' ) {
      $openwebinars_email = esc_html( $_POST['openwebinars_email'] );

      // echo $openwebinars_email;
    }
  }

  require( 'inc/options-page-wrapper.php' );

}


/*
 * Addind custom styles to our plugin
 */
function openwebinars_badges_styles() {
  wp_enqueue_style( 'openwebinars_badges_styles', plugins_url( 'openwebinars-badges/openwebinars-badges.css' ) );
}
add_action( 'admin_head', 'openwebinars_badges_styles' );
