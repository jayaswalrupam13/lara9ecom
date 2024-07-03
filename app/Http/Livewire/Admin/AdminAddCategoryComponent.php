<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use App\Traits\CommonFunctions;
use Livewire\Component;
use Livewire\WithFileUploads;

class AdminAddCategoryComponent extends Component
{
    public $name, $slug, $category_id, $image, $is_popular = 0, $new_image;

    use CommonFunctions, WithFileUploads;

    public function generateSlug(){

        $this->slug = $this->generate_common_slug($this->name);
    }

    public function mount($category_id = NULL){

        if ($category_id) {                    
            $category = Category::find($category_id);            
            $get_public_vars = get_public_vars($this);   
            copy_values_model_to_this($category, $this, $get_public_vars);       
            $this->category_id = $category_id; 
                 
            //cd($get_public_vars);dd($this);

            /*
            $this->name = $category->name;
            $this->slug = $category->slug;
            $this->image = $category->image;
            $this->is_popular = $category->is_popular;

            */
        } 
    }

    public function updated($fields){

        $this->validateOnly($fields, [
            'name' => 'required',
            'image' => 'required',
            'is_popular' => 'required',
            'slug' => 'required'
        ]);
    }

    public function storeCategory(){

        $validatedData = $this->validate([
            'name' => 'required',
            'image' => 'required',
            'is_popular' => 'required',
            'slug' => 'required'
        ]);
        $category = new Category();
        $category = copy_values_this_to_model($validatedData, $category);   

        $obj = new AdminAddProductComponent();
        $category->image = $obj->setProductFileName($this->image);
        $this->image->storeAs(config('constants.CATEGORY_PATH'), $category->image); 
        
        $category->save();
        //$this->reset();
        session()->flash('message', 'Category has been created successfully.');
    }

    public function updateCategory(){
        
        $validatedData = $this->validate([
            'name' => 'required',
            'is_popular' => 'required',
            'slug' => 'required'
        ]);
        
        $category = Category::find($this->category_id);
        $category = copy_values_this_to_model($validatedData, $category);   
        
        if($this->new_image){

            if(is_file(config('constants.CATEGORY_IMAGE_PATH'). '/'.$category->image)){
                
                unlink(config('constants.CATEGORY_IMAGE_PATH'). '/'. $category->image);
            }

            $obj = new AdminAddProductComponent();
            $category->image = $obj->setProductFileName($this->new_image);
            $this->new_image->storeAs(config('constants.CATEGORY_PATH'), $category->image);
        } 

        $category->save();        
        session()->flash('message', 'Category has been updated successfully.');
        
    }


    public function render()
    {
        return view('livewire.admin.admin-add-category-component');
    }
}
