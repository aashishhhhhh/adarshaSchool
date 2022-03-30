<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\PageType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;
class PageTypeController extends Controller
{
    public function index()
    {
        $pages= PageType::all();
        return view('pages.page-list',compact('pages'));
    }

    public function store(Request $request)
    {
        $data=$request->validate([
            'title'=>'required'
        ]);
       $slug=Str::slug($data['title']);
       $id= PageType::create([
            'title'=>$request->title,
            'slug'=>$slug
       ]);
      
    //    Page::create([
    //        'title'=>$request->title,
    //        'slug'=>$slug,
    //         'page_type_id'=>$id->id
    //    ]);

        return redirect()->route('page-type.index')->with('msg','Page inserted successfully');
    }
}
