<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use Livewire\{Component, WithPagination};
use App\Traits\CommonFunctions;

class SearchComponent extends Component
{
    use WithPagination, CommonFunctions;
    public $q, $search_term;
    public $pageSize = 12;
    public $pageSizeOptionList = [12, 15, 25, 32];
    public $orderBy = "default_sorting";
    public $orderByOptionList = ["default_sorting" => "Default Sorting", "price_low_to_high" => "Price: Low to High", 
                                "price_high_to_low" => "Price: High to Low", "newest_date" => "Newest Date"];

    public function store($product_id, $product_name, $product_price){

        $this->livewireStoreCart($product_id, $product_name, $product_price);
    }

    public function mount(){

        $this->fill(request()->only('q'));              // This will fill the $q property with the value from the request
        $this->search_term = "%{$this->q}%";
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

        $products = Product::where('name', 'like', $this->search_term)->orderBy($field, $sort)->paginate($this->pageSize);

        $categories = Category::orderBy('name', 'ASC')->get();
        return view('livewire.search-component', compact(['products', 'categories']));
    }
}
