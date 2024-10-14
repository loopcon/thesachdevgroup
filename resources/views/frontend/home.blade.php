@extends('frontend.layout.header')
@section('css')
   {{-- <link rel="stylesheet" href="https://unpkg.com/swiper@6.8.4/swiper-bundle.min.css"> --}}
   
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

  <!-- our businesses -->
  <section id="brands-section" style="background-color:{{$home_our_businesses_title->background_color ?? null}};">
    <div class="col-md-12">
      <div class="brand-title">
        <h2 style="color: {{$home_our_businesses_title->businesses_title_color ?? null}}; font-size:{{$home_our_businesses_title->businesses_title_font_size ?? null}}; font-family:{{$home_our_businesses_title->businesses_title_font_family ?? null}};">{{$home_our_businesses_title->businesses_title ?? null}}</h2>
        <p></p>
      </div>
    </div>
    @if($home_our_businessess->count() > 4)
      <div class="brands-logo-parent owl-carousel owl-theme" id="our_businesses_carousel">
        @foreach($home_our_businessess as $home_our_businesses)
          <div class="brand-one">
              <a href="{{$home_our_businesses->link}}" target="_blank">
                <img src="{{url('public/home_our_businesses/'.$home_our_businesses->image)}}" alt="" width="100%"> 
              </a>
          </div> 
        @endforeach
      </div>
    @else
    <div class="brands-logo-parent">
      <div class="brands-logo">
          @foreach($home_our_businessess as $home_our_businesses)
               <div class="brand-one">
                   <a href="{{$home_our_businesses->link}}" target="_blank">
                     <img src="{{url('public/home_our_businesses/'.$home_our_businesses->image)}}" alt="" width="100%"> 
                   </a>
               </div> 
           @endforeach
      </div>
     </div>
    @endif
  </section>

  <section id="our_story_section">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="our-story-image">
                    @if(isset($mission_visions_imgae->image) && isset($mission_visions_imgae->image))
                      <img src="{{url('public/mission_vision_image/'.$mission_visions_imgae->image)}}" width="100%">
                    @endif
                </div>
            </div>
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-3 user-mission-scroll">
                        <div class="nav nav-pills tabs-width" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            @foreach ($mission_visions as $key => $mission_vision)
                            @php($active = '')
                            @if($key == 0)
                                @php($active = 'active')
                            @endif
                                <a class="nav-link {{$active}}" id="{{$mission_vision->slug}}-tab" data-toggle="pill" href="#{{$mission_vision->slug}}" role="tab" aria-controls="{{$mission_vision->slug}}">
                                    <img src="{{url('public/mission_vision/'.$mission_vision->icon)}}" alt="" width="45px"> 
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
                                    <p>{!! $mission_vision->description !!}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </section>

  <!-- count -->
    @if($counts->count() > 4)
      <div id="count_owl" class="owl-carousel owl-theme projectFactsWrap">
        @php($counter = 0)
        @foreach ($counts as $count)
          @php($counter ++)
          <div class="item" style="background-color:{{$count->background_color}};">
              <img src="{{url('public/count_icon/'.$count->icon)}}" style="width:50px; height:50px;"> 
              <p class="number number{{$counter}}" style="color:{{$count->amount_color}}; font-size:{{$count->amount_font_size}}; font-family:{{$count->amount_font_family}};">
                {{$count->amount}}
              </p>
              <span></span>
              <p style="color:{{$count->name_color}}; font-size:{{$count->name_font_size}}; font-family:{{$count->name_font_family}};">{{$count->name}}</p>
          </div>
        @endforeach
      </div>
    @else
    <div class="projectFactsWrap">
      @php($counter_data = 0)
      @foreach ($counts as $count)
        @php($counter_data ++)
        <div class="item" style="background-color:{{$count->background_color}};">
          <img src="{{url('public/count_icon/'.$count->icon)}}" style="width:50px; height:50px;"> 
          <p class="number number{{$counter_data}}" style="color:{{$count->amount_color}}; font-size:{{$count->amount_font_size}}; font-family:{{$count->amount_font_family}};">
            {{$count->amount}}
          </p>
          <span></span>
          <p style="color:{{$count->name_color}}; font-size:{{$count->name_font_size}}; font-family:{{$count->name_font_family}};">{{$count->name}}</p>
        </div>
      @endforeach
    </div> 
    @endif

  <!-- home deatail -->
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
              <h3 style="color:{{$home_detail->title_color}}; font-size:{{$home_detail->title_font_size}}; font-family:{{$home_detail->title_font_family}};">{{$home_detail->title}}</h3>    
              <h2 style="color:{{$home_detail->sub_title_color}}; font-size:{{$home_detail->sub_title_font_size}}; font-family:{{$home_detail->sub_title_font_family}};">{{$home_detail->sub_title}}</h2>
              <div>{!! $home_detail->description !!}</div>
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
        <h2 style="color:{{$testimonials_title->testimonials_title_color ?? null}}; font-size:{{$testimonials_title->testimonials_title_font_size ?? null}}; font-family:{{$testimonials_title->testimonials_title_font_family ?? null}};">{{$testimonials_title->testimonials_title ?? null}}</h2>
      </div>
      <div class="row">
        <div class="col-sm-12">
          <div id="customers-testimonials" class="owl-carousel">
            @foreach ($testimonials as $testimonial)
              <div class="item">
                  <div class="shadow-effect">
                    <img src="{{url('public/testimonials/'.$testimonial->image)}}" alt=""> 
                    <div class="expanded" data-full-description="{!! $testimonial->description !!}">
                      {!! substr(strip_tags($testimonial->description), 0, 110) !!}{{ strlen(strip_tags($testimonial->description)) > 110 ? '...' : '' }}
                    </div>
                  </div>
                  <div class="testimonial-name" style="color:{{$testimonial->name_color}}; font-size:{{$testimonial->name_font_size}}; font-family:{{$testimonial->name_font_family}}; background-color:{{$testimonial->name_background_color}}">
                    {{$testimonial->name}}
                  </div>
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
@section('javascript')
 {{-- <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.1/owl.carousel.min.js"></script> --}}
{{-- <script src="https://unpkg.com/swiper@6.8.4/swiper-bundle.min.js"></script> --}}
{{-- <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> --}}
<script>
 $(document).ready(function() {
  $('#owl-carousel').owlCarousel({
    loop: true,
    margin: 30,
    dots: true,
    nav: true,
    items: 1,
    navText: [
      '<i class="fa fa-angle-left" aria-hidden="true"></i>',
      '<i class="fa fa-angle-right" aria-hidden="true"></i>'
    ],
    autoplay:true,
    autoplayTimeout:2000,
  });

  $('#our_businesses_carousel').owlCarousel({
    loop: true,
    dots: false,
    nav: false,
    // items: 7,
    autoplay:true,
    autoplayTimeout:2000,
    responsiveClass: true,
    responsive: {
      0:{
        items: 3 // Display 3 items on mobile screens
      },
      576:{
        items: 3
      },
      769:{
        items: 7
      }
    }
  });

  $('#count_owl').owlCarousel({
    loop: true,
    dots: false,
    nav: false,
    items: 4,
    autoplay:true,
    autoplayTimeout:2000,
    responsiveClass: true,
    responsive: {
      0:{
        items: 2
      },
      480:{
        items: 3
      },
      769:{
        items: 4
      }
    }
  });

    $.fn.jQuerySimpleCounter = function(options) {
      var settings = $.extend({
        start: 0,
        end: 100,
        easing: 'swing',
        duration: 400,
        complete: ''
      }, options);

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

    @php($counter = 0)
    @foreach ($counts as $count)
      @php($counter ++)
      $('.number{{$counter}}').jQuerySimpleCounter({end: {{$count->amount}}, duration: 3000});
    @endforeach
  });

  // for toggle description
  $(document).ready(function() {
    $('.expanded').on('click', function() {
      var fullDescription = $(this).data('full-description');
      $(this).html(fullDescription);
    });
  });
 
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
      autoplayTimeout:1800,
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
            items: 3
        },
        1170: {
            items: 3
        }
      }
    });
  });
</script>
@endsection
