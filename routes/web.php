<?php

use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DownloadsController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\NoticeBoardController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PageTypeController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\SliderController;
use App\Models\AboutUs;
use App\Models\Page;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});
Route::get('test',[PageController::class,'test']);
Route::post('submit',[PageController::class,'submit'])->name('test.create');

Auth::routes(['register'=>false]);
Route::group(['middleware'=>'auth'],function(){
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('page-type', PageTypeController::class)->except(['edit']);
    Route::resource('page', PageController::class)->only(['index','create','store','update','edit','destroy']);
    Route::resource('sliders', SliderController::class)->only(['index','create','store','update','edit','destroy']);
    Route::resource('message', MessageController::class)->only(['index','create','store','update','edit','destroy']);
    Route::resource('aboutus', AboutUsController::class)->only(['index','create','store','update','edit','destroy']);
    Route::post('addDetail',[AboutUsController::class,'storeDetail'])->name('aboutus-detail.store');
    Route::get('addDetail/{aboutus}',[AboutUsController::class,'addDetail'])->name('aboutus.addDetail');
    Route::get('showDetail/{aboutus}',[AboutUsController::class,'showDetail'])->name('aboutus.showDetail');
    Route::post('aboutUsUpdate',[AboutUsController::class,'updatee'])->name('aboutus.updatee');
    Route::get('aboutUsEdit',[AboutUsController::class,'aboutUsEdit'])->name('aboutUs-edit');
    Route::resource('contactUs', ContactUsController::class)->only(['index','create','store','update','edit','destroy']);
    Route::get('contactUsEdit',[ContactUsController::class,'contactUsEdit'])->name('contactUs-edit');
    Route::post('contactUsUpdatee',[ContactUsController::class,'updatee'])->name('contactUs.updatee');
    Route::resource('faculty', FacultyController::class)->only(['index','create','store','update','edit','destroy']);
    Route::resource('course', CourseController::class)->only(['index','create','store','update','edit','destroy']);
    Route::get('course/{course}',[CourseController::class,'destroy'])->name('course-delete');
    Route::get('addCourse/{faculty}',[CourseController::class,'addCourse'])->name('add-Course');
    Route::resource('notice',NoticeBoardController::class)->only(['index','create','store','update','edit','destroy']);
    Route::get('noticesAdd/{notice}',[NoticeBoardController::class,'noticesAdd'])->name('notices.add');
    Route::post('noticesStore',[NoticeBoardController::class,'noticesStore'])->name('notices.store');
    Route::get('noticesEdit/{notice}',[NoticeBoardController::class,'noticesEdit'])->name('notices-edit');
    Route::post('noticesUpdate',[NoticeBoardController::class,'noticesUpdate'])->name('notices-update');
    Route::get('noticesDelete/{notice}',[NoticeBoardController::class,'noticesDelete'])->name('notices-delete');
    Route::resource('result',ResultController::class)->only(['index','create','store','update','edit','destroy']);
    Route::get('resultDestory/{result}',[ResultController::class,'resultDestroy'])->name('resultt.destroy');
    Route::resource('download',DownloadsController::class)->only(['index','create','store','update','edit','destroy']);
    Route::resource('gallery',GalleryController::class)->only(['index','create','store','update','edit','destroy']);
    Route::get('showPhotos/{gallery}',[GalleryController::class,'showPhotos'])->name('showPhotos');
    Route::get('galleryDestroy/{gallery}',[GalleryController::class,'galleryDestroy'])->name('gallery-delete');

});

