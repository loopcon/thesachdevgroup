@extends('frontend.layout.header')
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"> -->
@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/freeps2/a7rarpress@main/swiper-bundle.min.css">
@endsection
@section('content')
<section id="location-banner">
    <div class="location-banner-image">
        @if(isset($business->banner_image) && $business->banner_image)
            <img src="{{url('public/uploads/our_business/'.$business->banner_image)}}" alt="Banner">
        @endif
    </div>
</section>
<section id="introduction-location">
    <div class="container">
        <div class="location-text">
            <h1 style="color:{{$business->title_font_color}}; font-size:{{$business->title_font_size}}; font-family:{{$business->title_font_family}};">{{isset($business->title) && $business->title ? $business->title : ''}}</h1>
            <p style="color:{{$business->description_font_color}}; font-size:{{$business->description_font_size}}; font-family:{{$business->description_font_family}};">{{ isset($business->description) && $business->description ? $business->description : '' }}</p>
        </div>

        <div class="top-car-image"> 
            <div class="top-car-parent">
                @if(isset($services) && $services->count())
                    @foreach($services as $service)
                        <div class="car-image">
                            <a href="{{$service->url}}" target="_blank">
                            <img src="{{asset('uploads/service/'.$service->icon)}}" alt="" width="90px">
                            <p style="color:{{$service->name_font_color}}; font-size:{{$service->name_font_size}}; font-family:{{$service->name_font_family}};">{{$service->name}}</p>
                            </a>
                        </div>
                    @endforeach
                @endif

                @if(isset($car_model) && $car_model->count())
                    @foreach($car_model as $model)
                        <div class="car-image">
                            <a href="{{$model->link}}" target="_blank">
                            <img src="{{asset('car/'.$model->image)}}" alt="" width="222px">
                            <p style="color:{{$model->name_color}}; font-size:{{$model->name_font_size}}; font-family:{{$model->name_font_family}};">{{$model->name}}</p>
                            </a>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</section>

<!-- showroom -->
@if(isset($showrooms) && $showrooms)
<section id="location-section">
    <div class="container">
        <div class="location-tittle">
            <h2 style="color:{{$business->showroom_title_color}}; font-size:{{$business->showroom_title_font_size}}; font-family:{{$business->showroom_title_font_family}};">{{isset($business->showroom_title) && $business->showroom_title ? $business->showroom_title : NULL}}</h2>
        </div>
        <div class="slide-container swiper">
            <div class="slide-content">
                <div class="card-wrapper swiper-wrapper">
                    @foreach($showrooms as $showroom)
                        <div class="card swiper-slide">
                            <a href="#">
                                <div class="image-content">
                                    <!-- <span class="overlay"></span> -->
                                    <div class="card-image">
                                    <img src="{{asset('showrooms_slider_image/'.$showroom->slider_image)}}" alt="" class="card-img">
                                    </div>
                                </div>
                                <div class="card-content">
                                    <h2 class="name" style="color:{{$showroom->slider_showroom_name_color}}; font-size:{{$showroom->slider_showroom_name_font_size}}; font-family:{{$showroom->slider_showroom_name_font_family}};">{{$showroom->name}}</h2>
                                    <div class="rating">
                                        @php($rating = $showroom->rating * 20)
                                        <div class='stars'><div id='pid-{{$showroom->id}}' class='percent' style='width:{{$rating}}%;'></div></div>
                                    </div>
                                    <div class="star-parent">
                                        <img src="{{asset('front_img/google.webp')}}" alt="" width="6%">
                                        <p>{{$showroom->rating}}</p>
                                        <p>({{$showroom->number_of_rating}} reviews)</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="swiper-button-next swiper-navBtn"></div>
            <div class="swiper-button-prev swiper-navBtn"></div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
</section>
@endif
<!-- showroom end  -->

