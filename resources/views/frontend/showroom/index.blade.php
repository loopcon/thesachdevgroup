@extends('frontend.layout.header')
@section('css')
<link type="text/css" class="js-stylesheet" href="{{ url('public/plugins/parsley/parsley.css') }}" rel="stylesheet">
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.1/assets/owl.carousel.min.css">
<link rel="stylesheet" href="http://themes.audemedia.com/html/goodgrowth/css/owl.theme.default.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/freeps2/a7rarpress@main/swiper-bundle.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
@endsection

@section('content')
<section id="location-banner">
    <div class="location-banner-image">
        @if(isset($showroom->image) && $showroom->image)
            <img src="{{url('public/showrooms_image/'.$showroom->image)}}" alt="">
        @endif
    </div>
</section>

<section id="introduction-location">
    <div class="container">
        <div class="location-text">
            <h1 style="color:{{$showroom->name_color}}; font-size:{{$showroom->name_font_size}}; font-family:{{$showroom->name_font_family}};">{{isset($showroom->name) && $showroom->name ? $showroom->name : ''}}</h1>
            <p style="color:{{$showroom->description_font_color}}; font-size:{{$showroom->description_font_size}}; font-family:{{$showroom->description_font_family}};">{!! isset($showroom->description) && $showroom->description ? $showroom->description : '' !!}</p>
        </div>
        <div class="top-car-image">
            <div class="top-car-parent">
                @if(isset($cars) && $cars)
                    @foreach($cars as $car)
                        <div class="car-image">
                            <a href="{{$car->link}}">
                                <img src="{{url('public/car/'.$car->image)}}" alt="" width="90px">
                                <p style="color:{{$car->name_color}}; font-size:{{$car->name_font_size}}; font-family:{{$car->name_font_family}};">{{$car->name}}</p>
                            </a>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</section>

<section id="working-time">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 bg-#f1f1f1">
                <div class="location-parent">
                    <div class="location-image-one">
                        @if(isset($showroom->address_icon) && $showroom->address_icon)
                            <img src="{{url('public/showrooms_address_icon/'.$showroom->address_icon)}}" alt="" width="60%">
                        @endif
                    </div>
                    <div class="location-text-one">
                        <h4 style="color:{{$showroom->address_title_color}}; font-size:{{$showroom->address_title_font_size}}; font-family:{{$showroom->address_title_font_family}};">{{isset($showroom->address_title) && $showroom->address_title ? strtoupper($showroom->address_title) : ''}}</h4>
                        <p style="color:{{$showroom->address_color}}; font-size:{{$showroom->address_font_size}}; font-family:{{$showroom->address_font_family}};">{{isset($showroom->address) && $showroom->address ? $showroom->address : ''}}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 bg-light">
            <div class="location-parent">
                    <div class="location-image-one">
                        @if(isset($showroom->working_hours_icon) && $showroom->working_hours_icon)
                            <img src="{{url('public/showrooms_working_hours_icon/'.$showroom->working_hours_icon)}}" alt="" width="55%">
                        @endif
                    </div>
                    <div class="location-text-one">
                        <h4 style="color:{{$showroom->working_hour_title_color}}; font-size:{{$showroom->working_hour_title_font_size}}; font-family:{{$showroom->working_hour_title_font_family}};">{{isset($showroom->working_hour_title) && $showroom->working_hour_title ? strtoupper($showroom->working_hour_title) : ''}}</h4>
                        <p style="color:{{$showroom->working_hours_color}}; font-size:{{$showroom->working_hours_font_size}}; font-family:{{$showroom->working_hours_font_family}};">{{isset($showroom->working_hours) && $showroom->working_hours ? $showroom->working_hours : ''}}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 bg-light">
                <div class="location-parent">
                    <div class="location-image-one">
                        @if(isset($showroom->contact_number_icon) && $showroom->contact_number_icon)
                            <img src="{{url('public/showrooms_contact_number_icon/'.$showroom->contact_number_icon)}}" alt="" width="55%">
                        @endif
                    </div>
                    <div class="location-text-one">
                        <h4 style="color:{{$showroom->contact_title_color}}; font-size:{{$showroom->contact_title_font_size}}; font-family:{{$showroom->contact_title_font_family}};">{{isset($showroom->contact_title) && $showroom->contact_title ? strtoupper($showroom->contact_title) : ''}}</h4>
                        <p style="color:{{$showroom->contact_number_color}}; font-size:{{$showroom->contact_number_font_size}}; font-family:{{$showroom->contact_number_font_family}};"><a href="tel:+{{isset($showroom->contact_number) && $showroom->contact_number ? $showroom->contact_number: ''}}" style="color:{{$showroom->contact_number_color}}">+{{isset($showroom->contact_number) && $showroom->contact_number ? $showroom->contact_number: ''}}</a></p>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="location-parent">
                    <div class="location-image-one">
                        @if(isset($showroom->email_icon) && $showroom->email_icon)
                            <img src="{{url('public/showrooms_email_icon/'.$showroom->email_icon)}}" alt="" width="55%">
                        @endif
                    </div>
                    <div class="location-text-one">
                        <h4 style="color:{{$showroom->email_title_color}}; font-size:{{$showroom->email_title_font_size}}; font-family:{{$showroom->email_title_font_family}};">{{isset($showroom->email_title) && $showroom->email_title ? strtoupper($showroom->email_title) : ''}}</h4>
                        <p style="color:{{$showroom->email_color}}; font-size:{{$showroom->email_font_size}}; font-family:{{$showroom->email_font_family}};"><a href="mailto: {{isset($showroom->email) && $showroom->email ? $showroom->email : ''}}" style="color:{{$showroom->email_color}};">{{isset($showroom->email) && $showroom->email ? $showroom->email : ''}}</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@if(isset($facility) && !empty($facility))
