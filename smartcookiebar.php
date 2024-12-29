<?php
/**
 * Plugin Name: SmartCookieBar
 * Author: Farid Mia
 * Author URI: https://github.com/faridmia
 * Version: 1.0.0
 * Description: SmartCookieBar is a customizable WordPress plugin for displaying elegant cookie banners, ensuring GDPR and CCPA compliance with easy consent        management and user-friendly settings.
 * Text-Domain: smartcookiebar
 */

if( ! defined( 'ABSPATH' ) ) : exit(); endif; // No direct access allowed.

/**
* Define Plugins Contants
*/
define ( 'SMARTCB_COOKIE_PATH', trailingslashit( plugin_dir_path( __FILE__ ) ) );
define ( 'SMARTCB_COOKIE_URL', trailingslashit( plugins_url( '/', __FILE__ ) ) );
define('SMARTCB_COOKIE_IMG', SMARTCB_COOKIE_URL );
/**
 * Loading Necessary Scripts
 */
add_action( 'wp_enqueue_scripts', 'wp_react_cookie_load_scripts' );
add_action( 'admin_enqueue_scripts', 'wp_react_cookie_load_scripts' );
function wp_react_cookie_load_scripts() {


    
        wp_enqueue_style( 'smartcb-bootstrap-css', SMARTCB_COOKIE_URL . '/assets/bootstrap/css/bootstrap.min.css', __FILE__);
        wp_enqueue_style( 'smartcb-main-css', SMARTCB_COOKIE_URL . '/assets/style.css', __FILE__);

        // Include Local Bootstrap JS
        wp_enqueue_script(
            'smartcb-bootstrap-js',
            SMARTCB_COOKIE_URL. '/assets/bootstrap/js/bootstrap.bundle.min.js',
            [ 'jquery' ],
            time(),
            true
        );
        wp_enqueue_script(
            'smartcb-cookie-js',
            SMARTCB_COOKIE_URL. '/assets/js.cookie.min.js',
            [ 'jquery' ],
            time(),
            true
        );
    

    wp_enqueue_script( 'smartcb-wp-react-bundle', SMARTCB_COOKIE_URL . 'dist/bundle.js', [ 'jquery', 'wp-element' ], wp_rand(), true );

    wp_localize_script( 'smartcb-wp-react-bundle', 'appCookie', [
        'apiUrl' => esc_url_raw(rest_url()),
        'nonce' => wp_create_nonce( 'wp_rest'),
        'cookie_assets_url' => SMARTCB_COOKIE_IMG,
        'is_admin' => is_admin(),
    ] );
    

}

// Add cookie banner div to the footer
function smartcb_cookie_banner_mark_func() {
    echo '<div class="smartcb-react-cookie-banner-wrapper"></div>';
}
add_action('wp_footer', 'smartcb_cookie_banner_mark_func');


require_once SMARTCB_COOKIE_PATH . 'classes/class-create-admin-menu.php';
require_once SMARTCB_COOKIE_PATH . 'classes/class-create-settings-routes.php';