<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\HomeSlider;
use App\Models\Product;
use App\Traits\CommonFunctions;
use Livewire\Component;

class HomeComponent extends Component
{
    use CommonFunctions;

    public function store($product_id, $product_name, $product_price){

        $this->livewireStoreCart($product_id, $product_name, $product_price);
    }

    public function render()
    {
        $slides = HomeSlider::where('status', 1)->get();
        $lproducts = Product::orderBy('created_at', 'DESC')->get()->take(8);
        $fproducts = Product::where('featured', 1)->inRandomOrder()->get()->take(8);
        $pcategories = Category::where('is_popular', 1)->inRandomOrder()->get()->take(8);
        return view('livewire.home-component', compact(['slides', 'lproducts', 'fproducts', 'pcategories']));
    }
}
