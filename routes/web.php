<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\GalaxyToyotaController;
use App\Http\Controllers\LoginController;

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

    //galaxy_toyota
    Route::get('galaxy_toyota', [GalaxyToyotaController::class, 'galaxy_toyota'])->name('galaxy_toyota');
    Route::post('galaxy_toyota_insert', [GalaxyToyotaController::class, 'galaxy_toyota_insert'])->name('galaxy_toyota_insert');

    //galaxy_toyota_image
    Route::get('galaxy_toyota_image', [GalaxyToyotaController::class, 'galaxy_toyota_image'])->name('galaxy_toyota_image');
    Route::post('galaxy_toyota_image_insert', [GalaxyToyotaController::class, 'galaxy_toyota_image_insert'])->name('galaxy_toyota_image_insert');
    Route::get('galaxy_toyota_image_index', [GalaxyToyotaController::class, 'galaxy_toyota_image_index'])->name('galaxy_toyota_image.index');
    Route::get('galaxy_toyota_image_edit/{galaxy_toyota_image_edit}', [GalaxyToyotaController::class, 'galaxy_toyota_image_edit'])->name('galaxy_toyota_image.edit');
    Route::post('galaxy_toyota_image_update,{galaxy_toyota_image_update}', [GalaxyToyotaController::class, 'galaxy_toyota_image_update'])->name('galaxy_toyota_image_update');
    Route::delete('galaxy_toyota_image_destroy/{id}', [GalaxyToyotaController::class, 'galaxy_toyota_image_destroy']);

    //galaxy_toyota_showrooms_slider
    Route::get('galaxy_toyota_showrooms_slider', [GalaxyToyotaController::class, 'galaxy_toyota_showrooms_slider'])->name('galaxy_toyota_showrooms_slider');
    Route::post('galaxy_toyota_showrooms_slider_insert', [GalaxyToyotaController::class, 'galaxy_toyota_showrooms_slider_insert'])->name('galaxy_toyota_showrooms_slider_insert');

});