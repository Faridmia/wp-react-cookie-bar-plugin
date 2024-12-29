<?php
/**
 * This file will create admin menu page.
 */

class SMARTCB_Create_Admin_Page {

    public function __construct() {
        add_action( 'admin_menu', [ $this, 'smartcb_create_admin_menu' ] );
    }

    public function smartcb_create_admin_menu() {
        $capability = 'manage_options';
        $slug = 'smartcb-settings';

        add_menu_page(
            __( 'SmartCookieBar', 'smartcookiebar' ),
            __( 'SmartCookieBar', 'smartcookiebar' ),
            $capability,
            $slug,
            [ $this, 'smartcb_menu_page_template' ],
            'dashicons-buddicons-replies'
        );
    }

    public function smartcb_menu_page_template() {
        echo '<div class="wrap smartcookiebar"><div class="smartcookiebar-admin-app"></div></div>';
    }

}


new SMARTCB_Create_Admin_Page();