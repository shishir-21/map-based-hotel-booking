<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Add meta box
 */
function mbhb_add_hotel_meta_box() {
    add_meta_box(
        'mbhb_hotel_details',
        'Hotel Details',
        'mbhb_hotel_meta_box_callback',
        'hotel',
        'normal',
        'default'
    );
}
add_action( 'add_meta_boxes', 'mbhb_add_hotel_meta_box' );

/**
 * Meta box HTML
 */
function mbhb_hotel_meta_box_callback( $post ) {

    wp_nonce_field( 'mbhb_save_hotel_meta', 'mbhb_hotel_meta_nonce' );

    $price = get_post_meta( $post->ID, '_mbhb_price', true );
    $lat   = get_post_meta( $post->ID, '_mbhb_lat', true );
    $lng   = get_post_meta( $post->ID, '_mbhb_lng', true );
    ?>

    <p>
        <label><strong>Price (₹)</strong></label><br>
        <input type="number" name="mbhb_price" value="<?php echo esc_attr( $price ); ?>" style="width:100%;">
    </p>

    <p>
        <label><strong>Latitude</strong></label><br>
        <input type="text" name="mbhb_lat" value="<?php echo esc_attr( $lat ); ?>" style="width:100%;">
    </p>

    <p>
        <label><strong>Longitude</strong></label><br>
        <input type="text" name="mbhb_lng" value="<?php echo esc_attr( $lng ); ?>" style="width:100%;">
    </p>

    <?php
}

/**
 * Save meta box data
 */
function mbhb_save_hotel_meta( $post_id ) {

    if ( ! isset( $_POST['mbhb_hotel_meta_nonce'] ) ) return;
    if ( ! wp_verify_nonce( $_POST['mbhb_hotel_meta_nonce'], 'mbhb_save_hotel_meta' ) ) return;

    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

    if ( isset( $_POST['mbhb_price'] ) ) {
        update_post_meta( $post_id, '_mbhb_price', sanitize_text_field( $_POST['mbhb_price'] ) );
    }

    if ( isset( $_POST['mbhb_lat'] ) ) {
        update_post_meta( $post_id, '_mbhb_lat', sanitize_text_field( $_POST['mbhb_lat'] ) );
    }

    if ( isset( $_POST['mbhb_lng'] ) ) {
        update_post_meta( $post_id, '_mbhb_lng', sanitize_text_field( $_POST['mbhb_lng'] ) );
    }
}
add_action( 'save_post', 'mbhb_save_hotel_meta' );
