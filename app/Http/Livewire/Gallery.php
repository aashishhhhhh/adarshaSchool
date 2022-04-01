<?php

namespace App\Http\Livewire;

use App\Models\Page;
use Livewire\Component;

class Gallery extends Component
{
    public $gallery;
    public $albums;
    public $showGallery=false;
    public $galleryId;
    public function render()
    {
        return view('livewire.gallery');
    }

    public function showGallery($value)
    {
        $this->galleryId=$value;
        $this->showGallery=true;
        $this->albums=Page::query()->where('page_id',$value)->with('pictures')->get();
    }
}
