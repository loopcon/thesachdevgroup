@extends('frontend.layout.header')
@section('css')
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.1/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="http://themes.audemedia.com/html/goodgrowth/css/owl.theme.default.min.css"> --}}
    

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css">

    @endsection
@section('content')

    {{-- <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="5"></li>
        </ol>

        <div class="carousel-inner">

            <div class="carousel-item active">  
                @foreach ($home_sliders as $home_slider)
                    @if(isset($home_slider->image) && isset($home_slider->image))
                        <img class="d-block w-100" src="{{url('public/home_slider/'.$home_slider->image)}}"> 
                    @endif
                @endforeach
            </div> 

        </div>

        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>

        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div> --}}

    <div class="contain">
        <div id="owl-carousel" class="owl-carousel owl-theme">
            @foreach($home_sliders as $key => $slider)
            <div class="{{$key == 0 ? 'active' : '' }}">
                <img src="{{url('public/home_slider/'.$slider->image)}}" class="d-block w-100"  alt="..."> 
            </div>
            @endforeach
        </div>
      </div>

    {{-- <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
        </ol>
        <div class="carousel-inner">
            @foreach($home_sliders as $key => $slider)
            <div class="carousel-item {{$key == 0 ? 'active' : '' }}">
                <img src="{{url('public/home_slider/'.$slider->image)}}" class="d-block w-100"  alt="..."> 
            </div>
            @endforeach
        </div>
        <a class="carousel-control-prev" href="#myCarousel" role="button"  data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true">     </span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div> --}}
   

    <!-- our brands -->
    <section id="brands-section">
        <div class="col-md-12">
           <div class="brand-title">
              <h2>Our Businesses</h2>
              <p></p>
           </div>
        </div>
        <div class="brands-logo-parent">
            <div class="brands-logo">
                <div class="brand-one">
                    <a href="https://www.galaxytoyota.in/" target="_blank"><img src="assets/image/Toyota1.1 (1).png" alt="" width="100%"></a>
                </div>

                <div class="brand-one">
                    <a href="https://hanshyundai.com/" target="_blank"><img src="assets/image/Hyundai (1).png" alt="" width="100%"></a>
                </div>

                <div class="brand-one">
                    <a href="https://harpreetford.com/" target="_blank"><img src="assets/image/Ford.svg" alt="" width="100%"></a>
                </div>

                <div class="brand-one">
                    <a href="https://tsgusedcars.com/" target="_blank"><img src="assets/image/TSG Used Car.png" alt="" width="100%"></a>
                </div>

                <div class="brand-one">
                    <a href="https://autocarrepair.in/" target="_blank"><img src="assets/image/ACR (5).png" alt="" width="100%"></a>
                </div>

                <div class="brand-one">
                    <a href="https://amsdryice.com/" target="_blank"><img src="assets/image/AMS.svg" alt="" width="100%"></a>
                </div>

                <div class="brand-one">
                    <a href="https://tsgauctionmart.com/" target="_blank"><img src="assets/image/TSG Auction Mart (1).png" alt="" width="100%"></a>
                </div>
            </div>
        </div>
    </section>
  
    <!-- our story section  -->
    <section id="our-story">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="our-story-image">
                        <img src="assets/image/Toyota Building.svg" alt="" width="100%">
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="nav nav-pills tabs-width" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">
                                    <img src="assets/image/google-docs.png" alt="" width="45px"> 
                                    <p>Our Story</p>
                                </a>
                                <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">
                                    <img src="assets/image/mission.png" alt="" width="45px"> 
                                    <p>Our Mission</p>
                                </a>
                                <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">
                                    <img src="assets/image/2421371.png" alt="" width="45px"> 
                                    <p>Our Vision</p>
                                </a>  
                            </div>
                        </div>
            
                        <div class="col-md-9">
                            <div class="tab-content home-page-tab" id="v-pills-tabContent">
                                <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                    <h2>We Have Decades of Experience in the Automobile Industry</h2>
                                    <p>The Sachdev Group has been providing exceptional services to customers from decades. We pride ourselves in providing transparent, professional, and world-class services to our customers. Our loyal customers are a proof of our commitment to provide complete customer satisfaction by meeting their demands and preferences.</p>
                                </div>
                                <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                                    <h2>Our Mission for Uncompromising Quality</h2>
                                    <p>The Sachdev Group is committed to fulfilling the automotive needs of customers, meeting their preferences and expectations. We provide world-class infrastructure, transparent pricing, and excellent customer services aiming for complete customer satisfaction.</p>
                                </div>
                                <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                                    <h2>Our Vision of Progress and Possibility</h2>
                                    <p>The Sachdev Group aims to build long-lasting customer relationships by understanding and meeting their preferences. We also aim to build an employee-first environment promoting transparency, openness, and team building.</p>
                                </div>
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
                <div class="item wow fadeInUpBig animated animated" data-number="12" style="visibility: visible;">
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
                </div>
            </div>
        </div>
    </div>
  
    <section id="about-us">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="about-left-image">
                        <img src="assets/image/Happy Customer.svg" alt="" width="100%">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="about-right-content">
                        <h3>We are the Largest Car Dealers in India</h3>
                        <h2>Keeping Our Customers Happy</h2>
                        <p>The Sachdev Group is the largest dealer of Toyota and Hyundai cars. We are also authorized to provide car services for Toyota, Hyundai, and Ford. We offer complete automotive solutions by providing assistance in car insurance and financing. </p>
                        <p>Our world-class car showrooms display the latest car models offering the best prices and offers to customers. Our expert staff members provide complete assistance to customers ensuring a great customer experience.</p>
                        <p>Our state-of-the-art service centers are equipped with the latest technology and equipment to deliver exceptional quality car services. Certified technicians have the required skills and expertise to provide diagnostics, repairs, and services.
                            We are committed to providing complete customer satisfaction and fostering a transparent relationship with them.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
 
    <!-- testimonial -->
    <section class="testimonials">
        <div class="container">
            <div class="testimonial-heading">
                <h2>Our Customer Testimonials</h2>
            </div>
 
            <div class="row">
                <div class="col-sm-12">
                    <div id="customers-testimonials" class="owl-carousel">
                        <!--TESTIMONIAL 1 -->
                        <div class="item">
                            <div class="shadow-effect">
                                <img class="img-circle" src="assets/image/unnamed (7).png" alt="">
                                <p maxlength="20">Connected with Pradeep Meena. Slightly more expensive as compared to dealer price but good knowledge and proactive support.</p>
                            </div>
                            <div class="testimonial-name">Karunjit Singh</div>
                        </div>
                        <!--END OF TESTIMONIAL 1 -->
                        <!--TESTIMONIAL 2 -->
                        <div class="item">
                            <div class="shadow-effect">
                                <img class="img-circle" src="assets/image/unnamed (3).png" alt="">
                                <p>This is a big organization where customers and employees are treated well. One of the largest Auto Dealerships of India. Huge infrastructure, Best facilities and best customer services.</p>
                            </div>
                            <div class="testimonial-name">Santosh singh Dagur</div>
                        </div>
                        <!--END OF TESTIMONIAL 2 -->
                        <!--TESTIMONIAL 3 -->
                        <div class="item">
                            <div class="shadow-effect">
                                <img class="img-circle" src="assets/image/unnamed (4).png" alt="">
                                <p>My experience was not good with TSG group.now my issue has been resolved specially i would like to thanks to HR person Miss Richa.</p>
                            </div>
                            <div class="testimonial-name">Hemant sharma</div>
                        </div>
                        <!--END OF TESTIMONIAL 3 -->
                        <!--TESTIMONIAL 4 -->
                        <div class="item">
                            <div class="shadow-effect">
                                <img class="img-circle" src="assets/image/unnamed (5).png" alt="">
                                <p>One of the biggest organisations of Delhi NCR. With over 30 Location across Delhi NCR, it has over millions of customer base and thousands of employees.</p>
                            </div>
                            <div class="testimonial-name">Satish Kumar</div>
                        </div>
                        <!--END OF TESTIMONIAL 4 -->
                        <!--TESTIMONIAL 5 -->
                        <div class="item">
                            <div class="shadow-effect">
                                <img class="img-circle" src="assets/image/unnamed (6).png" alt="">
                                <p>Dramatically maintain clicks-and-mortar solutions without functional solutions. Completely synergize resource taxing relationships via premier niche markets. Professionally cultivate.</p>
                            </div>
                            <div class="testimonial-name">MICHAEL TEDDY</div>
                        </div>
                        <!--END OF TESTIMONIAL 5 -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END OF TESTIMONIALS -->
    
@endsection

@section('javascript')
{{-- <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script> --}}
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.1/owl.carousel.min.js"></script> --}}




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

    $('#number1').jQuerySimpleCounter({end: 750000,duration: 3000});
    $('#number2').jQuerySimpleCounter({end: 500000,duration: 3000});
    $('#number3').jQuerySimpleCounter({end: 7200000,duration: 3000});
    $('#number4').jQuerySimpleCounter({end: 600000,duration: 3000});



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