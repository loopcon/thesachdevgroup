@extends('admin.layout.header')
@section('css')
    <link type="text/css" class="js-stylesheet" href="{{ url('public/plugins/parsley/parsley.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
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
                    <form action="@if(isset($record->id)) {{ route('body_shop_update', array('id' => encrypt($record->id))) }} @else{{ route('body_shop_insert') }} @endif" method="POST" class="service-center-form" enctype="multipart/form-data" data-parsley-validate="">
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-md-4">
                                <label for="business_id" class="form-label">Our Business<span class="text-danger">*</span></label>
                                <select class="form-control select2" name="business_id" id="business_id" required>
                                    <option value="">-- Select Our Business --</option>
                                    @if(isset($our_business) && $our_business->count())
                                        @foreach($our_business as $value)
                                            <option value="{{$value->id}}"@if(isset($record->business_id) && $record->business_id == $value->id){{'selected'}}@endif>{{$value->title}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <div class="error"></div>
                                @if($errors->has('business_id')) <div class="text-danger">{{ $errors->first('business_id')}}</div> @endif
                            </div>

                            <div class="mb-3 col-md-4">
                                <label for="image" class="form-label">Image<span class="text-danger">*</span></label>
                                <input type="hidden" name="old_image" id="old_image" value="{{isset($record->image) ? $record->image : old('old_image')}}">
                                @if(isset($record->image) && $record->image)
                                    <img src="{{url('public/body_shop_image/'.$record->image)}}" width="50" style="margin-bottom: 10px; margin-left: 5px;">
                                @endif  
                                <input type="file" id="image" class="form-control" name="image">
                                @if($errors->has('image')) <div class="text-danger">{{ $errors->first('image')}}</div> @endif
                                <div class="error"></div>
                                <small class="image_type">(Height:243px,Width:325px; Image Type : jpg,jpeg,png,svg,webp)</small>
                            </div>

                            <div class="col-md-4">
                                <label for="name" class="form-label">Name<span class="text-danger">*</span></label>
                                <input type="text" id="name" class="form-control" name="name" value="{{isset($record->name) ? $record->name : old('name')}}" required>
                                @if($errors->has('name')) <div class="text-danger">{{ $errors->first('name')}}</div> @endif
                                <div class="error"></div>
                            </div>

                            <div class="col-md-4">
                                <label for="name_color" class="form-label">Name Text Color</label>
                                <input type="text" class="form-control colorpicker" name="name_color" id="name_color" value="{{isset($record->name_color) ? $record->name_color : old('name_color')}}">
                            </div>

                            <div class="mb-3 col-md-4">
                                @php($fontsize = fontSize())
                                <label for="name_font_size" class="form-label">Name Text Font Size</label>
                                <select class="form-control select2" name="name_font_size">
                                    <option value="">Select</option>
                                    @for($i=$fontsize['start']; $i<=$fontsize['end']; $i+=$fontsize['range'])
                                        <option value="{{$i}}px" @if(isset($record->name_font_size) && $record->name_font_size == $i.'px'){{'selected'}}@endif>{{$i}}px</option>
                                    @endfor
                               </select>
                            </div>

                            <div class="col-md-4">
                                @php($fontfamily = fontFamily())
                                <label for="name_font_family" class="form-label">Name Text Font Family</label>
                                <select class="form-control select2" name="name_font_family">
                                    <option value="">Select</option>
                                    @foreach($fontfamily as $family)
                                        <option value="{{$family['key']}}" @if(isset($record->name_font_family) && $record->name_font_family == $family['key']){{'selected'}}@endif>{{$family['value']}}</option>
                                    @endforeach
                               </select>
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

                            <div class="col-md-4 adm-select-car-drop">
                                <label for="car_model_id" class="form-label">Select Car<span class="text-danger">*</span></label>
                                <select name="car_model_id[]" id="car_model_id" class="form-control select2" required multiple>
                                    <option value="" disabled>Select</option>
                                    @foreach($cars as $car)
                                        <option value="{{$car->id}}"@if(isset($record->car_model_id) && in_array($car->id,json_decode($record->car_model_id)) == $car->id) {{'selected'}} @endif>{{$car->name}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('car_model_id')) <div class="text-danger">{{ $errors->first('car_model_id') }}</div>@endif
                            </div>

                            <div class="col-md-4 mt-2 mb-2">
                                <label for="address_title" class="form-label">Address Title</label>
                                <input type="address_title" class="form-control" value="{{isset($record->address_title) ? $record->address_title : old('address_title')}}" name="address_title" id="address_title">
                                @if ($errors->has('address_title')) <div class="text-danger">{{ $errors->first('address_title') }}</div>@endif
                            </div>

                            <div class="col-md-4 mt-2">
                                <label for="address_title_font_size" class="form-label">Address Title Font Size</label>
                                <select class="form-control select2" name="address_title_font_size">
                                    <option value="">-- Select --</option>
                                    @for($i=24; $i<=50; $i+=2)
                                        <option value="{{$i}}px" @if(isset($record->address_title_font_size) && $record->address_title_font_size == $i.'px'){{'selected'}}@endif>{{$i}}px</option>
                                    @endfor
                                </select>
                            </div>

                            <div class="col-md-4 mt-2">
                                <label for="address_title_font_family" class="form-label">Address Title Font Family</label>
                                <select class="form-control select2" name="address_title_font_family">
                                    <option value="">-- Select --</option>
                                    @foreach($fontfamily as $family)
                                        <option value="{{$family['key']}}" @if(isset($record->address_title_font_family) && $record->address_title_font_family == $family['key']){{'selected'}}@endif>{{$family['value']}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4 mt-2">
                                <label for="address_title_color" class="form-label">Address Title Font Color</label>
                                <input type="text" class="form-control colorpicker" value="{{isset($record->address_title_color) ? $record->address_title_color : old('address_title_color')}}" name="address_title_color" id="address_title_color">
                            </div> 

                            <div class="col-md-4 mt-2">
                                <label for="image" class="form-label">Address Icon</label>
                                @if(isset($record->address_icon) && $record->address_icon)
                                    <img src="{{url('public/uploads/body_shop_address_icon/'.$record->address_icon)}}" width="50">
                                @endif  
                                <input type="file" id="address_icon" class="form-control" name="address_icon" value="">
                                @if ($errors->has('address_icon')) <div class="text-danger">{{ $errors->first('address_icon') }}</div>@endif
                                <div class="error"></div>
                                <small class="image_type">(Hight:40px,Width:40px; Image Type : jpg,jpeg,png,svg,webp)</small>
                            </div>

                            <div class="col-md-4">
                                <label for="address" class="form-label">Address<span class="text-danger">*</span></label>
                                <textarea class="form-control" name="address" id="address" required>{{isset($record->address) ? $record->address : old('address')}}</textarea>
                                @if($errors->has('address')) <div class="text-danger">{{ $errors->first('address')}}</div> @endif
                                <div class="error"></div>
                            </div>

                            <div class="col-md-4">
                                <label for="address_font_color" class="form-label">Address Font Color</label>
                                <input type="text" class="form-control colorpicker" name="address_font_color" id="address_font_color" value="{{isset($record->address_font_color) ? $record->address_font_color : old('address_font_color')}}">
                            </div>

                            <div class="mb-3 col-md-4">
                                @php($fontsize = fontSize())
                                <label for="address_font_size" class="form-label">Address Font Size</label>
                                <select class="form-control select2" name="address_font_size">
                                    <option value="">Select</option>
                                    @for($i=$fontsize['start']; $i<=$fontsize['end']; $i+=$fontsize['range'])
                                        <option value="{{$i}}px" @if(isset($record->address_font_size) && $record->address_font_size == $i.'px'){{'selected'}}@endif>{{$i}}px</option>
                                    @endfor
                               </select>
                            </div>

                            <div class="col-md-4">
                                @php($fontfamily = fontFamily())
                                <label for="address_font_family" class="form-label">Address Font Family</label>
                                <select class="form-control select2" name="address_font_family">
                                    <option value="">Select</option>
                                    @foreach($fontfamily as $family)
                                        <option value="{{$family['key']}}" @if(isset($record->address_font_family) && $record->address_font_family == $family['key']){{'selected'}}@endif>{{$family['value']}}</option>
                                    @endforeach
                               </select>
                            </div>

                            <div class="col-md-4 mt-2">
                                <label for="working_hours" class="form-label">Working Hours</label>
                                <input type="text" class="form-control" value="{{isset($record->working_hours) ? $record->working_hours : old('working_hours')}}" name="working_hours" id="working_hours">
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

                            <div class="col-md-4 mt-2 mb-2">
                                <label for="working_hour_title" class="form-label">Working Hours Title</label>
                                <input type="working_hour_title" class="form-control" value="{{isset($record->working_hour_title) ? $record->working_hour_title : old('working_hour_title')}}" name="working_hour_title" id="working_hour_title">
                                @if ($errors->has('working_hour_title')) <div class="text-danger">{{ $errors->first('working_hour_title') }}</div>@endif
                            </div>

                            <div class="col-md-4 mt-2">
                                <label for="working_hour_title_font_size" class="form-label">Working Hours Title Font Size</label>
                                <select class="form-control select2" name="working_hour_title_font_size">
                                    <option value="">-- Select --</option>
                                    @for($i=24; $i<=50; $i+=2)
                                        <option value="{{$i}}px" @if(isset($record->working_hour_title_font_size) && $record->working_hour_title_font_size == $i.'px'){{'selected'}}@endif>{{$i}}px</option>
                                    @endfor
                                </select>
                            </div>

                            <div class="col-md-4 mt-2">
                                <label for="working_hour_title_font_family" class="form-label">Working Hours Title Font Family</label>
                                <select class="form-control select2" name="working_hour_title_font_family">
                                    <option value="">-- Select --</option>
                                    @foreach($fontfamily as $family)
                                        <option value="{{$family['key']}}" @if(isset($record->working_hour_title_font_family) && $record->working_hour_title_font_family == $family['key']){{'selected'}}@endif>{{$family['value']}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4 mt-2">
                                <label for="working_hour_title_color" class="form-label">Working Hours Title Font Color</label>
                                <input type="text" class="form-control colorpicker" value="{{isset($record->working_hour_title_color) ? $record->working_hour_title_color : old('working_hour_title_color')}}" name="working_hour_title_color" id="working_hour_title_color">
                            </div>

                            <div class="col-md-4 mt-2">
                                <label for="working_hours_icon" class="form-label">Working Hours Icon</label>
                                @if(isset($record->working_hours_icon) && $record->working_hours_icon)
                                    <img src="{{url('public/uploads/body_shop_working_hours_icon/'.$record->working_hours_icon)}}" width="50">
                                @endif  
                                <input type="file" id="working_hours_icon" class="form-control" name="working_hours_icon" value="">
                                <div class="error"></div>
                                <small class="image_type">(Hight:40px,Width:40px; Image Type : jpg,jpeg,png,svg,webp)</small>
                            </div>

                            <div class="col-md-4 mt-2 mb-2">
                                <label for="contact_title" class="form-label">Contact Number Title</label>
                                <input type="contact_title" class="form-control" value="{{isset($record->contact_title) ? $record->contact_title : old('contact_title')}}" name="contact_title" id="contact_title">
                                @if ($errors->has('contact_title')) <div class="text-danger">{{ $errors->first('contact_title') }}</div>@endif
                            </div>

                            <div class="col-md-4 mt-2">
                                <label for="contact_title_font_size" class="form-label">Contact Number Title Font Size</label>
                                <select class="form-control select2" name="contact_title_font_size">
                                    <option value="">-- Select --</option>
                                    @for($i=24; $i<=50; $i+=2)
                                        <option value="{{$i}}px" @if(isset($record->contact_title_font_size) && $record->contact_title_font_size == $i.'px'){{'selected'}}@endif>{{$i}}px</option>
                                    @endfor
                                </select>
                            </div>

                            <div class="col-md-4 mt-2">
                                <label for="contact_title_font_family" class="form-label">Contact Number Title Font Family</label>
                                <select class="form-control select2" name="contact_title_font_family">
                                    <option value="">-- Select --</option>
                                    @foreach($fontfamily as $family)
                                        <option value="{{$family['key']}}" @if(isset($record->contact_title_font_family) && $record->contact_title_font_family == $family['key']){{'selected'}}@endif>{{$family['value']}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4 mt-2">
                                <label for="contact_title_color" class="form-label">Contact Number Title Font Color</label>
                                <input type="text" class="form-control colorpicker" value="{{isset($record->contact_title_color) ? $record->contact_title_color : old('contact_title_color')}}" name="contact_title_color" id="contact_title_color">
                            </div>

                            <div class="col-md-4 mt-2">
                                <label for="contact_icon" class="form-label">Contact Number Icon</label>
                                @if(isset($record->contact_icon) && $record->contact_icon)
                                    <img src="{{url('public/uploads/body_shop_contact_icon/'.$record->contact_icon)}}" width="50">
                                @endif  
                                <input type="file" id="contact_icon" class="form-control" name="contact_icon" value="">
                                @if ($errors->has('contact_icon')) <div class="text-danger">{{ $errors->first('contact_icon') }}</div>@endif
                                <div class="error"></div>
                                <small class="image_type">(Hight:40px,Width:40px; Image Type : jpg,jpeg,png,svg,webp)</small>
                            </div>

                            <div class="col-md-4 mt-2">
                                <label for="email_title" class="form-label">Email Title</label>
                                <input type="text" class="form-control" value="{{isset($record->email_title) ? $record->email_title : old('email_title')}}" name="email_title" id="email_title">
                                @if ($errors->has('email_title')) <div class="text-danger">{{ $errors->first('email_title') }}</div>@endif
                            </div>

                            <div class="col-md-4 mt-2">
                                <label for="email_title_font_size" class="form-label">Email Title Font Size</label>
                                <select class="form-control select2" name="email_title_font_size">
                                    <option value="">-- Select --</option>
                                    @for($i=24; $i<=50; $i+=2)
                                        <option value="{{$i}}px" @if(isset($record->email_title_font_size) && $record->email_title_font_size == $i.'px'){{'selected'}}@endif>{{$i}}px</option>
                                    @endfor
                                </select>
                            </div>

                            <div class="col-md-4 mt-2">
                                <label for="email_title_font_family" class="form-label">Email Title Font Family</label>
                                <select class="form-control select2" name="email_title_font_family">
                                    <option value="">-- Select --</option>
                                    @foreach($fontfamily as $family)
                                        <option value="{{$family['key']}}" @if(isset($record->email_title_font_family) && $record->email_title_font_family == $family['key']){{'selected'}}@endif>{{$family['value']}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4 mt-2">
                                <label for="email_title_color" class="form-label">Email Title Font Color</label>
                                <input type="text" class="form-control colorpicker" value="{{isset($record->email_title_color) ? $record->email_title_color : old('email_title_color')}}" name="email_title_color" id="email_title_color">
                            </div>

                            <div class="col-md-4 mb-3 mt-2">
                                <label for="email_icon" class="form-label">Email Icon</label>
                                @if(isset($record->email_icon) && $record->email_icon)
                                    <img src="{{url('public/uploads/body_shop_email_icon/'.$record->email_icon)}}" width="50">
                                @endif  
                                <input type="file" id="email_icon" class="form-control" name="email_icon" value="">
                                @if ($errors->has('email_icon')) <div class="text-danger">{{ $errors->first('email_icon') }}</div>@endif
                                <small class="image_type">(Hight:40px,Width:40px; Image Type : jpg,jpeg,png,svg,webp)</small>
                            </div>

                            <div class="col-md-4">
                                <label for="email" class="form-label">Email<span class="text-danger">*</span></label>
                                <input type="email" class="form-control" name="email" value="{{isset($record->email) ? $record->email : old('email')}}" id="email" required>
                                <div class="error"></div>
                                @if($errors->has('email')) <div class="text-danger">{{ $errors->first('email')}}</div> @endif
                            </div>

                            <div class="col-md-4">
                                <label for="email_font_color" class="form-label">Email Font Color</label>
                                <input type="text" class="form-control colorpicker" name="email_font_color" id="email_font_color" value="{{isset($record->email_font_color) ? $record->email_font_color : old('email_font_color')}}">
                            </div>

                            <div class="mb-3 col-md-4">
                                @php($fontsize = fontSize())
                                <label for="email_font_size" class="form-label">Email Font Size</label>
                                <select class="form-control select2" name="email_font_size">
                                    <option value="">Select</option>
                                    @for($i=$fontsize['start']; $i<=$fontsize['end']; $i+=$fontsize['range'])
                                        <option value="{{$i}}px" @if(isset($record->email_font_size) && $record->email_font_size == $i.'px'){{'selected'}}@endif>{{$i}}px</option>
                                    @endfor
                               </select>
                            </div>

                            <div class="col-md-4">
                                @php($fontfamily = fontFamily())
                                <label for="email_font_family" class="form-label">Email Font Family</label>
                                <select class="form-control select2" name="email_font_family">
                                    <option value="">Select</option>
                                    @foreach($fontfamily as $family)
                                        <option value="{{$family['key']}}" @if(isset($record->email_font_family) && $record->email_font_family == $family['key']){{'selected'}}@endif>{{$family['value']}}</option>
                                    @endforeach
                               </select>
                            </div>

                            <div class="col-md-4 mt-2">
                                <label for="contact_number" class="form-label">Contact Number<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" required="" maxlength="10" minlength="10" value="{{isset($record->contact_number) ? $record->contact_number : old('contact_number')}}" name="contact_number" id="contact_number">
                                <div class="error"></div>
                                @if ($errors->has('contact_number')) <div class="text-danger">{{ $errors->first('contact_number') }}</div>@endif
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

                            <div class="col-md-4 mt-2 mb-2">
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

                            <div class="col-md-4">
                                <label for="link" class="form-label">Link</label>
                                <input type="text" id="link" class="form-control" name="link" value="{{isset($record->link) ? $record->link : old('link')}}">
                                <div class="error"></div>
                            </div>

                            <div class="mb-3 col-md-4">
                                <label for="rating" class="form-label">Rating<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="rating" id="rating" value="{{isset($record->rating) ? $record->rating : old('rating')}}">
                                @if($errors->has('rating')) <div class="text-danger">{{ $errors->first('rating')}}</div> @endif
                                <div class="error"></div>
                            </div>

                            <div class="col-md-4 mt-2">
                                <label for="number_of_rating" class="form-label">Number of Rating<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" required="" maxlength="5" value="{{isset($record->number_of_rating) ? $record->number_of_rating : old('number_of_rating')}}" name="number_of_rating" id="number_of_rating">
                                <div class="error"></div>
                                @if ($errors->has('number_of_rating')) <div class="text-danger">{{ $errors->first('number_of_rating') }}</div>@endif
                            </div>

                            <div class="col-12">
                                <h5>Facility Title :</h5>
                                <hr>
                            </div>

                            <div class="col-md-3 mt-2 mb-2">
                                <label for="facility_title" class="form-label">Facility Title</label>
                                <input type="facility_title" class="form-control" value="{{isset($record->facility_title) ? $record->facility_title : old('facility_title')}}" name="facility_title" id="facility_title">
                                @if ($errors->has('facility_title')) <div class="text-danger">{{ $errors->first('facility_title') }}</div>@endif
                            </div>

                            <div class="col-md-3 mt-2">
                                <label for="facility_title_font_size" class="form-label">Facility Title Font Size</label>
                                <select class="form-control select2" name="facility_title_font_size">
                                    <option value="">-- Select --</option>
                                    @for($i=24; $i<=50; $i+=2)
                                        <option value="{{$i}}px" @if(isset($record->facility_title_font_size) && $record->facility_title_font_size == $i.'px'){{'selected'}}@endif>{{$i}}px</option>
                                    @endfor
                                </select>
                            </div>

                            <div class="col-md-3 mt-2">
                                <label for="facility_title_font_family" class="form-label">Facility Title Font Family</label>
                                <select class="form-control select2" name="facility_title_font_family">
                                    <option value="">-- Select --</option>
                                    @foreach($fontfamily as $family)
                                        <option value="{{$family['key']}}" @if(isset($record->facility_title_font_family) && $record->facility_title_font_family == $family['key']){{'selected'}}@endif>{{$family['value']}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-3 mt-2">
                                <label for="facility_title_color" class="form-label">Facility Title Font Color</label>
                                <input type="text" class="form-control colorpicker" value="{{isset($record->facility_title_color) ? $record->facility_title_color : old('facility_title_color')}}" name="facility_title_color" id="facility_title_color">
                            </div>

                            <div class="col-12">
                                <h5>Customer Gallery Title :</h5>
                                <hr>
                            </div>

                            <div class="col-md-3 mt-2 mb-2">
                                <label for="customer_gallery_title" class="form-label">Customer Gallery Title</label>
                                <input type="customer_gallery_title" class="form-control" value="{{isset($record->customer_gallery_title) ? $record->customer_gallery_title : old('customer_gallery_title')}}" name="customer_gallery_title" id="customer_gallery_title">
                                @if ($errors->has('customer_gallery_title')) <div class="text-danger">{{ $errors->first('customer_gallery_title') }}</div>@endif
                            </div>

                            <div class="col-md-3 mt-2">
                                <label for="customer_gallery_title_font_size" class="form-label">Customer Gallery Title Font Size</label>
                                <select class="form-control select2" name="customer_gallery_title_font_size">
                                    <option value="">-- Select --</option>
                                    @for($i=24; $i<=50; $i+=2)
                                        <option value="{{$i}}px" @if(isset($record->customer_gallery_title_font_size) && $record->customer_gallery_title_font_size == $i.'px'){{'selected'}}@endif>{{$i}}px</option>
                                    @endfor
                                </select>
                            </div>

                            <div class="col-md-3 mt-2">
                                <label for="customer_gallery_title_font_family" class="form-label">Customer Gallery Title Font Family</label>
                                <select class="form-control select2" name="customer_gallery_title_font_family">
                                    <option value="">-- Select --</option>
                                    @foreach($fontfamily as $family)
                                        <option value="{{$family['key']}}" @if(isset($record->customer_gallery_title_font_family) && $record->customer_gallery_title_font_family == $family['key']){{'selected'}}@endif>{{$family['value']}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-3 mt-2">
                                <label for="customer_gallery_title_color" class="form-label">Customer Gallery Title Font Color</label>
                                <input type="text" class="form-control colorpicker" value="{{isset($record->customer_gallery_title_color) ? $record->customer_gallery_title_color : old('customer_gallery_title_color')}}" name="customer_gallery_title_color" id="customer_gallery_title_color">
                            </div>

                            <div class="col-md-4 mt-2">
                                <label for="lets_connect_image" class="form-label">Let's Connect Image</label>
                                @if(isset($record->lets_connect_image) && $record->lets_connect_image)
                                    <img src="{{url('public/uploads/body_shop/lets_connect_image/'.$record->lets_connect_image)}}" width="50">
                                @endif  
                                <input type="file" id="lets_connect_image" class="form-control" name="lets_connect_image" value="">
                                @if ($errors->has('lets_connect_image')) <div class="text-danger">{{ $errors->first('lets_connect_image') }}</div>@endif
                                <div class="error"></div>
                                <small class="image_type">(Hight:444px,Width:351px; Image Type : jpg,jpeg,png,svg,webp)</small>
                            </div>

                            <div class="col-12">
                                <h5>Testimonial Title :</h5>
                                <hr>
                            </div>

                            <div class="col-md-3 mt-2 mb-2">
                                <label for="testimonial_title" class="form-label">Testimonial Title</label>
                                <input type="testimonial_title" class="form-control" value="{{isset($record->testimonial_title) ? $record->testimonial_title : old('testimonial_title')}}" name="testimonial_title" id="testimonial_title">
                                @if ($errors->has('testimonial_title')) <div class="text-danger">{{ $errors->first('testimonial_title') }}</div>@endif
                            </div>

                            <div class="col-md-3 mt-2">
                                <label for="testimonial_title_font_size" class="form-label">Testimonial Title Font Size</label>
                                <select class="form-control select2" name="testimonial_title_font_size">
                                    <option value="">-- Select --</option>
                                    @for($i=24; $i<=50; $i+=2)
                                        <option value="{{$i}}px" @if(isset($record->testimonial_title_font_size) && $record->testimonial_title_font_size == $i.'px'){{'selected'}}@endif>{{$i}}px</option>
                                    @endfor
                                </select>
                            </div>

                            <div class="col-md-3 mt-2">
                                <label for="testimonial_title_font_family" class="form-label">Testimonial Title Font Family</label>
                                <select class="form-control select2" name="testimonial_title_font_family">
                                    <option value="">-- Select --</option>
                                    @foreach($fontfamily as $family)
                                        <option value="{{$family['key']}}" @if(isset($record->testimonial_title_font_family) && $record->testimonial_title_font_family == $family['key']){{'selected'}}@endif>{{$family['value']}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-3 mt-2">
                                <label for="testimonial_title_color" class="form-label">Testimonial Title Font Color</label>
                                <input type="text" class="form-control colorpicker" value="{{isset($record->testimonial_title_color) ? $record->testimonial_title_color : old('testimonial_title_color')}}" name="testimonial_title_color" id="testimonial_title_color">
                            </div>

                            <div class="col-md-4 mb-2">
                                <label for="map_link">Map Link</label>
                                <input type="text" id="map_link" class="form-control" name="map_link" value="{{isset($record->map_link) ? $record->map_link : old('map_link')}}">
                            </div>

                            <div class="col-md-4 mb-2">
                                <label for="meta_title">Meta Title</label>
                                <input type="text" id="meta_title" class="form-control" name="meta_title" value="{{isset($record->meta_title) ? $record->meta_title : old('meta_title')}}">
                            </div>

                            <div class="col-md-4">
                                <label for="meta_keyword">Meta Keyword</label>
                                <textarea class="form-control" name="meta_keyword">{{isset($record->meta_keyword) ? $record->meta_keyword : old('mera_keyword')}}</textarea>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="meta_description">Meta Description</label>
                                <textarea class="form-control" name="meta_description">{{isset($record->meta_description) ? $record->meta_description : old('meta_description')}}</textarea>
                                <div class="error"></div>
                            </div>
                        </div> 

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary submit">Submit</button>
                            <a href="{{ route('body_shop') }}" class="btn btn-danger">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
@section('javascript')
<script src="{{ url('public/plugins/parsley/parsley.js') }}"></script>
<script>
 $(document).ready(function () {
        // $(".body_shop_form").validate({
        //     rules: {
        //         'business_id': {
        //             required: true,
        //         },
        //         'image': {
        //             required: checkImage,
        //             extension: "jpg,jpeg,png,webp,svg",
        //         },
        //         'address': {
        //             required: true,
        //         },
        //         'name': {
        //             required: true,
        //         },
        //         'link': {
        //             url: "url",
        //         },
        //         'rating': {
        //             required: true,
        //             number: true,
        //             max: 5
        //         },
        //         'email': {
        //             required: true,
        //         },
        //         'number_of_rating': {
        //             required: true,
        //             number: true,
        //         },
        //     },
        //     // messages: {
        //     //     'business_id': {
        //     //         required: "The Business field is required.",
        //     //     },
        //     //     'image': {
        //     //         required: "The image field is required.",
        //     //         extension: "Image must be jpg,jpeg,png,svg or webp.",
        //     //     },
        //     //     'name': {
        //     //         required: "The name field is required.",
        //     //     },
        //     //     'link': {
        //     //         url: "Please enter a valid link.",
        //     //     },
        //     //     'rating': {
        //     //         required: "The rating field is required.",
        //     //         max: "The rating must not be greater than 5."
        //     //     },
        //     //     'number_of_rating': {
        //     //         required: "The number of rating field is required.",
        //     //     },
        //     // },
        //     errorPlacement: function(error, element) {
        //         error.appendTo(element.parent().find('.error'));
        //     },
        //     submitHandler: function(form) {
        //         $(form).find('.submit').prop("disabled", true);
        //         form.submit();
        //     }
        // });

        // function checkImage() {
        //     var old_image = $('#old_image').val();
        //     var image = $('#image').val();

        //     if(old_image != '' || image != ''){
        //         return false;
        //     }
        //     return true;
        // }

        var old_image = $('#old_image').val();
        var image = $('#image').val();
        if(old_image != '' || image != ''){
            document.getElementById("image").required = false;
        }else{
            document.getElementById("image").required = true;
        }

        $('.colorpicker').colorpicker();
    });
</script>
@endsection