<?php

namespace App\Providers\Block;

use Illuminate\Support\ServiceProvider;

class LatestPosts extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        add_action('acf/init', [$this, 'registerBlock']);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function registerBlock()
    {
        \acf_register_block_type([
            'name' => 'latest-posts',
            'title' => __('Latest Posts'),
            'description' => __('Displays a list of latest posts.'),
            'render_callback' => [$this, 'render'],
        ]);
    }

    public function render()
    {
        $args = [
            'title' => get_field('block_title'),
            'posts_per_page' => get_field('posts_per_page'),
        ];
        echo view('blocks.latest-posts', $args);
    }
}
