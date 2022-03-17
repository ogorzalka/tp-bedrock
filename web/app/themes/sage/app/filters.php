<?php

/**
 * Theme filters.
 */

namespace App;

/**
 * Add "… Continued" to the excerpt.
 *
 * @return string
 */
add_filter('excerpt_more', function () {
    return sprintf(' &hellip; <a href="%s">%s</a>', get_permalink(), __('Continued', 'sage'));
});

/*
add_action('acf/init', function() {
    \acf_register_block_type([
        'name' => 'latest-posts',
        'title' => __('Latest Posts'),
        'description' => __('Displays a list of latest posts.'),
        'render_callback' => __NAMESPACE__ . '\\render_latest_posts_block',
    ]);
});

function render_latest_posts_block() {
    $args = [
        'title' => get_field('block_title'),
        'posts_per_page' => get_field('posts_per_page'),
    ];
    echo view('blocks.latest-posts', $args);
}
*/
