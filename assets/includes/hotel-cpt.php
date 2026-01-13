<?php
// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function mbhb_register_hotel_cpt() {

    $labels = array(
        'name'               => 'Hotels',
        'singular_name'      => 'Hotel',
        'menu_name'          => 'Hotels',
        'add_new'            => 'Add New Hotel',
        'add_new_item'       => 'Add New Hotel',
        'edit_item'          => 'Edit Hotel',
        'new_item'           => 'New Hotel',
        'view_item'          => 'View Hotel',
        'search_items'       => 'Search Hotels',
        'not_found'          => 'No hotels found',
        'not_found_in_trash' => 'No hotels found in Trash',
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'menu_icon'          => 'dashicons-building',
        'supports'           => array( 'title', 'thumbnail' ),
        'has_archive'        => true,
        'show_in_rest'       => true, // Gutenberg support
    );

    register_post_type( 'hotel', $args );
}

add_action( 'init', 'mbhb_register_hotel_cpt' );
