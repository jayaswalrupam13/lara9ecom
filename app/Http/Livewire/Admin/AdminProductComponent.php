<?php

namespace App\Http\Livewire\Admin;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class AdminProductComponent extends Component
{
    use WithPagination;

    public $product_id;

    public function deleteProduct(){

        $product = Product::find($this->product_id);
        if(is_file(config('constants.PRODUCT_IMAGE_PATH'). '/'.$product->image)){

            unlink(config('constants.PRODUCT_IMAGE_PATH'). '/'. $product->image);
        }
        $product->delete();
        session()->flash('message', 'Product has been deleted');
    }

    public function render()
    {
        $products = Product::orderBy('created_at', 'DESC')->paginate(10);
        return view('livewire.admin.admin-product-component', compact(['products']));
    }
}
