<?php

namespace App\Http\Livewire\Admin;

use App\Models\HomeSlider;
use Livewire\Component;
use Livewire\WithFileUploads;

class AdminAddHomeSlideComponent extends Component
{
    public $top_title, $title, $sub_title, $offer, $link, $image, $status = 1, $slide_id, $new_image;

    use WithFileUploads;

    public function mount($slide_id = NULL){

        if ($slide_id) {
            $slider = HomeSlider::find($slide_id);
            $this->slide_id = $slide_id;            
            $this->top_title = $slider->top_title;
            $this->title = $slider->title;
            $this->sub_title = $slider->sub_title;
            $this->offer = $slider->offer;
            $this->link = $slider->link;
            $this->status = $slider->status;
            $this->image = $slider->image;    

            //copy_values_this_to_model($this, $slider);
        } 
    }

    public function updateSlide(){

        $validatedData = $this->validate([
                                            'top_title' => 'required',
                                            'title' => 'required',
                                            'sub_title' => 'required',
                                            'offer' => 'required',
                                            'link' => 'required',
                                            'status' => 'required',
                                        ]);
        $slider = HomeSlider::find($this->slide_id);
        $slider = copy_values_this_to_model($validatedData, $slider);   

        if($this->new_image){

            if(is_file(config('constants.SLIDER_IMAGE_PATH'). '/'.$slider->image)){

                unlink(config('constants.SLIDER_IMAGE_PATH'). '/'. $slider->image);
            }

            $obj = new AdminAddProductComponent();
            $slider->image = $obj->setProductFileName($this->new_image);
            $this->new_image->storeAs(config('constants.SLIDER_PATH'), $slider->image);
        }       

        $slider->save();
        session()->flash('message', 'Slider has been updated successfully!');
    }

    public function addSlide(){

        $validatedData = $this->validate([
                                            'top_title' => 'required',
                                            'title' => 'required',
                                            'sub_title' => 'required',
                                            'offer' => 'required',
                                            'link' => 'required',
                                            'image' => 'required',
                                            'status' => 'required'
                                        ]);

        $slider = new HomeSlider();
        $slider = copy_values_this_to_model($validatedData, $slider);   

        $obj = new AdminAddProductComponent();
        $slider->image = $obj->setProductFileName($this->image);
        $this->image->storeAs(config('constants.SLIDER_PATH'), $slider->image); 
        
        $slider->save();
        //$this->reset();
        session()->flash('message', 'Slider has been created successfully.');

    }

    public function render(){
        
        return view('livewire.admin.admin-add-home-slide-component');
    }
}