<section id="facility">
    <div class="container">
        <div class="text-facility">
            <h3 style="color:{{$showroom->facility_title_color}}; font-size:{{$showroom->facility_title_font_size}}; font-family:{{$showroom->facility_title_font_family}};">{{isset($showroom->facility_title) && $showroom->facility_title ? strtoupper($showroom->facility_title) : ''}}</h3>
        </div>
        <div class="slide-container swiper">
            <div class="slide-content">
                <div class="card-wrapper swiper-wrapper">
                    @if(isset($facility) && $facility)
                        @foreach($facility as $facility_image)
                            <div class="card swiper-slide">
                                <a href="">
                                    <div class="image-content-facitity">
                                        <!-- <span class="overlay"></span> -->
                                        <div class="card-image">
                                            <img src="{{url('public/showroom_facility_image/'.$facility_image->facility_image)}}" alt="" class="card-img">
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="swiper-button-next swiper-navBtn"></div>
            <div class="swiper-button-prev swiper-navBtn"></div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
</section>
@endif
<!-- slider end  -->

<section id="facility">
    <div class="container">
        <div class="text-facility">
            <h3 style="color:{{$showroom->customer_gallery_title_color}}; font-size:{{$showroom->customer_gallery_title_font_size}}; font-family:{{$showroom->customer_gallery_title_font_family}};">{{isset($showroom->customer_gallery_title) && $showroom->customer_gallery_title ? strtoupper($showroom->customer_gallery_title) : ''}}</h3>
        </div>
        <div class="slide-container swiper">
            <div class="slide-content">
                <div class="card-wrapper swiper-wrapper">
                @if(isset($facility) && $facility)
                    @foreach($facility as $customer_image)
                        <div class="card swiper-slide">
                            <a href="#">
                                <div class="image-content-facitity">
                                    <div class="card-image">
                                        <img src="{{url('public/showroom_customer_gallery_image/'.$customer_image->customer_gallery_image)}}" alt="" class="card-img">
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                @endif
                </div>
            </div>

            <div class="swiper-button-next swiper-navBtn"></div>
            <div class="swiper-button-prev swiper-navBtn"></div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
</section>

