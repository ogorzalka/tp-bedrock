<?php

namespace App\Providers\Block;

use Illuminate\Support\ServiceProvider;

class Slider extends ServiceProvider
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
            'name' => 'slider',
            'title' => __('Slider'),
            'description' => __('Displays a unique slider !'),
            'render_callback' => [$this, 'render'],
        ]);
    }

    public function render()
    {
        $args = [
        ];
        echo view('blocks.latest-posts', $args);
    }
}
