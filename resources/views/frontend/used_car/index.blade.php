@extends('frontend.layout.header')
@section('content')
<section id="contact-us">
    <div class="contact-banner">
        @if(isset($usedCar->banner_image) && $usedCar->banner_image)
            <img src="{{url('public/uploads/usedCar/'.$usedCar->banner_image)}}" alt="">
        @endif
    </div>
</section>

<!-- used car car data -->
<section id="used-car">
    <div class="container">
        <div class="used-car-cardparent">
            @if(isset($car_models) && $car_models)
                @foreach($car_models as $model)
                    <div class="usedcar-card">
                        <div class="used-car-image">
                            <img src="{{url('public/car/'.$model->image)}}" alt="">
                        </div>
                        <div class="usedcar-text">
                            <h4> {{$model->name}} @if($model->year !='')({{$model->year}})@endif</h4>
                            <p> {{$model->price}} </p>
                            <div class="transmition-detail">
                                @if($model->driven !='')
                                    <p> {{$model->driven}} <br> KM</p> 
                                @endif
                                <p>{{$model->fuel_type}}</p>
                                <p>{{$model->year}}</p>
                                <p>{{$model->body_style}}</p>
                            </div>
                        </div>
                        <div class="usedcar-button">
                            <a href="https://tsgusedcars.com/buy" target="_blank">Contact Us</a>
                            <a href="{{$model->link}}" target="_blank">View Details</a>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</section>
@endsection