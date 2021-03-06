<?php

namespace App\Http\Controllers;

use App\Mail\feedback;
use App\Models\Feedbacks;
use App\Models\Page;
use App\Models\PageType;
use App\Models\visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class FrontendController extends Controller
{
    public function home()
    {
        $pages = PageType::query()->with('pages.pictures','pages.Parents')->get();
       
        if (visitor::query()->where('ip', request()->ip())->count() == 0) {
            visitor::create(['ip' => request()->ip()]);
        }

        return view('frontend.frontend',['pages'=>$pages]); 
    }

    public function generalNotice($slug)
    {
        $pages = PageType::query()->with('pages.pictures','pages.Parents')->get();
        return view('frontend.general-notice',['pages'=>$pages]);
    }

    public function downloadFile($link)
    {
        
        $path=config('constants.path');
        return Storage::download($path.$link);
    }

    public function getFromSlug($slug)
    {
    
        abort_if(PageType::query()->where('slug', $slug)->count() == 0, 404);
        $pages = PageType::query()
            ->with('pages.pictures')
            ->get();

        return view('frontend.'.$slug, ['pages' => $pages, 'slug' => $slug]);
    }

    public function getFromProgramSlug($slug)
    {
        $pages = PageType::query()
            ->with('pages.pictures','pages.Parents')
            ->get();

        $program=Page::query()->where('slug',$slug)->with('pictures','Parents.pictures')->first();
            return view('frontend.'.$slug, ['pages' => $pages, 'slug' => $slug,'program'=>$program]);
    }

    public function subGallery($slug)
    {
        $pages = PageType::query()
            ->with('pages.pictures','pages.Parents')
            ->get();

        $program=Page::query()->where('slug',$slug)->with('pictures','Parents.pictures')->first();
        return view('frontend.sub-gallery',['program'=>$program,'pages'=>$pages]);
    }

    public function feedback(Request $request)
    {
       $data= $request->validate([
            'name'=>'required',
            'email'=>'required',
            'feedback'=>'required'
        ]);

        Feedbacks::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'comments'=>$request->feedback
        ]);
        $mail='admission@adarshaschool.edu.np';
        
        Mail::to($mail)->send(new feedback($data));
        return redirect()->back()->with('msg','Feedback given sucessfully');
    }

    public function singleNotice($slug)
    {
        $pages = PageType::query()
        ->with('pages.pictures','pages.Parents')
        ->get();
        $program=Page::query()->where('slug',$slug)->with('pictures','Parents.pictures')->first();
        return view('frontend.single-notice',['program'=>$program,'pages'=>$pages]);
    }

    


}
