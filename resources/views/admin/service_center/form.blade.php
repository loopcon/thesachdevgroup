@extends('admin.layout.header')
@section('css')
    <link class="js-stylesheet" href="{{ url('public/plugins/select2/css/select2.css') }}" rel="stylesheet">
    <link class="js-stylesheet" href="{{ url('public/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <link type="text/css" class="js-stylesheet" href="{{ url('public/plugins/parsley/parsley.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                @include('admin.alerts')
            </div>
          <div class="col-sm-6">
            <h1>{{$site_title}}</h1>
          </div>
        </div>
      </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <form action="@if(isset($record->id)) {{ route('service-center-update', array('id' => encrypt($record->id))) }} @else{{ route('service-center-store') }} @endif" method="POST" class="service-center-form" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-4 adm-brand-errorbox">
                                <label for="business_id" class="form-label">Our Business<span class="text-danger">*</span></label>
                                <select class="form-control select2" name="business_id" id="business_id" required="">
                                    <option value="">-- Select Business --</option>
                                    @foreach($business as $value)
                                        <option value="{{$value->id}}" @if(isset($record->business_id) && $record->business_id == $value->id){{'selected'}} @endif>{{$value->title}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('business_id')) <div class="text-danger">{{ $errors->first('business_id') }}</div>@endif
                            </div>

                            <div class="col-md-4 adm-select-car-drop">
                                <label for="service_id" class="form-label">Service<span class="text-danger">*</span></label>
                                <select class="form-control select2" name="service_id[]" id="service_id" required="" multiple>
                                    <option value="" disabled>-- Select Service --</option>
                                    @foreach($services as $value)
                                    <option value="{{$value->id}}"@if(isset($record->service_id) && in_array($value->id, json_decode($record->service_id)) == $value->id){{'selected'}}@endif>{{$value->name}}</option>
                                    @endforeach
                                </select>
                                <div id="error"></div>
                                @if ($errors->has('service_id')) <div class="text-danger">{{ $errors->first('service_id') }}</div>@endif
                            </div>

                            <div class="col-md-4">
                                <label for="name" class="form-label">Name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="name" required="" name="name" value="{{isset($record->name) ? $record->name : old('name')}}">
                                @if ($errors->has('name')) <div class="text-danger">{{ $errors->first('name') }}</div>@endif
                                <div class="error"></div>
                            </div>

                            <div class="col-md-4">
                                <label for="name_color" class="form-label">Name Color</label>
                                <input type="text" id="name_color" class="form-control colorpicker" name="name_color" value="{{isset($record->name_color) ? $record->name_color : old('name_color')}}">
                            </div>

                            <div class="col-md-4">
                                <label for="name_font_size" class="form-label">Name Font Size</label>
                                <select class="form-control select2" name="name_font_size">
                                    <option value="">Select</option>
                                    @for($i=24; $i<=50; $i+=2)
                                        <option value="{{$i}}px" @if(isset($record->name_font_size) && $record->name_font_size == $i.'px'){{'selected'}}@endif>{{$i}}px</option>
                                    @endfor
                                </select>
                            </div>

                            @php($fontfamily = fontFamily())
                            <div class="col-md-4 mt-2">
                                <label for="name_font_family" class="form-label">Name Font Family</label>
                                <select class="form-control select2" name="name_font_family">
                                    <option value="">Select</option>
                                    @foreach($fontfamily as $family)
                                        <option value="{{$family['key']}}" @if(isset($record->name_font_family) && $record->name_font_family == $family['key']){{'selected'}}@endif>{{$family['value']}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4 mt-2">
                                <label for="image" class="form-label">Banner Image</label>
                                @if(isset($record->image) && $record->image)
                                    <img src="{{url('public/uploads/service_center/'.$record->image)}}" width="100">
                                @endif  
                                <input type="file" id="image" class="form-control" name="image" value="">
                                @if ($errors->has('image')) <div class="text-danger">{{ $errors->first('image') }}</div>@endif
                                <div class="error"></div>
                                <small class="image_type">(Hight:1349,Width:281; Image Type : jpg,jpeg,png,svg,webp)</small>
                            </div>

                            <div class="col-md-4 mt-2">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" name="description" id="description">{{isset($record->description) ? $record->description : old('description')}}</textarea>
                            </div>

                            <div class="col-md-4 mt-2">
                                <label for="description_font_size" class="form-label">Description Font Size</label>
                                <select class="form-control select2" name="description_font_size">
                                    <option value="">-- Select --</option>
                                    @for($i=24; $i<=50; $i+=2)
                                        <option value="{{$i}}px" @if(isset($record->description_font_size) && $record->description_font_size == $i.'px'){{'selected'}}@endif>{{$i}}px</option>
                                    @endfor
                                </select>
                            </div>

                            <div class="col-md-4 mt-2">
                                <label for="description_font_family" class="form-label">Description Font Family</label>
                                <select class="form-control select2" name="description_font_family">
                                    <option value="">-- Select --</option>
                                    @foreach($fontfamily as $family)
                                        <option value="{{$family['key']}}" @if(isset($record->description_font_family) && $record->description_font_family == $family['key']){{'selected'}}@endif>{{$family['value']}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4 mt-2">
                                <label for="description_font_color" class="form-label">Description Font Color</label>
                                <input type="text" class="form-control colorpicker" value="{{isset($record->description_font_color) ? $record->description_font_color : old('description_font_color')}}" name="description_font_color" id="description_font_color">
                            </div>

                            <div class="col-md-4 mt-2">
                                <label for="address" class="form-label">Address<span class="text-danger">*</span></label>
                                <textarea class="form-control" name="address" required="" id="address">{{isset($record->address) ? $record->address : old('address')}}</textarea>
                                @if ($errors->has('address')) <div class="text-danger">{{ $errors->first('address') }}</div>@endif
                            </div> 

                            <div class="col-md-4 mt-2">
                                <label for="image" class="form-label">Address Icon</label>
                                @if(isset($record->address_icon) && $record->address_icon)
                                    <img src="{{url('public/uploads/address_icon/'.$record->address_icon)}}" width="100">
                                @endif  
                                <input type="file" id="address_icon" class="form-control" name="address_icon" value="">
                                @if ($errors->has('address_icon')) <div class="text-danger">{{ $errors->first('address_icon') }}</div>@endif
                                <div class="error"></div>
                                <small class="image_type">(Hight:40,Width:40; Image Type : jpg,jpeg,png,svg,webp)</small>
                            </div>

                            <div class="col-md-4 mt-2">
                                <label for="address_font_size" class="form-label">Address Font Size</label>
                                <select class="form-control select2" name="address_font_size">
                                    <option value="">Select</option>
                                    @for($i=24; $i<=50; $i+=2)
                                        <option value="{{$i}}px" @if(isset($record->address_font_size) && $record->address_font_size == $i.'px'){{'selected'}}@endif>{{$i}}px</option>
                                    @endfor
                                </select>
                            </div>

                            <div class="col-md-4 mt-2">
                                <label for="address_font_family" class="form-label">Address Font Family</label>
                                <select class="form-control select2" name="address_font_family">
                                    <option value="">-- Select --</option>
                                    @foreach($fontfamily as $family)
                                        <option value="{{$family['key']}}" @if(isset($record->address_font_family) && $record->address_font_family == $family['key']){{'selected'}}@endif>{{$family['value']}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4 mt-2">
                                <label for="address_font_color" class="form-label">Address Font Color</label>
                                <input type="text" class="form-control colorpicker" value="{{isset($record->address_font_color) ? $record->address_font_color : old('address_font_color')}}" name="address_font_color" id="address_font_color">
                            </div>

                            <div class="col-md-4 mt-2">
                                <label for="working_hours" class="form-label">Working Hours</label>
                                <input type="text" class="form-control" value="{{isset($record->working_hours) ? $record->working_hours : old('working_hours')}}" name="working_hours" id="working_hours">
                            </div>

                            <div class="col-md-4 mt-2">
                                <label for="working_hours_icon" class="form-label">Working Hours Icon</label>
                                @if(isset($record->working_hours_icon) && $record->working_hours_icon)
                                    <img src="{{url('public/uploads/working_hours_icon/'.$record->working_hours_icon)}}" width="100">
                                @endif  
                                <input type="file" id="working_hours_icon" class="form-control" name="working_hours_icon" value="">
                                <div class="error"></div>
                                <small class="image_type">(Hight:40,Width:40; Image Type : jpg,jpeg,png,svg,webp)</small>
                            </div>

                            <div class="col-md-4 mt-2">
                                <label for="working_hours_font_size" class="form-label">Working Hours Font Size</label>
                                <select class="form-control select2" name="working_hours_font_size">
                                    <option value="">-- Select --</option>
                                    @for($i=24; $i<=50; $i+=2)
                                        <option value="{{$i}}px" @if(isset($record->working_hours_font_size) && $record->working_hours_font_size == $i.'px'){{'selected'}}@endif>{{$i}}px</option>
                                    @endfor
                                </select>
                            </div>

                            <div class="col-md-4 mt-2">
                                <label for="working_hours_font_family" class="form-label">Working Hours Font Family</label>
                                <select class="form-control select2" name="working_hours_font_family">
                                    <option value="">-- Select --</option>
                                    @foreach($fontfamily as $family)
                                        <option value="{{$family['key']}}" @if(isset($record->working_hours_font_family) && $record->working_hours_font_family == $family['key']){{'selected'}}@endif>{{$family['value']}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4 mt-2">
                                <label for="working_hours_font_color" class="form-label">Working Hours Font Color</label>
                                <input type="text" class="form-control colorpicker" value="{{isset($record->working_hours_font_color) ? $record->working_hours_font_color : old('working_hours_font_color')}}" name="working_hours_font_color" id="working_hours_font_color">
                            </div>

                            <div class="col-md-4 mt-2">
                                <label for="contact_number" class="form-label">Contact Number<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" required="" maxlength="10" minlength="10" value="{{isset($record->contact_number) ? $record->contact_number : old('contact_number')}}" name="contact_number" id="contact_number">
                                @if ($errors->has('contact_number')) <div class="text-danger">{{ $errors->first('contact_number') }}</div>@endif
                            </div>

                            <div class="col-md-4 mt-2">
                                <label for="contact_icon" class="form-label">Contact Number Icon</label>
                                @if(isset($record->contact_icon) && $record->contact_icon)
                                    <img src="{{url('public/uploads/contact_icon/'.$record->contact_icon)}}" width="100">
                                @endif  
                                <input type="file" id="contact_icon" class="form-control" name="contact_icon" value="">
                                @if ($errors->has('contact_icon')) <div class="text-danger">{{ $errors->first('contact_icon') }}</div>@endif
                                <div class="error"></div>
                                <small class="image_type">(Hight:40,Width:40; Image Type : jpg,jpeg,png,svg,webp)</small>
                            </div>

                            <div class="col-md-4 mt-2">
                                <label for="contact_font_size" class="form-label">Contact Number Font Size</label>
                                <select class="form-control select2" name="contact_font_size">
                                    <option value="">-- Select --</option>
                                    @for($i=24; $i<=50; $i+=2)
                                        <option value="{{$i}}px" @if(isset($record->contact_font_size) && $record->contact_font_size == $i.'px'){{'selected'}}@endif>{{$i}}px</option>
                                    @endfor
                                </select>
                            </div>

                            <div class="col-md-4 mt-2">
                                <label for="contact_font_family" class="form-label">Contact Number Font Family</label>
                                <select class="form-control select2" name="contact_font_family">
                                    <option value="">-- Select --</option>
                                    @foreach($fontfamily as $family)
                                        <option value="{{$family['key']}}" @if(isset($record->contact_font_family) && $record->contact_font_family == $family['key']){{'selected'}}@endif>{{$family['value']}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4 mt-2">
                                <label for="contact_font_color" class="form-label">Contact Number Font Color</label>
                                <input type="text" class="form-control colorpicker" value="{{isset($record->contact_font_color) ? $record->contact_font_color : old('contact_font_color')}}" name="contact_font_color" id="contact_font_color">
                            </div>

                            <div class="col-md-4 mt-2">
                                <label for="email" class="form-label">Email<span class="text-danger">*</span></label>
                                <input type="email" class="form-control" value="{{isset($record->email) ? $record->email : old('email')}}" name="email" id="email">
                                @if ($errors->has('email')) <div class="text-danger">{{ $errors->first('email') }}</div>@endif
                            </div>

                            <div class="col-md-4 mt-2">
                                <label for="email_font_size" class="form-label">Email Font Size</label>
                                <select class="form-control select2" name="email_font_size">
                                    <option value="">-- Select --</option>
                                    @for($i=24; $i<=50; $i+=2)
                                        <option value="{{$i}}px" @if(isset($record->email_font_size) && $record->email_font_size == $i.'px'){{'selected'}}@endif>{{$i}}px</option>
                                    @endfor
                                </select>
                            </div>

                            <div class="col-md-4 mt-2">
                                <label for="email_font_family" class="form-label">Email Font Family</label>
                                <select class="form-control select2" name="email_font_family">
                                    <option value="">-- Select --</option>
                                    @foreach($fontfamily as $family)
                                        <option value="{{$family['key']}}" @if(isset($record->email_font_family) && $record->email_font_family == $family['key']){{'selected'}}@endif>{{$family['value']}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4 mt-2">
                                <label for="email_font_color" class="form-label">Email Font Color</label>
                                <input type="text" class="form-control colorpicker" value="{{isset($record->email_font_color) ? $record->email_font_color : old('email_font_color')}}" name="email_font_color" id="email_font_color">
                            </div>

                            <div class="col-md-4 mb-3 mt-2">
                                <label for="email_icon" class="form-label">Email Icon</label>
                                @if(isset($record->email_icon) && $record->email_icon)
                                    <img src="{{url('public/uploads/email_icon/'.$record->email_icon)}}" width="100">
                                @endif  
                                <input type="file" id="email_icon" class="form-control" name="email_icon" value="">
                                @if ($errors->has('email_icon')) <div class="text-danger">{{ $errors->first('email_icon') }}</div>@endif
                                <small class="image_type">(Hight:40,Width:40; Image Type : jpg,jpeg,png,svg,webp)</small>
                            </div>

                            <div class="col-md-4 mt-2">
                                <label for="rating" class="form-label">Rating<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" required="" value="{{isset($record->rating) ? $record->rating : old('rating')}}" name="rating" id="rating">
                                @if ($errors->has('rating')) <div class="text-danger">{{ $errors->first('rating') }}</div>@endif
                            </div>

                            <div class="col-md-4 mt-2">
                                <label for="number_of_rating" class="form-label">Number of Rating<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" required="" maxlength="5" value="{{isset($record->number_of_rating) ? $record->number_of_rating : old('number_of_rating')}}" name="number_of_rating" id="number_of_rating">
                                @if ($errors->has('number_of_rating')) <div class="text-danger">{{ $errors->first('number_of_rating') }}</div>@endif
                            </div>

                            <div class="col-md-4">
                                <label for="slider_service_center_name" class="form-label">Slider Service Center Name</label>
                                <input type="text" class="form-control" id="slider_service_center_name" name="slider_service_center_name" value="{{isset($record->slider_service_center_name) ? $record->slider_service_center_name : old('slider_service_center_name')}}">
                                @if ($errors->has('slider_service_center_name')) <div class="text-danger">{{ $errors->first('slider_service_center_name') }}</div>@endif
                            </div>

                            <div class="col-md-4">
                                <label for="slider_service_center_name_color" class="form-label">Slider Service Center Name Color</label>
                                <input type="text" id="slider_service_center_name_color" class="form-control colorpicker" name="slider_service_center_name_color" value="{{isset($record->slider_service_center_name_color) ? $record->slider_service_center_name_color : old('slider_service_center_name_color')}}">
                            </div>

                            <div class="col-md-4">
                                <label for="slider_service_center_name_size" class="form-label">Slider Service Center Name Font Size</label>
                                <select class="form-control select2" name="slider_service_center_name_size">
                                    <option value="">Select</option>
                                    @for($i=24; $i<=50; $i+=2)
                                        <option value="{{$i}}px" @if(isset($record->slider_service_center_name_size) && $record->slider_service_center_name_size == $i.'px'){{'selected'}}@endif>{{$i}}px</option>
                                    @endfor
                                </select>
                            </div>

                            @php($fontfamily = fontFamily())
                            <div class="col-md-4 mt-2">
                                <label for="slider_service_center_name_font_family" class="form-label">Slider Service Center Name Font Family</label>
                                <select class="form-control select2" name="slider_service_center_name_font_family">
                                    <option value="">Select</option>
                                    @foreach($fontfamily as $family)
                                        <option value="{{$family['key']}}" @if(isset($record->slider_service_center_name_font_family) && $record->slider_service_center_name_font_family == $family['key']){{'selected'}}@endif>{{$family['value']}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="slider_image" class="form-label">Slider Image</label>
                                @if(isset($record->slider_image) && $record->slider_image)
                                    <img src="{{url('public/uploads/service_center/slider_image/'.$record->slider_image)}}" width="100">
                                @endif  
                                <input type="file" id="slider_image" class="form-control" name="slider_image" value="">
                                @if ($errors->has('slider_image')) <div class="text-danger">{{ $errors->first('slider_image') }}</div>@endif
                                <small class="image_type">(Hight:243,Width:325; Image Type : jpg,jpeg,png,svg,webp)</small>
                            </div>

                            <?php /* <div class="col-12">
                                <h5>Why Choose Section</h5>
                                <hr>
                            </div>

                            <div class="col-md-6 mb-2">
                                <label for="why_choose_title" class="form-label">Why Choose Title</label>
                                <input type="text" class="form-control" value="{{isset($record->why_choose_title) ? $record->why_choose_title : old('why_choose_title')}}" name="why_choose_title" id="why_choose_title">
                            </div>

                            <div class="col-md-6 mb-2">
                                <label for="why_choose_image" class="form-label">Why Choose Image</label>&nbsp;<small>(Image Type : jpg,jpeg,png,webp)</small>
                                @if(isset($record->why_choose_image) && $record->why_choose_image)
                                    <img src="{{url('public/uploads/why_choose_image/'.$record->why_choose_image)}}" width="100">
                                @endif  
                                <input type="file" id="why_choose_image" class="form-control" name="why_choose_image" value="">
                                @if ($errors->has('why_choose_image')) <div class="text-danger">{{ $errors->first('why_choose_image') }}</div>@endif
                                <div class="error"></div>
                            </div>

                            <div class="col-md-12 mb-2">
                                <label for="why_choose_description" class="form-label">Why Choose Description</label>
                                <textarea class="ckeditor form-control" value="{{isset($record->why_choose_description) ? $record->why_choose_description : old('why_choose_description')}}" name="why_choose_description" id="why_choose_description"></textarea>
                            </div> */ ?>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary submit">Submit</button>
                            <a href="{{ route('service-center') }}" class="btn btn-danger">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
@section('javascript')
<script type="text/javascript" src="{{ url('public/plugins/parsley/parsley.js') }}"></script>
<script src="{{ url('public/plugins/select2/js/select2.js') }}"></script>
<script>
    $(document).ready(function () {
        $('.select2').select2({ width: '100%' });

        $(".service-center-form").validate({
            rules: {
                'rating': {
                    number: true,
                },
                'number_of_rating': {
                    number: true,
                },
            //     'service_id': {
            //         required: true,
            //     },
            //     'address': {
            //         required: true,
            //     },
            //     'email': {
            //         required: true,
            //     },
            // },
            // messages: {
            //     'name': {
            //         required: "Name is required",
            //     },
            //     'service_id': {
            //         required: "Service is required",
            //     },
            //     'business_id': {
            //         required: "Our Business is required",
            //     },
            //     'address': {
            //         required: "Address is required",
            //     },
            //     'email': {
            //         required: "Email is required",
            //     },
            },
            submitHandler: function(form) {
                $(form).find('.submit').prop("disabled", true);
                form.submit();
            }
        });

        $('.colorpicker').colorpicker();
    });
</script>
@endsection