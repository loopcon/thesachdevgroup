@extends('frontend.layout.header')
@section('content')
<section id="contact-us">
    <div class="contact-banner">
        <img src="assets/image/newcar-page/1600 x 426.png" alt="">
    </div>
</section>

<section id="car-brands">
	<div class="container">
	    <div class="new-car-heading">
	        <h1>SELECT BRAND</h1>
	    </div>
        <div class="new-brand-logo">
            @if(isset($brands) && $brands)
                @foreach($brands as $brand)
                    <div class="brand-one">
                        <a href="#{{$brand->id}}"><img src="{{url('public/brand/'.$brand->image)}}" alt="" width="100%"></a>
                    </div>
                @endforeach
            @endif
            <!-- <div class="brand-one">
                <a href="#toyota-cars"><img src="assets/image/Toyota1.1 (1).png" alt="" width="100%"></a>
            </div> -->
        </div>
    </div>
</section>

@foreach($brands as $data)
<section class="pt-5" id="{{$data->id}}">
    <div class="container">
        <div class="row">
            <div class="col-6">
                <h3 class="mb-3" style="color:{{$data->color}}; font-size:{{$data->font_size}}; font-family:{{$data->font_family}};">{{$data->name}}</h3>
            </div>
            <div class="col-6 text-right">
                <a class="btn btn-primary mb-3 " href="https://hanshyundai.com/" role="button" data-slide="next" target="_blank">
                   View More</i>
                </a>
            </div>
            <div class="col-12">
                <div id="carouselExampleIndicators2" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="row">
                                @foreach($models as $model)
                                    @if($model->brand_id == $data->id)
                                        <div class="col-md-4 mb-3">
                                            <div class="card">
                                                @if(isset($model->image) && $model->image)
                                                    <img class="img-fluid" alt="100%x280" src="{{url('public/car/'.$model->image)}}">
                                                @endif
                                                <div class="card-body">
                                                    <h4 class="card-title" style="color:{{$data->name_color}}; font-size:{{$data->name_font_size}}; font-family:{{$data->name_font_family}};">{{$model->name}}</h4>
                                                    <p class="card-text" style="color:{{$data->price_color}}; font-size:{{$data->price_font_size}}; font-family:{{$data->price_font_family}};">{{$model->price}}</p>
                                                    <a href="https://hanshyundai.com/hyundai-alcazar"  target="_blank">View Details</a>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                                <!-- <div class="col-md-4 mb-3">
                                    <div class="card">
                                        <img class="img-fluid" alt="100%x280" src="assets/image/newcar-page/galaxy-toyota-hyundaicars-56 (1).jpg">
                                        <div class="card-body">
                                            <h4 class="card-title">Hyundai Grand i10 NIOS</h4>
                                            <p class="card-text">₹ 5.92 - 8.23 Lakh*</p>
											<a href="https://hanshyundai.com/hyundai-grand-i10-nios"  target="_blank">View Details</a>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="card">
                                        <img class="img-fluid" alt="100%x280" src="assets/image/newcar-page/galaxy-toyota-hyundaicars-53(1).jpg">
                                        <div class="card-body">
                                            <h4 class="card-title">Hyundai i20</h4>
                                            <p class="card-text">₹ 7.04 - 11.20 Lakh*</p>
											<a href="https://hanshyundai.com/hyundai-all-new-i20"  target="_blank">View Details</a>
                                        </div>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endforeach

<!-- toyota car data -->
<!-- <section class="pt-5 pb-5" id="toyota-cars">
    <div class="container">
        <div class="row">
            <div class="col-6">
                <h3 class="mb-3">Toyota</h3>
            </div>
            <div class="col-6 text-right">
                <a class="btn btn-primary mb-3 " href="https://www.galaxytoyota.in/" role="button" data-slide="next" target="_blank">
                   View More</i>
                </a>
            </div>
            <div class="col-12">
                <div id="carouselExampleIndicators3" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <div class="card">
                                        <img class="img-fluid" alt="100%x280" src="assets/image/newcar-page/Legender (2).png">
                                        <div class="card-body">
                                            <h4 class="card-title">Legender</h4>
                                            <p class="card-text">₹ 43.66 - 51.44 Lakh*</p>
											<a href="https://www.galaxytoyota.in/car/toyota-legender" target="_blank">View Details</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="card">
                                        <img class="img-fluid" alt="100%x280" src="assets/image/newcar-page/UC (1).png">
                                        <div class="card-body">
                                            <h4 class="card-title">Urban Cruiser Hyryder</h4>
                                            <p class="card-text">₹ 11.14 - 20.39 Lakh*</p>
											<a href="https://www.galaxytoyota.in/car/toyota-urban-cruiser-hyryder" target="_blank">View Details</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="card">
                                        <img class="img-fluid" alt="100%x280" src="assets/image/newcar-page/Innova Hycross.png">
                                        <div class="card-body">
                                            <h4 class="card-title">Innova Hycross</h4>
                                            <p class="card-text">₹ 19.77 - 30.77 Lakh*</p>
											<a href="https://www.galaxytoyota.in/car/toyota-innova-hycross" target="_blank">View Details</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> -->
@endsection