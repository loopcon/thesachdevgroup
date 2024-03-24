<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CarController;
use App\Http\Controllers\Admin\ShowroomController;
use App\Http\Controllers\Admin\HeaderMenuController;

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
    
    //user role permission   
    Route::get('role-permission/{role_id?}', [\App\Http\Controllers\Admin\RolePermissionController::class, 'index'])->name('role-permission');
    Route::post('role-permission', [\App\Http\Controllers\Admin\RolePermissionController::class, 'store'])->name('role-permission');
    
    //home slider
    Route::get('homeslider', [HomeController::class, 'homeslider'])->name('homeslider');
    Route::post('homeslider_insert', [HomeController::class, 'homeslider_insert'])->name('homeslider_insert');
    Route::get('homeslider_index', [HomeController::class, 'homeslider_index'])->name('homeslider.index');
    Route::get('homeslider_edit/{homeslider_edit}', [HomeController::class, 'homeslider_edit'])->name('home_slider.edit');
    Route::post('homeslider_update,{homeslider_update}', [HomeController::class, 'homeslider_update'])->name('homeslider_update');
    Route::get('homeslider_destroy/{id}', [HomeController::class, 'homeslider_destroy'])->name('homeslider_destroy');

    //home our businesses
    Route::get('home_our_businesses', [HomeController::class, 'home_our_businesses'])->name('home_our_businesses');
    Route::post('home_our_businesses_insert', [HomeController::class, 'home_our_businesses_insert'])->name('home_our_businesses_insert');
    Route::get('home_our_businesses_index', [HomeController::class, 'home_our_businesses_index'])->name('home_our_businesses.index');
    Route::get('home_our_businesses_edit/{home_our_businesses_edit}', [HomeController::class, 'home_our_businesses_edit'])->name('home_our_businesses.edit');
    Route::post('home_our_businesses_update,{home_our_businesses_update}', [HomeController::class, 'home_our_businesses_update'])->name('home_our_businesses_update');
    Route::get('home_our_businesses_destroy/{id}', [HomeController::class, 'home_our_businesses_destroy'])->name('home_our_businesses_destroy');

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

    //galaxy_toyota
    Route::get('galaxy_toyota', [GalaxyToyotaController::class, 'galaxy_toyota'])->name('galaxy_toyota');
    Route::post('galaxy_toyota_insert', [GalaxyToyotaController::class, 'galaxy_toyota_insert'])->name('galaxy_toyota_insert');

    //brand
    Route::get('brand', [BrandController::class, 'brand'])->name('brand');
    Route::post('brand_insert', [BrandController::class, 'brand_insert'])->name('brand_insert');
    Route::get('brand_index', [BrandController::class, 'brand_index'])->name('brand.index');
    Route::get('brand_edit/{brand_edit}', [BrandController::class, 'brand_edit'])->name('brand.edit');
    Route::post('brand_update,{brand_update}', [BrandController::class, 'brand_update'])->name('brand_update');
    Route::get('brand_destroy/{id}', [BrandController::class, 'brand_destroy'])->name('brand_destroy');

    //car
    Route::get('car', [CarController::class, 'car'])->name('car');
    Route::post('car_insert', [CarController::class, 'car_insert'])->name('car_insert');
    Route::get('car_index', [CarController::class, 'car_index'])->name('car.index');
    Route::get('car_edit/{car_edit}', [CarController::class, 'car_edit'])->name('car.edit');
    Route::post('car_update,{car_update}', [CarController::class, 'car_update'])->name('car_update');
    Route::get('car_destroy/{id}', [CarController::class, 'car_destroy'])->name('car_destroy');

    //showroom
    Route::get('showroom', [ShowroomController::class, 'showroom'])->name('showroom');
    Route::post('showroom_insert', [ShowroomController::class, 'showroom_insert'])->name('showroom_insert');
    Route::get('showroom_index', [ShowroomController::class, 'showroom_index'])->name('showroom.index');
    Route::get('showroom_edit/{showroom_edit}/{brand_id}', [ShowroomController::class, 'showroom_edit'])->name('showroom.edit');
    Route::post('showroom_update,{showroom_update}', [ShowroomController::class, 'showroom_update'])->name('showroom_update');
    Route::get('showroom_destroy/{id}', [ShowroomController::class, 'showroom_destroy'])->name('showroom_destroy');

    Route::post('facilitie_imagedelete', [ShowroomController::class, 'DeleteFacilitieImage'])->name('facilitie_imagedelete');
    Route::post('customer_gallery_imagedelete', [ShowroomController::class, 'DeleteCustomerGallery'])->name('customer_gallery_imagedelete');

    Route::get('getcars', [ShowroomController::class, 'getcarname'])->name('getcars');

    //header_menu
    Route::get('header_menu', [HeaderMenuController::class, 'header_menu'])->name('header_menu');
    Route::post('header_menu_insert', [HeaderMenuController::class, 'header_menu_insert'])->name('header_menu_insert');
    Route::get('header_menu_index', [HeaderMenuController::class, 'header_menu_index'])->name('header_menu.index');
    Route::get('header_menu_edit/{header_menu_edit}', [HeaderMenuController::class, 'header_menu_edit'])->name('header_menu.edit');
    Route::post('header_menu_update,{header_menu_update}', [HeaderMenuController::class, 'header_menu_update'])->name('header_menu_update');
    Route::get('header_menu_destroy/{id}', [HeaderMenuController::class, 'header_menu_destroy'])->name('header_menu_destroy');
    
     //Showroom testimonial
     Route::get('showroom-testimonial', [\App\Http\Controllers\Admin\ShowroomTestimonialController::class, 'showroomTestimonialList'])->name('showroom-testimonial');
     Route::get('showroom-testimonial-create', [\App\Http\Controllers\Admin\ShowroomTestimonialController::class, 'showroomTestimonialCreate'])->name('showroom-testimonial-create');
     Route::post('showroom-testimonial-store', [\App\Http\Controllers\Admin\ShowroomTestimonialController::class, 'showroomTestimonialStore'])->name('showroom-testimonial-store');
     Route::get('showroom-testimonial-edit/{id}', [\App\Http\Controllers\Admin\ShowroomTestimonialController::class, 'showroomTestimonialEdit'])->name('showroom-testimonial-edit');
     Route::post('showroom-testimonial-update/{id}', [\App\Http\Controllers\Admin\ShowroomTestimonialController::class, 'showroomTestimonialUpdate'])->name('showroom-testimonial-update');
     Route::get('showroom-testimonial-delete/{id}', [\App\Http\Controllers\Admin\ShowroomTestimonialController::class, 'showroomTestimonialDestroy'])->name('showroom-testimonial-delete');
     Route::get('showroom-testimonial-datatable', [\App\Http\Controllers\Admin\ShowroomTestimonialController::class, 'showroomTestimonialDatatable'])->name('showroom-testimonial-datatable');

   
});