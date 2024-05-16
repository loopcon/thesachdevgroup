<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeSettingController;
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
use App\Http\Controllers\Admin\ShowroomFacilityCustomerGalleryController;
use App\Http\Controllers\Admin\RolePermissionController;
use App\Http\Controllers\Admin\ShowroomTestimonialController;
use App\Http\Controllers\Admin\ShowroomModelController;
use App\Http\Controllers\Admin\ServiceCenterController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\ServiceCenterFacilityCustomerGalleryController;
use App\Http\Controllers\Admin\ServiceCenterTestimonialController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\AwardsController;
use App\Http\Controllers\Admin\OurBusinessController;
use App\Http\Controllers\Admin\OurBusinessInsuranceController;
use App\Http\Controllers\Admin\VacancyController;
use App\Http\Controllers\Admin\CareerController;
use App\Http\Controllers\Admin\BodyShopController;
use App\Http\Controllers\Admin\UsedCarController;
use App\Http\Controllers\Admin\ContactUsController;
use App\Http\Controllers\Admin\OurLocationController;
use App\Http\Controllers\Admin\NewCarsController;
use App\Http\Controllers\Admin\AfterSalesServiceController;
use App\Http\Controllers\Admin\CarInsuranceController;
use App\Http\Controllers\Admin\CompanyCsrController;

// frontend controller
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\BusinessController;
use App\Http\Controllers\Frontend\ContactUsDetailController;
use App\Http\Controllers\Frontend\locationDetailController;
use App\Http\Controllers\Frontend\PageDetailController;
use App\Http\Controllers\Frontend\AwardsDetailController;
use App\Http\Controllers\Frontend\ServiceCenterDetailController;
use App\Http\Controllers\Frontend\ShowroomDetailController;
use App\Http\Controllers\Frontend\CareerDetailController;
use App\Http\Controllers\Frontend\NewCarController;
use App\Http\Controllers\Frontend\AfterSalesServicedDetailController;
use  App\Http\Controllers\Frontend\UsedCarDetailController;
use  App\Http\Controllers\Frontend\CarInsuranceDetailController;
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


// Route::get('/', function () {
//     return redirect()->route('admin');
// });

//login
Route::get('admin', [LoginController::class, 'login'])->name('admin');
Route::post('customlogin', [LoginController::class, 'customLogin'])->name('login.custom'); 
Route::get('logout', [LoginController::class, 'logout'])->name('logout');


Route::get('dashboard', [LoginController::class, 'dashboard'])->name('dashboard');

