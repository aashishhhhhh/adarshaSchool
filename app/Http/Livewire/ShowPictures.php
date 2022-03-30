<?php

namespace App\Http\Livewire;

use App\Models\Picture;
use Livewire\Component;

class ShowPictures extends Component
{

    public $gallery;
    public $msg=null;
    public function render()
    {
        $this->gallery=$this->gallery->load('pictures');
        return view('livewire.show-pictures');
    }

    public function removeImage($id)
    {
        Picture::query()->where('id',$id)->delete();
        $this->msg='Slider deleted Sucessfully';
        $this->render();
    }
    

}
