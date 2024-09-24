@extends('admin.layout.header')
@section('css')
    <link class="js-stylesheet" href="{{ asset('plugins/parsley/parsley.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h1>Showroom Create</h1>
          </div>
        </div>
      </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('showroom_insert') }}" method="POST" class="showroom_form" enctype="multipart/form-data" data-parsley-validate="">
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-md-4">
                                <label for="our_business_id" class="form-label">Our Business<span class="text-danger">*</span></label>
                                <select class="form-control our_business_id select2" name="our_business_id" id="our_business_id" required>
                                    <option selected="selected" disabled="disabled" value="">Select</option>
                                    @foreach($our_business as $our_busines)
                                        <option value="{{$our_busines->id}}">{{$our_busines->title}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('our_business_id')) <div class="text-danger">{{ $errors->first('our_business_id') }}</div>@endif
                                <div id="errorbusinessdiv"></div>
                            </div>

                            <div class="mb-3 col-md-4">
                                <label for="image" class="form-label">Image</label>
                                <input type="file" id="image" class="form-control" name="image">
                                <div id="error"></div>
                                <small class="image_type">(Height:281px,Width:1349px; Image Type : jpg,jpeg,png,svg,webp)</small>
                            </div>

                            <div class="col-md-4">
                                <label for="name" class="form-label">Showroom Name<span class="text-danger">*</span></label>
                                <input type="text" id="name" class="form-control" name="name" required>
                                @if ($errors->has('name')) <div class="text-danger">{{ $errors->first('name') }}</div>@endif
                                <div id="error"></div>
                            </div>

                            <div class="col-md-4">
                                <label for="name_color" class="form-label">Showroom Name Text Color</label>
                                <input type="text" class="form-control colorpicker" name="name_color" id="name_color">
                            </div>

                            <div class="col-md-4">
                                @php($fontsize = fontSize())
                                <label for="name_font_size" class="form-label">Showroom Name Text Font Size</label>
                                <select class="form-control select2" name="name_font_size">
                                    <option value="">Select</option>
                                    @for($i=$fontsize['start']; $i<=$fontsize['end']; $i+=$fontsize['range'])
                                        <option value="{{$i}}px">{{$i}}px</option>
                                    @endfor
                                </select>
                            </div>

                            <div class="mb-3 col-md-4">
                                @php($fontfamily = fontFamily())
                                <label for="name_font_family" class="form-label">Showroom Name Text Font Family</label>
                                <select class="form-control select2" name="name_font_family">
                                    <option value="">Select</option>
                                    @foreach($fontfamily as $family)
                                        <option value="{{$family['key']}}">{{$family['value']}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-12 mt-2 mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="ckeditor form-control" name="description"></textarea>
                                <div class="error"></div>
                            </div>

                            <?php /**<div class="mb-3 col-md-4">
                                <label for="description_color" class="form-label">Description Text Color</label>
                                <input type="text" class="form-control colorpicker" name="description_color" id="description_color">
                            </div>
    
                            <div class="mb-3 col-md-4">
                                <label for="description_font_size" class="form-label">Description Text Font Size</label>
                                <select class="form-control select2" name="description_font_size">
                                    <option value="">Select</option>
                                    @for($i=$fontsize['start']; $i<=$fontsize['end']; $i+=$fontsize['range'])
                                        <option value="{{$i}}px">{{$i}}px</option>
                                    @endfor
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label for="description_font_family" class="form-label">Description Text Font Family</label>
                                <select class="form-control select2" name="description_font_family">
                                    <option value="">Select</option>
                                    @foreach($fontfamily as $family)
                                        <option value="{{$family['key']}}">{{$family['value']}}</option>
                                    @endforeach
                                </select>
                            </div>**/ ?>

                            <div class="col-md-4">
                                <label for="brand_id" class="form-label">Select Brand<span class="text-danger">*</span></label>
                                <select name="brand_id" id="brand_id" class="form-control select2" required>
                                    <option value="">Select</option>
                                    @foreach($brands as $brand)
                                        <option value="{{$brand->id}}">
                                            {{$brand->name}}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('brand_id')) <div class="text-danger">{{ $errors->first('brand_id') }}</div>@endif
                                <div id="errordiv"></div>
                            </div>

                            <div class="col-md-4 adm-select-car-drop">
                                <label for="car_id" class="form-label">Select Car<span class="text-danger">*</span></label>
                                <select name="car_id[]" id="car_id" class="form-control select2" required multiple>
                                    <option disabled>Select</option>
                                </select>
                                @if ($errors->has('car_id')) <div class="text-danger">{{ $errors->first('car_id') }}</div>@endif
                                <div id="errorcardiv"></div>
                            </div>

                            <div class="col-md-4 mt-2 mb-2">
                                <label for="address_title" class="form-label">Address Title</label>
                                <input type="address_title" class="form-control" name="address_title" id="address_title">
                                @if ($errors->has('address_title')) <div class="text-danger">{{ $errors->first('address_title') }}</div>@endif
                            </div>

                            <div class="col-md-4 mt-2">
                                <label for="address_title_font_size" class="form-label">Address Title Font Size</label>
                                <select class="form-control select2" name="address_title_font_size">
                                    <option value="">-- Select --</option>
                                    @for($i=24; $i<=50; $i+=2)
                                        <option value="{{$i}}px">{{$i}}px</option>
                                    @endfor
                                </select>
                            </div>

                            <div class="col-md-4 mt-2">
                                <label for="address_title_font_family" class="form-label">Address Title Font Family</label>
                                <select class="form-control select2" name="address_title_font_family">
                                    <option value="">-- Select --</option>
                                    @foreach($fontfamily as $family)
                                        <option value="{{$family['key']}}">{{$family['value']}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4 mt-2">
                                <label for="address_title_color" class="form-label">Address Title Font Color</label>
                                <input type="text" class="form-control colorpicker" name="address_title_color" id="address_title_color">
                            </div>

                            <div class="mb-3 col-md-4">
                                <label for="address_icon" class="form-label">Address Icon</label>
                                <input type="file" id="address_icon" class="form-control" name="address_icon">
                                <div id="error"></div>
                                <small class="image_type">(Height:45px,Width:45px; Image Type : jpg,jpeg,png,svg,webp)</small>
                            </div>

                            <div class="mb-3 col-md-4">
                                <label for="address" class="form-label">Address<span class="text-danger">*</span></label>
                                <textarea class="form-control" name="address" required></textarea>
                                @if ($errors->has('address')) <div class="text-danger">{{ $errors->first('address') }}</div>@endif
                                <div class="error"></div>
                            </div>

                            <div class="col-md-4">
                                <label for="address_color" class="form-label">Address Text Color</label>
                                <input type="text" class="form-control colorpicker" name="address_color" id="address_color">
                            </div>

                            <div class="col-md-4">
                                @php($fontsize = fontSize())
                                <label for="address_font_size" class="form-label">Address Text Font Size</label>
                                <select class="form-control select2" name="address_font_size">
                                    <option value="">Select</option>
                                    @for($i=$fontsize['start']; $i<=$fontsize['end']; $i+=$fontsize['range'])
                                        <option value="{{$i}}px">{{$i}}px</option>
                                    @endfor
                                </select>
                            </div>

                            <div class="col-md-4">
                                @php($fontfamily = fontFamily())
                                <label for="address_font_family" class="form-label">Address Text Font Family</label>
                                <select class="form-control select2" name="address_font_family">
                                    <option value="">Select</option>
                                    @foreach($fontfamily as $family)
                                        <option value="{{$family['key']}}">{{$family['value']}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4 mt-2 mb-2">
                                <label for="working_hour_title" class="form-label">Working Hours Title</label>
                                <input type="working_hour_title" class="form-control" name="working_hour_title" id="working_hour_title">
                                @if ($errors->has('working_hour_title')) <div class="text-danger">{{ $errors->first('working_hour_title') }}</div>@endif
                            </div>

                            <div class="col-md-4 mt-2">
                                <label for="working_hour_title_font_size" class="form-label">Working Hours Title Font Size</label>
                                <select class="form-control select2" name="working_hour_title_font_size">
                                    <option value="">-- Select --</option>
                                    @for($i=24; $i<=50; $i+=2)
                                        <option value="{{$i}}px">{{$i}}px</option>
                                    @endfor
                                </select>
                            </div>

                            <div class="col-md-4 mt-2">
                                <label for="working_hour_title_font_family" class="form-label">Working Hours Title Font Family</label>
                                <select class="form-control select2" name="working_hour_title_font_family">
                                    <option value="">-- Select --</option>
                                    @foreach($fontfamily as $family)
                                        <option value="{{$family['key']}}">{{$family['value']}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4 mt-2">
                                <label for="working_hour_title_color" class="form-label">Working Hours Title Font Color</label>
                                <input type="text" class="form-control colorpicker" name="working_hour_title_color" id="working_hour_title_color">
                            </div>

                            <div class="mb-3 col-md-4">
                                <label for="working_hours_icon" class="form-label">Working Hours Icon</label>
                                <input type="file" id="working_hours_icon" class="form-control" name="working_hours_icon">
                                @if ($errors->has('working_hours_icon')) <div class="text-danger">{{ $errors->first('working_hours_icon') }}</div>@endif
                                <div id="error"></div>
                                <small class="image_type">(Height:41px,Width:41px; Image Type : jpg,jpeg,png,svg,webp)</small>
                            </div>

                            <div class="col-md-4">
                                <label for="working_hours" class="form-label">Working Hours<span class="text-danger">*</span></label>
                                <input type="text" id="working_hours" class="form-control" name="working_hours" required>
                                @if ($errors->has('working_hours')) <div class="text-danger">{{ $errors->first('working_hours') }}</div>@endif
                                <div id="error"></div>
                            </div>

                            <div class="mb-3 col-md-4">
                                <label for="working_hours_color" class="form-label">Working Hours Text Color</label>
                                <input type="text" class="form-control colorpicker" name="working_hours_color" id="working_hours_color">
                            </div>

                            <div class="col-md-4">
                                <label for="working_hours_font_size" class="form-label">Working Hours Text Font Size</label>
                                <select class="form-control select2" name="working_hours_font_size">
                                    <option value="">Select</option>
                                    @for($i=$fontsize['start']; $i<=$fontsize['end']; $i+=$fontsize['range'])
                                        <option value="{{$i}}px">{{$i}}px</option>
                                    @endfor
                                </select>
                            </div>

                            <div class="mb-3 col-md-4">
                                <label for="working_hours_font_family" class="form-label">Working Hours Text Font Family</label>
                                <select class="form-control select2" name="working_hours_font_family">
                                    <option value="">Select</option>
                                    @foreach($fontfamily as $family)
                                        <option value="{{$family['key']}}">{{$family['value']}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4 mt-2 mb-2">
                                <label for="contact_title" class="form-label">Contact Number Title</label>
                                <input type="contact_title" class="form-control" name="contact_title" id="contact_title">
                                @if ($errors->has('contact_title')) <div class="text-danger">{{ $errors->first('contact_title') }}</div>@endif
                            </div>

                            <div class="col-md-4 mt-2">
                                <label for="contact_title_font_size" class="form-label">Contact Number Title Font Size</label>
                                <select class="form-control select2" name="contact_title_font_size">
                                    <option value="">-- Select --</option>
                                    @for($i=24; $i<=50; $i+=2)
                                        <option value="{{$i}}px">{{$i}}px</option>
                                    @endfor
                                </select>
                            </div>

                            <div class="col-md-4 mt-2">
                                <label for="contact_title_font_family" class="form-label">Contact Number Title Font Family</label>
                                <select class="form-control select2" name="contact_title_font_family">
                                    <option value="">-- Select --</option>
                                    @foreach($fontfamily as $family)
                                        <option value="{{$family['key']}}">{{$family['value']}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4 mt-2">
                                <label for="contact_title_color" class="form-label">Contact Number Title Font Color</label>
                                <input type="text" class="form-control colorpicker" name="contact_title_color" id="contact_title_color">
                            </div>

                            <div class="mb-3 col-md-4">
                                <label for="contact_number_icon" class="form-label">Contact Number Icon</label>
                                <input type="file" id="contact_number_icon" class="form-control" name="contact_number_icon">
                                @if ($errors->has('contact_number_icon')) <div class="text-danger">{{ $errors->first('contact_number_icon') }}</div>@endif
                                <div id="error"></div>
                                <small class="image_type">(Height:45px,Width:45px; Image Type : jpg,jpeg,png,svg,webp)</small>
                            </div>

                            <div class="col-md-4">
                                <label for="contact_number" class="form-label">Contact Number<span class="text-danger">*</span></label>
                                <input type="number" id="contact_number" class="form-control" name="contact_number" required>
                                @if ($errors->has('contact_number')) <div class="text-danger">{{ $errors->first('contact_number') }}</div>@endif
                                <div class="error"></div>
                            </div>

                            <div class="mb-3 col-md-4">
                                <label for="contact_number_color" class="form-label">Contact Number Text Color</label>
                                <input type="text" class="form-control colorpicker" name="contact_number_color" id="contact_number_color">
                            </div>

                            <div class="col-md-4">
                                <label for="contact_number_font_size" class="form-label">Contact Number Text Font Size</label>
                                <select class="form-control select2" name="contact_number_font_size">
                                    <option value="">Select</option>
                                    @for($i=$fontsize['start']; $i<=$fontsize['end']; $i+=$fontsize['range'])
                                        <option value="{{$i}}px">{{$i}}px</option>
                                    @endfor
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label for="contact_number_font_family" class="form-label">Contact Number Text Font Family</label>
                                <select class="form-control select2" name="contact_number_font_family">
                                    <option value="">Select</option>
                                    @foreach($fontfamily as $family)
                                        <option value="{{$family['key']}}">{{$family['value']}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4 mt-2">
                                <label for="email_title" class="form-label">Email Title</label>
                                <input type="text" class="form-control" name="email_title" id="email_title">
                                @if ($errors->has('email_title')) <div class="text-danger">{{ $errors->first('email_title') }}</div>@endif
                            </div>

                            <div class="col-md-4 mt-2">
                                <label for="email_title_font_size" class="form-label">Email Title Font Size</label>
                                <select class="form-control select2" name="email_title_font_size">
                                    <option value="">-- Select --</option>
                                    @for($i=24; $i<=50; $i+=2)
                                        <option value="{{$i}}px">{{$i}}px</option>
                                    @endfor
                                </select>
                            </div>

                            <div class="col-md-4 mt-2">
                                <label for="email_title_font_family" class="form-label">Email Title Font Family</label>
                                <select class="form-control select2" name="email_title_font_family">
                                    <option value="">-- Select --</option>
                                    @foreach($fontfamily as $family)
                                        <option value="{{$family['key']}}">{{$family['value']}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4 mt-2">
                                <label for="email_title_color" class="form-label">Email Title Font Color</label>
                                <input type="text" class="form-control colorpicker" name="email_title_color" id="email_title_color">
                            </div>

                            <div class="col-md-4">
                                <label for="email_icon" class="form-label">Email Icon</label>
                                <input type="file" id="email_icon" class="form-control" name="email_icon">
                                @if ($errors->has('email_icon')) <div class="text-danger">{{ $errors->first('email_icon') }}</div>@endif
                                <div id="error"></div>
                                <small class="image_type">(Height:45px,Width:45px; Image Type : jpg,jpeg,png,svg,webp)</small>
                            </div>

                            <div class="mb-3 col-md-4">
                                <label for="email" class="form-label">Email<span class="text-danger">*</span></label>
                                <input type="email" id="email" class="form-control" name="email" required>
                                @if ($errors->has('email')) <div class="text-danger">{{ $errors->first('email') }}</div>@endif
                                <div class="error"></div>
                            </div>

                            <div class="col-md-4">
                                <label for="email_color" class="form-label">Email Text Color</label>
                                <input type="text" class="form-control colorpicker" name="email_color" id="email_color">
                            </div>

                            <div class="col-md-4">
                                <label for="email_color" class="form-label">Email Text Font Size</label>
                                <select class="form-control select2" name="email_font_size">
                                    <option value="">Select</option>
                                    @for($i=$fontsize['start']; $i<=$fontsize['end']; $i+=$fontsize['range'])
                                        <option value="{{$i}}px">{{$i}}px</option>
                                    @endfor
                                </select>
                            </div>

                            <div class="mb-3 col-md-4">
                                <label for="email_color" class="form-label">Email Text Font Family</label>
                                <select class="form-control select2" name="email_font_family">
                                    <option value="">Select</option>
                                    @foreach($fontfamily as $family)
                                        <option value="{{$family['key']}}">{{$family['value']}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-12">
                                <h5>Facility Title :</h5>
                                <hr>
                            </div>

                            <div class="col-md-3 mt-2 mb-2">
                                <label for="facility_title" class="form-label">Facility Title</label>
                                <input type="facility_title" class="form-control" name="facility_title" id="facility_title">
                                @if ($errors->has('facility_title')) <div class="text-danger">{{ $errors->first('facility_title') }}</div>@endif
                            </div>

                            <div class="col-md-3 mt-2">
                                <label for="facility_title_font_size" class="form-label">Facility Title Font Size</label>
                                <select class="form-control select2" name="facility_title_font_size">
                                    <option value="">-- Select --</option>
                                    @for($i=24; $i<=50; $i+=2)
                                        <option value="{{$i}}px">{{$i}}px</option>
                                    @endfor
                                </select>
                            </div>

                            <div class="col-md-3 mt-2">
                                <label for="facility_title_font_family" class="form-label">Facility Title Font Family</label>
                                <select class="form-control select2" name="facility_title_font_family">
                                    <option value="">-- Select --</option>
                                    @foreach($fontfamily as $family)
                                        <option value="{{$family['key']}}">{{$family['value']}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-3 mt-2">
                                <label for="facility_title_color" class="form-label">Facility Title Font Color</label>
                                <input type="text" class="form-control colorpicker" name="facility_title_color" id="facility_title_color">
                            </div>

                            <div class="col-12">
                                <h5>Customer Gallery Title :</h5>
                                <hr>
                            </div>

                            <div class="col-md-3 mt-2 mb-2">
                                <label for="customer_gallery_title" class="form-label">Customer Gallery Title</label>
                                <input type="customer_gallery_title" class="form-control" name="customer_gallery_title" id="customer_gallery_title">
                                @if ($errors->has('customer_gallery_title')) <div class="text-danger">{{ $errors->first('customer_gallery_title') }}</div>@endif
                            </div>

                            <div class="col-md-3 mt-2">
                                <label for="customer_gallery_title_font_size" class="form-label">Customer Gallery Title Font Size</label>
                                <select class="form-control select2" name="customer_gallery_title_font_size">
                                    <option value="">-- Select --</option>
                                    @for($i=24; $i<=50; $i+=2)
                                        <option value="{{$i}}px">{{$i}}px</option>
                                    @endfor
                                </select>
                            </div>

                            <div class="col-md-3 mt-2">
                                <label for="customer_gallery_title_font_family" class="form-label">Customer Gallery Title Font Family</label>
                                <select class="form-control select2" name="customer_gallery_title_font_family">
                                    <option value="">-- Select --</option>
                                    @foreach($fontfamily as $family)
                                        <option value="{{$family['key']}}">{{$family['value']}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-3 mt-2">
                                <label for="customer_gallery_title_color" class="form-label">Customer Gallery Title Font Color</label>
                                <input type="text" class="form-control colorpicker" name="customer_gallery_title_color" id="customer_gallery_title_color">
                            </div>

                            <div class="col-md-4 mt-2">
                                <label for="lets_connect_image" class="form-label">Let's Connect Image</label>
                                <input type="file" id="lets_connect_image" class="form-control" name="lets_connect_image" value="">
                                @if ($errors->has('lets_connect_image')) <div class="text-danger">{{ $errors->first('lets_connect_image') }}</div>@endif
                                <div class="error"></div>
                                <small class="image_type">(Hight:444,Width:351; Image Type : jpg,jpeg,png,svg,webp)</small>
                            </div>

                            <div class="col-12">
                                <h5>Testimonial Title :</h5>
                                <hr>
                            </div>

                            <div class="col-md-3 mt-2 mb-2">
                                <label for="testimonial_title" class="form-label">Testimonial Title</label>
                                <input type="testimonial_title" class="form-control" name="testimonial_title" id="testimonial_title">
                                @if ($errors->has('testimonial_title')) <div class="text-danger">{{ $errors->first('testimonial_title') }}</div>@endif
                            </div>

                            <div class="col-md-3 mt-2">
                                <label for="testimonial_title_font_size" class="form-label">Testimonial Title Font Size</label>
                                <select class="form-control select2" name="testimonial_title_font_size">
                                    <option value="">-- Select --</option>
                                    @for($i=24; $i<=50; $i+=2)
                                        <option value="{{$i}}px">{{$i}}px</option>
                                    @endfor
                                </select>
                            </div>

                            <div class="col-md-3 mt-2">
                                <label for="testimonial_title_font_family" class="form-label">Testimonial Title Font Family</label>
                                <select class="form-control select2" name="testimonial_title_font_family">
                                    <option value="">-- Select --</option>
                                    @foreach($fontfamily as $family)
                                        <option value="{{$family['key']}}">{{$family['value']}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-3 mt-2">
                                <label for="testimonial_title_color" class="form-label">Testimonial Title Font Color</label>
                                <input type="text" class="form-control colorpicker" name="testimonial_title_color" id="testimonial_title_color">
                            </div>

                            <div class="col-12">
                                <h5> Slider Section :</h5>
                                <hr>
                            </div>

                            <div class="mb-3 col-md-4">
                                <label for="slider_image" class="form-label">Slider Image</label>
                                <input type="file" id="slider_image" class="form-control" name="slider_image">
                                @if ($errors->has('slider_image')) <div class="text-danger">{{ $errors->first('slider_image') }}</div>@endif
                                <div id="error"></div>
                                <small class="image_type">(Height:243px,Width:325px; Image Type : jpg,jpeg,png,svg,webp)</small>
                            </div>

                            <div class="col-md-4">
                                <label for="slider_showroom_name" class="form-label">Slider Showroom Name</label>
                                <input type="text" id="slider_showroom_name" class="form-control" name="slider_showroom_name">
                            </div>

                            <div class="mb-3 col-md-4">
                                <label for="slider_showroom_name_color" class="form-label">Slider Showroom Text Color</label>
                                <input type="text" id="slider_showroom_name_color" class="form-control colorpicker" name="slider_showroom_name_color">
                            </div>

                            <div class="col-md-4 mb-2">
                                @php($fontsize = fontSize())
                                <label for="slider_showroom_name_font_size" class="form-label">Slider Showroom Text Font Size</label>
                                <select class="form-control select2" name="slider_showroom_name_font_size">
                                    <option value="">Select</option>
                                    @for($i=$fontsize['start']; $i<=$fontsize['end']; $i+=$fontsize['range'])
                                        <option value="{{$i}}px">{{$i}}px</option>
                                    @endfor
                                </select>
                            </div>

                            <div class="col-md-4">
                                @php($fontfamily = fontFamily())
                                <label for="slider_showroom_name_font_family" class="form-label">Slider Showroom Text Font Family</label>
                                <select class="form-control select2" name="slider_showroom_name_font_family">
                                    <option value="">Select</option>
                                    @foreach($fontfamily as $family)
                                        <option value="{{$family['key']}}">{{$family['value']}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4 mt-2">
                                <label for="rating" class="form-label">Rating<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="rating" id="rating" required>
                                @if ($errors->has('rating')) <div class="text-danger">{{ $errors->first('rating') }}</div>@endif
                                <div id="error"></div>
                            </div>

                            <div class="col-md-4 mb-2">
                                <label for="number_of_rating" class="form-label">Number of Rating<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" maxlength="5" name="number_of_rating" id="number_of_rating" required>
                                @if ($errors->has('number_of_rating')) <div class="text-danger">{{ $errors->first('number_of_rating') }}</div>@endif
                                <div id="error"></div>
                            </div>

                            <div class="col-md-4 mb-2">
                                <label for="map_link">Map Link</label>
                                <input type="text" id="map_link" class="form-control" name="map_link">
                            </div>

                            <div class="col-md-4 mb-3">
								<label for="meta_title">Meta Title</label>
								<input type="text" class="form-control" name="meta_title">
							</div>

							<div class="col-md-4">
								<label for="meta_keyword">Meta Keyword</label>
								<textarea class="form-control" name="meta_keyword"></textarea>
							</div>

							<div class="col-md-4 mb-3">
								<label for="meta_description">Meta Description</label>
								<textarea class="form-control" name="meta_description"></textarea>
								<div class="error"></div>
							</div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary submit">Submit</button>
                            <a href="{{ route('showroom_list') }}" class="btn btn-danger">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
@section('javascript')
<script src="{{ asset('plugins/parsley/parsley.js') }}"></script>
<script src="{{asset('public/plugins/ckeditor/ckeditor.js')}}"  type="text/javascript"></script>
<script>
    $(document).ready(function () {
        CKEDITOR.replace('description', {
            height:300,
        });

        $('#brand_id').change(function () {
            var brand_id = $(this).val();
            if (brand_id) {
                $.ajax({
                    type: "GET",
                    url: "{{ route('getcars') }}",
                    data: { brand_id: brand_id },
                    success: function (cars) {
                        $('#car_id').empty();
                        $('#car_id').append('<option disabled>Select</option>');
                        $.each(cars, function (key, car) {
                            $('#car_id').append('<option value="' + car.id + '">' + car.name + '</option>');
                        });
                    }
                });
            } else {
                $('#car_id').empty();
            }
        });

        // $(".showroom_form").validate({
        //     rules: {
        //         'our_business_id': {
        //             required: true,
        //         },
        //         'slider_image': {
        //             extension: "jpg,jpeg,png,webp,svg",
        //         },
        //         'image': {
        //             extension: "jpg,jpeg,png,webp,svg",
        //         },
        //         'name': {
        //             required: true,
        //         },
        //         'brand_id': {
        //             required: true,
        //         },
        //         'car_id[]': { 
        //             required: true,
        //         },
        //         'address': {
        //             required: true,
        //         },
        //         'working_hours': {
        //             required: true,
        //         },
        //         'contact_number': {
        //             required: true,
        //             maxlength:"10",
        //             minlength:"10",
        //         },
        //         'email': {
        //             required: true,
        //         },
        //         'address_icon': {
        //             extension: "jpg,jpeg,png,webp,svg",
        //         },
        //         'working_hours_icon': {
        //             extension: "jpg,jpeg,png,webp,svg",
        //         },
        //         'contact_number_icon': {
        //             extension: "jpg,jpeg,png,webp,svg",
        //         },
        //         'email_icon': {
        //             extension: "jpg,jpeg,png,webp,svg",
        //         },
        //         'rating': {
        //             required: true,
        //             number: true,
        //             max: 5
        //         },
        //         'number_of_rating': {
        //             required: true,
        //             number: true,
        //         },
        //     },
          
        //     errorPlacement: function(error, element) {
        //         if(element.attr("name") == "our_business_id"){
        //             error.appendTo('#errorbusinessdiv');
        //             return;
        //         }
        //         if(element.attr("name") == "brand_id"){
        //             error.appendTo('#errordiv');
        //             return;
        //         }
        //         if(element.attr("name") == "car_id[]"){
        //             error.appendTo('#errorcardiv');
        //             return;
        //         }
        //         if(element.attr("name") == "name"){
        //                 error.appendTo('#error');
        //                 return;
        //         }else {
        //             error.insertAfter(element);
        //         }
        //     },
        //     submitHandler: function(form) {
        //         $(form).find('.submit').prop("disabled", true);
        //         form.submit();
        //     }
        // });

        $('.colorpicker').colorpicker();
    });
</script>
@endsection