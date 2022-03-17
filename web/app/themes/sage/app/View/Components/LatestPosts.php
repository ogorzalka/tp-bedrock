<?php

namespace App\View\Components;

use App\Model\Post;
use Roots\Acorn\View\Component;

class LatestPosts extends Component
{
    public $posts;

    function __construct($args = []) {
        $this->posts = Post::get($args);
    }
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.latest-posts');
    }
}
