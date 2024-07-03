<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartComponent extends Component
{

    public function increaseQuantity($rowId){

        $product = Cart::instance('cart')->get($rowId);
        $qty = $product->qty + 1;
        Cart::instance('cart')->update($rowId, $qty);
        $this->emitTo('cart-icon-component', 'refreshComponent');
    }

    public function decreaseQuantity($rowId){

        $product = Cart::instance('cart')->get($rowId);
        $qty = $product->qty - 1;
        Cart::instance('cart')->update($rowId, $qty);
        $this->emitTo('cart-icon-component', 'refreshComponent');
    }

    public function deleteItemInCart($id){

        Cart::instance('cart')->remove($id);
        $this->emitTo('cart-icon-component', 'refreshComponent');
        session()->flash('success_msg', 'Item has been removed');
    }

    public function emptyCart(){

        Cart::instance('cart')->destroy();
        $this->emitTo('cart-icon-component', 'refreshComponent');
        session()->flash('success_msg', 'Cart is empty');
    }

    public function render()
    {
        return view('livewire.cart-component');
    }
}
