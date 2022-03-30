<?php

namespace App\Http\Livewire;

use App\Models\Page;
use App\Models\Picture;
use Livewire\Component;

class SliderList extends Component
{

    public $slider;
    public $pagee;
    public $msg=false;
    public $page;
    public function render()
    {
        $this->pagee=Page::query()->where('slug','slider')->first();
        $this->slider=$this->pagee == null ? '' : $this->pagee->load('pictures');
        return view('livewire.slider-list');
    }

    public function removeImage($value)
    {
       Picture::query()->where('id',$value)->delete();
       $this->msg='Slider deleted Sucessfully';
       $this->render();
    }
}
