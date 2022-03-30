<?php

namespace App\Http\Controllers;

use App\Http\Helper\MediaHelper;
use App\Models\Page;
use App\Models\PageType;
use App\Models\Picture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laravel\Ui\Presets\React;
use Illuminate\Support\Str;

class GalleryController extends Controller
{
    public $slug='gallery';
    public $pageType;
    public function __construct()
    {
        $this->pageType=PageType::query()->where('slug',$this->slug)->first();
    }
    public function index()
    {
        return view('gallery.gallery', [
            'gallery' => $this->pageType == null ? '' : $this->pageType->load('pages')
        ]);
    }

    public function create()
    {
        return view('gallery.gallery-add');
    }

    public function store(Request $request,MediaHelper $mediaHelper){
        $data=$request->validate([
            'title'=>'required',
            'photo.*' => 'required',
        ]);
        DB::transaction(function () use ($request, $mediaHelper) {
            if ($request->hasFile('photo')) {
                foreach ($request->photo as $key => $image) {
                   $imageName[]=$mediaHelper->uploadSingleImage($image);

                }
                $id= Page::create([
                    'slug'=>Str::slug($request->title),
                    'title'=>$request->title,
                    'content'=>json_encode($request->except('_token')),
                    'page_type_id'=>$this->pageType->id,
                    'show_on_home'=>1
                ]);

                foreach ($imageName as $key => $image) {
                    Picture::create([
                        'imageable_id'=>$id->id,
                        'imageable_type'=>Page::NAMESPACE,
                        'url'=>$image,
                        'is_banner'=>0
                    ]);
                }
            }
        });
        return redirect()->route('gallery.index')->with('msg','Gallery Created successfully');

    }

    public function edit(Page $gallery)
    {
        $gallery=$gallery->load('pictures');
        return view('gallery.gallery-edit',compact('gallery'));
    }

    public function update(Request $request,MediaHelper $mediaHelper,Page $gallery)
    {
        $data=$request->validate([
            'title'=>'required',
            'photo.*' => 'required',
        ]);
        DB::transaction(function () use ($request, $mediaHelper,$gallery) {
            if ($request->hasFile('photo')) {
                foreach ($request->photo as $key => $image) {
                   $imageName[]=$mediaHelper->uploadSingleImage($image);
                }
                   

                foreach ($imageName as $key => $image) {
                    Picture::create([
                        'imageable_id'=>$gallery->id,
                        'imageable_type'=>Page::NAMESPACE,
                        'url'=>$image,
                        'is_banner'=>0
                    ]);
                }
            }
            $gallery->update([
                'slug'=>Str::slug($request->title),
                'content'=>json_encode($request->except('_token')),
                'title'=>$request->title,
            ]);
        });
        return redirect()->route('gallery.index')->with('msg','Gallery Created successfully');
    }

    public function showPhotos(Page $gallery)
    {
        $gallery->load('pictures');
        return view('gallery.show-pictures',compact('gallery'));
    }

    public function galleryDestroy(Page $gallery)
    {
       if ($gallery->load('pictures')!=null) {
           $gallery->load('pictures')->delete();
           $gallery->delete();
       }
       return redirect()->route('gallery.index')->with('msg','Gallery Deleted successfully');
    }
}
