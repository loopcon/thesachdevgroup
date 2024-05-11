@extends('frontend.layout.header')
@section('content')
<section id="contact-us">
    <div class="contact-banner">
        @if(isset($car_insurance) && $car_insurance)
            <img src="{{url('public/uploads/carInsurance/'.$car_insurance->banner_image)}}" alt="">
        @endif
    </div>
</section>

<section id="insurence-content">
    <div class="container">
        <div class="insurence-content-text">
            <h1 style="color:{{$car_insurance->title_color}}; font-size:{{$car_insurance->title_font_size}}; font-family:{{$car_insurance->title_font_family}};">{{isset($car_insurance->title) && $car_insurance->title ? $car_insurance->title : ''}}</h1>
            <p style="color:{{$car_insurance->description_font_color}}; font-size:{{$car_insurance->description_font_size}}; font-family:{{$car_insurance->description_font_family}};">{{isset($car_insurance->description) && $car_insurance->description ? $car_insurance->description : ''}}</p>
        </div>
        <div class="new-brand-logo">
            @if(isset($brands) && $brands)
                @foreach($brands as $brand)
                    <div class="brand-one">
                        <a href="{{$brand->link}}" target="_blank"><img src="{{url('public/brand/'.$brand->image)}}" alt="" width="100%"></a>
                    </div>
                @endforeach
            @endif
            <!-- <div class="brand-one">
                <a href="https://www.galaxytoyota.in/" target= "_blank"><img src="assets/image/Toyota1.1 (1).png" alt="" width="100%"></a>
            </div>
            <div class="brand-one">
                <a href="https://harpreetford.com/" target= "_blank"><img src="assets/image/Ford.svg" alt="" width="100%"></a>
            </div> -->
        </div>
    </div>
</section>

<section id="form-insurence">
    <div class="container">
        <div class="insurencetext">
            <h2 style="color:{{$car_insurance->insurance_form_title_color}}; font-size:{{$car_insurance->insurance_form_title_font_size}}; font-family:{{$car_insurance->insurance_form_title_font_family}};">{{isset($car_insurance->insurance_form_title) && $car_insurance->insurance_form_title ? $car_insurance->insurance_form_title : ''}}</h2>
        </div>
        <div class="insurence-form">
            <form action="" method="post">
                <div class="row">
                    <div class="col-md-6 col-sm-12 margin-bookservice">
                        <input type="text" class="form-control" placeholder="First Name" required>
                    </div>
                    <div class="col-md-6 col-sm-12 margin-bookservice">
                        <input type="email" class="form-control" placeholder="Email" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 col-sm-12 margin-bookservice">
                        <input type="tel" class="form-control" placeholder="Phone" required>
                    </div>
                    <div class="col-md-6 col-sm-12 margin-bookservice">
                        <select id="inputState" class="form-control">
                            <option selected>Choose Brand</option>
                            @if(isset($brands) && $brands)
                                @foreach($brands as $brand)
                                    <option value="{{$brand->id}}">{{$brand->name}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>

                <div class="form-group margin-bookservice">
                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="gridCheck">
                    <label class="form-check-label" for="gridCheck">
                    I agree to the <a href="{{url('privacy-policy')}}"> Privacy Policy. </a>
                    </label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary bookservice-button">Submit</button>
            </form>
        </div>
    </div>
</section>
@endsection