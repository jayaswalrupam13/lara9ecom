<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class AdminCategoriesComponent extends Component
{

    use WithPagination;

    public $category_id;

    public function deleteCategory(){

        $category = Category::find($this->category_id);
        if(is_file(config('constants.CATEGORY_IMAGE_PATH'). '/'.$category->image)){

            unlink(config('constants.CATEGORY_IMAGE_PATH'). '/'. $category->image);
        }
        $category->delete();
        session()->flash('message', 'Category has been deleted successfully.');
    }

    public function render()
    {
        $categories = Category::orderBy('name', 'ASC')->paginate(30);
        return view('livewire.admin.admin-categories-component', compact(['categories']));
    }
}
