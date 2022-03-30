<?php

namespace App\Http\Controllers;

use App\Http\Helper\MediaHelper;
use App\Models\Page;
use App\Models\PageType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DownloadsController extends Controller
{
    public $slug='downloads';
    public $pageType;
    public function __construct()
    {
        $this->pageType=PageType::query()->where('slug',$this->slug)->first();
    }
    public function index()
    {
        return view('download.download-list', [
            'result' => $this->pageType == null ? '' : $this->pageType->load('pages')
        ]);
    }

    public function create()
    {
        return view('download.download-add');
    }

    public function store(Request $request,MediaHelper $mediaHelper)
    {

        $data=$request->validate([
            'title'=>'required',
            'file'=>'sometimes'
        ]);
        DB::transaction(function () use ($request, $mediaHelper) {

        if ($request->hasFile('file')) {
            if ($request->file->getClientOriginalExtension()=='pdf') {
                $orginalName = Str::before($request->file->getClientOriginalName(), '.');
                $fileName =  $orginalName . "-" . Str::random(10) . "." . $request->file->extension();
                $filePath = storage_path() . '/app/public/upload/';
                $request->file->storeAs('upload', $fileName, 'public');
            }
            else{
                $fileName=$mediaHelper->uploadSingleImage($request->file);
            }
           json_encode([$request->except('_token'),'RealFile'=>$fileName]);
           $id= Page::create([
                'slug'=>Str::slug($request->title),
                'title'=>$request->title,
                'content'=>json_encode([$request->except('_token'),'RealFile'=>$fileName]),
                'page_type_id'=>$this->pageType->id,
                'show_on_home'=>1
            ]);
         }
        });
        return redirect()->route('download.index')->with('msg','Download File Created successfully');
    }

    public function edit(Page $download)
    {
        return view('download.download-edit',compact('download'));
    }

    public function update(Request $request,MediaHelper $mediaHelper, Page $download)
    {
        $data=$request->validate([
            'title'=>'required',
            'file'=>'sometimes'
        ]);

        DB::transaction(function () use ($request, $mediaHelper,$download) {

            if ($request->hasFile('file')) {
                if ($request->file->getClientOriginalExtension()=='pdf') {
                    $orginalName = Str::before($request->file->getClientOriginalName(), '.');
                    $fileName =  $orginalName . "-" . Str::random(10) . "." . $request->file->extension();
                    $filePath = storage_path() . '/app/public/upload/';
                    $request->file->storeAs('upload', $fileName, 'public');
                }
                else{
                    $fileName=$mediaHelper->uploadSingleImage($request->file);
                }
               json_encode([$request->except('_token'),'RealFile'=>$fileName]);
               $download->update([
                   'title'=>$request->title,
                   'content'=>json_encode([$request->except('_token'),'RealFile'=>$fileName]),
               ]);
             }
             else{
                 $data=json_decode($download->content,true);
                 $fileName=$data['RealFile'];
                 $download->update([
                     'title'=>$request->title,
                     'content'=>json_encode([$request->except('_token'),'RealFile'=>$fileName]),
                 ]);
             }
            });
            return redirect()->route('download.index')->with('msg','download Updated successfully');
    }

}
