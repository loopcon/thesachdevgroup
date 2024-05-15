@extends('frontend.layout.header')
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"> -->
@section('css')
<style>
    .nav-tabs-divider .nav-item:not(:last-child) {
        border-right: 1px solid #ccc; 
    }
    .justify-content-between {
        justify-content: center !important;
    }
    .nav-link { 
        display: block;  
        color: black;
        font-weight: 600;
        padding: 0.5rem 0.5rem;
    }
    .section-b{
        padding:10px;
    } 
    .tabbable-panel{
        border: none;
    }
    .btns {
        position: relative;
        display: inline-block;
        margin: 1px;
        padding:0;
        border: 0;
        border-radius: 30px;
        text-align: center;
        white-space: nowrap;
        cursor: pointer; 
        font-size: 13px; 
    }
    .btns:hover {
        box-shadow: inset 0 -3px 0 #ec3237;
    }
    .btns:active {
        transform: translateY(1px);
        box-shadow: inset 0 3px 0 0 rgba(0, 0, 0, 0.15);
    } 
    .btns:focus {
        outline: none;
    }
    .btns--basic {
        background-color: #e3eacc;
        color: #455a00;
    }
    a:hover {
        color: #ec3237;
    }
    .btns--ghost {
        background-color: transparent;
        border: 1px solid #00000073;
        color: #ec3237;
    }
    .btns--dark { 
        background-color: #455a00;
        color: white;
    }
    .btns--action {
        background-color: #739600;
        color: white;
    }
    .btns--danger {
        background-color: #ff0000;
        color: white;
    }
    .btns--link {
        background-color: transparent;
        color: #5786bd;
    }
    .btns--dropdown {
        padding-right: 3em;
    }
    .btns--dropdown:before {
        content: "";
        right: 24px;
        top: 22px;
        width: 2px;
        height: 6px;
        background-color: rgba(0, 0, 0, 0.1);
        position: absolute;
        transform: rotate(-45deg);
    }
    .btns--dropdown:after {
        content: "";
        right: 20px;
        top: 22px;
        width: 2px;
        height: 6px;
        background-color: rgba(0, 0, 0, 0.1);
        position: absolute;
        transform: rotate(45deg);
    }     
    .btns-group {
        display: flex;
        list-style: none;
        padding: 0;
        margin: 0;
        flex-wrap: wrap; 
        justify-content: center;
    }
    .btns-group__item {
        float: left;
    }
    .btns-group__item:first-child .btns {
        border-radius: 30px 0 0 30px;
    }
    .btns-group__item .btns {
        border-radius: 0;
        margin: 0;
        border-right: 1px solid rgba(0, 0, 0, 0.1);
    }
    .btns-group__item:last-child .btns {
        border-radius: 0 30px 30px 0;
        border-right: 0;
    }
    article.job-card {
        width: 700px;
        position: relative;
        border-top: 1px solid #e3e3e3;
        border-bottom: 1px solid #e3e3e3;
        padding: 24px;
    }
    article.job-card:hover,
    article.job-card:focus {
        background-color: rgba(0,166,194,.03);
        border-color: #b2e4ec;
    }
    .company-logo-img {
        grid-area: 1 / 1 / 2 / 2;
        background-color: #fff;
        
        height: 80px;
        width: 80px;
        box-sizing: border-box;
        position: relative;
        padding: 5px;
    }
    .company-logo-img img {
        max-height: calc(100% - 10px);
        max-width: calc(100% - 10px);
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
    .job-title {
        grid-area: 1 / 2 / 2 / 3;
        font-size: 16px;
        align-self: start;
        font-weight: 500;
        margin-top: 5px;
        padding: 0 24px;
    }
    .company-name {
        grid-area: 2 / 2 / 3 / 3;
        align-self: center;
        font-size: 14px;
        color: #777;
        margin-bottom: 5px;
        padding: 0 24px;
    }
    .skills-container {
        grid-area: 3 / 2 / 4 / 3;
        align-self: center;
        padding-top: 10px;
        padding: 0 24px;
    }
    .skill {
        display: inline;
        color: #00a6c2;
        border-radius: 2px;
        background-color: rgba(0,166,194,.05);
        border: 1px solid rgba(0,166,194,.15);
        padding: 5px 8px;
        font-size: 12px;
    }
    .apply {
        grid-area: 1 / 3 / 2 / 4;
        background-color: #ec3237;
        color: #fff;
    }
    .save {
        grid-area: 3 / 3 / 4 / 4;
        background-color: #fff;
        border: 1px solid #a4a5a8;
        color: #777;
    }
    .mobile-wrapper {
        margin-top: 20px;
        width: 100%;
    }
    .mobile-wrapper article {
        width: 100%;
        padding: 16px 0px;
    }
    .mobile-wrapper .company-logo-img {
        grid-area: 1 / 1 / 3 / 2;
        height: 100px;
        width: 100%;
    }
    .mobile-wrapper .job-title {
        grid-area: 1 / 2 / 2 / 2;
        padding: 8px 16px 0 16px;
    }
    .mobile-wrapper .company-name {
        grid-area: 2 / 2 / 3 / 2;
        padding: 0 16px;
    }
    .mobile-wrapper .skills-container {
        grid-area: 3 / 1 / 4 / 3;
        padding: 16px 0;
        font-size: 2vh;
    }
    .mobile-wrapper .btn-container {
        grid-area: 4 / 1 / 5 / 3;
        display: flex;
    }
    .mobile-wrapper .btn-container button {
        height: 38px;
        flex: 1;
        width: 0;
    }
    .mobile-wrapper .btn-container .apply {
        margin-right: 10px;
    }
</style>
@endsection
@section('content')
<section id="contact-us">
    <div class="contact-banner">
        @if(isset($our_location->image) && isset($our_location->image))
            <img src="{{url('public/our_location/'.$our_location->image)}}">
        @endif
    </div>
</section>
<section id="loaction-wise-map">
    <div class="tabs-location">
        <div class="row" style="margin-right:0px ; margin-left:0px">
            <div class="col-md-12">
			    <div class="tabbable-panel">
				    <div class="tabbable-line"> 
                        <div class="tab-content">
                            <div class="col-md-5">
                                <div class="tabbable-panel">
                                    <div class="tabbable-line">
                                    </div>
                                </div>
                            </div>		    
                            
                            <div class="tab-pane active" id="tab_default_1">
                                <div class="location-tab-parent">
                                    <section class="header">
                                        <div class="container py-4" style="max-width: -webkit-fill-available;">
                                            <div class="row">
                                                <div class="col-md-5" style="overflow-x: hidden; overflow-y: auto; margin-bottom: 30px;">
                                                    <div class="section-b">
                                                        <h1 style="text-align: -webkit-center; color:{{$our_location->title_color}}; font-size:{{$our_location->title_font_size}}; font-family:{{$our_location->title_font_family}};">{{$our_location->title}}</h1>    
                                                        <ul class="btns-group" role="tablist">
                                                            @foreach($our_business as $business)
                                                                <li>
                                                                    <button class="btns btns--ghost">
                                                                        <a class="nav-link" href="#tab-{{ $business->id }}" onclick="changeBusiness('{{ $business->id }}')" aria-controls="#tab-{{ $business->id }}" role="tab" data-toggle="tab">{{ $business->title }}</a>
                                                                    </button>
                                                                </li>
                                                            @endforeach 
                                                        </ul>
                                                    </div>
                                                    <div class="tabpanel">
                                                        <div class="nav nav-pills-custom custom-height" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                                            <div class="tab-content">
                                                                @foreach ($showrooms as $index => $showroom)
                                                                    <div role="tabpanel" class="tab-pane @if($showroom->our_business_id == $showroom_first->our_business_id) active @endif tab-{{ $showroom->our_business_id }}">
                                                                        <div class="mobile-wrapper">
                                                                            <article class="job-card">
                                                                                <div class="row">
                                                                                    <div class="col-sm-4">
                                                                                        <div class="company-logo-img">
                                                                                            @if(isset($showroom->image) && $showroom->image)
                                                                                                <img src="{{url('public/showrooms_image/'.$showroom->image)}}"> 
                                                                                            @endif
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-sm-8">
                                                                                        <div class="job-title" style="color:{{$showroom->name_color}}; font-size:{{$showroom->name_font_size}}; font-family:{{$showroom->name_font_family}};">
                                                                                            @if($showroom->name) {{$showroom->name}} (SALES) @endif
                                                                                        </div>
                                                                                        <div class="company-name" style="color:{{$showroom->address_color}}; font-size:{{$showroom->address_font_size}}; font-family:{{$showroom->address_font_family}};">
                                                                                            {{$showroom->address}}
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="job-title">
                                                                                    <p class="mobile-font-color">Mobile Number: <a href="tel:+91 {{$showroom->contact_number}}">@if(isset($showroom->contact_number)) +91 {{$showroom->contact_number}} @endif</a></p>
                                                                                    <p class="mobile-font-color">E-mail: <a href="mailto:{{$showroom->email}}">{{$showroom->email}}</a></p>
                                                                                </div>
                                                                                <a class="nav-link mb-0 p-0 left-location active location-anchore" data-toggle="pill" href="#shalimar-sales" onclick="changeShowroom('{{ $showroom->id }}')" role="tab" aria-controls="v-pills-home" aria-selected="true">
                                                                                    <div class="btn-container">
                                                                                        <button class="apply">Click Here</button>      
                                                                                    </div>
                                                                                </a>
                                                                            </article>
                                                                        </div>
                                                                    </div>
                                                                @endforeach

                                                                @foreach ($service_center as $service)
                                                                    <div role="tabpanel" class="tab-pane tab-{{ $service->business_id }} @if($service->business_id == $service_center_first->business_id) active @endif">
                                                                        <div class="mobile-wrapper">
                                                                            <article class="job-card">
                                                                                <div class="row">
                                                                                    <div class="col-sm-4">
                                                                                        <div class="company-logo-img">
                                                                                            @if(isset($service->image) && $service->image)
                                                                                                <img src="{{url('public/service_center/'.$service->image)}}"> 
                                                                                            @endif
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-sm-8">
                                                                                        <div class="job-title" style="color:{{$service->name_color}}; font-size:{{$service->name_font_size}}; font-family:{{$service->name_font_family}};">
                                                                                           @if($service->name) {{$service->name}} (SERVICE) @endif
                                                                                        </div>
                                                                                        <div class="company-name" style="color:{{$service->address_font_color}}; font-size:{{$service->address_font_size}}; font-family:{{$service->address_font_family}};">
                                                                                            {{$service->address}}
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="job-title">
                                                                                    <p class="mobile-font-color">Mobile Number: <a href="tel:+91 {{$service->contact_number}}">@if(isset($service->contact_number)) +91 {{$service->contact_number}} @endif</a></p>
                                                                                    <p class="mobile-font-color">E-mail: <a href="mailto:{{$service->email}}">{{$service->email}}</a></p>
                                                                                </div>
                                                                                <a class="nav-link mb-0 p-0 left-location active location-anchore" data-toggle="pill" href="#shalimar-sales" onclick="changeSeviceCenter('{{ $service->id }}')" role="tab" aria-controls="v-pills-home" aria-selected="true">
                                                                                    <div class="btn-container">
                                                                                        <button class="apply">Click Here</button>      
                                                                                    </div>
                                                                                </a>
                                                                            </article>
                                                                        </div>
                                                                    </div>
                                                                @endforeach 

                                                                @foreach ($body_shops as $body_shop)
                                                                    <div role="tabpanel" class="tab-pane tab-{{ $body_shop->business_id }} @if($body_shop->business_id == $body_shops_first->business_id) active @endif">
                                                                        <div class="mobile-wrapper">
                                                                            <article class="job-card">
                                                                                <div class="row">
                                                                                    <div class="col-sm-4">
                                                                                        <div class="company-logo-img">
                                                                                            @if(isset($body_shop->image) && $body_shop->image)
                                                                                                <img src="{{url('public/body_shop_image/'.$body_shop->image)}}"> 
                                                                                            @endif
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-sm-8">
                                                                                        <div class="job-title" style="color:{{$body_shop->name_color}}; font-size:{{$body_shop->name_font_size}}; font-family:{{$body_shop->name_font_family}};">
                                                                                           @if($body_shop->name) {{$body_shop->name}} (BODYSHOP) @endif
                                                                                        </div>
                                                                                        <div class="company-name" style="color:{{$body_shop->address_font_color}}; font-size:{{$body_shop->address_font_size}}; font-family:{{$body_shop->address_font_family}};">
                                                                                            {{$body_shop->address}}
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="job-title">
                                                                                    <p class="mobile-font-color">Mobile Number: <a href="tel:+91 {{$body_shop->contact_number}}">@if(isset($body_shop->contact_number)) +91 {{$body_shop->contact_number}} @endif</a></p>
                                                                                    <p class="mobile-font-color">E-mail: <a href="mailto:{{$body_shop->email}}">{{$body_shop->email}}</a></p>
                                                                                </div>
                                                                                <a class="nav-link mb-0 p-0 left-location active location-anchore" data-toggle="pill" href="#shalimar-sales" onclick="changeBodyShop('{{ $body_shop->id }}')" role="tab" aria-controls="v-pills-home" aria-selected="true">
                                                                                    <div class="btn-container">
                                                                                        <button class="apply">Click Here</button>      
                                                                                    </div>
                                                                                </a>
                                                                            </article>
                                                                        </div>
                                                                    </div>
                                                                @endforeach 
                                                            </div>
                                                        </div>
                                                    </div> 
                                                </div>

                                                <div class="col-md-7">
                                                    <!-- Tabs content -->
                                                    <div class="tab-content" id="v-pills-tabContent">
                                                        @foreach($showrooms as $key => $record)
                                                            <div class="tab-pane fade rounded bg-white showroom-map showroom-map-{{$record->id}} show @if($key == 0)active @endif" id="{{$record->id}}" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                                                <iframe src="{{$record->map_link}}" width="100%" height="625" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                                            </div>
                                                        @endforeach

                                                        @foreach($service_center as $record)
                                                            <div class="tab-pane fade rounded bg-white service-map service-map-{{$record->id}} show" id="{{$record->id}}" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                                                <iframe src="{{$record->map_link}}" width="100%" height="625" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                                            </div>
                                                        @endforeach

                                                        @foreach($body_shops as $record)
                                                            <div class="tab-pane fade rounded bg-white bodyshop-map bodyshop-map-{{$record->id}} show" id="{{$record->id}}" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                                                <iframe src="{{$record->map_link}}" width="100%" height="625" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                                            </div>
                                                        @endforeach
                                                        <!-- <div class="tab-pane fade  rounded bg-white" id="motinagar-sales" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                                                            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14004.021022705392!2d77.1467438!3d28.6595613!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390d03dc0387cd09%3A0xb622965543714d9a!2sGalaxy%20Toyota%20Showroom!5e0!3m2!1sen!2sin!4v1691990383295!5m2!1sen!2sin" width="100%" height="625" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                                        </div>
                                                        
                                                        <div class="tab-pane fade rounded bg-white" id="lajpatnagar-sales" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                                                            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14016.630727623673!2d77.2354085!3d28.5650274!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390ce38154ef1f99%3A0x357454fac62137ce!2sGalaxy%20Toyota%20Showroom!5e0!3m2!1sen!2sin!4v1691990436217!5m2!1sen!2sin" width="100%" height="625" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                                        </div>
                                                        
                                                        <div class="tab-pane fade  rounded bg-white" id="dwarka-sales" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                                                            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14016.19364006216!2d77.0629251!3d28.568309!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390d1b3ecaf33e29%3A0x50d0ac1d8d1cca54!2sGalaxy%20Toyota%20Showroom!5e0!3m2!1sen!2sin!4v1691990488297!5m2!1sen!2sin" width="100%" height="625" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                                        </div>

                                                        <div class="tab-pane fade  rounded bg-white" id="chhatarpur-sales" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                                                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3506.098376097879!2d77.17253727455216!3d28.506687789786014!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390d1fec0052ab71%3A0x78bf6724473fe463!2sGalaxy%20Toyota%20Showroom!5e0!3m2!1sen!2sin!4v1706529548105!5m2!1sen!2sin" width="100%" height="625" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                                        </div>
                                    
                                                        <div class="tab-pane fade  rounded bg-white" id="motinagar-bodyshop" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                                                            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14004.021022705392!2d77.1467438!3d28.6595613!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390d03dd7ed65ed7%3A0xa85eb68c0a6c5def!2sGalaxy%20Toyota%20Service%20Center!5e0!3m2!1sen!2sin!4v1691990637861!5m2!1sen!2sin" width="100%" height="625" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></ifram>
                                                        </div>
                                    
                                                        <div class="tab-pane fade  rounded bg-white" id="kundli-service" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                                                            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d13974.532985168695!2d77.1171281!3d28.8795249!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390dabf1adbec169%3A0xc7831fca4def5fa5!2sGalaxy%20Toyota%20Service%20Center%20%26%20Bodyshop!5e0!3m2!1sen!2sin!4v1691990845469!5m2!1sen!2sin" width="100%" height="625" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                                        </div>
                                    
                                                        <div class="tab-pane fade  rounded bg-white" id="azadpur-service" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                                                            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d13995.670004786321!2d77.1627636!3d28.7220114!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390d01a9a6051cf1%3A0x8a45caab366481aa!2sGalaxy%20Toyota%20Service%20Center!5e0!3m2!1sen!2sin!4v1691990910819!5m2!1sen!2sin" width="100%" height="625" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                                        </div>
                                    
                                                        <div class="tab-pane fade  rounded bg-white" id="motinagar-service" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                                                            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14004.021022705392!2d77.1467438!3d28.6595613!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390d03dd7ed65ed7%3A0xa85eb68c0a6c5def!2sGalaxy%20Toyota%20Service%20Center!5e0!3m2!1sen!2sin!4v1691990637861!5m2!1sen!2sin" width="100%" height="625" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                                        </div>
                                    
                                                        <div class="tab-pane fade  rounded bg-white" id="okhla-service-1" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                                                            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14022.942477709985!2d77.2818694!3d28.517601!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390ce10b1fd1268f%3A0x5395729ccd3a0e30!2sGalaxy%20Toyota%20Service%20Center!5e0!3m2!1sen!2sin!4v1691991060836!5m2!1sen!2sin" width="100%" height="625" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                                        </div> -->
                                    
                                                        <div class="tab-pane fade  rounded bg-white" id="okhla-service-2" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                                                            <h4 class="font-italic mb-4">Confirm booking</h4>
                                                            <p class="font-italic text-muted mb-2">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('javascript')
<script>
    $(document).ready(function() {
        // Event delegation for 'a' tags
        $(document).on('click', 'a', function() {
        });

        // Event delegation for 'button' tags
        $(document).on('click', 'button', function() {
        });

        $('.tab-pane:first-child').addClass('active');
        // $('.btns-group li.active').click();
    });

    function changeBusiness(business_id)
    {
        $('#v-pills-tabContent .service-map').removeClass('active');

        $('#v-pills-tab .tab-pane').removeClass('active');
        $('.tab-'+business_id).addClass('active');

        $('#v-pills-tabContent .showroom-map').removeClass('active');
        $('.showroom-map-'+business_id).addClass('active');

    }

    function changeShowroom(showroom_id)
    {
        $('#v-pills-tabContent .showroom-map').removeClass('active');
        $('.showroom-map-'+showroom_id).addClass('active');
    }

    function changeSeviceCenter(service_id)
    {
        $('#v-pills-tabContent .showroom-map').removeClass('active');
        $('#v-pills-tabContent .bodyshop-map').removeClass('active');
        $('.showroom-map:first-child').removeClass('active');

        $('#v-pills-tabContent .service-map').removeClass('active');
        $('.service-map-'+service_id).addClass('active');
    }

    function changeBodyShop(body_shop_id)
    {
        $('#v-pills-tabContent .showroom-map').removeClass('active');
        $('#v-pills-tabContent .service-map').removeClass('active');
        $('.showroom-map:first-child').removeClass('active');

        $('#v-pills-tabContent .bodyshop-map').removeClass('active');
        $('.bodyshop-map-'+body_shop_id).addClass('active');
    }
</script>
@endsection

