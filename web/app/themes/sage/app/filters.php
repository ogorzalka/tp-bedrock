<?php

/**
 * Theme filters.
 */

namespace App;

use AmphiBee\AcfBlocks\Block;
use WordPlate\Acf\Fields\Image;
use WordPlate\Acf\Fields\Text;
use WordPlate\Acf\Fields\WysiwygEditor;

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
/*
Block::make('Contenu + Image')
    ->setView('blocks.content-image')
    ->enableJsx()
    ->setFields([
        Text::make('Titre', 'block_title'),
        WysiwygEditor::make('Contenu', 'block_content'),
        Image::make('Image', 'block_image')->returnFormat('id'),
    ]);
*/

add_action('acf/init', function() {
    \acf_register_block_type([
        'name' => 'slider',
        'title' => __('Slider'),
        'description' => __('Displays a unique slider !'),
        'render_callback' => '\\App\\render_slider',
        'enqueue_script' => get_stylesheet_directory_uri() . '/resources/scripts/block/slider.js'
    ]);
});

function render_slider() {
    $slides = [];

    if ($repeater = get_field('slider')) {
        foreach ($repeater as $slide) {
            $slides[] = (object)[
                'image' => \wp_get_attachment_image($slide['image'], 'full'),
                'title' => $slide['title'],
                'description' => $slide['description'],
                'permalink' => $slide['lien']['url'],
            ];
        }
    }

    echo view('blocks.slider', [ 'slides' => $slides ]);
}
