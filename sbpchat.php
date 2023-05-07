<?php
/**
 * Plugin Name: SEO Book PRO Chat
 * Plugin URI: https://seobookpro.com/
 * Description: SEO Book PRO is a Simple Powerful SEO plugin and tool for WordPress. The SEO Book PRO Plugin is a powerful tool designed to help website owners and marketers optimize their website's search engine performance. The plugin offers a range of features and options, including settings for Google and Bing, as well as social media networks. The plugin also includes an options tab menu, support, and FAQs, making it easy for users to get the most out of their SEO efforts. With a dedicated folder and easy-to-use interface, the SEO Book PRO Plugin is an essential tool for anyone looking to improve their website's search engine rankings.
 * Version: 1.0.0
 * Author: Dimitar Krumov
 * Author URI: https://seobookpro.com/
 * Text Domain: seobookprochat
 * Contributors: (this should be a list of wordpress.org userid's)
 * Tags: SEO Book Pro, SEO, WordPress SEO Plugin, WordPress SEO Tools
 * Donate link: https://www.paypal.com/donate/?hosted_button_id=C36EVYX8YLQKN
 * Domain Path: /languages/
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 *
 * @package SEO_Book_PRO_Chat
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Define constants.
define( 'SEOBPCHAT_VERSION', '1.0.0' );
define( 'SEOBPCHAT_PLUGIN_FILE', __FILE__ );
define( 'SEOBPCHAT_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'SEOBPCHAT_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

/*
foreach ( glob( plugin_dir_path( __FILE__ ) . "inc/func/advanced/std/extras/*.php" ) as $file ) {
    include_once $file;
}
*/
// Include required files.
require_once SEOBPCHAT_PLUGIN_DIR . 'inc/admin/seobpchat.php';
require_once SEOBPCHAT_PLUGIN_DIR . 'inc/admin/seobpchat-settings.php';


function seobpchat_register_page_cx_settings() {
register_setting( 'seobpchat_page', 'seobpchat_page_cx' );
register_setting( 'seobpchat_page', 'seobpchat_enable_cx' );
register_setting( 'seobpchat_page', 'seobpchat_gcse_box_display' );
register_setting( 'seobpchat_page', 'seobpchat_gcse_searchresults_box_display' );

}
add_action( 'admin_init', 'seobpchat_register_page_cx_settings' );
//add_action( 'admin_init', 'seobpchat_gcse_enable_gcse_box' );
add_action( 'wp_body_open', 'seobpchat_page_cx' );


add_action('admin_init', 'seobpchat_register_gcse_settings');
add_action('wp_body_open', 'seobpchat_gcse_display_selected_filter');





// Enque Bootstrap Framework
function seobpchat_load_bootstrap() {
    wp_enqueue_style( 'material-icons', 'https://fonts.googleapis.com/icon?family=Material+Icons&display=swap');
    wp_enqueue_style( 'material-symbols', 'https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined&display=swap');
    wp_enqueue_style( 'bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css');
    wp_enqueue_style( 'bootstrap-icons', 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css');
    wp_enqueue_style( 'jquery-ui', 'https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css');
    wp_enqueue_script( 'bundle', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js');
    wp_enqueue_script( 'popper', 'https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js');
    wp_enqueue_script( 'jquery', 'https://code.jquery.com/jquery-3.6.0.js');
    wp_enqueue_script( 'jquery-ui', 'https://code.jquery.com/ui/1.13.2/jquery-ui.js');
 // wp_enqueue_script( 'widgets', 'https://platform.twitter.com/widgets.js');
// <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
// Load All CSS Styles and JavaScripts from the main Assets Folder
/*
  foreach( glob( plugin_dir_path( __FILE__ ) . 'assets/css/*.css' ) as $file ) {
                                    $filename = substr($file, strrpos($file, '/') + 1);
                                    wp_enqueue_style( $filename, plugin_dir_url( __FILE__ ) . 'assets/css/' . $filename );
                    }
                    foreach( glob( plugin_dir_path( __FILE__ ) . 'assets/js/*.js' ) as $file ) {
                                     $filename = substr($file, strrpos($file, '/') + 1);
                                     wp_enqueue_script( $filename, plugin_dir_url( __FILE__ ) . 'assets/js/' . $filename );
                    }
*/
}
add_action( 'admin_enqueue_scripts', 'seobpchat_load_bootstrap' );

function seobpchat_enqueue_custom_styles() {
// Load All CSS Styles and JavaScripts from the main Assets Folder for the Front End
 // Load All CSS Styles from the /inc/css/ Folder
                    foreach( glob( plugin_dir_path( __FILE__ ) . 'inc/assets/css/*.css' ) as $file ) {
                    $filename = substr($file, strrpos($file, '/') + 1);
                    wp_enqueue_style( $filename, plugin_dir_url( __FILE__ ) . 'inc/css/' . $filename );
                    }

                    foreach( glob( plugin_dir_path( __FILE__ ) . 'inc/assets/js/*.js' ) as $file ) {
                    $filename = substr($file, strrpos($file, '/') + 1);
                    wp_enqueue_script( $filename, plugin_dir_url( __FILE__ ) . 'assets/js/' . $filename );
                    }

}
add_action( 'wp_enqueue_scripts', 'seobpchat_enqueue_custom_styles' );

// Loading External Styles and Scripts to Get Work in to the Front End of the Plugin for the Public not the admin part
function seobpchat_load_external_styles() {
    wp_enqueue_style( 'bootstrap-icons', 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css' );
    wp_enqueue_style( 'material-icons', 'https://fonts.googleapis.com/icon?family=Material+Icons&display=swap');
    wp_enqueue_style( 'material-symbols', 'https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined&display=swap');
}
add_action( 'wp_enqueue_scripts', 'seobpchat_load_external_styles' );

function seobpchat_add_menu_pages() {
    add_menu_page(
        __( 'SBP Chat', 'seobookprochat' ),
        __( 'SEO Chat', 'seobookprochat' ),
        'manage_options',
        'seobpchat',
        'seobpchat_page',
        'dashicons-admin-settings',
        10
    );
    add_submenu_page(
     'seobpchat',
        __( 'Chat Settings', 'seobookprochat' ),
        __( 'Chat Settings', 'seobookprochat' ),
        'manage_options',
        'seobpchat-chat-settings',
        'seobpchat_chat_settings',
        11
    );
}
add_action( 'admin_menu', 'seobpchat_add_menu_pages' );


// Register plugin activation and deactivation hooks.
register_activation_hook( __FILE__, 'seobpchat_activate' );
register_deactivation_hook( __FILE__, 'seobpchat_deactivate' );

// Define activation and deactivation functions.
function seobpchat_activate() {
// Do something on activation.
}
function seobpchat_deactivate() {
// Do something on deactivation.
}