Route::group(['middleware' => 'auth'], function () {
    
    //user role permission   
    Route::get('role-permission/{role_id?}', [RolePermissionController::class, 'index'])->name('role-permission');
    Route::post('role-permission', [RolePermissionController::class, 'store'])->name('role-permission');
    
    //home slider
    Route::get('homeslider', [HomeSettingController::class, 'homeslider'])->name('homeslider');
    Route::post('homeslider_insert', [HomeSettingController::class, 'homeslider_insert'])->name('homeslider_insert');
    Route::get('homeslider_index', [HomeSettingController::class, 'homeslider_index'])->name('homeslider.index');
    Route::get('homeslider_edit/{homeslider_edit}', [HomeSettingController::class, 'homeslider_edit'])->name('home_slider.edit');
    Route::post('homeslider_update,{homeslider_update}', [HomeSettingController::class, 'homeslider_update'])->name('homeslider_update');
    Route::get('homeslider_destroy/{id}', [HomeSettingController::class, 'homeslider_destroy'])->name('homeslider_destroy');

    //home our businesses
    Route::get('home_our_businesses', [HomeSettingController::class, 'home_our_businesses'])->name('home_our_businesses');
    Route::post('home_our_businesses_insert', [HomeSettingController::class, 'home_our_businesses_insert'])->name('home_our_businesses_insert');
    Route::get('home_our_businesses_index', [HomeSettingController::class, 'home_our_businesses_index'])->name('home_our_businesses.index');
    Route::get('home_our_businesses_edit/{home_our_businesses_edit}', [HomeSettingController::class, 'home_our_businesses_edit'])->name('home_our_businesses.edit');
    Route::post('home_our_businesses_update,{home_our_businesses_update}', [HomeSettingController::class, 'home_our_businesses_update'])->name('home_our_businesses_update');
    Route::get('home_our_businesses_destroy/{id}', [HomeSettingController::class, 'home_our_businesses_destroy'])->name('home_our_businesses_destroy');

    //home our businesses title
    Route::post('home_our_businesses_title_insert', [HomeSettingController::class, 'home_our_businesses_title_insert'])->name('home_our_businesses_title_insert');


    //Testimonials
    Route::get('testimonials', [TestimonialController::class, 'testimonials'])->name('testimonials');
    Route::post('testimonials_insert', [TestimonialController::class, 'testimonials_insert'])->name('testimonials_insert');
    Route::get('testimonials_index', [TestimonialController::class, 'testimonials_index'])->name('testimonials.index');
    Route::get('testimonials_edit/{testimonials_edit}', [TestimonialController::class, 'testimonials_edit'])->name('testimonials.edit');
    Route::post('testimonials_update,{testimonials_update}', [TestimonialController::class, 'testimonials_update'])->name('testimonials_update');
    Route::get('testimonials_destroy/{id}', [TestimonialController::class, 'testimonials_destroy'])->name('testimonials_destroy');

    //testimonials title 
    Route::post('testimonials_title_insert', [TestimonialController::class, 'testimonials_title_insert'])->name('testimonials_title_insert');


    //Home Detail
    Route::get('home_detail', [HomeSettingController::class, 'home_detail'])->name('home_detail');
    Route::post('home_detail_insert', [HomeSettingController::class, 'home_detail_insert'])->name('home_detail_insert');

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
    Route::get('showroom_list', [ShowroomController::class, 'showroom_list'])->name('showroom_list');
    Route::post('showroom_index', [ShowroomController::class, 'showroom_index'])->name('showroom.index');
    Route::get('showroom_edit/{showroom_edit}/{brand_id}', [ShowroomController::class, 'showroom_edit'])->name('showroom.edit');
    Route::post('showroom_update,{showroom_update}', [ShowroomController::class, 'showroom_update'])->name('showroom_update');
    Route::get('showroom_destroy/{id}', [ShowroomController::class, 'showroom_destroy'])->name('showroom_destroy');

    Route::get('getcars', [ShowroomController::class, 'getcarname'])->name('getcars');

    //header_menu
    Route::get('header_menu', [HeaderMenuController::class, 'header_menu'])->name('header_menu');
    Route::post('header_menu_insert', [HeaderMenuController::class, 'header_menu_insert'])->name('header_menu_insert');
    Route::get('header_menu_index', [HeaderMenuController::class, 'header_menu_index'])->name('header_menu.index');
    Route::get('header_menu_edit/{header_menu_edit}', [HeaderMenuController::class, 'header_menu_edit'])->name('header_menu.edit');
    Route::post('header_menu_update,{header_menu_update}', [HeaderMenuController::class, 'header_menu_update'])->name('header_menu_update');
    Route::get('header_menu_destroy/{id}', [HeaderMenuController::class, 'header_menu_destroy'])->name('header_menu_destroy');
    

     //Showroom testimonial
     Route::get('showroom-testimonial', [ShowroomTestimonialController::class, 'showroomTestimonialList'])->name('showroom-testimonial');
     Route::get('showroom-testimonial-create', [ShowroomTestimonialController::class, 'showroomTestimonialCreate'])->name('showroom-testimonial-create');
     Route::post('showroom-testimonial-store', [ShowroomTestimonialController::class, 'showroomTestimonialStore'])->name('showroom-testimonial-store');
     Route::get('showroom-testimonial-edit/{id}', [ShowroomTestimonialController::class, 'showroomTestimonialEdit'])->name('showroom-testimonial-edit');
     Route::post('showroom-testimonial-update/{id}', [ShowroomTestimonialController::class, 'showroomTestimonialUpdate'])->name('showroom-testimonial-update');
     Route::get('showroom-testimonial-delete/{id}', [ShowroomTestimonialController::class, 'showroomTestimonialDestroy'])->name('showroom-testimonial-delete');
     Route::get('showroom-testimonial-datatable', [ShowroomTestimonialController::class, 'showroomTestimonialDatatable'])->name('showroom-testimonial-datatable');

     //Showroom testimonial
     Route::get('showroom-model', [ShowroomModelController::class, 'showroomModelList'])->name('showroom-model');
     Route::get('showroom-model-create', [ShowroomModelController::class, 'showroomModelCreate'])->name('showroom-model-create');
     Route::post('showroom-model-store', [ShowroomModelController::class, 'showroomModelStore'])->name('showroom-model-store');
     Route::get('showroom-model-edit/{id}', [ShowroomModelController::class, 'showroomModelEdit'])->name('showroom-model-edit');
     Route::post('showroom-model-update/{id}', [ShowroomModelController::class, 'showroomModelUpdate'])->name('showroom-model-update');
     Route::get('showroom-model-delete/{id}', [ShowroomModelController::class, 'showroomModelDestroy'])->name('showroom-model-delete');
     Route::get('showroom-model-datatable', [ShowroomModelController::class, 'showroomModelDatatable'])->name('showroom-model-datatable');

     //footer menu
    Route::get('footer_menu', [FooterMenuController::class, 'footer_menu'])->name('footer_menu');
    Route::get('footerMenuCreate', [FooterMenuController::class, 'footerMenuCreate'])->name('footerMenuCreate');
    Route::post('footer_menu_insert', [FooterMenuController::class, 'footer_menu_insert'])->name('footer_menu_insert');
    Route::get('footer_menu_index', [FooterMenuController::class, 'footer_menu_index'])->name('footer_menu.index');
    Route::get('footer_menu_edit/{footer_menu_edit}', [FooterMenuController::class, 'footer_menu_edit'])->name('footer_menu.edit');
    Route::post('footer_menu_update,{id}', [FooterMenuController::class, 'footer_menu_update'])->name('footer_menu_update');
    Route::get('footer_menu_destroy/{id}', [FooterMenuController::class, 'footer_menu_destroy'])->name('footer_menu_destroy');

    //footer menu description
    Route::post('footer_menu_description_insert', [FooterMenuController::class, 'footer_menu_description_insert'])->name('footer_menu_description_insert');

    //mission_vision
    Route::get('mission_vision', [MissionVisionController::class, 'mission_vision'])->name('mission_vision');
    Route::get('missionVisionCreate', [MissionVisionController::class, 'missionVisionCreate'])->name('missionVisionCreate');
    Route::post('mission_vision_insert', [MissionVisionController::class, 'mission_vision_insert'])->name('mission_vision_insert');
    Route::get('mission_vision_index', [MissionVisionController::class, 'mission_vision_index'])->name('mission_vision.index');
    Route::get('mission_vision_edit/{mission_vision_edit}', [MissionVisionController::class, 'mission_vision_edit'])->name('mission_vision.edit');
    Route::post('mission_vision_update,{id}', [MissionVisionController::class, 'mission_vision_update'])->name('mission_vision_update');
    Route::get('mission_vision_destroy/{id}', [MissionVisionController::class, 'mission_vision_destroy'])->name('mission_vision_destroy');

    // mission_vision_image
    Route::post('mission_vision_image_insert', [MissionVisionController::class, 'mission_vision_image_insert'])->name('mission_vision_image_insert');

    //service center
    Route::get('service-center', [ServiceCenterController::class, 'serviceCenterList'])->name('service-center');
    Route::get('service-center-create', [ServiceCenterController::class, 'serviceCenterCreate'])->name('service-center-create');
    Route::post('service-center-store', [ServiceCenterController::class, 'serviceCenterStore'])->name('service-center-store');
    Route::get('service-center-edit/{id}', [ServiceCenterController::class, 'serviceCenterEdit'])->name('service-center-edit');
    Route::post('service-center-update/{id}', [ServiceCenterController::class, 'servicecenterUpdate'])->name('service-center-update');
    Route::get('service-center-delete/{id}', [ServiceCenterController::class, 'serviceCenterDestroy'])->name('service-center-delete');
    Route::get('service-center-datatable', [ServiceCenterController::class, 'serviceCenterDatatable'])->name('service-center-datatable');

    //header_menu_social_media_icon
    Route::post('header_menu_social_media_icon_insert', [HeaderMenuSocialMediaIconController::class, 'header_menu_social_media_icon_insert'])->name('header_menu_social_media_icon_insert');
    Route::get('header_menu_social_media_icon_index', [HeaderMenuSocialMediaIconController::class, 'header_menu_social_media_icon_index'])->name('header_menu_social_media_icon.index');
    Route::post('header_menu_social_media_icon_edit', [HeaderMenuSocialMediaIconController::class, 'EditSocialMedia'])->name('header_menu_social_media_icon_edit');
    Route::post('social_media_icon_update', [HeaderMenuSocialMediaIconController::class, 'social_media_icon_update'])->name('social_media_icon_update');
    Route::get('header_menu_social_media_icon_destroy/{id}', [HeaderMenuSocialMediaIconController::class, 'header_menu_social_media_icon_destroy'])->name('header_menu_social_media_icon_destroy');

    //service
    Route::get('service', [ServiceController::class, 'serviceList'])->name('service');
    Route::get('service-create', [ServiceController::class, 'serviceCreate'])->name('service-create');
    Route::post('service-store', [ServiceController::class, 'serviceStore'])->name('service-store');
    Route::get('service-edit/{id}', [ServiceController::class, 'serviceEdit'])->name('service-edit');
    Route::post('service-update/{id}', [ServiceController::class, 'serviceUpdate'])->name('service-update');
    Route::get('service-delete/{id}', [ServiceController::class, 'serviceDestroy'])->name('service-delete');
    Route::get('service-datatable', [ServiceController::class, 'serviceDatatable'])->name('service-datatable');

    //count
    Route::get('count', [CountController::class, 'count'])->name('count');
    Route::get('countCreate', [CountController::class, 'countCreate'])->name('countCreate');
    Route::post('count_insert', [CountController::class, 'count_insert'])->name('count_insert');
    Route::get('count_index', [CountController::class, 'count_index'])->name('count.index');
    Route::get('count_edit/{count_edit}', [CountController::class, 'count_edit'])->name('count.edit');
    Route::post('count_update,{id}', [CountController::class, 'count_update'])->name('count_update');
    Route::get('count_destroy/{id}', [CountController::class, 'count_destroy'])->name('count_destroy');

    //service center facility and customer gallery
    Route::get('service-center-facility-customergallery', [ServiceCenterFacilityCustomerGalleryController::class, 'serviceCenterFacilityCustomerGalleryList'])->name('service-center-facility-customergallery');
    Route::post('service-center-facility-customergallery-html', [ServiceCenterFacilityCustomerGalleryController::class, 'ajaxaServiceCenterFacilityCustomerGalleryHtml'])->name('service-center-facility-customergallery-html');
    Route::post('service-center-facility-customergallery-store', [ServiceCenterFacilityCustomerGalleryController::class, 'serviceCenterFacilityCustomerGalleryStore'])->name('service-center-facility-customergallery-store');
    Route::post('service-center-facility-customergallery-update/{id}', [ServiceCenterFacilityCustomerGalleryController::class, 'serviceCenterFacilityCustomerGalleryUpdate'])->name('service-center-facility-customergallery-update');
    Route::get('service-center-facility-customergallery-delete/{id}', [ServiceCenterFacilityCustomerGalleryController::class, 'serviceCenterFacilityCustomerGalleryDestroy'])->name('service-center-facility-customergallery-delete');
    Route::get('service-center-facility-customergallery-datatable', [ServiceCenterFacilityCustomerGalleryController::class, 'serviceCenterFacilityCustomerGalleryDatatable'])->name('service-center-facility-customergallery-datatable');

    //service center testimonial
    Route::get('service-center-testimonial', [ServiceCenterTestimonialController::class, 'serviceCeterTestimonialList'])->name('service-center-testimonial');
    Route::get('service-center-testimonial-create', [ServiceCenterTestimonialController::class, 'serviceCenterTestimonialCreate'])->name('service-center-testimonial-create');
    Route::post('service-center-testimonial-store', [ServiceCenterTestimonialController::class, 'serviceCenterTestimonialStore'])->name('service-center-testimonial-store');
    Route::get('service-center-testimonial-edit/{id}', [ServiceCenterTestimonialController::class, 'serviceCenterTestimonialEdit'])->name('service-center-testimonial-edit');
    Route::post('service-center-testimonial-update/{id}', [ServiceCenterTestimonialController::class, 'serviceCenterTestimonialUpdate'])->name('service-center-testimonial-update');
    Route::get('service-center-testimonial-delete/{id}', [ServiceCenterTestimonialController::class, 'serviceCenterTestimonialDestroy'])->name('service-center-testimonial-delete');
    Route::get('service-center-testimonial-datatable', [ServiceCenterTestimonialController::class, 'serviceCenterTestimonialDatatable'])->name('service-center-testimonial-datatable');

    //users
    Route::get('user', [UserController::class, 'userList'])->name('user');
    Route::get('user-create', [UserController::class, 'userCreate'])->name('user-create');
    Route::post('user-store', [UserController::class, 'userStore'])->name('user-store');
    Route::get('user-edit/{id}', [UserController::class, 'userEdit'])->name('user-edit');
    Route::post('user-update/{id}', [UserController::class, 'userUpdate'])->name('user-update');
    Route::get('user-delete/{id}', [UserController::class, 'userDestroy'])->name('user-delete');
    Route::post('user-datatable', [UserController::class, 'userDatatable'])->name('user-datatable');
    Route::post('get-business', [UserController::class, 'getBusiness'])->name('get-business');

    //faq
    Route::get('faq', [FaqController::class, 'faqList'])->name('faq');
    Route::get('faq-create', [FaqController::class, 'faqCreate'])->name('faq-create');
    Route::post('faq-store', [FaqController::class, 'faqStore'])->name('faq-store');
    Route::get('faq-edit/{id}', [FaqController::class, 'faqEdit'])->name('faq-edit');
    Route::post('faq-update/{id}', [FaqController::class, 'faqUpdate'])->name('faq-update');
    Route::get('faq-delete/{id}', [FaqController::class, 'faqDestroy'])->name('faq-delete');
    Route::get('faq-datatable', [FaqController::class, 'faqDatatable'])->name('faq-datatable');

    Route::post('faq-title-update', [FaqController::class, 'faqTitleUpdate'])->name('faq-title-update');


    //showroom_facility_customer_gallery
    Route::get('showroom_facility_customer_gallery', [ShowroomFacilityCustomerGalleryController::class, 'showroom_facility_customer_gallery'])->name('showroom_facility_customer_gallery');
    Route::post('showroom_facility_customer_gallery_insert', [ShowroomFacilityCustomerGalleryController::class, 'showroom_facility_customer_gallery_insert'])->name('showroom_facility_customer_gallery_insert');
    Route::get('showroom_facility_customer_gallery_index', [ShowroomFacilityCustomerGalleryController::class, 'showroom_facility_customer_gallery_index'])->name('showroom_facility_customer_gallery.index');
    Route::post('facility_customer_gallery_edit', [ShowroomFacilityCustomerGalleryController::class, 'showroom_facility_customer_gallery_edit'])->name('facility_customer_gallery_edit');
    Route::post('showroom_facility_customer_gallery_update', [ShowroomFacilityCustomerGalleryController::class, 'showroom_facility_customer_gallery_update'])->name('showroom_facility_customer_gallery_update');
    Route::get('showroom_facility_customer_gallery_destroy/{id}', [ShowroomFacilityCustomerGalleryController::class, 'showroom_facility_customer_gallery_destroy'])->name('showroom_facility_customer_gallery_destroy');

    //pages
    Route::get('pages', [PageController::class, 'pageList'])->name('pages');
    Route::get('page-create', [PageController::class, 'pageCreate'])->name('page-create');
    Route::post('page-store', [PageController::class, 'pageStore'])->name('page-store');
    Route::get('page-edit/{id}', [PageController::class, 'pageEdit'])->name('page-edit');
    Route::post('page-update/{id}', [PageController::class, 'pageUpdate'])->name('page-update');
    Route::get('page-delete/{id}', [PageController::class, 'pageDestroy'])->name('page-delete');
    Route::get('page-datatable', [PageController::class, 'pageDatatable'])->name('page-datatable');

    //awards
    Route::get('awards', [AwardsController::class, 'awardList'])->name('awards');
    Route::post('award-store', [AwardsController::class, 'awardStore'])->name('award-store');
    Route::post('award-update/{id}', [AwardsController::class, 'awardUpdate'])->name('award-update');
    Route::get('award-delete/{id}', [AwardsController::class, 'awardDestroy'])->name('award-delete');
    Route::post('award-datatable', [AwardsController::class, 'awardDatatable'])->name('award-datatable');
    Route::post('ajax-award-html',[AwardsController::class, 'ajaxAwardHtml'])->name('ajax-award-html');

    Route::get('award-banner-create', [AwardsController::class, 'awardBannerCreate'])->name('award-banner-create');
    Route::post('award-banner-update', [AwardsController::class, 'awardBannerUpdate'])->name('award-banner-update');

    //our business
    Route::get('our-business', [OurBusinessController::class, 'ourBusinessList'])->name('our-business');
    Route::get('our-business-create', [OurBusinessController::class, 'ourBusinessCreate'])->name('our-business-create');
    Route::post('our-business-store', [OurBusinessController::class, 'ourBusinessStore'])->name('our-business-store');
    Route::get('our-business-edit/{id}', [OurBusinessController::class, 'ourBusinessEdit'])->name('our-business-edit');
    Route::post('our-business-update/{id}', [OurBusinessController::class, 'ourBusinessUpdate'])->name('our-business-update');
    Route::get('our-business-delete/{id}', [OurBusinessController::class, 'ourBusinessDestroy'])->name('our-business-delete');
    Route::get('our-business-datatable', [OurBusinessController::class, 'ourBusinessDatatable'])->name('our-business-datatable');

    //our business insurance
    Route::get('our-business-insurance', [OurBusinessInsuranceController::class, 'ourBusinessInsuranceList'])->name('our-business-insurance');
    Route::get('our-business-insurance-create', [OurBusinessInsuranceController::class, 'ourBusinessInsuraceCreate'])->name('our-business-insurance-create');
    Route::post('our-business-insurance-store', [OurBusinessInsuranceController::class, 'ourBusinessInsuranceStore'])->name('our-business-insurance-store');
    Route::get('our-business-insurance-edit/{id}', [OurBusinessInsuranceController::class, 'ourBusinessInsuranceEdit'])->name('our-business-insurance-edit');
    Route::post('our-business-insurance-update/{id}', [OurBusinessInsuranceController::class, 'ourBusinessInsuranceUpdate'])->name('our-business-insurance-update');
    Route::get('our-business-insurance-delete/{id}', [OurBusinessInsuranceController::class, 'ourBusinessInsuranceDestroy'])->name('our-business-insurance-delete');
    Route::get('our-business-insurance-datatable', [OurBusinessInsuranceController::class, 'ourBusinessInsuranceDatatable'])->name('our-business-insurance-datatable');

    // vacancies
    Route::get('vacancies', [VacancyController::class, 'vacancyList'])->name('vacancies');
    Route::get('vacancy-create', [VacancyController::class, 'vacancyCreate'])->name('vacancy-create');
    Route::post('vacancy-store', [VacancyController::class, 'vacancyStore'])->name('vacancy-store');
    Route::get('vacancy-edit/{id}', [VacancyController::class, 'vacancyEdit'])->name('vacancy-edit');
    Route::post('vacancy-update/{id}', [VacancyController::class, 'vacancyUpdate'])->name('vacancy-update');
    Route::get('vacancy-delete/{id}', [VacancyController::class, 'vacancyDestroy'])->name('vacancy-delete');
    Route::get('vacancy-datatable', [VacancyController::class, 'vacancyDatatable'])->name('vacancy-datatable');

    // career
    Route::get('career', [CareerController::class, 'career'])->name('career');
    Route::post('career-update', [CareerController::class, 'careerUpdate'])->name('career-update');

    //body shop
    Route::get('body_shop', [BodyShopController::class, 'body_shop'])->name('body_shop');
    Route::get('bodyShopCreate', [BodyShopController::class, 'bodyShopCreate'])->name('bodyShopCreate');
    Route::post('body_shop_insert', [BodyShopController::class, 'body_shop_insert'])->name('body_shop_insert');
    Route::get('body_shop_index', [BodyShopController::class, 'body_shop_index'])->name('body_shop.index');
    Route::get('body_shop_edit/{body_shop_edit}', [BodyShopController::class, 'body_shop_edit'])->name('body_shop.edit');
    Route::post('body_shop_update,{id}', [BodyShopController::class, 'body_shop_update'])->name('body_shop_update');
    Route::get('body_shop_destroy/{id}', [BodyShopController::class, 'body_shop_destroy'])->name('body_shop_destroy');

    //used car
    Route::get('used_car', [UsedCarController::class, 'used_car'])->name('used_car');
    Route::get('usedCarCreate', [UsedCarController::class, 'usedCarCreate'])->name('usedCarCreate');
    Route::post('used_car_insert', [UsedCarController::class, 'used_car_insert'])->name('used_car_insert');
    Route::get('used_car_index', [UsedCarController::class, 'used_car_index'])->name('used_car.index');
    Route::get('used_car_edit/{used_car_edit}', [UsedCarController::class, 'used_car_edit'])->name('used_car.edit');
    Route::post('used_car_update,{id}', [UsedCarController::class, 'used_car_update'])->name('used_car_update');
    Route::get('used_car_destroy/{id}', [UsedCarController::class, 'used_car_destroy'])->name('used_car_destroy');

    //contact_us
    Route::get('contact_us', [ContactUsController::class, 'contact_us'])->name('contact_us');
    Route::post('contact_us_insert', [ContactUsController::class, 'contact_us_insert'])->name('contact_us_insert');

    //our_location
    Route::get('our_location', [OurLocationController::class, 'our_location'])->name('our_location');
    Route::post('our_location_insert', [OurLocationController::class, 'our_location_insert'])->name('our_location_insert');

    // new cars
    Route::get('new-cars', [NewCarsController::class, 'newCars'])->name('new-cars');
    Route::post('new-cars-update', [NewCarsController::class, 'newCarsUpdate'])->name('new-cars-update');

    // after sales service
    Route::get('after-sales-service', [AfterSalesServiceController::class, 'afterSalesService'])->name('after-sales-service');
    Route::post('after-sales-service-update', [AfterSalesServiceController::class, 'afterSalesServiceUpdate'])->name('after-sales-service-update');

    // car insurance
    Route::get('car-insurance', [CarInsuranceController::class, 'carInsurance'])->name('car-insurance');
    Route::post('car-insurance-update', [CarInsuranceController::class, 'carInsuranceUpdate'])->name('car-insurance-update');

    // csr
    Route::get('company-csr', [CompanyCsrController::class, 'companyCsr'])->name('company-csr');
    Route::post('company-csr-update', [CompanyCsrController::class, 'companyCsrUpdate'])->name('company-csr-update');
});

