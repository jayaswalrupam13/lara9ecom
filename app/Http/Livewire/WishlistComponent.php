<?php

namespace App\Http\Livewire;

use App\Traits\CommonFunctions;
use Livewire\Component;

class WishlistComponent extends Component
{
    use CommonFunctions; 
    
    public function removeFromWishlist($product_id){

        $this->livewireRemoveWishlist($product_id);        
    }
    
    public function render()
    {
        return view('livewire.wishlist-component');
    }
}
