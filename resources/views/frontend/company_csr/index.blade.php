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
            <h3>{{isset($csr->title) && $csr->title ? $csr->title : ''}}</h3>
            <p>{{isset($csr->description) && $csr->description ? $csr->description : ''}}</p>
        </div>
    </div>

</section>

<section id="csr-data">
    <div class="container">
        <div class="csr-parent">
            <div class="row">
                <div class="col-md-5">
                    <div class="csr-left-text">
                        <h3>{{isset($csr->left_title) && $csr->left_title ? $csr->left_title : ''}}</h3>
                        <p>{!! isset($csr->left_description) && $csr->left_description ? $csr->left_description : '' !!}</p>
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