<!-- service center -->
@if(isset($service_centers) && $service_centers)
<section id="service-location">
    <div class="container">
        <div class="location-tittle">
            <h2 style="color:{{$business->service_center_title_color}}; font-size:{{$business->service_center_title_font_size}}; font-family:{{$business->service_center_title_font_family}};">{{isset($business->service_center_title) && $business->service_center_title ? $business->service_center_title : NULL}}</h2>
        </div>
        <div class="slide-container swiper">
            <div class="slide-content">
                <div class="card-wrapper swiper-wrapper">
                    @foreach($service_centers as $service_center)
                        <div class="card swiper-slide">
                            <a href="#">
                                <div class="image-content">
                                    <!-- <span class="overlay"></span> -->
                                    <div class="card-image">
                                    <img src="{{asset('uploads/service_center/slider_image/'.$service_center->slider_image)}}" alt="" class="card-img">
                                    </div>
                                </div>
                                <div class="card-content">
                                    <h2 class="name" style="color:{{$service_center->slider_service_center_name_color}}; font-size:{{$service_center->slider_service_center_name_size}}; font-family:{{$service_center->slider_service_center_name_font_family}};">{{$service_center->slider_service_center_name}}</h2>
                                    <div class="rating">
                                        @php($rate = $service_center->rating * 20)
                                        <div class='stars'><div id='pid-{{$service_center->id}}' class='percent' style='width:{{$rate}}%;'></div></div>
                                        <!-- <img src="public/front_img/star.webp" alt=""> -->
                                    </div>
                                    <div class="star-parent">
                                        <img src="{{asset('front_img/google.webp')}}" alt="" width="6%">
                                        <p>{{$service_center->rating}}</p>
                                        <p>({{$service_center->number_of_rating}} reviews)</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="swiper-button-next swiper-navBtn"></div>
            <div class="swiper-button-prev swiper-navBtn"></div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
</div>
</section>
@endif
<!-- service center end -->

<!-- toyota showroom locaions slider  -->
<?php /*<section id="bodyshop-location">
    <div class="container">
    <div class="location-tittle">
        <h2>Galaxy Toyota Body Shops</h2>
    </div>
    <div class="slide-container swiper">
                <div class="slide-content">
                    <div class="card-wrapper swiper-wrapper">
                    
                        <div class="card swiper-slide">
                        <a href="https://www.galaxytoyota.in/service/body-paint">
                            <div class="image-content">
                                <!-- <span class="overlay"></span> -->
                                <div class="card-image">
                                <img src="assets/image/locations-banner/service-motinagar.jpg" alt="" class="card-img">
                                </div>
                            </div>

                            <div class="card-content">
                                <h2 class="name">Galaxy Toyota Body Shop Moti Nagar
    </h2>
    <div class="rating">
                            <img src="assets/image/locations-banner/star.png" alt="">
                            <img src="assets/image/locations-banner/star.png" alt="">
                            <img src="assets/image/locations-banner/star.png" alt="">
                            <img src="assets/image/locations-banner/star.png" alt="">
                            <img src="assets/image/locations-banner/rating.png" alt="">
                            </div>
                                <div class="star-parent">
                                <img src="assets/image/locations-banner/google.png" alt="" width="6%">
                            <p>4.6</p>
                            <p>(4,160 reviews)</p>
                            
                            </div>
                            
                                
                            </div>
                            </a>
                        </div>
                    
                        <div class="card swiper-slide">
                        <a href="https://www.galaxytoyota.in/service/body-paint">
                            <div class="image-content">
                                <!-- <span class="overlay"></span> -->
                                <div class="card-image">
                                <img src="assets/image/locations-banner/kundli-service.jpg" alt="" class="card-img">
                                </div>
                            </div>

                            <div class="card-content">
                                <h2 class="name">Galaxy Toyota Body Shop Kundli
    </h2>
    <div class="rating">
                            <img src="assets/image/locations-banner/star.png" alt="">
                            <img src="assets/image/locations-banner/star.png" alt="">
                            <img src="assets/image/locations-banner/star.png" alt="">
                            <img src="assets/image/locations-banner/star.png" alt="">
                            <img src="assets/image/locations-banner/rating.png" alt="">
                            </div>
                                <div class="star-parent">
                                <img src="assets/image/locations-banner/google.png" alt="" width="6%">
                            <p>4.7</p>
                            <p>(946 reviews)</p>
                            
                            </div>
                            
                                
                            </div>
                            </a>
                        </div>
                        <div class="card swiper-slide">
                        <a href="https://www.galaxytoyota.in/service/body-paint">
                            <div class="image-content">
                                <!-- <span class="overlay"></span> -->
                                <div class="card-image">
                                <img src="assets/image/locations-banner/azadpur-service.jpg" alt="" class="card-img">
                                </div>
                            </div>

                            <div class="card-content">
                                <h2 class="name">Galaxy Toyota Body Shop Azadpur
    </h2>
    <div class="rating">
                            <img src="assets/image/locations-banner/star.png" alt="">
                            <img src="assets/image/locations-banner/star.png" alt="">
                            <img src="assets/image/locations-banner/star.png" alt="">
                            <img src="assets/image/locations-banner/star.png" alt="">
                            <img src="assets/image/locations-banner/rating.png" alt="">
                            </div>
                                <div class="star-parent">
                                <img src="assets/image/locations-banner/google.png" alt="" width="6%">
                            <p>4.6</p>
                            <p>(420 reviews)</p>
                            
                            </div>
                            
                                
                            </div>
                            </a>
                        </div> 
                        
                    </div>
                </div>

                <div class="swiper-button-next swiper-navBtn"></div>
                <div class="swiper-button-prev swiper-navBtn"></div>
                <div class="swiper-pagination"></div>
            </div>
    </div>
</section>*/ ?>
<!-- toyota showroom location end  -->

<!-- toyota showroom locaions slider  -->
<?php /**<section id="used-car-locations">
    <div class="container">
    <div class="location-tittle">
        <h2>Galaxy Toyota Used car</h2>
    </div>
    <div class="slide-container swiper">
                <div class="slide-content">
                    <div class="card-wrapper swiper-wrapper">
                    
                        <div class="card swiper-slide">
                        <a href="">
                            <div class="image-content">
                                <!-- <span class="overlay"></span> -->
                                <div class="card-image">
                                <img src="assets/image/locations-banner/2.jpg" alt="" class="card-img">
                                </div>
                            </div>

                            <div class="card-content">
                                <h2 class="name">Galaxy Toyota U Dwarka
    </h2>
    <div class="rating">
                            <img src="assets/image/locations-banner/star.png" alt="">
                            <img src="assets/image/locations-banner/star.png" alt="">
                            <img src="assets/image/locations-banner/star.png" alt="">
                            <img src="assets/image/locations-banner/star.png" alt="">
                            <img src="assets/image/locations-banner/rating.png" alt="">
                            </div>
                                <div class="star-parent">
                                <img src="assets/image/locations-banner/google.png" alt="" width="6%">
                            <p>4.6</p>
                            <p>(4,160 reviews)</p>
                            
                            </div>
                            
                                
                            </div>
                            </a>
                        </div>
                    
                        <div class="card swiper-slide">
                        <a href="">
                            <div class="image-content">
                                <!-- <span class="overlay"></span> -->
                                <div class="card-image">
                                <img src="assets/image/locations-banner/1.jpg" alt="" class="card-img">
                                </div>
                            </div>

                            <div class="card-content">
                                <h2 class="name">Galaxy Toyota U Moti Nagar
    </h2>
    <div class="rating">
                            <img src="assets/image/locations-banner/star.png" alt="">
                            <img src="assets/image/locations-banner/star.png" alt="">
                            <img src="assets/image/locations-banner/star.png" alt="">
                            <img src="assets/image/locations-banner/star.png" alt="">
                            <img src="assets/image/locations-banner/rating.png" alt="">
                            </div>
                                <div class="star-parent">
                                <img src="assets/image/locations-banner/google.png" alt="" width="6%">
                            <p>4.7</p>
                            <p>(946 reviews)</p>
                            
                            </div>
                            
                                
                            </div>
                            </a>
                        </div>
                        <div class="card swiper-slide">
                        <a href="">
                            <div class="image-content">
                                <!-- <span class="overlay"></span> -->
                                <div class="card-image">
                                <img src="assets/image/locations-banner/4.jpg" alt="" class="card-img">
                                </div>
                            </div>

                            <div class="card-content">
                                <h2 class="name">Galaxy Toyota U Shalimar
    </h2>
    <div class="rating">
                            <img src="assets/image/locations-banner/star.png" alt="">
                            <img src="assets/image/locations-banner/star.png" alt="">
                            <img src="assets/image/locations-banner/star.png" alt="">
                            <img src="assets/image/locations-banner/star.png" alt="">
                            <img src="assets/image/locations-banner/rating.png" alt="">
                            </div>
                                <div class="star-parent">
                                <img src="assets/image/locations-banner/google.png" alt="" width="6%">
                            <p>4.6</p>
                            <p>(420 reviews)</p>
                            
                            </div>
                            
                                
                            </div>
                            </a>
                        </div> 
                        
                    </div>
                </div>

                <div class="swiper-button-next swiper-navBtn"></div>
                <div class="swiper-button-prev swiper-navBtn"></div>
                <div class="swiper-pagination"></div>
            </div>
    </div>
</section>**/ ?>
<!-- toyota showroom location end  -->

<!-- insurence  -->
@if(isset($business_insurance) && $business_insurance)
<section id="insurence-page">
    <div class="container">
        <div class="heading-title-insurence">
            <h2 style="color:{{$business->insurance_title_color}}; font-size:{{$business->insurance_title_font_size}}; font-family:{{$business->insurance_title_font_family}};">{{isset($business->insurance_title) && $business->insurance_title ? $business->insurance_title : NULL}}</h2>
        </div>
        <div class="insurence-parent">
            @if($business_insurance->count() > 3)
                <div id="owl-insurence-carousel" class="owl-carousel owl-theme">
                    @foreach($business_insurance as $record)
                        <div class="insurence-card">
                            <a href="#" target="_blank">
                                <div class="insurence-card-one">
                                    <img src="{{asset('uploads/our_business_insurance/'.$record->icon)}}" alt="" width="30%">
                                    <div class="insurence-content">
                                        <p style="color:{{$record->name_font_color}}; font-size:{{$record->name_font_size}}; font-family:{{$record->name_font_family}};">{{$record->name}}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            @else
                @foreach($business_insurance as $record)
                    <div class="insurence-card">
                        <a href="#" target="_blank">
                            <div class="insurence-card-one">
                                <img src="{{asset('uploads/our_business_insurance/'.$record->icon)}}" alt="" width="30%">
                                <div class="insurence-content">
                                    <p style="color:{{$record->name_font_color}}; font-size:{{$record->name_font_size}}; font-family:{{$record->name_font_family}};">{{$record->name}}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</section>
@endif

<!-- why choose us  -->
<section id="insurence-page">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="left-image-insurence">
                    <img src="{{asset('uploads/our_business_why_choose/'.$business->why_choose_image)}}" alt="">
                </div>
            </div>

            <div class="col-md-6">
                <div class="heading-title-advantage">
                    <h2 style="color:{{$business->why_choose_title_color}}; font-size:{{$business->why_choose_title_font_size}}; font-family:{{$business->why_choose_title_font_family}};">{{isset($business->why_choose_title) && $business->why_choose_title ? $business->why_choose_title : ''}}</h2>
                    <div style="color:{{$business->why_choose_description_color}}; font-size:{{$business->why_choose_description_font_size}}; font-family:{{$business->why_choose_description_font_family}};">
                        {!! isset($business->why_choose_description) && $business->why_choose_description ? $business->why_choose_description : '' !!}
                    </div>
                    <!-- <ul>
                        <li><img src="assets/image/locations-banner/check (1).png" alt="" width="18px"> Wide Selection Of Toyota Cars</li>
                        <li><img src="assets/image/locations-banner/check (1).png" alt="" width="18px"> Expert Service And Maintenance</li>
                        <li><img src="assets/image/locations-banner/check (1).png" alt="" width="18px"> Genuine Toyota Parts</li>
                        <li><img src="assets/image/locations-banner/check (1).png" alt="" width="18px"> Customer-Centric Approach</li>
                        <li><img src="assets/image/locations-banner/check (1).png" alt="" width="18px"> World-Class Facilities</li>
                        <li><img src="assets/image/locations-banner/check (1).png" alt="" width="18px"> Experienced & Knowledgeable Staff</li>
                    </ul> -->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- why choose end -->
@endsection
@section('javascript')
   <!-- Swiper JS -->
   <script src="//cdn.jsdelivr.net/gh/freeps2/a7rarpress@main/swiper-bundle.min.js"></script>
    <!-- JavaScript -->
      <!--Uncomment this line-->
    <script src="//cdn.jsdelivr.net/gh/freeps2/a7rarpress@main/script.js"></script>
    <script>
        var swiper = new Swiper(".slide-content", {
            slidesPerView: 3,
            spaceBetween: 25,
            loop: true,
            centerSlide: 'true',
            fade: 'true',
            grabCursor: 'true',
            pagination: {
            el: ".swiper-pagination",
            clickable: true,
            dynamicBullets: true,
            },
            navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
            },

             breakpoints:{
                0: {
                     slidesPerView: 1,
                },
                520: {
                    slidesPerView: 2,
                },
                950: {
                    slidesPerView: 3,
                },
             },
        });

        $(document).ready(function() {
            $('#owl-insurence-carousel').owlCarousel({
                loop: true,
                margin: 30,
                dots: true,
                // nav: true,
                items: 3,
            });
        });
</script>
@endsection


