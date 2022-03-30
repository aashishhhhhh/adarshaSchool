<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactUsRequest;
use App\Models\ContactUs;
use App\Models\Page;
use App\Models\PageType;
use Illuminate\Http\Request;
use Mockery\Matcher\Contains;
use phpDocumentor\Reflection\PseudoTypes\True_;
use SebastianBergmann\Type\VoidType;

class ContactUsController extends Controller
{
    public $slug;
    public $contactUs;
    public $pageType;
    public function __construct()
    {
        $this->slug='contact-us';
        $this->pageType=PageType::query()->where('slug',$this->slug)->first();
    }
    public function index()
    {
        $this->contactUs=Page::query()->where('slug',$this->slug)->first();
        if ($this->contactUs==null) {
            $content=null;
            return view('contact-us.contact-us',compact('content'));
        }
        else{
            $this->contactUs=Page::query()->where('slug',$this->slug)->first();
            $content=json_decode($this->contactUs->content,True);
            return view('contact-us.contact-us',compact('content'));
        }
   
    }

    public function create()
    {
        $page= Page::query()->where('slug',$this->slug)->first();
        if ($page==null) {
            return view('contact-us.contact-us-add');
        }
        else{
            return redirect()->route('contactUs-edit');
        }
    }

    public function store(ContactUsRequest $request)
    {
        
        $data=$request->validate([
            'school_contact_no'=>'required',
            'email'=>'required',
            'principle_contact_no'=>'required',
            'school_co_contact_no'=>'required'
        ]);

        Page::create([
            'slug'=>$this->slug,
            'title'=>strtoupper($this->slug),
            'show_on_home'=>1,
            'page_type_id'=>$this->pageType->id
        ]);

        $request=json_encode($data);
        Page::query()->where('slug',$this->slug)->update([
            'content'=>$request
        ]);
        return redirect()->route('contactUs.index')->with('msg','About Us Content inserted successfully');
    }

    public function contactUsEdit()
    {
        $contactUs=Page::query()->where('slug',$this->slug)->first();
        $content=json_decode($contactUs->content,True);
        return view('contact-us.contact-us-edit',compact('content'));
    }

    public function updatee(ContactUsRequest $request)
    {
        $request=json_encode($request->except('_token'));
        Page::query()->where('slug',$this->slug)->update([
            'content'=>$request
        ]);       
        return redirect()->route('contactUs.index')->with('msg','About Us Content updated successfully');
    }

   
}
