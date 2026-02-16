<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ProductGrid extends Component
{
    public $products;

    /**
     * Create a new component instance.
     */
    public function __construct($products = [])
    {
        $this->products = $products;
    }

    public function render()
    {
        return view('components.product-grid');
    }
}
