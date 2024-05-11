@extends('frontend.layout.header')
@section('content')
<section id="contact-us">
    <div class="contact-banner">
        @if(isset($new_car->banner_image) && $new_car->banner_image)
            <img src="{{url('public/uploads/new_car/'.$new_car->banner_image)}}" alt="">
        @endif
    </div>
</section>

<section id="car-brands">
	<div class="container">
	    <div class="new-car-heading">
	        <h1 style="color:{{$new_car->title_color}}; font-size:{{$new_car->title_font_size}}; font-family:{{$new_car->title_font_family}};">{{isset($new_car->title) && $new_car->title ? $new_car->title : ''}}</h1>
	    </div>
        <div class="new-brand-logo">
            @if(isset($brands) && $brands)
                @foreach($brands as $brand)
                    <div class="brand-one">
                        <a href="#{{$brand->id}}"><img src="{{url('public/brand/'.$brand->image)}}" alt="" width="100%"></a>
                    </div>
                @endforeach
            @endif
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
                                                    <a href="{{$model->link}}"  target="_blank">View Details</a>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endforeach

@endsection