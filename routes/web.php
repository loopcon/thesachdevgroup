<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\GalaxyToyotaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\ShowroomController;

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
    return redirect()->route('login');
});

//login
Route::get('login', [LoginController::class, 'login'])->name('login');
Route::post('customlogin', [LoginController::class, 'customLogin'])->name('login.custom'); 
Route::get('logout', [LoginController::class, 'logout'])->name('logout');


Route::get('dashboard', [LoginController::class, 'dashboard'])->name('dashboard');

Route::group(['middleware' => 'auth'], function () {
   
    //home slider
    Route::get('homeslider', [HomeController::class, 'homeslider'])->name('homeslider');
    Route::post('homeslider_insert', [HomeController::class, 'homeslider_insert'])->name('homeslider_insert');
    Route::get('homeslider_index', [HomeController::class, 'homeslider_index'])->name('homeslider.index');
    Route::get('homeslider_edit/{homeslider_edit}', [HomeController::class, 'homeslider_edit'])->name('home_slider.edit');
    Route::post('homeslider_update,{homeslider_update}', [HomeController::class, 'homeslider_update'])->name('homeslider_update');
    Route::delete('homeslider_destroy/{id}', [HomeController::class, 'homeslider_destroy']);

    //home our businesses
    Route::get('home_our_businesses', [HomeController::class, 'home_our_businesses'])->name('home_our_businesses');
    Route::post('home_our_businesses_insert', [HomeController::class, 'home_our_businesses_insert'])->name('home_our_businesses_insert');
    Route::get('home_our_businesses_index', [HomeController::class, 'home_our_businesses_index'])->name('home_our_businesses.index');
    Route::get('home_our_businesses_edit/{home_our_businesses_edit}', [HomeController::class, 'home_our_businesses_edit'])->name('home_our_businesses.edit');
    Route::post('home_our_businesses_update,{home_our_businesses_update}', [HomeController::class, 'home_our_businesses_update'])->name('home_our_businesses_update');
    Route::delete('home_our_businesses_destroy/{id}', [HomeController::class, 'home_our_businesses_destroy']);


    //Testimonials
    Route::get('testimonials', [HomeController::class, 'testimonials'])->name('testimonials');
    Route::post('testimonials_insert', [HomeController::class, 'testimonials_insert'])->name('testimonials_insert');
    Route::get('testimonials_index', [HomeController::class, 'testimonials_index'])->name('testimonials.index');
    Route::get('testimonials_edit/{testimonials_edit}', [HomeController::class, 'testimonials_edit'])->name('testimonials.edit');
    Route::post('testimonials_update,{testimonials_update}', [HomeController::class, 'testimonials_update'])->name('testimonials_update');
    Route::delete('testimonials_destroy/{id}', [HomeController::class, 'testimonials_destroy']);

    //Home Detail
    Route::get('home_detail', [HomeController::class, 'home_detail'])->name('home_detail');
    Route::post('home_detail_insert', [HomeController::class, 'home_detail_insert'])->name('home_detail_insert');

    //setting
    Route::get('setting', [SettingController::class, 'setting'])->name('setting');
    Route::post('setting_insert', [SettingController::class, 'setting_insert'])->name('setting_insert');

    //brand
    Route::get('brand', [BrandController::class, 'brand'])->name('brand');
    Route::post('brand_insert', [BrandController::class, 'brand_insert'])->name('brand_insert');
    Route::get('brand_index', [BrandController::class, 'brand_index'])->name('brand.index');
    Route::get('brand_edit/{brand_edit}', [BrandController::class, 'brand_edit'])->name('brand.edit');
    Route::post('brand_update,{brand_update}', [BrandController::class, 'brand_update'])->name('brand_update');
    Route::delete('brand_destroy/{id}', [BrandController::class, 'brand_destroy']);

    //car
    Route::get('car', [CarController::class, 'car'])->name('car');
    Route::post('car_insert', [CarController::class, 'car_insert'])->name('car_insert');
    Route::get('car_index', [CarController::class, 'car_index'])->name('car.index');
    Route::get('car_edit/{car_edit}', [CarController::class, 'car_edit'])->name('car.edit');
    Route::post('car_update,{car_update}', [CarController::class, 'car_update'])->name('car_update');
    Route::delete('car_destroy/{id}', [CarController::class, 'car_destroy']);

    //showroom
    Route::get('showroom', [ShowroomController::class, 'showroom'])->name('showroom');
    Route::post('showroom_insert', [ShowroomController::class, 'showroom_insert'])->name('showroom_insert');
    Route::get('showroom_index', [ShowroomController::class, 'showroom_index'])->name('showroom.index');
    Route::get('showroom_edit/{showroom_edit}', [ShowroomController::class, 'showroom_edit'])->name('showroom.edit');
    Route::post('showroom_update,{showroom_update}', [ShowroomController::class, 'showroom_update'])->name('showroom_update');
    Route::delete('showroom_destroy/{id}', [ShowroomController::class, 'showroom_destroy']);

    Route::post('facilitie_imagedelete', [ShowroomController::class, 'DeleteFacilitieImage'])->name('facilitie_imagedelete');
    
    Route::post('customer_gallery_imagedelete', [ShowroomController::class, 'DeleteCustomerGallery'])->name('customer_gallery_imagedelete');

});