<?php
namespace App\View\Components;

use Illuminate\View\Component;

class Header extends Component
{
    public int $level;
    public string $classAttr;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(int $level = 1, $className = false)
    {
        $this->level = $level;
        $this->classAttr = $className ? " class=\"{$className}\"" : '';
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.tags.header');
    }
}
