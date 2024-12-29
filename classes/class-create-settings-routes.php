<?php
/**
 * This file will create Custom Rest API End Points.
 */


class SMARTCB_WP_React_Settings_Rest_Route {

    public function __construct() {
        add_action( "rest_api_init", [$this, "smartcb_create_rest_rounte"] );
    }

    function smartcb_create_rest_rounte() {

        register_rest_route( 'smartcb/v1', '/settings', array(
            'methods'  => WP_REST_Server::EDITABLE, // For POST requests
            'callback' => [ $this, 'smartcb_save_settings'],
            'permission_callback' => function () {
                return current_user_can( 'manage_options' );
            },
        ) );
    
        register_rest_route( 'smartcb/v1', '/settings', array(
            'methods'  => WP_REST_Server::READABLE, // For GET requests
            'callback' => [ $this,'smartcb_get_settings'],
            'permission_callback' => function () {
                return true;
            },
        ) );
    }

    // Callback for saving settings
    function smartcb_save_settings( WP_REST_Request $request ) {
        $params = $request->get_json_params();

        // Save the settings to the database
        update_option( 'smartcb_banner_title', sanitize_text_field( $params['smartcb_banner_title'] ) );
        update_option( 'smartcb_banner_desc', sanitize_textarea_field( $params['smartcb_banner_desc'] ) );
        update_option( 'smartcb_banner_accept_btn', sanitize_text_field( $params['smartcb_banner_accept_btn'] ) );
        update_option( 'smartcb_banner_decline_btn', sanitize_text_field( $params['smartcb_banner_decline_btn'] ) );

        return new WP_REST_Response( [ 'success' => true ], 200 );
    }

    // Callback for getting settings
    function smartcb_get_settings() {
        return new WP_REST_Response( [
            'smartcb_banner_title'     => get_option( 'smartcb_banner_title', '' ),
            'smartcb_banner_desc'      => get_option( 'smartcb_banner_desc', '' ),
            'smartcb_banner_accept_btn'=> get_option( 'smartcb_banner_accept_btn', '' ),
            'smartcb_banner_decline_btn'=> get_option( 'smartcb_banner_decline_btn', '' ),
        ], 200 );
    }

}


new SMARTCB_WP_React_Settings_Rest_Route();