<!-- form  -->
<section id="location-wiseform">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="contact-form-location">
                    <h3>Let’s connect!</h3>
                    <p>We’d love to hear from you. Drop a message or give us a call. You can use the form below to get in touch with us.</p>
                    <div class="form-contact-us">
                        <form action="{{route('showroom-contact-query-store')}}" method="post" enctype="maltipart/form-data" data-parsley-validate="">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 col-sm-12 margin-bookservice">
                                    <input type="text" class="form-control" placeholder="First Name" name="first_name" required>
                                </div>
                                <div class="col-md-6 col-sm-12 margin-bookservice">
                                    <input type="email" class="form-control" placeholder="Email" name="email" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-12 margin-bookservice">
                                    <input type="tel" class="form-control num_only" placeholder="Phone" name="phone" maxlength="10" required>
                                </div>
                                <div class="col-md-6 col-sm-12 margin-bookservice">
                                    <select id="inputState" class="form-control" name="our_service">
                                        <option value="" selected>Choose Service</option>
                                        @foreach($our_services as $service)
                                            <option value="{{$service->id}}">{{$service->name}}</option>
                                        @endforeach
                                        <!-- <option>New Car</option>
                                        <option>Used Car</option>
                                        <option>Service</option>
                                        <option>Insurence</option> -->
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" id="exampleFormControlTextarea1" name="description" rows="3"></textarea>
                            </div>
                            <div class="form-group margin-bookservice">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="gridCheck">
                                    <label class="form-check-label" for="gridCheck">
                                    I agree to the <a href="{{url('privacy-policy')}}"> Privacy Policy </a>.
                                    </label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary bookservice-button">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="locations-contact-us">
                    @if(isset($showroom->lets_connect_image) && $showroom->lets_connect_image)
                        <img src="{{url('public/uploads/showroom/lets_connect_image/'.$showroom->lets_connect_image)}}" alt="" width="65%">
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

<!-- testimonials -->
@if(isset($testimonials) && !empty($testimonials))
<section id="testimonial">
    <div class="container">
        <div class="location-testimonial">
            <h2 style="color:{{$showroom->testimonial_title_color}}; font-size:{{$showroom->testimonial_title_font_size}}; font-family:{{$showroom->testimonial_title_font_family}};">{{isset($showroom->testimonial_title) && $showroom->testimonial_title ? $showroom->testimonial_title : ''}}</h2>
        </div>
        <div class="reviews">
            <section class="testimonials">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <div id="customers-testimonials" class="owl-carousel">
                                @foreach($testimonials as $testimonial)
                                    <!--TESTIMONIAL 1 -->
                                    <div class="item">
                                        <div class="shadow-effect">
                                            <img class="img-circle" src="{{url('public/uploads/showroom_testimonial/'.$testimonial->image)}}" alt="">
                                            <p maxlength="20" style="color:{{$testimonial->description_text_color}}; font-size:{{$testimonial->description_text_size}}; font-family:{{$testimonial->description_font_family}};">{{$testimonial->description}}</p>
                                        </div>
                                        <div class="testimonial-name" style="color:{{$testimonial->name_text_color}}; font-size:{{$testimonial->name_text_size}}; font-family:{{$testimonial->name_font_family}}; background-color:{{$testimonial->name_background_color}};">{{$testimonial->name}}</div>
                                    </div>
                                    <!--END OF TESTIMONIAL 1 -->
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</section>
@endif
<!-- end testimonials -->

@endsection
@section('javascript')
<script src="{{ url('public/plugins/parsley/parsley.js') }}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.1/owl.carousel.min.js"></script>
<!-- Swiper JS -->
<script src="//cdn.jsdelivr.net/gh/freeps2/a7rarpress@main/swiper-bundle.min.js"></script>
<!-- JavaScript -->
<!--Uncomment this line-->
<script src="//cdn.jsdelivr.net/gh/freeps2/a7rarpress@main/script.js"></script>
<script>
    @if(session('message'))
        toastr.success('{{ session('message') }}');
    @endif

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
</script>
<script>
  jQuery(document).ready(function($) {
        "use strict";
        //  TESTIMONIALS CAROUSEL HOOK
        $('#customers-testimonials').owlCarousel({
            loop: true,
            center: true,
            items: 3,
            margin: 0,
            autoplay: true,
            dots:true,
            autoplayTimeout: 8500,
            smartSpeed: 450,
            responsive: {
                0: {
                items: 1
                },
                768: {
                items: 2
                },
                1170: {
                items: 3
                }
            }
        });
    });
</script>
@endsection