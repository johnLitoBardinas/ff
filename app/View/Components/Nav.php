<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Nav extends Component
{
    public $logo;

    public $totalBranch;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct( String $logo, String $totalBranch )
    {
        $this->logo = $logo;
        $this->totalBranch = $totalBranch;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.nav');
    }
}
