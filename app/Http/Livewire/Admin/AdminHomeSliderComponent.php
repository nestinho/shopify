<?php

namespace App\Http\Livewire\Admin;

use App\Models\Homeslider;
use Livewire\Component;

class AdminHomeSliderComponent extends Component
{

    public function deleteSlide($id)
    {
        $slider = Homeslider::find($id);
        $slider->delete();
        session()->flash('message','Slider has been deleted successfully!');
    }

    public function render()
    {
        $sliders = Homeslider::all();
        return view('livewire.admin.admin-home-slider-component',['sliders'=>$sliders])->layout('layouts.base');
    }
}
