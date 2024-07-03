<?php

namespace App\Http\Livewire\Admin;

use App\Models\HomeSlider;
use Livewire\Component;

class AdminHomeSliderComponent extends Component
{

    public $slide_id;

    public function deleteSlide(){

        $slider = HomeSlider::find($this->slide_id);
        if(is_file(config('constants.SLIDER_IMAGE_PATH'). '/'.$slider->image)){

            unlink(config('constants.SLIDER_IMAGE_PATH'). '/'. $slider->image);
        }
        $slider->delete();
        session()->flash('message', 'Slider has been deleted');
    }

    public function render()
    {
        $slides = HomeSlider::orderBy('created_at', 'DESC')->get();
        return view('livewire.admin.admin-home-slider-component', compact(['slides']));
    }
}
