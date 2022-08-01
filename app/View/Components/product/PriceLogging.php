<?php

namespace App\View\Components\product;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PriceLogging extends Component
{
    public function render(): View
    {
        return view('product.components.price-logging');
    }
}
