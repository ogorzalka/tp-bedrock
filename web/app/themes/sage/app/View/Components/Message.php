<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Message extends Component
{
    public $mood;
    public $linkHtml;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($mood = 'happy', $link = false)
    {
        $this->mood = $mood;
        if ($link) {
            $this->linkHtml = view('partials.message.link', ['link' => $link]);
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.message');
    }
}
