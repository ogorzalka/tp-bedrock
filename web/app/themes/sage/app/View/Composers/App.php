<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class App extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        '*',
    ];

    /**
     * Data to be passed to view before rendering.
     *
     * @return array
     */
    public function with()
    {
        return [
            'siteName' => $this->getInfo('name'),
            'siteDescription' => $this->getInfo('description'),
        ];
    }

    public function getInfo(string $name)
    {
        return get_bloginfo($name, 'display');
    }
}
