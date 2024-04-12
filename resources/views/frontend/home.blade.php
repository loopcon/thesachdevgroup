@extends('frontend.layout.header')
@section('css')
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css">
   
   
   <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Whisper&display=swap');
    </style>

@endsection
@section('content')

    <div id="owl-carousel" class="owl-carousel owl-theme">
        @foreach($home_sliders as $key => $slider)
            <div class="{{$key == 0 ? 'active' : '' }}">
                <img src="{{url('public/home_slider/'.$slider->image)}}" class="d-block w-100"  alt="..."> 
                <div class="sliderTitle">
                    <div class="container">
                        <div class="">
                            <h2 style="text-align: {{$slider->text_position}}; color: {{$slider->title_color}}; font-size:{{$slider->title_font_size}}; font-family:{{$slider->title_font_family}};">{{$slider->title}}</h2>
                            <p style="text-align: {{$slider->text_position}}; color: {{$slider->sub_title_color}}; font-size:{{$slider->sub_title_font_size}}; font-family:{{$slider->sub_title_font_family}};">{{$slider->subtitle}}</p>
                        </div>
                    </div>
                </div>    
            </div>
        @endforeach
    </div>
    
    <!-- our brands -->
    <section id="brands-section" style="background-color:{{$home_our_businesses_background_color[0] ?? null}};">
     
        <div class="col-md-12">
           <div class="brand-title">
            @foreach($home_our_businessess as $home_our_businesses)
                <h2 style="color: {{$home_our_businesses->businesses_title_color}}; font-size:{{$home_our_businesses->businesses_title_font_size}}; font-family:{{$home_our_businesses->businesses_title_font_family}};">{{$home_our_businesses->businesses_title}}</h2>
                <p></p>
            @endforeach
           </div>
        </div>
        <div class="brands-logo-parent owl-carousel owl-theme" id="our_businesses_carousel">
            @foreach($home_our_businessess as $home_our_businesses)
                <div class="brand-one">
                    <a href="{{$home_our_businesses->link}}" target="_blank">
                        <img src="{{url('public/home_our_businesses/'.$home_our_businesses->image)}}" alt="" width="100%"> 
                    </a>
                </div> 
            @endforeach
        </div>
    </section>

    <!-- our story section  -->
    <section id="our-story">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="our-story-image">
                        @foreach ($home_details as $home_detail)
                            <img src="{{url('public/our_story_image/'.$home_detail->our_story_image)}}" alt="" width="100%"> 
                            
                        @endforeach
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="nav nav-pills tabs-width" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                @foreach ($mission_visions as $key => $mission_vision)
                                @php($active = '')
                                @if($key == 0)
                                    @php($active = 'active')
                                @endif
                                    <a class="nav-link {{$active}}" id="{{$mission_vision->slug}}-tab" data-toggle="pill" href="#{{$mission_vision->slug}}" role="tab" aria-controls="{{$mission_vision->slug}}">
                                        <img src="{{url('public/mission_vision/'.$mission_vision->icon)}}" alt="" width="100%"> 
                                        <p style="color:{{$mission_vision->icon_name_color}}; font-size:{{$mission_vision->icon_name_font_size}}; font-family:{{$mission_vision->icon_name_font_family}};">{{$mission_vision->icon_name}}</p>
                                    </a>
                                @endforeach
                            </div>
                        </div>
            
                        <div class="col-md-9">
                            <div class="tab-content home-page-tab" id="v-pills-tabContent">
                                @foreach ($mission_visions as $key => $mission_vision)
                                    @php($show_active = '')
                                    @if($key == 0)
                                        @php($show_active = 'show active')
                                    @endif
                                    <div class="tab-pane fade {{$show_active}}" id="{{$mission_vision->slug}}" role="tabpanel" aria-labelledby="{{$mission_vision->slug}}-tab">
                                        <h2 style="color:{{$mission_vision->title_color}}; font-size:{{$mission_vision->title_font_size}}; font-family:{{$mission_vision->title_font_family}};">{{$mission_vision->title}}</h2>
                                        <div style="color:{{$mission_vision->description_color}}; font-size:{{$mission_vision->description_font_size}}; font-family:{{$mission_vision->description_font_family}};">{!! $mission_vision->description !!}</div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    


    <!-- countup -->
    <div id="projectFacts" class="sectionClass">
        <div class="fullWidth eight columns">
            <div class="projectFactsWrap ">
                @php($counter = 0)
                @foreach ($counts as $count)
                    @php($counter ++)
                    <div class="item wow fadeInUpBig animated animated" data-number="12" style="visibility: visible; background-color:{{$count->background_color}};">
                        <img src="{{url('public/count_icon/'.$count->icon)}}" style="width:50px; height:50px;"> 

                        <p class="number number{{$counter}}" style="color:{{$count->amount_color}}; font-size:{{$count->amount_font_size}}; 
                            font-family:{{$count->amount_font_family}};">
                            {{$count->amount}}
                        </p>
                        

                        <span></span>
                        <p style="color:{{$count->name_color}}; font-size:{{$count->name_font_size}}; 
                            font-family:{{$count->name_font_family}};">{{$count->name}}</p>
                    </div> 

                   
                    {{-- <div class="item wow fadeInUpBig animated animated" data-number="12" style="visibility: visible;">
                        <i class="fa fa-users" aria-hidden="true"></i>
                        
                        <p class="number number{{$counter}}">750000</p>
                        <span></span>
                        <p>Customer Base</p>
                    </div> --}}

                @endforeach

             

                {{-- <div class="item wow fadeInUpBig animated animated" data-number="12" style="visibility: visible;">
                    <i class="fa fa-users" aria-hidden="true"></i>
                    <p id="number1" class="number">750000</p>
                    <span></span>
                    <p>Customer Base</p>
                </div>
                <div class="item wow fadeInUpBig animated animated" data-number="55" style="visibility: visible;">
                    <i class="fa fa-car" aria-hidden="true"></i>
                    <p id="number2" class="number">500000</p>
                    <span></span>
                    <p>Cars Sold</p>
                </div>
                <div class="item wow fadeInUpBig animated animated" data-number="359" style="visibility: visible;">
                    <i class="fa fa-wrench" aria-hidden="true"></i>
                    <p id="number3" class="number">7200000</p>
                    <span></span>
                    <p>Cars Serviced</p>
                </div>
                <div class="item wow fadeInUpBig animated animated" data-number="246" style="visibility: visible;">
                    <i class="fa fa-smile-o" aria-hidden="true"></i>
                    <p id="number4" class="number">600000</p>
                    <span></span>
                    <p>Satisfied Customers</p>
                </div> --}}
            </div>
        </div>
    </div>
  
    <section id="about-us">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="about-left-image">
                        @foreach ($home_details as $home_detail)
                            <img src="{{url('public/home_detail/'.$home_detail->image)}}" alt="" width="100%"> 
                        @endforeach
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="about-right-content">
                        @foreach ($home_details as $home_detail)
                            <h3 style="color:{{$home_detail->title_color}}; font-size:{{$home_detail->title_font_size}}; 
                                font-family:{{$home_detail->title_font_family}};">{{$home_detail->title}}</h3>    
                            
                            <h2 style="color:{{$home_detail->sub_title_color}}; font-size:{{$home_detail->sub_title_font_size}}; 
                                font-family:{{$home_detail->sub_title_font_family}};">{{$home_detail->sub_title}}</h2>
                        
                            <div style="color:{{$home_detail->description_color}}; font-size:{{$home_detail->description_font_size}}; font-family:{{$home_detail->description_font_family}};">
                                {!! $home_detail->description !!}
                            </div>

                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
 
    <!-- testimonial -->
    <section class="testimonials">
        <div class="container">
            <div class="testimonial-heading">
                @foreach ($testimonials as $testimonial)
                    <h2 style="color:{{$testimonial->testimonials_title_color}}; font-size:{{$testimonial->testimonials_title_font_size}}; 
                        font-family:{{$testimonial->testimonials_title_font_family}};">{{$testimonial->testimonials_title}}</h2>
                @endforeach
            </div>
            
            <div class="row">
                <div class="col-sm-12">
                    <div id="customers-testimonials" class="owl-carousel">
                        @foreach ($testimonials as $testimonial)
                        <div class="item">
                            <div class="shadow-effect">
                            <img src="{{url('public/testimonials/'.$testimonial->image)}}" alt=""> 

                                <div style="color:{{$testimonial->description_color}}; font-size:{{$testimonial->description_font_size}}; 
                                    font-family:{{$testimonial->description_font_family}};">
                                    {!! $testimonial->description !!}
                                </div>
                            </div>
                            <div class="testimonial-name" style="color:{{$testimonial->name_color}}; font-size:{{$testimonial->name_font_size}}; 
                                font-family:{{$testimonial->name_font_family}}; background-color:{{$testimonial->name_background_color}}">
                                {{$testimonial->name}}
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END OF TESTIMONIALS -->
    
