<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ChangePass;
use App\Models\User;
use App\Models\Brand;
use App\Models\Multipic;
use Illuminate\Support\Facades\DB;


Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

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
    $brands = Brand::all();
    $abouts = DB::table('home_abouts')->first();
    $services = DB::table('services')->latest()->get();
    $images = Multipic::all();
    return view('home',compact('brands','abouts','services','images'));
});

Route::get('/about', function () {
    return view('about'); 
});

Route::get('/contact-with-dummy-text',[ContactController::class,'index'])->name('con');

//Category
Route::get('/category/all',[CategoryController::class,'AllCat'])->name('all.category');
Route::post('/category/add',[CategoryController::class,'AddCat'])->name('store.category');
//Edit
Route::get('/category/edit/{id}',[CategoryController::class,'Edit']);
Route::post('/category/update/{id}',[CategoryController::class,'Update']);

//SoftDelete
Route::get('/softdelete/category/{id}',[CategoryController::class,'SoftDelete']);

//Restore Deleted
Route::get('/category/restore/{id}',[CategoryController::class,'Restore']);

//Prm. delete
Route::get('/prmdelete/category/{id}',[CategoryController::class,'PrmDelete']);

//Brand

Route::get('/brand/all',[BrandController::class,'AllBrand'])->name('all.brand');
Route::post('/brand/add',[BrandController::class,'StoreBrand'])->name('store.brand');
Route::get('/brand/edit/{id}',[BrandController::class,'Edit']);
Route::post('/brand/update/{id}',[BrandController::class, 'Update']);
Route::get('/brand/delete/{id}',[BrandController::class,'Delete']);

//EndBrand

//Multi Image
Route::get('/multi/images',[BrandController::class,'Multipic'])->name('multi.image');
Route::post('/multi/images/add',[BrandController::class,'StoreImages'])->name('store.image');
//End Multi image

//Admin Routes
Route::get('/home/slider',[HomeController::class,'HomeSlider'])->name('home.slider');
Route::get('/add/slider',[HomeController::class,'AddSlider'])->name('add.slider');
Route::post('/store/slider',[HomeController::class,'StoreSlider'])->name('store.slider');
Route::get('/slider/edit/{id}',[HomeController::class,'EditSlider']);
Route::post('/slider/update/{id}',[HomeController::class,'UpdateSlider']);
Route::get('/slider/delete/{id}',[HomeController::class,'Delete']);

//Home About
Route::get('/home/about',[AboutController::class,'HomeAbout'])->name('home.about');
Route::get('/about/add',[AboutController::class,'Create'])->name('add.homeabout');
Route::post('/about/store',[AboutController::class,'Store'])->name('store.homeabout');
Route::get('/about/edit/{id}',[AboutController::class,'Edit']);
Route::post('/about/update/{id}',[AboutController::class,'Update']);
Route::get('/about/delete/{id}',[AboutController::class,'Delete']);

//Home Service
Route::get('/home/service',[ServiceController::class,'HomeService'])->name('home.service');
Route::get('/add/service',[ServiceController::class,'addService'])->name('homeservice.add');
Route::post('/service/store',[ServiceController::class,'storeService'])->name('store.homeservice');
Route::get('/edit/service/{id}',[ServiceController::class,'Edit']);
Route::post('/update/service/{id}',[ServiceController::class,'Update']);
Route::get('/delete/service/{id}',[ServiceController::class,'Delete']);

//Portfolio
Route::get('/portfolio',[AboutController::class,'Portfolio'])->name('portfolio');

//Admin Contact Page
Route::get('/admin/contact',[ContactController::class,'AdminContact'])->name('admin.contact');
Route::get('/admin/add/contact',[ContactController::class,'AddContact'])->name('add.contact');
Route::post('/admin/store/contact',[ContactController::class,'StoreContact'])->name('store.contact');
Route::get('/contact/edit/{id}',[ContactController::class,'EditContact']);
Route::post('/contact/update/{id}',[ContactController::class,'UpdateContact']);
Route::get('/contact/delete/{id}',[ContactController::class,'DeleteContact']);

//soft
Route::get('/contact/restore/{id}',[ContactController::class,'RestoreDeleteContact']);
Route::get('/contact/delete/prm/{id}',[ContactController::class,'prmDeleteContact']);

// Home Contact Page
Route::get('/contact',[ContactController::class,'Contact'])->name('contact');
//Form Contact
Route::post('/contact/form',[ContactController::class,'ContactForm'])->name('contact.form');
Route::get('/admin/message',[ContactController::class,'AdminMessage'])->name('admin.message');
Route::get('/message/delete/{id}',[ContactController::class,'MessageDelete']);


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    // $users = User::all();
    // $users = DB::table('users')->get();

    return view('admin.index');
})->name('dashboard');
Route::get('/user/logout',[BrandController::class,'Logout'])->name('user.logout');


//Change password and user profile
Route::get('/user/password',[ChangePass::class,'ChangePassword'])->name('change.password');
Route::post('/password/update',[ChangePass::class,'UpdatePassword'])->name('password.update');

//User Profile
Route::get('/user/profile',[ChangePass::class,'ProfileUpdate'])->name('profile.update');
Route::post('/user/profile/update',[ChangePass::class,'ProfileUpdateData'])->name('update.user.profile');
