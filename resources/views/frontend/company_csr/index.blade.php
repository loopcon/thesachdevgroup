@extends('frontend.layout.header')
@section('content')
<section id="contact-us">
    <div class="contact-banner">
        @if(isset($csr->banner_image) && $csr->banner_image)
            <img src="{{url('public/uploads/companyCsrBanner/'.$csr->banner_image)}}" alt="">
        @endif
    </div>
</section>

<section id="csr-toptext">
    <div class="container">
        <div class="csr-content">
            <h3 style="color:{{$csr->title_color}}; font-size:{{$csr->title_font_size}}; font-family:{{$csr->title_font_family}};">{{isset($csr->title) && $csr->title ? $csr->title : ''}}</h3>
            <p style="color:{{$csr->description_font_color}}; font-size:{{$csr->description_font_size}}; font-family:{{$csr->description_font_family}};">{{isset($csr->description) && $csr->description ? $csr->description : ''}}</p>
        </div>
    </div>
</section>

<section id="csr-data">
    <div class="container">
        <div class="csr-parent">
            <div class="row">
                <div class="col-md-5">
                    <div class="csr-left-text">
                        <h3 style="color:{{$csr->left_title_color}}; font-size:{{$csr->left_title_font_size}}; font-family:{{$csr->left_title_font_family}};">{{isset($csr->left_title) && $csr->left_title ? $csr->left_title : ''}}</h3>
                        <div>{!! isset($csr->left_description) && $csr->left_description ? $csr->left_description : '' !!}</div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="csr-right-image">
                        @if(isset($csr->image) && $csr->image)
                            <img src="{{url('public/uploads/companyCsr/'.$csr->image)}}">
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection