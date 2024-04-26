@extends('frontend.layout.header')
@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/freeps2/a7rarpress@main/swiper-bundle.min.css">
    <style>
        .card{
            width: 100%; 
            overflow: hidden;
            background-color: #FFFFFF;
            border-radius: 15px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.2);
            text-align: center;
            -webkit-transition: .1s ease-in-out;
            transition: .1s ease-in-out;
        }
        .card:first-of-type{
            margin-right: 25px;
        }
        .card:hover{
            margin-top: -10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }
        .banner{
            height: 100px;
            width: 100%;
            padding-top: 30px;
            background-color: #FAFAFA;
            background-size: cover;
            background-position: center;
        }
        .card .banner{
            background-image: url("https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEiKM6rRET9CTBdVhMPRZIYaT3fHRVVEoIAZ9D3lR9da2ZlTlRdoK1X7E9mOcp7cNWP912Cq-fkhmdpD6byoX5EoDNkOHaoZa0xKcOx-ccCWxNU8Mr9TabV6dnRPqdhMD4T0EwbcX0Alxp9Z-85RRY_T8fynoHjQI38wuQcnTfwJL88JiGYW2x6jkmDR/s1600/bg-new-1.jpg");
        }
        .avatar{
            height: 100px;
            width: 100px;
            margin: auto;
            background-size: cover;
            background-position: center;
            background-color: #F1F1F1;
            border-radius: 100%;
        }
        .card .avatar{
            background-image: url("https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEjxivAs4UknzmDfLBXGMxQkayiZDhR2ftB4jcIV7LEnIEStiUyMygioZnbLXCAND-I_xWQpVp0jv-dv9NVNbuKn4sNpXYtLIJk2-IOdWQNpC2Ldapnljifu0pnQqAWU848Ja4lT9ugQex-nwECEh3a96GXwiRXlnGEE6FFF_tKm66IGe3fzmLaVIoNL/s1600/img_avatar.png");
        }
        h3, a, i{
            -webkit-transition: .1s ease-in-out;
            transition: .1s ease-in-out;
        }
        a {
            padding: 5px 0px;
            color: #9E9E9E;
            text-decoration: none;
        }
        ul {
            margin-top: 10px;
            padding: 15px 0px;
        }
        ul a{
            display: inline;
        }
        ul a i:hover{
            transform: scale(1.5);
            color: #2ab1ce;
        }
        a,
        a:hover,
        a:focus,
        a:active {
            text-decoration: none;
            outline: none;
        }
        a,
        a:active,
        a:focus {
            color: #333;
            text-decoration: none; 
            transition-timing-function: ease-in-out;
            -ms-transition-timing-function: ease-in-out;
            -moz-transition-timing-function: ease-in-out;
            -webkit-transition-timing-function: ease-in-out;
            -o-transition-timing-function: ease-in-out;
            transition-duration: .2s;
            -ms-transition-duration: .2s;
            -moz-transition-duration: .2s;
            -webkit-transition-duration: .2s;
            -o-transition-duration: .2s;
        }
        ul {
            margin: 0;
            list-style: none;
        }
        img {
            max-width: 100%;
            height: auto;
        }
        .sec-title-style1 {
            position: relative;
            display: block;
            margin-top: -9px;
            padding-bottom: 50px;
        }
        .sec-title-style1.max-width{
            position: relative;
            display: block;
            max-width: 770px;
            margin: -9px auto 0;
            padding-bottom: 52px;    
        }
        .sec-title-style1.pabottom50 {
            padding-bottom: 42px;
        }
        .sec-title-style1 .title {
            position: relative;
            display: block;
            color: #131313;
            font-size: 36px;
            line-height: 46px;
            font-weight: 700;
            text-transform: uppercase;
        }
        .sec-title-style1 .title.clr-white{
            color: #ffffff;
        }
        .sec-title-style1 .decor {
            position: relative;
            display: block;
            width: 70px;
            height: 5px;
            margin: 19px 0 0;
        }
        .sec-title-style1 .decor:before{
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            width: 5px;
            height: 5px;
            background: #e52334;
            border-radius: 50%;
            content: "";
        }
        .sec-title-style1 .decor:after{
            position: absolute;
            top: 0;
            right: 10px;
            bottom: 0;
            width: 5px;
            height: 5px;
            background: #e52334;
            border-radius: 50%;
            content: "";
        }
        .sec-title-style1 .decor span {
            position: absolute;
            top: 0;
            left: 0;
            bottom: 0;
            width: 50px;
            height: 1px;
            background: #e52334;
            margin: 2px 0;
        }
        .sec-title-style1 .text{
            position: relative;
            display: block;
            margin: 7px 0 0;
        }
        .sec-title-style1 .text p{
            position: relative;
            display: inline-block;
            padding: 0 15px;
            color: #131313;
            font-size: 14px;
            line-height: 16px;
            font-weight: 700;
            text-transform: uppercase;
            margin: 0;
        }
        .sec-title-style1 .text.clr-yellow p{
            color: #e52334;
        }
        .sec-title-style1 .text .decor-left{
            position: relative;
            top: -2px;
            display: inline-block;
            width: 70px;
            height: 5px;
            background: transparent;
        }
        .sec-title-style1 .text .decor-left span {
            position: absolute;
            top: 0;
            left: 0;
            bottom: 0;
            width: 50px;
            height: 1px;
            background: #e52334;
            content: "";
            margin: 2px 0;
        }
        .sec-title-style1 .text .decor-left:before{
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            width: 5px;
            height: 5px;
            background: #e52334;
            border-radius: 50%;
            content: "";
        }
        .sec-title-style1 .text .decor-left:after{
            position: absolute;
            top: 0;
            right: 10px;
            bottom: 0;
            width: 5px;
            height: 5px;
            background: #e52334;
            border-radius: 50%;
            content: "";
        }
        .sec-title-style1 .text .decor-right{
            position: relative;
            top: -2px;
            display: inline-block;
            width: 70px;
            height: 5px;
            background: transparent;
        }
        .sec-title-style1 .text .decor-right span {
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            width: 50px;
            height: 1px;
            background: #e52334;
            content: "";
            margin: 2px 0;
        }
        .sec-title-style1 .text .decor-right:before{
            position: absolute;
            top: 0;
            left: 0;
            bottom: 0;
            width: 5px;
            height: 5px;
            background: #e52334;
            border-radius: 50%;
            content: "";
        }
        .sec-title-style1 .text .decor-right:after{
            position: absolute;
            top: 0;
            left: 10px;
            bottom: 0;
            width: 5px;
            height: 5px;
            background: #e52334;
            border-radius: 50%;
            content: "";
        }
        .sec-title-style1 .bottom-text{
            position: relative;
            display: block;
            padding-top: 16px;
        }
        .sec-title-style1 .bottom-text p{
            color: #848484;
            font-size: 16px;
            line-height: 26px;
            font-weight: 400;
            margin: 0;
        }
        .sec-title-style1 .bottom-text.clr-gray p{
            color: #cdcdcd;    
        }
        .contact-address-area{
            position: relative;
            display: block; 
            background: #ffffff;
            padding: 80px 0 90px;
        } 
        .contact-address-area .sec-title-style1.max-width { 
            padding-bottom: 45px;
        }
        .contact-address-box{
            display: flex;
            justify-content: center;
            margin-right: 0px;
            flex-direction: row;
            flex-wrap: wrap;
            width: 100%;
            align-items: center;
            margin-left: 0px;  
        }
        .single-contact-address-box {
            position: relative;
            display: block;
            background: #131313;
            padding: 85px 30px 77px;
        }
        .single-contact-address-box .icon-holder{
            position: relative;
            display: block;
            padding-bottom: 24px;
        }
        .single-contact-address-box .icon-holder span:before{
            font-size: 75px;
        }
        .single-contact-address-box h3{
            color: #ffffff;
            margin: 0px 0 9px;
        }
        .single-contact-address-box h2{
            color: #e52334;
            font-size: 24px;
            font-weight: 600;
            margin: 0 0 19px;
        }
        .single-contact-address-box a{
            color: #ffffff;
        }
        .single-contact-address-box.main-branch {
            background: #e52334;
            padding: 53px 30px 51px;
            margin-top: -20px;
            margin-bottom: -20px;
        }
        .single-contact-address-box.main-branch h3{
            color: #131313;
            font-size: 18px;
            font-weight: 700;
            margin: 0 0 38px;
            text-transform: uppercase;
            text-align: center;
        }
        .single-contact-address-box.main-branch .inner{
            position: relative;
            display: block;
        }
        .single-contact-address-box.main-branch .inner ul{
            position: relative;
            display: block;
            overflow: hidden;
        }
        .single-contact-address-box.main-branch .inner ul li{
            position: relative;
            display: block;
            padding-left: 110px;
            border-bottom: 1px solid #737373;
            padding-bottom: 23px;
            margin-bottom: 24px;
        }
        .single-contact-address-box.main-branch .inner ul li:last-child{
            border: none;
            margin-bottom: 0;
            padding-bottom: 0; 
        }
        .single-contact-address-box.main-branch .inner ul li .title{
            position: absolute;
            top: 2px;
            left: 0;
            display: inline-block;
        }
        .single-contact-address-box.main-branch .inner ul li .title h4{
            color: #131313;
            font-size: 18px; 
            font-weight: 600;
            line-height: 24px;
            text-transform: capitalize;
            border-bottom: 2px solid #a5821e;
        }
        .single-contact-address-box.main-branch .inner ul li .text{
            position: relative;
            display: block;
        }
        .single-contact-address-box.main-branch .inner ul li .text p{
            color: #131313;
            font-size: 16px;
            line-height: 24px;
            font-weight: 600;
            margin: 0;
        }
    </style>
