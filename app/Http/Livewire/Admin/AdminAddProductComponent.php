<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use App\Models\Product;
use App\Traits\CommonFunctions;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;

class AdminAddProductComponent extends Component
{
    public $name, $slug, $short_description, $description, $regular_price, $sale_price, $sku, 
    $stock_status = 'instock', $featured = 0, 
    $quantity, $image, $category_id, $product_id, $new_image;    
    
    use CommonFunctions;
    use WithFileUploads;

    public function generateSlug(){

        $this->slug = $this->generate_common_slug($this->name);
    }

    public function setProductFileName($imageObj){

        $originalName = $imageObj->getClientOriginalName();
        $nameWithoutExtension = pathinfo($originalName, PATHINFO_FILENAME);
        return $nameWithoutExtension.'-'.Carbon::now()->timestamp.'.'.$imageObj->extension();        
    }

    public function mount($product_id=NULL){

        if($product_id){

            $product = Product::find($product_id);
            $this->name = $product->name;
            $this->slug = $product->slug;
            $this->short_description = $product->short_description;
            $this->description = $product->description;
            $this->regular_price = $product->regular_price;
            $this->sale_price = $product->sale_price;
            $this->sku = $product->SKU;
            $this->stock_status = $product->stock_status;
            $this->featured = $product->featured;
            $this->quantity = $product->quantity;
            $this->image = $product->image;     
            $this->category_id = $product->category_id;
            
        }
    }

    public function addProduct(){

        $this->validate([
                            'name' => 'required',
                            'slug' => 'required',
                            'short_description' => 'required',
                            'description' => 'required',
                            'regular_price' => 'required',
                            'sale_price' => 'required',
                            'sku' => 'required',
                            'stock_status' => 'required',
                            'featured' => 'required',
                            'quantity' => 'required',
                            'image' => 'required',
                            'category_id' => 'required'
                        ]);
        $product = new Product();
        $product->name = $this->name;
        $product->slug = $this->slug;
        $product->short_description = $this->short_description;
        $product->description = $this->description;
        $product->regular_price = $this->regular_price;
        $product->sale_price = $this->sale_price;
        $product->sku = $this->sku;
        $product->stock_status = $this->stock_status;
        $product->featured = $this->featured;
        $product->quantity = $this->quantity;
        $product->category_id = $this->category_id;

        $product->image = $this->setProductFileName($this->image);
        $this->image->storeAs(config('constants.PRODUCT_PATH'), $product->image);        
        
        $product->save();
        session()->flash('message', 'Product has been added!');
    }

    public function updateProduct(){

        $this->validate([
                            'name' => 'required',
                            'slug' => 'required',
                            'short_description' => 'required',
                            'description' => 'required',
                            'regular_price' => 'required',
                            'sale_price' => 'required',
                            'sku' => 'required',
                            'stock_status' => 'required',
                            'featured' => 'required',
                            'quantity' => 'required',
                            'image' => 'required',
                            'category_id' => 'required'
                        ]);
        $product = Product::find($this->product_id);
        $product->name = $this->name;
        $product->slug = $this->slug;
        $product->short_description = $this->short_description;
        $product->description = $this->description;
        $product->regular_price = $this->regular_price;
        $product->sale_price = $this->sale_price;
        $product->sku = $this->sku;
        $product->stock_status = $this->stock_status;
        $product->featured = $this->featured;
        $product->quantity = $this->quantity;
        $product->category_id = $this->category_id;

        if($this->new_image){

            if(is_file(config('constants.PRODUCT_IMAGE_PATH'). '/'.$product->image)){

                unlink(config('constants.PRODUCT_IMAGE_PATH'). '/'. $product->image);
            }

            $product->image = $this->setProductFileName($this->new_image);
            $this->new_image->storeAs(config('constants.PRODUCT_PATH'), $product->image); 
        }

        $product->save();
        session()->flash('message', 'Product has been updated successfully!');
    }

    public function render()
    {   
        $categories = Category::orderBy('name', 'ASC')->get();
        return view('livewire.admin.admin-add-product-component', compact(['categories']));
    }
}
