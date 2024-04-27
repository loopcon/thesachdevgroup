<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TSGAUTOMOTIVE</title>
    <link rel="icon" type="image/x-icon" href="assets/image/favicon (2).png">
    <link rel="stylesheet" href="{{url('public/frontend/css/new-style.css')}}">
    <link rel="stylesheet" href="{{url('public/frontend/css/responsive-style.css')}}">
    <link rel="stylesheet" href="{{url('public/frontend/css/user-custom.css')}}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- font awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css">

    @php($setting_detail = getSettingDetail())
        @if(isset($setting_detail) && isset($setting_detail->logo))
        <link rel="icon" type="image/png" href="{{url('public/logo/'.$setting_detail->logo)}}">
        @endif
    @yield('css')
</head>
<body>
    <!-- New code started  -->
    <div class="top-bar1">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 col-sm-7">
                    <div class="contact-detail">
                        @php($setting = getSettingDetail())
                    
                        <a href="mailto:info@thesachdevgroup.com" style="display: flex; align-items: center;">
                            @if(isset($setting) && isset($setting->email_icon))
                                <img src="{{url('public/email_icon/'.$setting->email_icon)}}" style="height:30px; width:30px">
                            @endif

                            @if(isset($setting) && isset($setting->email))
                                <p style="color:{{$setting->email_color}}; font-size:{{$setting->email_font_size}}; font-family:{{$setting->email_font_family}}; margin-bottom: 0px; margin-left: 5px;"> {{$setting->email}}</p>
                            @endif  
                        </a>

                        <a href="tel:+4733378901" style="display: flex; align-items: center;">
                            @if(isset($setting) && isset($setting->call_icon))
                                <img src="{{url('public/call_icon/'.$setting->call_icon)}}" style="height:30px; width:30px">
                            @endif
                            @if(isset($setting) && isset($setting->mobile_number))
                                <p style="color:{{$setting->mobile_number_color}}; font-size:{{$setting->mobile_number_font_size}}; font-family:{{$setting->mobile_number_font_family}}; margin-bottom: 0px; margin-left: 5px;"> {{$setting->mobile_number}}</p>
                            @endif
                        </a>
                    </div>
                </div>
                <div class="col-md-6 col-sm-5">
                    <div class="social-icon">
                        @if(isset($setting) && isset($setting->payment_button_text))
                            <a href="_payment.php" class="payment-button" style="color:{{$setting->payment_button_text_color}}; font-size: @if($setting->payment_button_font_size) {{$setting->payment_button_font_size}} @else 16px; @endif; font-family:{{$setting->payment_button_font_family}}; background-color:{{$setting->payment_button_color}};">
                                {{$setting->payment_button_text}}
                            </a>
                        @endif

                        @foreach ($header_social_media_icons as $header_social_media_icon)
                            <a href="{{$header_social_media_icon->link}}">
                                <img src="{{url('public/header_menu_social_media_icon/'.$header_social_media_icon->icon)}}" style="height:30px; width:30px">
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="topbar-mobile" style="display: none;">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-xs-5">
                    <div class="contact-detail">
                        <a href="">
                            @if(isset($setting) && isset($setting->call_icon))
                                <img src="{{url('public/call_icon/'.$setting->call_icon)}}" style="height:30px; width:30px">
                            @endif
                            @if(isset($setting) && isset($setting->mobile_number))
                                {{$setting->mobile_number}}
                            @endif
                        </a>
                    </div>
                </div>

                <div class="col-xs-5">
                    <div class="pay-button">
                        @if(isset($setting) && isset($setting->payment_button_text))
                        <a href="_payment.php" class="payment-button" style="color:{{$setting->payment_button_text_color}}; font-size: @if($setting->payment_button_font_size) {{$setting->payment_button_font_size}} @else 16px; @endif; font-family:{{$setting->payment_button_font_family}}; background-color:{{$setting->payment_button_color}};">
                            {{$setting->payment_button_text}}
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="header1">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light custom-nav p-0">
                <a class="navbar-brand" href="{{route('home')}}">
                    @if(isset($setting) && isset($setting->logo))
                        <img src="{{url('public/logo/'.$setting->logo)}}" width="80%">
                    @endif 
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <ul class="navbar-nav mr-auto">

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Our Businesses</a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    @foreach($our_business as $business)
                                        @if($business->url !='')
                                            <a class="dropdown-item" href="{{url($business->url)}}">{{$business->title}}</a>
                                        @else
                                            <a class="dropdown-item" href="{{url('business/'.$business->slug)}}">{{$business->title}}</a>
                                        @endif
                                    @endforeach
                                </div>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Our Services</a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    @foreach ($header_menu_our_services as $header_menu_our_service)
                                        <a class="dropdown-item" href="{{$header_menu_our_service->link}}" style="color:{{$header_menu_our_service->color}}; font-size:{{$header_menu_our_service->font_size}}; font-family:{{$header_menu_our_service->font_family}};">
                                            {{$header_menu_our_service->name}}
                                        </a>
                                    @endforeach
                                </div>
                            </li>

                            @if ($header_menu_careers->count() > 0)
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Careers</a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        @foreach ($header_menu_careers as $header_menu_career)
                                            <a class="dropdown-item" href="{{$header_menu_career->link}}" style="color:{{$header_menu_career->color}}; font-size:{{$header_menu_career->font_size}}; font-family:{{$header_menu_career->font_family}};">
                                                {{$header_menu_career->name}}
                                            </a>
                                        @endforeach
                                    </div>
                                </li>
                            @else
                                <a class="nav-link" href="">Careers</a>
                            @endif


                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Awards & Recognition</a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    @foreach ($header_menu_awards_recognitions as $header_menu_awards_recognition)
                                        <a class="dropdown-item" href="{{$header_menu_awards_recognition->link}}" style="color:{{$header_menu_awards_recognition->color}}; font-size:{{$header_menu_awards_recognition->font_size}}; font-family:{{$header_menu_awards_recognition->font_family}};">
                                            {{$header_menu_awards_recognition->name}}
                                        </a>
                                    @endforeach
                                </div>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Contact Us</a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    @foreach ($header_menu_contacts as $header_menu_contact)
                                        <a class="dropdown-item" href="{{$header_menu_contact->link}}" style="color:{{$header_menu_contact->color}}; font-size:{{$header_menu_contact->font_size}}; font-family:{{$header_menu_contact->font_family}};">
                                            {{$header_menu_contact->name}}
                                        </a>
                                    @endforeach
                                </div>
                            </li>

                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </div>

<!-- Content Wrapper. Contains page content -->
@yield('content')
 <!-- /.content-wrapper -->

@include('frontend.layout.footer')

@yield('javascript')