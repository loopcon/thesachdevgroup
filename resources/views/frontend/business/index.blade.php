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
            <h1>{{isset($business->title) && $business->title ? $business->title : ''}}</h1>
            <p>{{ isset($business->description) && $business->description ? $business->description : '' }}</p>
        </div>

        <div class="top-car-image"> 
            <div class="top-car-parent">
                <div class="car-image">
                    <a href="https://www.galaxytoyota.in/car/toyota-glanza" target="_blank">
                    <img src="assets/image/locations-banner/Glanza.jpg" alt="" width="300px">
                    <p>Glanza</p>
                    </a>
                </div>

                <div class="car-image">
                    <a href="https://www.galaxytoyota.in/car/toyota-urban-cruiser-hyryder" target="_blank">
                    <img src="assets/image/locations-banner/UC.jpg" alt="" width="300px">
                    <p>Urban Cruiser Hyryder</p>
                    </a>
                </div>

                <div class="car-image">
                    <a href="https://www.galaxytoyota.in/car/toyota-innova-crysta" target="_blank">
                    <img src="assets/image/locations-banner/Innova.jpg" alt="" width="300px">
                    <p>Innova Crysta</p>
                    </a>
                </div>

                <div class="car-image">
                    <a href="https://www.galaxytoyota.in/car/toyota-rumion" target="_blank">
                    <img src="assets/image/locations-banner/Untitled-design.jpg" alt="" width="300px">
                    <p> Rumion</p>
                    </a>
                </div>

                <div class="car-image">
                    <a href="https://www.galaxytoyota.in/car/toyota-innova-hycross" target="_blank">
                    <img src="assets/image/locations-banner/Innova-Hycross.jpg" alt="" width="300px">
                    <p>Innova Hycross</p>
                    </a>
                </div>

                <div class="car-image">
                    <a href="https://www.galaxytoyota.in/car/toyota-hilux" target="_blank">
                    <img src="assets/image/locations-banner/Hilux (2).jpg" alt="" width="300px">
                    <p>Hilux</p>
                    </a>
                </div>

                <div class="car-image">
                    <a href="https://www.galaxytoyota.in/car/toyota-fortuner" target="_blank">
                    <img src="assets/image/locations-banner/Fortuner (3).jpg" alt="" width="300px">
                    <p>Fortuner</p>
                    </a>
                </div>

                <div class="car-image">
                    <a href="https://www.galaxytoyota.in/car/toyota-legender" target="_blank">
                    <img src="assets/image/locations-banner/Legender.jpg" alt="" width="300px">
                    <p>Legender</p>
                    </a>
                </div>

                <div class="car-image">
                    <a href="https://www.galaxytoyota.in/car/toyota-camry" target="_blank">
                    <img src="assets/image/locations-banner/Camry (1).jpg" alt="" width="300px">
                    <p>Camry</p>
                    </a>
                </div>

                <div class="car-image">
                    <a href="https://www.galaxytoyota.in/car/toyota-vellfire" target="_blank">
                    <img src="assets/image/locations-banner/Vellfire (1).jpg" alt="" width="300px">
                    <p>Vellfire</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- toyota showroom locaions slider  -->
<section id="location-section">
<div class="container">
<div class="location-tittle">
    <h2>Galaxy Toyota Showrooms</h2>
</div>
<div class="slide-container swiper">
            <div class="slide-content">
                <div class="card-wrapper swiper-wrapper">
                   
                    <div class="card swiper-slide">
                    <a href="/galaxy-toyota-showroom-motinagar.php">
                        <div class="image-content">
                            <!-- <span class="overlay"></span> -->
                            <div class="card-image">
                               <img src="assets/image/locations-banner/1.jpg" alt="" class="card-img">
                            </div>
                        </div>

                        <div class="card-content">
                            <h2 class="name">Galaxy Toyota Showroom Moti Nagar
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
                    <a href="/galaxy-toyota-showroom-shalimar.php">
                        <div class="image-content">
                            <!-- <span class="overlay"></span> -->
                            <div class="card-image">
                               <img src="assets/image/locations-banner/4.jpg" alt="" class="card-img">
                            </div>
                        </div>

                        <div class="card-content">
                            <h2 class="name">Galaxy Toyota Showroom Shalimar
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
                           <p>4.8</p>
                           <p>(960 reviews)</p>
                           
                           </div>
                          
                            
                        </div>
                        </a>
                    </div>
                    <div class="card swiper-slide">
                    <a href="/galaxy-toyota-showroom-lajpatnagar.php">
                        <div class="image-content">
                            <!-- <span class="overlay"></span> -->
                            <div class="card-image">
                               <img src="assets/image/locations-banner/5.jpg" alt="" class="card-img">
                            </div>
                        </div>

                        <div class="card-content">
                            <h2 class="name">Galaxy Toyota Showroom Lajpat Nagar
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
                    <div class="card swiper-slide">
                    <a href="/galaxy-toyota-showroom-dwarka.php">
                        <div class="image-content">
                            <!-- <span class="overlay"></span> -->
                            <div class="card-image">
                               <img src="assets/image/locations-banner/2.jpg" alt="" class="card-img">
                            </div>
                        </div>

                        <div class="card-content">
                            <h2 class="name">Galaxy Toyota Showroom Dwarka
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
                           <p>(1,458 reviews)</p>
                           
                           </div>
                          
                            
                        </div>
                        </a>
                    </div>
                    <div class="card swiper-slide">
                    <a href="/galaxy-toyota-showroom-chattarpur.php">
                        <div class="image-content">
                            <!-- <span class="overlay"></span> -->
                            <div class="card-image">
                               <img src="assets/image/locations-banner/Untitled design (3).jpg" alt="" class="card-img">
                            </div>
                        </div>

                        <div class="card-content">
                            <h2 class="name">Galaxy Toyota Showroom Chattarpur
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
                           <p>4.9</p>
                           <p>(1,042 reviews)</p>
                        
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
</section>
<!-- toyota showroom location end  -->
<!-- toyota showroom locaions slider  -->
<section id="service-location">
<div class="container">
<div class="location-tittle">
    <h2>Galaxy Toyota Service Centers</h2>
</div>
<div class="slide-container swiper">
            <div class="slide-content">
                <div class="card-wrapper swiper-wrapper">
                   
                    <div class="card swiper-slide">
                    <a href="/galaxy-toyota-service-okhla.php">
                        <div class="image-content">
                            <!-- <span class="overlay"></span> -->
                            <div class="card-image">
                               <img src="assets/image/locations-banner/okhla-service.jpg" alt="" class="card-img">
                            </div>
                        </div>

                        <div class="card-content">
                            <h2 class="name">Galaxy Toyota Service Center Okhla
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
                    <a href="/galaxy-toyota-service-kundli.php">
                        <div class="image-content">
                            <!-- <span class="overlay"></span> -->
                            <div class="card-image">
                               <img src="assets/image/locations-banner/kundli-service.jpg" alt="" class="card-img">
                            </div>
                        </div>

                        <div class="card-content">
                            <h2 class="name">Galaxy Toyota Service Center Kundli
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
                           <p>4.8</p>
                           <p>(960 reviews)</p>
                          
                           </div>
                          
                            
                        </div>
                        </a>
                    </div>
                    <div class="card swiper-slide">
                    <a href="/galaxy-toyota-service-azadpur.php">
                        <div class="image-content">
                            <!-- <span class="overlay"></span> -->
                            <div class="card-image">
                               <img src="assets/image/locations-banner/azadpur-service.jpg" alt="" class="card-img">
                            </div>
                        </div>

                        <div class="card-content">
                            <h2 class="name">Galaxy Toyota Service Center Azadpur
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
                    <div class="card swiper-slide">
                    <a href="/galaxy-toyota-service-motinagar.php">
                        <div class="image-content">
                            <!-- <span class="overlay"></span> -->
                            <div class="card-image">
                               <img src="assets/image/locations-banner/service-motinagar.jpg" alt="" class="card-img">
                            </div>
                        </div>

                        <div class="card-content">
                            <h2 class="name">Galaxy Toyota Service Center Moti Nagar
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
                           <p>(1,458 reviews)</p>
                          
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
</section>
<!-- toyota showroom location end  -->
<!-- toyota showroom locaions slider  -->
<section id="bodyshop-location">
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
</section>
<!-- toyota showroom location end  -->
<!-- toyota showroom locaions slider  -->
<section id="used-car-locations">
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
</section>
<!-- toyota showroom location end  -->

<!-- insurence  -->


<section id="insurence-page">

<div class="container">
<div class="heading-title-insurence">
    <h2>Galaxy Toyota Insurance</h2>
</div>

<div class="insurence-parent">
    <div class="insurence-card">
        <a href="https://www.galaxytoyota.in/applyforinsurance" target="_blank">
            <div class="insurence-card-one">
        <img src="assets/image/locations-banner/protection.png" alt="" width="30%">
        <div class="insurence-content">
        <p>New Car Insurance</p>
        </div>
        </div>
        </a>
    </div>

    <div class="insurence-card">
        <a href="https://www.galaxytoyota.in/applyforinsurance" target="_blank">
        <div class="insurence-card-one">
        <img src="assets/image/locations-banner/renewable.png" alt="" width="30%">
        <div class="insurence-content">
        <p>Renew Insurance</p>
        </div>
</div>
        </a>
    </div>

    <div class="insurence-card">
        <a href="https://www.galaxytoyota.in/applyforinsurance" target="_blank">
        <div class="insurence-card-one">
        <img src="assets/image/locations-banner/writing.png" alt="" width="30%">
        <div class="insurence-content">
        <p>Claim Insurance</p>
        </div>
        </div>
        </a>
    </div>
</div>

</div>

</section>



<!-- why choose us  -->



<section id="insurence-page">

<div class="container">

<div class="row align-items-center">
    <div class="col-md-6">
    <div class="left-image-insurence">
        <img src="assets/image/locations-banner/Img 1.png" alt="">
    </div>
    </div>

    <div class="col-md-6">
    <div class="heading-title-advantage">
    <h2>Why Choose Galaxy Toyota?</h2>
    <ul>
        <li><img src="assets/image/locations-banner/check (1).png" alt="" width="18px"> Wide Selection Of Toyota Cars</li>
        <li><img src="assets/image/locations-banner/check (1).png" alt="" width="18px"> Expert Service And Maintenance</li>
        <li><img src="assets/image/locations-banner/check (1).png" alt="" width="18px"> Genuine Toyota Parts</li>
        <li><img src="assets/image/locations-banner/check (1).png" alt="" width="18px"> Customer-Centric Approach</li>
        <li><img src="assets/image/locations-banner/check (1).png" alt="" width="18px"> World-Class Facilities</li>
        <li><img src="assets/image/locations-banner/check (1).png" alt="" width="18px"> Experienced & Knowledgeable Staff</li>
    </ul>
</div>
        </div>
</div>

</div>

</section>
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
</script>
@endsection