@endsection

@section('javascript')
 {{-- <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.1/owl.carousel.min.js"></script> --}}




<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.js"></script>


<script>
        
    $('#owl-carousel').owlCarousel({
        loop: true,
        margin: 30,
        dots: true,
        nav: true,
        items: 1,
        navText: [
        '<i class="fa fa-angle-left" aria-hidden="true"></i>',
        '<i class="fa fa-angle-right" aria-hidden="true"></i>'
    ]
    // navContainer: '.main-content .custom-nav',
    });

    
    $('#our_businesses_carousel').owlCarousel({
        loop: false,
        dots: false,
        nav: false,
        items: 7,
        responsiveClass: true,
        responsive: {
            0:{
            items: 2
            },
            480:{
            items: 3
            },
            769:{
            items: 7
            }
        }
    });


	$.fn.jQuerySimpleCounter = function( options ) {
	    var settings = $.extend({
	        start:  0,
	        end:    100,
	        easing: 'swing',
	        duration: 400,
	        complete: ''
	    }, options );

	    var thisElement = $(this);

	    $({count: settings.start}).animate({count: settings.end}, {
			duration: settings.duration,
			easing: settings.easing,
			step: function() {
				var mathCount = Math.ceil(this.count);
				thisElement.text(mathCount);
			},
			complete: settings.complete
		});
	};

    // $('#number1').jQuerySimpleCounter({end: 750000,duration: 3000});
    // $('#number2').jQuerySimpleCounter({end: 500000,duration: 3000});
    // $('#number3').jQuerySimpleCounter({end: 7200000,duration: 3000});
    // $('#number4').jQuerySimpleCounter({end: 600000,duration: 3000});

    // $('.number1').jQuerySimpleCounter({end: 750000,duration: 3000});
    // $('.number2').jQuerySimpleCounter({end: 500000,duration: 3000});
    // $('.number3').jQuerySimpleCounter({end: 7200000,duration: 3000});
    // $('.number4').jQuerySimpleCounter({end: 600000,duration: 3000});






  	/* AUTHOR LINK */
    $('.about-me-img').hover(function(){
        $('.authorWindowWrapper').stop().fadeIn('fast').find('p').addClass('trans');
    }, function(){
        $('.authorWindowWrapper').stop().fadeOut('fast').find('p').removeClass('trans');
    });
  
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