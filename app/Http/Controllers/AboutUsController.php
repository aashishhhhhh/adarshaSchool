<?php

namespace App\Http\Controllers;

use App\Http\Helper\MediaHelper;
use App\Http\Requests\AboutUsRequest;
use App\Models\AboutUs;
use App\Models\Page;
use App\Models\PageType;
use App\Models\Picture;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use File;
use Illuminate\Support\Facades\DB;

class AboutUsController extends Controller
{
    public $slug;
    public $pageType;
    public function __construct()
    {
        $this->slug='about-us';
        $this->pageType=PageType::query()->where('slug',$this->slug)->first();
    }
    public function index()
    {
       $aboutus= $this->pageType;
    
        return view('about-us.about-us', [
            'aboutus' => $this->pageType == null ? '' : $this->pageType->load('pages')
        ]);
        // $aboutus=Page::query()->where('slug',$this->slug)->get();
    }
    public function create()
{
         return view('about-us.about-us-add');
    }
    public function store(Request $request)
    {
        $data=$request->validate([
            'title'=>'required',
            'content'=>'required',
        ]);

           $id= Page::create([
                'slug'=>Str::slug($request->title),
                'title'=>$request->title,
                'content'=>json_encode($request->except('_token')),
                'page_type_id'=>$this->pageType->id,
                'show_on_home'=>1
            ]);

        return redirect()->route('aboutus.index')->with('msg','About Us Content Created successfully');

     }

     public function edit($id)
     {
         $aboutus=Page::find($id);
         return view('about-us.about-us-edit',compact('aboutus'));
     }

     public function update(Request $request,$aboutus)
     {
         $aboutus=Page::find($aboutus);
        $data=$request->validate([
            'title'=>'required',
            'content'=>'required',
        ]);

        $aboutus->update([
            'slug'=>Str::slug($request->title),
            'title'=>$request->title,
            'content'=>json_encode($request->except('_token')),
        ]);
        return redirect()->route('aboutus.index')->with('msg','About Us Content Created successfully');
     }


    public function updatee(Request $request)
    {
       $request=json_encode($request->except('_token'));
            Page::query()->where('slug',$this->slug)->update([
            'content'=>$request
            ]);
        return redirect()->route('aboutUs-edit')->with('msg','About Us Content inserted successfully');
    }

    public function addDetail(Page $aboutus)
    {
        return view('about-us.add-detail',compact('aboutus'));
    }

    public function storeDetail(Request $request, MediaHelper $mediaHelper)
    {
        $data= $request->validate([
            'name.*'=>'required',
            'Designation.*'=>'required',
            'photo.*'=>'required'
        ]);
        
        foreach ($request->name as $key => $value) {
            $data=array();
            $data['name']=$request->name[$key];
            $data['Designation']=$request->Designation[$key];
            if (array_key_exists('photo',$request->all())) {
                if (array_key_exists($key,$request->photo)) {
                   $id=Page::create([
                        'slug'=>Str::slug($request->name[$key]),
                        'title'=>$request->name[$key],
                        'content'=>json_encode($data),
                        'page_type_id'=>null,
                        'page_id'=>$request->aboutUsId,
                        'show_on_home'=>1
                    ]);

                    $imageName = $mediaHelper->uploadSingleImage($request->photo[$key]);
                     
                            Picture::create([
                                'imageable_id' => $id->id,
                                'imageable_type' => Page::NAMESPACE,
                                'url' => $imageName,
                                'is_banner'=>0
                            ]);
                }
                else{
                    Page::create([
                        'slug'=>Str::slug($request->name[$key]),
                        'title'=>$request->name[$key],
                        'content'=>json_encode($data),
                        'page_type_id'=>null,
                        'page_id'=>$request->aboutUsId,
                        'show_on_home'=>1
                    ]);
                }
            }
            else{
                Page::create([
                    'slug'=>Str::slug($request->name[$key]),
                    'title'=>$request->name[$key],
                    'content'=>json_encode($data),
                    'page_type_id'=>null,
                    'page_id'=>$request->aboutUsId,
                    'show_on_home'=>1
                ]);
            }
           
        }
        return redirect()->route('aboutus.index')->with('msg','About Us Content Created successfully');
    }

    public function showDetail($aboutus)
    {
        $id=$aboutus;
        $title=Page::find($aboutus)->title;
        $aboutus=Page::query()->where('page_id',$aboutus)->with('pictures')->get();
        return view('about-us.show-detail',['aboutus'=>$aboutus,'title'=>$title,'id'=>$id]);
    }

    public function editDetail(Page $aboutus)
    {   
        $aboutus->load('pictures');
        return view('about-us.edit-detail',['aboutus'=>$aboutus]);
    }

    public function updateDetail (Request $request,MediaHelper $mediaHelper)
    {
        $aboutus=Page::query()->where('id',$request->aboutUsId)->first()->load('pictures');
        $data= $request->validate([
            'name'=>'required',
            'Designation'=>'required',
        ]);
        $data=array();
        $data['name']=$request->name;
        $data['Designation']=$request->Designation;
        DB::transaction(function () use ($request, $mediaHelper,$aboutus) {

       if ($request->hasFile('photo')) {
          foreach ($aboutus->pictures as $key => $value) {
              if (File::exists(public_path('storage/thumbnails/' . $value->url))) {
            File::delete(public_path('storage/thumbnails/' . $value->url));
            File::delete(public_path('storage/upload/' . $value->url));
            }
             $value->delete();
             $imageName = $mediaHelper->uploadSingleImage($request->photo);
             Picture::create([
                'imageable_id' => $request->aboutUsId,
                'imageable_type' => Page::NAMESPACE,
                'url' => $imageName,
                'is_banner'=>0
            ]);
          }
       }
    });
       Page::query()->where('id',$request->aboutUsId)->update([
        'slug'=>Str::slug($request->name),
        'title'=>$request->name,
        'content'=>json_encode($data),
       ]);
       return redirect()->route('aboutus.index')->with('msg','Detail Updated successfully');

    }
}
