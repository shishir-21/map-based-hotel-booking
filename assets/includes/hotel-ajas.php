<?php
add_action('wp_ajax_mbhb_get_hotels', 'mbhb_get_hotels');
add_action('wp_ajax_nopriv_mbhb_get_hotels', 'mbhb_get_hotels');

function mbhb_get_hotels() {

    $query = new WP_Query([
        'post_type' => 'hotel',
        'posts_per_page' => -1
    ]);

    $hotels = [];

    while ($query->have_posts()) {
        $query->the_post();

        $hotels[] = [
    'title' => get_the_title(),
    'price' => get_post_meta(get_the_ID(), '_mbhb_price', true),
    'rating' => '4.5',
    'image' => get_the_post_thumbnail_url(get_the_ID(), 'medium'),
    'lat' => get_post_meta(get_the_ID(), '_mbhb_lat', true),
    'lng' => get_post_meta(get_the_ID(), '_mbhb_lng', true),
];

    }

    wp_reset_postdata();

    wp_send_json($hotels);
}
