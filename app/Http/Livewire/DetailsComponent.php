<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use App\Traits\CommonFunctions;

class DetailsComponent extends Component
{
    public $slug;
    public function mount($slug)
    {

        $this->slug = $slug;
    }
    use CommonFunctions;

    public function store($product_id, $product_name, $product_price){

        $this->livewireStoreCart($product_id, $product_name, $product_price);
    }

    public function render()
    {
        $product = Product::where('slug', $this->slug)->first();
        $rproducts = Product::where('category_id', $product->category_id)->inRandomOrder()->limit(4)->get();
        $nproducts = Product::Latest()->take(4)->get();
        return view('livewire.details-component', compact('product', 'rproducts', 'nproducts'));
    }
}
