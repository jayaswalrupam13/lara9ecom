<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use Livewire\{Component, WithPagination};
use App\Traits\CommonFunctions;
use Gloudemans\Shoppingcart\Facades\Cart;

class ShopComponent extends Component
{
    use WithPagination, CommonFunctions;
    
    public $min_value = 0, $max_value = 1000;
    public $pageSize = 12;
    public $pageSizeOptionList = [12, 15, 25, 32];
    public $orderBy = "default_sorting";
    public $orderByOptionList = ["default_sorting" => "Default Sorting", "price_low_to_high" => "Price: Low to High", 
                                "price_high_to_low" => "Price: High to Low", "newest_date" => "Newest Date"];

    public function store($product_id, $product_name, $product_price){

        /*Cart::add($product_id, $product_name, 1, $product_price)->associate('\App\Models\Product');
        session()->flash('success_msg', 'Item added in cart');
        return redirect()->route('shop.cart');*/

        $this->livewireStoreCart($product_id, $product_name, $product_price);
    }

    public function addToWishlist($product_id, $product_name, $product_price){

        Cart::instance('wishlist')->add($product_id, $product_name, 1, $product_price)->associate('App\models\Product');        
        $this->emitTo('wishlist-icon-component', 'refreshComponent');
    }

    public function removeFromWishlist($product_id){

        $this->livewireRemoveWishlist($product_id);        
    }

    public function changePageSize($size){

        $this->pageSize = $size;
    }

    public function changeOrderBy($order){

        $this->orderBy = $order;
    }

    public function render()
    {
        switch ($this->orderBy){

            case "price_low_to_high":

                $field = 'regular_price'; $sort = 'ASC';
            break;   
            
            case "price_high_to_low":
                
                $field = 'regular_price'; $sort = 'DESC';
            break; 
            
            case "newest_date":
            
                $field = 'created_at'; $sort = 'DESC';
            break; 
            
            default:

                $field = 'created_at'; $sort = 'ASC';
        }

        $products = Product::whereBetween('regular_price', [$this->min_value, $this->max_value])->orderBy($field, $sort)->paginate($this->pageSize);
        $categories = Category::orderBy('name', 'ASC')->get();
        
        return view('livewire.shop-component', compact(['products', 'categories']));
    }
}
