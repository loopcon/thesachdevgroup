@extends('frontend.layout.header')
@section('content')
<section id="contact-us">
    <div class="contact-banner">
        @if(isset($after_sales_service->banner_image) && $after_sales_service->banner_image)
            <img src="{{url('public/uploads/afterSalesService/'.$after_sales_service->banner_image)}}" alt="">
        @endif
    </div>
</section>

<section id="servive-content">
    <div class="container">
        <div class="service-text">
            <h2 style="color:{{$after_sales_service->title_color}}; font-size:{{$after_sales_service->title_font_size}}; font-family:{{$after_sales_service->title_font_family}};">{{isset($after_sales_service->title) && $after_sales_service->title ? $after_sales_service->title : ''}}</h2>
            <p style="color:{{$after_sales_service->description_font_color}}; font-size:{{$after_sales_service->description_font_size}}; font-family:{{$after_sales_service->description_font_family}};">{{isset($after_sales_service->description) && $after_sales_service->description ? $after_sales_service->description : ''}}</p>
        </div>
        <div class="new-brand-logo">
            @if(isset($brands) && $brands)
                @foreach($brands as $brand)
                    <div class="brand-one">
                        <a href="{{$brand->link}}" target="_blank"><img src="{{url('public/brand/'.$brand->image)}}" alt="" width="100%"></a>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</section>

<section id="bookservice-form">
    <div class="container">
        <div class="heading-bookservice">
            <h2 style="color:{{$after_sales_service->book_service_form_title_color}}; font-size:{{$after_sales_service->book_service_form_title_font_size}}; font-family:{{$after_sales_service->book_service_form_title_font_family}};">{{isset($after_sales_service->book_service_form_title) && $after_sales_service->book_service_form_title ? $after_sales_service->book_service_form_title : ''}}</h2>
        </div>
        <div class="bookservice-form">
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
                                @foreach($brands as $data)
                                    <option value="{{$data->id}}">{{$data->name}}</option>
                                @endforeach
                            @endif
                            <!-- <option>Toyota</option>
                            <option>Ford</option>
                            <option>ACR</option> -->
                        </select>
                    </div>
                </div>
                <div class="form-group margin-bookservice">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="gridCheck">
                        <label class="form-check-label" for="gridCheck">I agree to the <a href="privacy-policy.php"> Privacy Policy. </a></label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary bookservice-button">Submit</button>
            </form>
        </div>
    </div>
</section>
@endsection