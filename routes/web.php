<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CarController;
use App\Http\Controllers\Admin\ShowroomController;
use App\Http\Controllers\Admin\HeaderMenuController;
use App\Http\Controllers\Admin\FooterMenuController;
use App\Http\Controllers\Admin\MissionVisionController;
use App\Http\Controllers\Admin\HeaderMenuSocialMediaIconController;
use App\Http\Controllers\Admin\CountController;
use App\Http\Controllers\Admin\TestimonialController;

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
    Route::get('testimonials', [TestimonialController::class, 'testimonials'])->name('testimonials');
    Route::post('testimonials_insert', [TestimonialController::class, 'testimonials_insert'])->name('testimonials_insert');
    Route::get('testimonials_index', [TestimonialController::class, 'testimonials_index'])->name('testimonials.index');
    Route::get('testimonials_edit/{testimonials_edit}', [TestimonialController::class, 'testimonials_edit'])->name('testimonials.edit');
    Route::post('testimonials_update,{testimonials_update}', [TestimonialController::class, 'testimonials_update'])->name('testimonials_update');
    Route::get('testimonials_destroy/{id}', [TestimonialController::class, 'testimonials_destroy'])->name('testimonials_destroy');

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

     //Showroom testimonial
     Route::get('showroom-model', [\App\Http\Controllers\Admin\ShowroomModelController::class, 'showroomModelList'])->name('showroom-model');
     Route::get('showroom-model-create', [\App\Http\Controllers\Admin\ShowroomModelController::class, 'showroomModelCreate'])->name('showroom-model-create');
     Route::post('showroom-model-store', [\App\Http\Controllers\Admin\ShowroomModelController::class, 'showroomModelStore'])->name('showroom-model-store');
     Route::get('showroom-model-edit/{id}', [\App\Http\Controllers\Admin\ShowroomModelController::class, 'showroomModelEdit'])->name('showroom-model-edit');
     Route::post('showroom-model-update/{id}', [\App\Http\Controllers\Admin\ShowroomModelController::class, 'showroomModelUpdate'])->name('showroom-model-update');
     Route::get('showroom-model-delete/{id}', [\App\Http\Controllers\Admin\ShowroomModelController::class, 'showroomModelDestroy'])->name('showroom-model-delete');
     Route::get('showroom-model-datatable', [\App\Http\Controllers\Admin\ShowroomModelController::class, 'showroomModelDatatable'])->name('showroom-model-datatable');

     //footer menu
    Route::get('footer_menu', [FooterMenuController::class, 'footer_menu'])->name('footer_menu');
    Route::get('footerMenuCreate', [FooterMenuController::class, 'footerMenuCreate'])->name('footerMenuCreate');
    Route::post('footer_menu_insert', [FooterMenuController::class, 'footer_menu_insert'])->name('footer_menu_insert');
    Route::get('footer_menu_index', [FooterMenuController::class, 'footer_menu_index'])->name('footer_menu.index');
    Route::get('footer_menu_edit/{footer_menu_edit}', [FooterMenuController::class, 'footer_menu_edit'])->name('footer_menu.edit');
    Route::post('footer_menu_update,{id}', [FooterMenuController::class, 'footer_menu_update'])->name('footer_menu_update');
    Route::get('footer_menu_destroy/{id}', [FooterMenuController::class, 'footer_menu_destroy'])->name('footer_menu_destroy');

    //mission_vision
    Route::get('mission_vision', [MissionVisionController::class, 'mission_vision'])->name('mission_vision');
    Route::get('missionVisionCreate', [MissionVisionController::class, 'missionVisionCreate'])->name('missionVisionCreate');
    Route::post('mission_vision_insert', [MissionVisionController::class, 'mission_vision_insert'])->name('mission_vision_insert');
    Route::get('mission_vision_index', [MissionVisionController::class, 'mission_vision_index'])->name('mission_vision.index');
    Route::get('mission_vision_edit/{mission_vision_edit}', [MissionVisionController::class, 'mission_vision_edit'])->name('mission_vision.edit');
    Route::post('mission_vision_update,{id}', [MissionVisionController::class, 'mission_vision_update'])->name('mission_vision_update');
    Route::get('mission_vision_destroy/{id}', [MissionVisionController::class, 'mission_vision_destroy'])->name('mission_vision_destroy');

    //service center
    Route::get('service-center', [\App\Http\Controllers\Admin\ServiceCenterController::class, 'serviceCenterList'])->name('service-center');
    Route::get('service-center-create', [\App\Http\Controllers\Admin\ServiceCenterController::class, 'serviceCenterCreate'])->name('service-center-create');
    Route::post('service-center-store', [\App\Http\Controllers\Admin\ServiceCenterController::class, 'serviceCenterStore'])->name('service-center-store');
    Route::get('service-center-edit/{id}', [\App\Http\Controllers\Admin\ServiceCenterController::class, 'serviceCenterEdit'])->name('service-center-edit');
    Route::post('service-center-update/{id}', [\App\Http\Controllers\Admin\ServiceCenterController::class, 'servicecenterUpdate'])->name('service-center-update');
    Route::get('service-center-delete/{id}', [\App\Http\Controllers\Admin\ServiceCenterController::class, 'serviceCenterDestroy'])->name('service-center-delete');
    Route::get('service-center-datatable', [\App\Http\Controllers\Admin\ServiceCenterController::class, 'serviceCenterDatatable'])->name('service-center-datatable');

    //header_menu_social_media_icon
    Route::post('header_menu_social_media_icon_insert', [HeaderMenuSocialMediaIconController::class, 'header_menu_social_media_icon_insert'])->name('header_menu_social_media_icon_insert');
    Route::get('header_menu_social_media_icon_index', [HeaderMenuSocialMediaIconController::class, 'header_menu_social_media_icon_index'])->name('header_menu_social_media_icon.index');
    Route::post('header_menu_social_media_icon_edit', [HeaderMenuSocialMediaIconController::class, 'EditSocialMedia'])->name('header_menu_social_media_icon_edit');
    Route::post('social_media_icon_update', [HeaderMenuSocialMediaIconController::class, 'social_media_icon_update'])->name('social_media_icon_update');
    Route::get('header_menu_social_media_icon_destroy/{id}', [HeaderMenuSocialMediaIconController::class, 'header_menu_social_media_icon_destroy'])->name('header_menu_social_media_icon_destroy');

    //service
    Route::get('service', [\App\Http\Controllers\Admin\ServiceController::class, 'serviceList'])->name('service');
    Route::get('service-create', [\App\Http\Controllers\Admin\ServiceController::class, 'serviceCreate'])->name('service-create');
    Route::post('service-store', [\App\Http\Controllers\Admin\ServiceController::class, 'serviceStore'])->name('service-store');
    Route::get('service-edit/{id}', [\App\Http\Controllers\Admin\ServiceController::class, 'serviceEdit'])->name('service-edit');
    Route::post('service-update/{id}', [\App\Http\Controllers\Admin\ServiceController::class, 'serviceUpdate'])->name('service-update');
    Route::get('service-delete/{id}', [\App\Http\Controllers\Admin\ServiceController::class, 'serviceDestroy'])->name('service-delete');
    Route::get('service-datatable', [\App\Http\Controllers\Admin\ServiceController::class, 'serviceDatatable'])->name('service-datatable');

    //count
    Route::get('count', [CountController::class, 'count'])->name('count');
    Route::get('countCreate', [CountController::class, 'countCreate'])->name('countCreate');
    Route::post('count_insert', [CountController::class, 'count_insert'])->name('count_insert');
    Route::get('count_index', [CountController::class, 'count_index'])->name('count.index');
    Route::get('count_edit/{count_edit}', [CountController::class, 'count_edit'])->name('count.edit');
    Route::post('count_update,{id}', [CountController::class, 'count_update'])->name('count_update');
    Route::get('count_destroy/{id}', [CountController::class, 'count_destroy'])->name('count_destroy');

    //service center facility and customer gallery
    Route::get('service-center-facility-customergallery', [\App\Http\Controllers\Admin\ServiceCenterFacilityCustomerGalleryController::class, 'serviceCenterFacilityCustomerGalleryList'])->name('service-center-facility-customergallery');
    Route::post('service-center-facility-customergallery-html', [\App\Http\Controllers\Admin\ServiceCenterFacilityCustomerGalleryController::class, 'ajaxaServiceCenterFacilityCustomerGalleryHtml'])->name('service-center-facility-customergallery-html');
    Route::post('service-center-facility-customergallery-store', [\App\Http\Controllers\Admin\ServiceCenterFacilityCustomerGalleryController::class, 'serviceCenterFacilityCustomerGalleryStore'])->name('service-center-facility-customergallery-store');
    Route::post('service-center-facility-customergallery-update/{id}', [\App\Http\Controllers\Admin\ServiceCenterFacilityCustomerGalleryController::class, 'serviceCenterFacilityCustomerGalleryUpdate'])->name('service-center-facility-customergallery-update');
    Route::get('service-center-facility-customergallery-delete/{id}', [\App\Http\Controllers\Admin\ServiceCenterFacilityCustomerGalleryController::class, 'serviceCenterFacilityCustomerGalleryDestroy'])->name('service-center-facility-customergallery-delete');
    Route::get('service-center-facility-customergallery-datatable', [\App\Http\Controllers\Admin\ServiceCenterFacilityCustomerGalleryController::class, 'serviceCenterFacilityCustomerGalleryDatatable'])->name('service-center-facility-customergallery-datatable');

    //service center testimonial
    Route::get('service-center-testimonial', [\App\Http\Controllers\Admin\ServiceCenterTestimonialController::class, 'serviceCeterTestimonialList'])->name('service-center-testimonial');
    Route::get('service-center-testimonial-create', [\App\Http\Controllers\Admin\ServiceCenterTestimonialController::class, 'serviceCenterTestimonialCreate'])->name('service-center-testimonial-create');
    Route::post('service-center-testimonial-store', [\App\Http\Controllers\Admin\ServiceCenterTestimonialController::class, 'serviceCenterTestimonialStore'])->name('service-center-testimonial-store');
    Route::get('service-center-testimonial-edit/{id}', [\App\Http\Controllers\Admin\ServiceCenterTestimonialController::class, 'serviceCenterTestimonialEdit'])->name('service-center-testimonial-edit');
    Route::post('service-center-testimonial-update/{id}', [\App\Http\Controllers\Admin\ServiceCenterTestimonialController::class, 'serviceCenterTestimonialUpdate'])->name('service-center-testimonial-update');
    Route::get('service-center-testimonial-delete/{id}', [\App\Http\Controllers\Admin\ServiceCenterTestimonialController::class, 'serviceCenterTestimonialDestroy'])->name('service-center-testimonial-delete');
    Route::get('service-center-testimonial-datatable', [\App\Http\Controllers\Admin\ServiceCenterTestimonialController::class, 'serviceCenterTestimonialDatatable'])->name('service-center-testimonial-datatable');

    //users
    Route::get('user', [\App\Http\Controllers\Admin\UserController::class, 'userList'])->name('user');
    Route::get('user-create', [\App\Http\Controllers\Admin\UserController::class, 'userCreate'])->name('user-create');
    Route::post('user-store', [\App\Http\Controllers\Admin\UserController::class, 'userStore'])->name('user-store');
    Route::get('user-edit/{id}', [\App\Http\Controllers\Admin\UserController::class, 'userEdit'])->name('user-edit');
    Route::post('user-update/{id}', [\App\Http\Controllers\Admin\UserController::class, 'userUpdate'])->name('user-update');
    Route::get('user-delete/{id}', [\App\Http\Controllers\Admin\UserController::class, 'userDestroy'])->name('user-delete');
    Route::get('user-datatable', [\App\Http\Controllers\Admin\UserController::class, 'userDatatable'])->name('user-datatable');

    //faq
    Route::get('faq', [\App\Http\Controllers\Admin\FaqController::class, 'faqList'])->name('faq');
    Route::get('faq-create', [\App\Http\Controllers\Admin\FaqController::class, 'faqCreate'])->name('faq-create');
    Route::post('faq-store', [\App\Http\Controllers\Admin\FaqController::class, 'faqStore'])->name('faq-store');
    Route::get('faq-edit/{id}', [\App\Http\Controllers\Admin\FaqController::class, 'faqEdit'])->name('faq-edit');
    Route::post('faq-update/{id}', [\App\Http\Controllers\Admin\FaqController::class, 'faqUpdate'])->name('faq-update');
    Route::get('faq-delete/{id}', [\App\Http\Controllers\Admin\FaqController::class, 'faqDestroy'])->name('faq-delete');
    Route::get('faq-datatable', [\App\Http\Controllers\Admin\FaqController::class, 'faqDatatable'])->name('faq-datatable');

    //pages
    Route::get('pages', [\App\Http\Controllers\Admin\PageController::class, 'pageList'])->name('pages');
    Route::get('page-create', [\App\Http\Controllers\Admin\PageController::class, 'pageCreate'])->name('page-create');
    Route::post('page-store', [\App\Http\Controllers\Admin\PageController::class, 'pageStore'])->name('page-store');
    Route::get('page-edit/{id}', [\App\Http\Controllers\Admin\PageController::class, 'pageEdit'])->name('page-edit');
    Route::post('page-update/{id}', [\App\Http\Controllers\Admin\PageController::class, 'pageUpdate'])->name('page-update');
    Route::get('page-delete/{id}', [\App\Http\Controllers\Admin\PageController::class, 'pageDestroy'])->name('page-delete');
    Route::get('page-datatable', [\App\Http\Controllers\Admin\PageController::class, 'pageDatatable'])->name('page-datatable');

    //awards
    Route::get('awards', [\App\Http\Controllers\Admin\AwardsController::class, 'awardList'])->name('awards');
    Route::post('award-store', [\App\Http\Controllers\Admin\AwardsController::class, 'awardStore'])->name('award-store');
    Route::post('award-update/{id}', [\App\Http\Controllers\Admin\AwardsController::class, 'awardUpdate'])->name('award-update');
    Route::get('award-delete/{id}', [\App\Http\Controllers\Admin\AwardsController::class, 'awardDestroy'])->name('award-delete');
    Route::post('award-datatable', [\App\Http\Controllers\Admin\AwardsController::class, 'awardDatatable'])->name('award-datatable');
    Route::post('ajax-award-html',[App\Http\Controllers\Admin\AwardsController::class, 'ajaxAwardHtml'])->name('ajax-award-html');

    //our business
    Route::get('our-business', [\App\Http\Controllers\Admin\OurBusinessController::class, 'ourBusinessList'])->name('our-business');
    Route::get('our-business-create', [\App\Http\Controllers\Admin\OurBusinessController::class, 'ourBusinessCreate'])->name('our-business-create');
    Route::post('our-business-store', [\App\Http\Controllers\Admin\OurBusinessController::class, 'ourBusinessStore'])->name('our-business-store');
    Route::get('our-business-edit/{id}', [\App\Http\Controllers\Admin\OurBusinessController::class, 'ourBusinessEdit'])->name('our-business-edit');
    Route::post('our-business-update/{id}', [\App\Http\Controllers\Admin\OurBusinessController::class, 'ourBusinessUpdate'])->name('our-business-update');
    Route::get('our-business-delete/{id}', [\App\Http\Controllers\Admin\OurBusinessController::class, 'ourBusinessDestroy'])->name('our-business-delete');
    Route::get('our-business-datatable', [\App\Http\Controllers\Admin\OurBusinessController::class, 'ourBusinessDatatable'])->name('our-business-datatable');
});