//Frontend
Route::get('/', function () {
    return redirect()->route('home');
});

Route::get('/', [HomeController::class, 'home'])->name('home');

//contactus_detail
Route::get('contactus/contact', [ContactUsDetailController::class, 'contactusDetail'])->name('contactus_detail');

//location
Route::get('contactus/location', [locationDetailController::class, 'locationDetail'])->name('location_detail');

// business page
Route::get('business/{slug}', [BusinessController::class, 'businessDetail']);

// faq page
Route::get('faqs', [PageDetailController::class, 'faqPage'])->name('faqs');

// cms pages
Route::get('{slug}', [PageDetailController::class, 'cmsPage']);
// $compnycms = Cache::remember('pages', 10, function() { 
//     return DB::table('pages')
//     ->get();
//         });

//     if(!empty($compnycms)) {
//     foreach ($compnycms as $page) {
//         Route::get($page->slug, [App\Http\Controllers\Frontend\PageController::class, 'cmsPage'])->name($page->slug);
//     }
// }

// awards
Route::get('awards/gallery', [AwardsDetailController::class, 'gallery'])->name('awards-gallery');

// service center
Route::get('service-center/{slug}', [ServiceCenterDetailController::class, 'serviceCenter']);

// showroom
Route::get('showroom/{slug}', [ShowroomDetailController::class, 'showroom']);

// careers
Route::get('careers/job', [CareerDetailController::class, 'job'])->name('job');

// new cars
Route::get('our-service/buy_new_car_landing_page', [NewCarController::class, 'carList'])->name('buy_new_car_landing_page');

// after sales service
Route::get('our-service/bookservice', [AfterSalesServicedDetailController::class, 'bookService'])->name('bookservice');

// used car
Route::get('our-service/used-car', [UsedCarDetailController::class, 'usedCar']);

// used car
Route::get('our-service/book-insurance', [CarInsuranceDetailController::class, 'bookInsurance']);