@endsection
@section('content')
    <section id="contact-us">
        <div class="contact-banner">
            @if(isset($contact_us->image) && $contact_us->image)
                <img src="{{url('public/contact_us/'.$contact_us->image)}}" alt="contact-us">
            @endif
        </div>
    </section>
    <section class="contact-address-area">
        <div class="sec-title-style1 text-center max-width">
            <div class="title" style="color: {{$contact_us->title_color ?? null}}; font-size:{{$contact_us->title_font_size ?? null}}; font-family:{{$contact_us->title_font_family ?? null}};">
                {{$contact_us->title ?? null}}
            </div>
            <div class="text">
                <div class="decor-left">
                    <span></span>
                </div>
                <p style="color: {{$contact_us->sub_title_color ?? null}}; font-size:{{$contact_us->sub_title_font_size ?? null}}; font-family:{{$contact_us->sub_title_font_family ?? null}};">{{$contact_us->sub_title ?? null}}</p>
                <div class="decor-right">
                    <span></span>
                </div>
            </div>
        </div>
        <div class="contact-address-box row">
            <div class="col-md-3" style="margin-top: 15px; margin-bottom: 15px;">
                <div class="card">
                    <div class="banner">
                        <div class="avatar"></div>
                    </div>

                    @php($setting = getSettingDetail())
                    <h3 style="margin-top:45px; margin-bottom:10px; color:{{$setting->address_color ?? null}}; font-size:{{$setting->address_font_size ?? null}}; font-family:{{$setting->address_font_family ?? null}};">
                        {{$setting->address ?? null}}
                    </h3>

                    @if(isset($setting) && isset($setting->email))
                    <div style="display: flex; align-items:center; justify-content: center;"> 📧 
                        <a href="mailto:info@thesachdevgroup.com" style="margin-left:5px; color:{{$setting->email_color}}; font-size:{{$setting->email_font_size}}; font-family:{{$setting->email_font_family}};">
                             {{$setting->email}}
                        </a>
                    </div>
                    @endif 

                    @if(isset($setting) && isset($setting->mobile_number))
                        <div style="display: flex; align-items:center; justify-content: center;"> 📱 
                            <a href="tel:+4733378901" style="margin-left:5px; color:{{$setting->mobile_number_color}}; font-size:{{$setting->mobile_number_font_size}}; font-family:{{$setting->mobile_number_font_family}};">
                                {{$setting->mobile_number}}
                            </a>
                        </div>
                    @endif

                    @if(isset($setting) && isset($setting->time))
                        <div style="display: flex; align-items:center; justify-content: center;"> 💼 
                            <a href="" style="margin-left:5px; color:{{$setting->time_color}}; font-size:{{$setting->time_font_size}}; font-family:{{$setting->time_font_family}};">
                                {{$setting->time}}
                            </a>
                        </div>
                    @endif


                    {{-- <ul style="	background-color: #FAFAFA;"> 
                        <a href="https://twitter.com/TsgDelhi?s=20" target="_blank" style="margin-right: 10px;"><i class="fa fa-twitter" style="font-size:16px"></i></a>
                        <a href="https://www.linkedin.com/company/the-sachdev-group-tsg" target="_blank"  style="margin-right: 10px;"><i class="fa fa-linkedin" style="font-size:16px"></i></a>
                        <a href="https://www.facebook.com/tsgautomotive/" target="_blank" style="margin-right: 10px;"><i class="fa fa-facebook" style="font-size:16px"></i></a>
                    </ul> --}}

                    <ul style="background-color: #FAFAFA;"> 
                        @foreach ($header_social_media_icons as $header_social_media_icon)
                            <a href="{{$header_social_media_icon->link}}" style="background-color: #000;">
                                <img src="{{url('public/header_menu_social_media_icon/'.$header_social_media_icon->icon)}}" target="_blank" style="margin-right: 10px;">
                            </a>
                        @endforeach
                    </ul>

                </div> 
            </div>
            <div class="col-md-4" style="margin-top: 15px; margin-bottom: 15px;">
                <div class="card">
                    <div class="contact-form">
                        <h3 style="margin-top: 30px; margin-bottom: 10px; color: {{$contact_us->form_title_color ?? null}}; font-size:{{$contact_us->form_title_font_size ?? null}}; font-family:{{$contact_us->form_title_font_family ?? null}};">{{$contact_us->form_title ?? null}}</h3>
                            <p style="color: {{$contact_us->form_sub_title_color ?? null}}; font-size:{{$contact_us->form_sub_title_font_size ?? null}}; font-family:{{$contact_us->form_sub_title_font_family ?? null}};">{{$contact_us->form_sub_title ?? null}}</p>
                        <div class="form-contact-us">
                            <form action="" method="post">
                                <div class="row">
                                    <div class="col-md-6 col-sm-12 margin-bookservice">
                                        <input type="text" class="form-control" placeholder="First Name" required>
                                    </div>
                                    <div class="col-md-6 col-sm-12 margin-bookservice">
                                        <input  type="tel" class="form-control" placeholder="Phone" pattern="[0-9]{10}" title="Please enter a 10-digit contact number" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 margin-bookservice">
                                        <input type="email" class="form-control" placeholder="Email" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-sm-12 margin-bookservice">
                                        {{-- <select id="inputState" class="form-control">
                                            <option selected>Choose Brand</option>
                                            <option>Galaxy Toyota</option>
                                            <option>Hans Hyundai</option>
                                            <option>Harpreet Ford</option>
                                            <option>TSG Insure</option>
                                            <option value=""> AMS Dry ice</option>
                                            <option value=""> ACR</option>
                                            <option value=""> Tsg Auction Mart</option>
                                        </select> --}}
                                        <select id="inputState" class="form-control">
                                            <option selected>Choose Brand</option>
                                            @foreach($our_business as $business)
                                                <option>{{$business->title}}</option>
                                            @endforeach
                                        </select> 
                                    </div>
                                    <div class="col-md-6 col-sm-12 margin-bookservice">
                                        <select id="inputState" class="form-control">
                                            <option selected>Choose Location</option>
                                            <option>Moti Nagar</option>
                                            <option>Shalimar Place</option>
                                            <option>Lajpat Nagar</option>
                                            <option>Dwarka</option>
                                            <option value=""> Gurugram</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                </div>

                                <div class="form-group margin-bookservice">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="gridCheck">
                                        <label class="form-check-label" for="gridCheck">
                                        I agree to the 
                                        <a href="privacy-policy.php"> Privacy Policy. </a>
                                        </label>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary bookservice-button">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3" style="margin-top: 15px; margin-bottom: 15px;">
                <div class="card">
                    
                    {{-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3501.0042941758775!2d77.14451381456026!3d28.659590089607708!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390d0544f1a7bf87%3A0x5001b9e8509f6ab0!2sGalaxy+Toyota+Showroom%2C+Motinagar!5e0!3m2!1sen!2sin!4v1544683633989" width="600" height="400" style="border:0; width:100%; " allowfullscreen=""></iframe> --}}
                    <iframe src="{{$contact_us->map_link}}" width="600" height="400" style="border:0; width:100%; " allowfullscreen=""></iframe>
                    

                  
                </div>  
            </div>
        </div>
    </section>  
@endsection