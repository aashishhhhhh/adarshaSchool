<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\PageType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Framework\Error\Notice;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $pages= PageType::all();
        return view('layouts.main',compact('pages'));
    }

    public function home()
    {
        $pages = PageType::query()->with('pages.pictures','pages.Parents')->get();

        
        // foreach ($pages as $key => $value) {
        //     foreach ($value->pages as $key => $item) {
        //       if ($item->page_type_id==5) {
        //           dd($item->Parents);
        //       }
        //     } 
        // }
        return view('frontend.frontend',['pages'=>$pages]);
    }

    public function generalNotice( $slug)
    {
        $pages = PageType::query()->with('pages.pictures','pages.Parents')->get();
        return view('frontend.general-notice',['pages'=>$pages]);
    }

    public function downloadFile($link)
    {
        // config('path');
        
        $path=config('constants.path');
        // dd($link);
        return Storage::download($path.$link);
    }
}
