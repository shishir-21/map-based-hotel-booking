<?php
/*
Plugin Name: Map Based Hotel Booking
Description: Displays hotels on a map.
Version: 1.0
Author: Shishir Mathur
License: GPLv2
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

require_once plugin_dir_path( __FILE__ ) . 'includes/hotel-cpt.php';
require_once plugin_dir_path( __FILE__ ) . 'includes/hotel-meta-box.php';
require_once plugin_dir_path(__FILE__) . 'includes/hotel-ajax.php';
add_action( 'wp_enqueue_scripts', function () {

    wp_enqueue_script(
        'mbhb-hotel-js',
        plugin_dir_url( __FILE__ ) . 'assets/js/hotel.js',
        [],
        '1.0',
        true
    );

    wp_localize_script(
        'mbhb-hotel-js',
        'mbhb_ajax',
        [
            'ajax_url' => admin_url( 'admin-ajax.php' )
        ]
    );
});
