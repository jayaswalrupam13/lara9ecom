<?php

namespace App\Traits;

/**
 * @method static App\Gloudemans\Shoppingcart\Facades\Cart::class function()
 */
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Str;

trait CommonFunctions
{

    public function generate_common_slug($name){

        return Str::slug($name);
    }

    public function livewireStoreCart($product_id, $product_name, $product_price, $product_quantity = 1)
    {
        Cart::instance('cart')->add($product_id, $product_name, $product_quantity, $product_price)->associate('\App\Models\Product');
        session()->flash('success_msg', 'Item added in cart');
        return redirect()->route('shop.cart');
    }

    public function livewireRemoveWishlist($product_id)
    {
        foreach(Cart::instance('wishlist')->content() as $wishItem){

            if($wishItem->id == $product_id){

                Cart::instance('wishlist')->remove($wishItem->rowId);
                $this->emitTo('wishlist-icon-component', 'refreshComponent');
                return;
            }

        }
    }
}
?>