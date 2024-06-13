@extends('admin.layout.header')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h1>Showroom Edit</h1>
          </div>
        </div>
      </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    @foreach($showrooms as $showroom)
                        <form method="post" action="{{ route('showroom_update', $showroom->id) }}" class="edit_form" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" value="{{ $showroom->id }}" class="id" name="id">
                            <div class="row">
                                <div class="mb-3 col-md-4">
                                    <label for="our_business_id" class="form-label">Our Business<span class="text-danger">*</span></label>
                                    <select name="our_business_id" id="our_business_id" class="form-control select2">
                                        <option selected="selected" disabled="disabled">Select</option>
                                        @foreach($our_business as $our_busines)
                                            <option value="{{$our_busines->id}}" {{$showroom->our_business_id == $our_busines->id  ? 'selected' : ''}}>
                                                {{$our_busines->title}}
                                            </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('our_business_id')) <div class="text-danger">{{ $errors->first('our_business_id') }}</div>@endif
                                </div>

                                <div class="mb-3 col-md-4">
                                    <label for="image" class="form-label">Image</label>
                                    @if(isset($showroom->image) && isset($showroom->image))
                                        <img src="{{url('public/showrooms_image/'.$showroom->image)}}" width="100" style="margin-bottom:10px; margin-left:10px;">
                                    @endif
                                    <input type="file" id="image" class="form-control" name="image">
                                    <small class="image_type">(Height:281px,Width:1349px; Image Type : jpg,jpeg,png,svg,webp)</small>
                                </div>

                                <div class="col-md-4">
                                    <label for="name" class="form-label">Showroom Name<span class="text-danger">*</span></label>
                                    <input type="text" id="name" class="form-control" name="name" value="{{$showroom->name}}">
                                    @if ($errors->has('name')) <div class="text-danger">{{ $errors->first('name') }}</div>@endif
                                    <div id="error"></div>
                                </div>

                                <div class="col-md-4">
                                    <label for="name_color" class="form-label">Showroom Name Text Color</label>
                                    <input type="text" class="form-control colorpicker" name="name_color" id="name_color" value="{{$showroom->name_color}}">
                                </div>

                                <div class="mb-3 col-md-4">
                                    @php($fontsize = fontSize())
                                    <label for="name_font_size" class="form-label">Showroom Name Text Font Size</label>
                                    <select class="form-control select2" name="name_font_size">
                                        <option value="">Select</option>
                                        @for($i=$fontsize['start']; $i<=$fontsize['end']; $i+=$fontsize['range'])
                                            <option value="{{$i}}px" {{$showroom->name_font_size == $i.'px' ? 'selected' : ''}}>{{$i}}px</option>
                                        @endfor
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    @php($fontfamily = fontFamily())
                                    <label for="name_font_family" class="form-label">Showroom Name Text Font Family</label>
                                    <select class="form-control select2" name="name_font_family">
                                        <option value="">Select</option>
                                        @foreach($fontfamily as $family)
                                            <option value="{{$family['key']}}" {{$showroom->name_font_family == $family['key'] ? 'selected' : ''}}>{{$family['value']}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-12 mt-2 mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="ckeditor form-control" name="description">{{$showroom->description}}</textarea>
                                    <div class="error"></div>
                                </div>

                                <div class="mb-3 col-md-4">
                                    <label for="description_color" class="form-label">Description Text Color</label>
                                    <input type="text" class="form-control colorpicker" name="description_color" id="description_color" value="{{$showroom->description_color}}">
                                    <div class="error"></div>
                                </div>

                                <div class="col-md-4 mt-2">
                                    <label for="description_font_size">Description Text Font Size</label>
                                    <select class="form-control select2" name="description_font_size">
                                        <option value="">Select</option>
                                        @for($i=$fontsize['start']; $i<=$fontsize['end']; $i+=$fontsize['range'])
                                            <option value="{{$i}}px" {{$showroom->description_font_size == $i.'px' ? 'selected' : ''}}>{{$i}}px</option>
                                        @endfor
                                    </select>
                                </div>

                                <div class="col-md-4 mt-2" >
                                    <label for="description_font_family">Description Text Font Family</label>
                                    <select class="form-control select2" name="description_font_family">
                                        <option value="">Select</option>
                                        @foreach($fontfamily as $family)
                                            <option value="{{$family['key']}}" {{$showroom->description_font_family == $family['key'] ? 'selected' : ''}}>{{$family['value']}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label for="brand_id" class="form-label">Select Brand<span class="text-danger">*</span></label>
                                    <select name="brand_id" id="brand_id" class="form-control select2">
                                        <option value="">Select</option>
                                        @foreach($brands as $brand)
                                            <option value="{{$brand->id}}" {{$showroom->brand_id == $brand->id  ? 'selected' : ''}}>
                                                {{$brand->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('brand_id')) <div class="text-danger">{{ $errors->first('brand_id') }}</div>@endif
                                </div>

                                <div class="col-md-4 adm-select-car-drop">
                                    <label for="car_id" class="form-label">Select Car<span class="text-danger">*</span></label>
                                    <select name="car_id[]" id="car_id" class="form-control select2" multiple>
                                        <option disabled>Select</option>
                                        @foreach($cars as $car)
                                            <option value="{{$car->id}}" {{ in_array($car->id, json_decode($showroom->car_id)) ? 'selected' : '' }}>
                                                {{$car->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('car_id')) <div class="text-danger">{{ $errors->first('car_id') }}</div>@endif
                                    <div id="errorcardiv"></div>
                                </div>

                                <div class="col-md-4 mt-2 mb-2">
                                    <label for="address_title" class="form-label">Address Title</label>
                                    <input type="address_title" class="form-control" value="{{isset($showroom->address_title) ? $showroom->address_title : old('address_title')}}" name="address_title" id="address_title">
                                    @if ($errors->has('address_title')) <div class="text-danger">{{ $errors->first('address_title') }}</div>@endif
                                </div>

                                <div class="col-md-4 mt-2">
                                    <label for="address_title_font_size" class="form-label">Address Title Font Size</label>
                                    <select class="form-control select2" name="address_title_font_size">
                                        <option value="">-- Select --</option>
                                        @for($i=24; $i<=50; $i+=2)
                                            <option value="{{$i}}px" {{$showroom->address_title_font_size == $i.'px' ? 'selected' : ''}}>{{$i}}px</option>
                                        @endfor
                                    </select>
                                </div>

                                <div class="col-md-4 mt-2">
                                    <label for="address_title_font_family" class="form-label">Address Title Font Family</label>
                                    <select class="form-control select2" name="address_title_font_family">
                                        <option value="">-- Select --</option>
                                        @foreach($fontfamily as $family)
                                            <option value="{{$family['key']}}" {{$showroom->address_title_font_family == $family['key'] ? 'selected' : ''}}>{{$family['value']}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-4 mt-2">
                                    <label for="address_title_color" class="form-label">Address Title Font Color</label>
                                    <input type="text" class="form-control colorpicker" value="{{isset($showroom->address_title_color) ? $showroom->address_title_color : old('address_title_color')}}" name="address_title_color" id="address_title_color">
                                </div>

                                <div class="col-md-4">
                                    <label for="address_icon" class="form-label">Address Icon<span class="text-danger">*</span></label>
                                    @if(isset($showroom->address_icon) && isset($showroom->address_icon))
                                        <img src="{{url('public/showrooms_address_icon/'.$showroom->address_icon)}}" width="100" style="margin-bottom:10px; margin-left:10px;">
                                    @endif
                                    <input type="file" id="address_icon" class="form-control" name="address_icon">
                                    <div id="error"></div>
                                    <small class="image_type">(Height:45px,Width:45px; Image Type : jpg,jpeg,png,svg,webp)</small>
                                </div>

                                <div class="mb-3 col-md-4">
                                    <label for="address" class="form-label">Address<span class="text-danger">*</span></label>
                                    <textarea class="form-control" name="address">{{$showroom->address}}</textarea>
                                    @if ($errors->has('address')) <div class="text-danger">{{ $errors->first('address') }}</div>@endif
                                    <div class="error"></div>
                                </div>

                                <div class="col-md-4">
                                    <label for="address_color" class="form-label">Address Text Color</label>
                                    <input type="text" class="form-control colorpicker" name="address_color" id="address_color" value="{{$showroom->address_color}}">
                                </div>

                                <div class="mb-3 col-md-4">
                                    @php($fontsize = fontSize())
                                    <label for="address_font_size" class="form-label">Address Text Font Size</label>
                                    <select class="form-control select2" name="address_font_size">
                                        <option value="">Select</option>
                                        @for($i=$fontsize['start']; $i<=$fontsize['end']; $i+=$fontsize['range'])
                                            <option value="{{$i}}px" {{$showroom->address_font_size == $i.'px' ? 'selected' : ''}}>{{$i}}px</option>
                                        @endfor
                                    </select>
                                </div>

                                <div class="mb-3 col-md-4">
                                    @php($fontfamily = fontFamily())
                                    <label for="address_font_family" class="form-label">Address Text Font Family</label>
                                    <select class="form-control select2" name="address_font_family">
                                        <option value="">Select</option>
                                        @foreach($fontfamily as $family)
                                            <option value="{{$family['key']}}" {{$showroom->address_font_family == $family['key'] ? 'selected' : ''}}>{{$family['value']}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-4 mt-2 mb-2">
                                    <label for="working_hour_title" class="form-label">Working Hours Title</label>
                                    <input type="working_hour_title" class="form-control" value="{{isset($showroom->working_hour_title) ? $showroom->working_hour_title : old('working_hour_title')}}" name="working_hour_title" id="working_hour_title">
                                    @if ($errors->has('working_hour_title')) <div class="text-danger">{{ $errors->first('working_hour_title') }}</div>@endif
                                </div>

                                <div class="col-md-4 mt-2">
                                    <label for="working_hour_title_font_size" class="form-label">Working Hours Title Font Size</label>
                                    <select class="form-control select2" name="working_hour_title_font_size">
                                        <option value="">-- Select --</option>
                                        @for($i=24; $i<=50; $i+=2)
                                            <option value="{{$i}}px" {{$showroom->working_hour_title_font_size == $i.'px' ? 'selected' : ''}}>{{$i}}px</option>
                                        @endfor
                                    </select>
                                </div>

                                <div class="col-md-4 mt-2">
                                    <label for="working_hour_title_font_family" class="form-label">Working Hours Title Font Family</label>
                                    <select class="form-control select2" name="working_hour_title_font_family">
                                        <option value="">-- Select --</option>
                                        @foreach($fontfamily as $family)
                                            <option value="{{$family['key']}}" {{$showroom->working_hour_title_font_family == $family['key'] ? 'selected' : ''}}>{{$family['value']}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-4 mt-2">
                                    <label for="working_hour_title_color" class="form-label">Working Hours Title Font Color</label>
                                    <input type="text" class="form-control colorpicker" value="{{isset($showroom->working_hour_title_color) ? $showroom->working_hour_title_color : old('working_hour_title_color')}}" name="working_hour_title_color" id="working_hour_title_color">
                                </div>

                                <div class="mb-3 col-md-4">
                                    <label for="working_hours_icon" class="form-label">Working Hours Icon<span class="text-danger">*</span></label>
                                    @if(isset($showroom->working_hours_icon) && isset($showroom->working_hours_icon))
                                        <img src="{{url('public/showrooms_working_hours_icon/'.$showroom->working_hours_icon)}}" width="100" style="margin-bottom:10px; margin-left:10px;">
                                    @endif
                                    <input type="file" id="working_hours_icon" class="form-control" name="working_hours_icon">
                                    @if ($errors->has('working_hours_icon')) <div class="text-danger">{{ $errors->first('working_hours_icon') }}</div>@endif
                                    <div id="error"></div>
                                    <small class="image_type">(Height:41px,Width:41px; Image Type : jpg,jpeg,png,svg,webp)</small>
                                </div>

                                <div class="col-md-4">
                                    <label for="working_hours" class="form-label">Working Hours<span class="text-danger">*</span></label>
                                    <input  type="text" class="form-control" name="working_hours" value="{{$showroom->working_hours}}">
                                    @if ($errors->has('working_hours')) <div class="text-danger">{{ $errors->first('working_hours') }}</div>@endif
                                    <div id="error"></div>
                                </div>

                                <div class="mb-3 col-md-4">
                                    <label for="working_hours_color" class="form-label">Working Hours Text Color</label>
                                    <input type="text" class="form-control colorpicker" name="working_hours_color" id="working_hours_color" value="{{$showroom->working_hours_color}}">
                                </div>

                                <div class="mb-3 col-md-4">
                                    <label for="working_hours_font_size" class="form-label">Working Hours Text Font Size</label>
                                    <select class="form-control select2" name="working_hours_font_size">
                                        <option value="">Select</option>
                                        @for($i=$fontsize['start']; $i<=$fontsize['end']; $i+=$fontsize['range'])
                                            <option value="{{$i}}px" {{$showroom->working_hours_font_size == $i.'px' ? 'selected' : ''}}>{{$i}}px</option>
                                        @endfor
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label for="working_hours_font_family" class="form-label">Working Hours Text Font Family</label>
                                    <select class="form-control select2" name="working_hours_font_family">
                                        <option value="">Select</option>
                                        @foreach($fontfamily as $family)
                                            <option value="{{$family['key']}}" {{$showroom->working_hours_font_family == $family['key'] ? 'selected' : ''}}>{{$family['value']}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-4 mt-2 mb-2">
                                    <label for="contact_title" class="form-label">Contact Number Title</label>
                                    <input type="contact_title" class="form-control" value="{{isset($showroom->contact_title) ? $showroom->contact_title : old('contact_title')}}" name="contact_title" id="contact_title">
                                    @if ($errors->has('contact_title')) <div class="text-danger">{{ $errors->first('contact_title') }}</div>@endif
                                </div>

                                <div class="col-md-4 mt-2">
                                    <label for="contact_title_font_size" class="form-label">Contact Number Title Font Size</label>
                                    <select class="form-control select2" name="contact_title_font_size">
                                        <option value="">-- Select --</option>
                                        @for($i=24; $i<=50; $i+=2)
                                            <option value="{{$i}}px" {{$showroom->contact_title_font_size == $i.'px' ? 'selected' : ''}}>{{$i}}px</option>
                                        @endfor
                                    </select>
                                </div>

                                <div class="col-md-4 mt-2">
                                    <label for="contact_title_font_family" class="form-label">Contact Number Title Font Family</label>
                                    <select class="form-control select2" name="contact_title_font_family">
                                        <option value="">-- Select --</option>
                                        @foreach($fontfamily as $family)
                                            <option value="{{$family['key']}}" {{$showroom->contact_title_font_family == $family['key'] ? 'selected' : ''}}>{{$family['value']}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-4 mt-2">
                                    <label for="contact_title_color" class="form-label">Contact Number Title Font Color</label>
                                    <input type="text" class="form-control colorpicker" value="{{isset($showroom->contact_title_color) ? $showroom->contact_title_color : old('contact_title_color')}}" name="contact_title_color" id="contact_title_color">
                                </div>

                                <div class="col-md-4">
                                    <label for="contact_number_icon" class="form-label">Contact Number Icon<span class="text-danger">*</span></label>
                                    @if(isset($showroom->contact_number_icon) && isset($showroom->contact_number_icon))
                                        <img src="{{url('public/showrooms_contact_number_icon/'.$showroom->contact_number_icon)}}" width="100" style="margin-bottom:10px; margin-left:10px;">
                                    @endif
                                    <input type="file" id="contact_number_icon" class="form-control" name="contact_number_icon">
                                    <div id="error"></div>
                                    <small class="image_type">(Height:41px,Width:41px; Image Type : jpg,jpeg,png,svg,webp)</small>
                                </div>

                                <div class="mb-3 col-md-4">
                                    <label for="contact_number" class="form-label">Contact Number<span class="text-danger">*</span></label>
                                    <input type="number" id="contact_number" class="form-control" name="contact_number" value="{{$showroom->contact_number}}">
                                    @if ($errors->has('contact_number')) <div class="text-danger">{{ $errors->first('contact_number') }}</div>@endif
                                    <div class="error"></div>
                                </div>

                                <div class="mb-3 col-md-4">
                                    <label for="contact_number_color" class="form-label">Contact Number Text Color</label>
                                    <input type="text" class="form-control colorpicker" name="contact_number_color" id="contact_number_color" value="{{$showroom->contact_number_color}}">
                                </div>

                                <div class="col-md-4">
                                    <label for="contact_number_font_size" class="form-label">Contact Number Text Font Size</label>
                                    <select class="form-control select2" name="contact_number_font_size">
                                        <option value="">Select</option>
                                        @for($i=$fontsize['start']; $i<=$fontsize['end']; $i+=$fontsize['range'])
                                            <option value="{{$i}}px" {{$showroom->contact_number_font_size == $i.'px' ? 'selected' : ''}}>{{$i}}px</option>
                                        @endfor
                                    </select>
                                </div>
                       
                                <div class="mb-3 col-md-4">
                                    <label for="contact_number_font_family" class="form-label">Contact Number Text Font Family</label>
                                    <select class="form-control select2" name="contact_number_font_family">
                                        <option value="">Select</option>
                                        @foreach($fontfamily as $family)
                                            <option value="{{$family['key']}}" {{$showroom->contact_number_font_family == $family['key'] ? 'selected' : ''}}>{{$family['value']}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-4 mt-2">
                                    <label for="email_title" class="form-label">Email Title</label>
                                    <input type="text" class="form-control" value="{{isset($showroom->email_title) ? $showroom->email_title : old('email_title')}}" name="email_title" id="email_title">
                                    @if ($errors->has('email_title')) <div class="text-danger">{{ $errors->first('email_title') }}</div>@endif
                                </div>

                                <div class="col-md-4 mt-2">
                                    <label for="email_title_font_size" class="form-label">Email Title Font Size</label>
                                    <select class="form-control select2" name="email_title_font_size">
                                        <option value="">-- Select --</option>
                                        @for($i=24; $i<=50; $i+=2)
                                            <option value="{{$i}}px" {{$showroom->email_title_font_size == $i.'px' ? 'selected' : ''}}>{{$i}}px</option>
                                        @endfor
                                    </select>
                                </div>

                                <div class="col-md-4 mt-2">
                                    <label for="email_title_font_family" class="form-label">Email Title Font Family</label>
                                    <select class="form-control select2" name="email_title_font_family">
                                        <option value="">-- Select --</option>
                                        @foreach($fontfamily as $family)
                                            <option value="{{$family['key']}}" {{$showroom->email_title_font_family == $family['key'] ? 'selected' : ''}}>{{$family['value']}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-4 mt-2">
                                    <label for="email_title_color" class="form-label">Email Title Font Color</label>
                                    <input type="text" class="form-control colorpicker" value="{{isset($showroom->email_title_color) ? $showroom->email_title_color : old('email_title_color')}}" name="email_title_color" id="email_title_color">
                                </div>

                                <div class="col-md-4">
                                    <label for="email_icon" class="form-label">Email Icon<span class="text-danger">*</span></label>
                                    @if(isset($showroom->email_icon) && isset($showroom->email_icon))
                                        <img src="{{url('public/showrooms_email_icon/'.$showroom->email_icon)}}" width="100" style="margin-bottom:10px; margin-left:10px;">
                                    @endif
                                    <input type="file" id="email_icon" class="form-control" name="email_icon">
                                    @if ($errors->has('email_icon')) <div class="text-danger">{{ $errors->first('email_icon') }}</div>@endif
                                    <div id="error"></div>
                                    <small class="image_type">(Height:41px,Width:41px; Image Type : jpg,jpeg,png,svg,webp)</small>
                                </div>

                                <div class="mb-3 col-md-4">
                                    <label for="email" class="form-label">Email<span class="text-danger">*</span></label>
                                    <input type="email" id="email" class="form-control" name="email" value="{{$showroom->email}}">
                                    @if ($errors->has('email')) <div class="text-danger">{{ $errors->first('email') }}</div>@endif
                                    <div class="error"></div>
                                </div>

                                <div class="col-md-4">
                                    <label for="email_color" class="form-label">Email Text Color</label>
                                    <input type="text" class="form-control colorpicker" name="email_color" id="email_color" value="{{$showroom->email_color}}">
                                </div>

                                <div class="col-md-4">
                                    <label for="email_color" class="form-label">Email Text Font Size</label>
                                    <select class="form-control select2" name="email_font_size">
                                        <option value="">Select</option>
                                        @for($i=$fontsize['start']; $i<=$fontsize['end']; $i+=$fontsize['range'])
                                            <option value="{{$i}}px" {{$showroom->email_font_size == $i.'px' ? 'selected' : ''}}>{{$i}}px</option>
                                        @endfor
                                    </select>
                                </div>

                                <div class="mb-3 col-md-4">
                                    <label for="email_color" class="form-label">Email Text Font Family</label>
                                    <select class="form-control select2" name="email_font_family">
                                        <option value="">Select</option>
                                        @foreach($fontfamily as $family)
                                            <option value="{{$family['key']}}" {{$showroom->email_font_family == $family['key'] ? 'selected' : ''}}>{{$family['value']}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-12">
                                    <h5>Facility Title :</h5>
                                    <hr>
                                </div>

                                <div class="col-md-3 mt-2 mb-2">
                                    <label for="facility_title" class="form-label">Facility Title</label>
                                    <input type="facility_title" class="form-control" value="{{isset($showroom->facility_title) ? $showroom->facility_title : old('facility_title')}}" name="facility_title" id="facility_title">
                                    @if ($errors->has('facility_title')) <div class="text-danger">{{ $errors->first('facility_title') }}</div>@endif
                                </div>

                                <div class="col-md-3 mt-2">
                                    <label for="facility_title_font_size" class="form-label">Facility Title Font Size</label>
                                    <select class="form-control select2" name="facility_title_font_size">
                                        <option value="">-- Select --</option>
                                        @for($i=24; $i<=50; $i+=2)
                                            <option value="{{$i}}px" {{$showroom->facility_title_font_size == $i.'px' ? 'selected' : ''}}>{{$i}}px</option>
                                        @endfor
                                    </select>
                                </div>

                                <div class="col-md-3 mt-2">
                                    <label for="facility_title_font_family" class="form-label">Facility Title Font Family</label>
                                    <select class="form-control select2" name="facility_title_font_family">
                                        <option value="">-- Select --</option>
                                        @foreach($fontfamily as $family)
                                            <option value="{{$family['key']}}" {{$showroom->facility_title_font_family == $family['key'] ? 'selected' : ''}}>{{$family['value']}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-3 mt-2">
                                    <label for="facility_title_color" class="form-label">Facility Title Font Color</label>
                                    <input type="text" class="form-control colorpicker" value="{{isset($showroom->facility_title_color) ? $showroom->facility_title_color : old('facility_title_color')}}" name="facility_title_color" id="facility_title_color">
                                </div>

                                <div class="col-12">
                                    <h5>Customer Gallery Title :</h5>
                                    <hr>
                                </div>

                                <div class="col-md-3 mt-2 mb-2">
                                    <label for="customer_gallery_title" class="form-label">Customer Gallery Title</label>
                                    <input type="customer_gallery_title" class="form-control" value="{{isset($showroom->customer_gallery_title) ? $showroom->customer_gallery_title : old('customer_gallery_title')}}" name="customer_gallery_title" id="customer_gallery_title">
                                    @if ($errors->has('customer_gallery_title')) <div class="text-danger">{{ $errors->first('customer_gallery_title') }}</div>@endif
                                </div>

                                <div class="col-md-3 mt-2">
                                    <label for="customer_gallery_title_font_size" class="form-label">Customer Gallery Title Font Size</label>
                                    <select class="form-control select2" name="customer_gallery_title_font_size">
                                        <option value="">-- Select --</option>
                                        @for($i=24; $i<=50; $i+=2)
                                            <option value="{{$i}}px" {{$showroom->customer_gallery_title_font_size == $i.'px' ? 'selected' : ''}}>{{$i}}px</option>
                                        @endfor
                                    </select>
                                </div>

                                <div class="col-md-3 mt-2">
                                    <label for="customer_gallery_title_font_family" class="form-label">Customer Gallery Title Font Family</label>
                                    <select class="form-control select2" name="customer_gallery_title_font_family">
                                        <option value="">-- Select --</option>
                                        @foreach($fontfamily as $family)
                                            <option value="{{$family['key']}}" {{$showroom->customer_gallery_title_font_family == $family['key'] ? 'selected' : ''}}>{{$family['value']}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-3 mt-2">
                                    <label for="customer_gallery_title_color" class="form-label">Customer Gallery Title Font Color</label>
                                    <input type="text" class="form-control colorpicker" value="{{isset($showroom->customer_gallery_title_color) ? $showroom->customer_gallery_title_color : old('customer_gallery_title_color')}}" name="customer_gallery_title_color" id="customer_gallery_title_color">
                                </div>

                                <div class="col-md-4 mt-2">
                                    <label for="lets_connect_image" class="form-label">Let's Connect Image</label>
                                    @if(isset($showroom->lets_connect_image) && $showroom->lets_connect_image)
                                        <img src="{{url('public/uploads/showroom/lets_connect_image/'.$showroom->lets_connect_image)}}" width="100">
                                    @endif  
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
                                    <input type="testimonial_title" class="form-control" value="{{isset($showroom->testimonial_title) ? $showroom->testimonial_title : old('testimonial_title')}}" name="testimonial_title" id="testimonial_title">
                                    @if ($errors->has('testimonial_title')) <div class="text-danger">{{ $errors->first('testimonial_title') }}</div>@endif
                                </div>

                                <div class="col-md-3 mt-2">
                                    <label for="testimonial_title_font_size" class="form-label">Testimonial Title Font Size</label>
                                    <select class="form-control select2" name="testimonial_title_font_size">
                                        <option value="">-- Select --</option>
                                        @for($i=24; $i<=50; $i+=2)
                                            <option value="{{$i}}px" {{$showroom->testimonial_title_font_size == $i.'px' ? 'selected' : ''}}>{{$i}}px</option>
                                        @endfor
                                    </select>
                                </div>

                                <div class="col-md-3 mt-2">
                                    <label for="testimonial_title_font_family" class="form-label">Testimonial Title Font Family</label>
                                    <select class="form-control select2" name="testimonial_title_font_family">
                                        <option value="">-- Select --</option>
                                        @foreach($fontfamily as $family)
                                            <option value="{{$family['key']}}" {{$showroom->testimonial_title_font_family == $family['key'] ? 'selected' : ''}}>{{$family['value']}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-3 mt-2">
                                    <label for="testimonial_title_color" class="form-label">Testimonial Title Font Color</label>
                                    <input type="text" class="form-control colorpicker" value="{{isset($showroom->testimonial_title_color) ? $showroom->testimonial_title_color : old('testimonial_title_color')}}" name="testimonial_title_color" id="testimonial_title_color">
                                </div>

                                <div class="col-12">
                                    <h5> Slider Section :</h5>
                                    <hr>
                                </div>

                                <div class="mb-3 col-md-4">
                                    <label for="slider_image" class="form-label">Slider Image</label>
                                    @if(isset($showroom->slider_image) && isset($showroom->slider_image))
                                        <img src="{{url('public/showrooms_slider_image/'.$showroom->slider_image)}}" width="100" style="margin-bottom:10px; margin-left:10px;">
                                    @endif
                                    <input type="file" id="slider_image" class="form-control" name="slider_image">
                                    @if ($errors->has('slider_image')) <div class="text-danger">{{ $errors->first('slider_image') }}</div>@endif
                                    <small class="image_type">(Height:243px,Width:325px; Image Type : jpg,jpeg,png,svg,webp)</small>
                                </div>

                                <div class="col-md-4">
                                    <label for="slider_showroom_name" class="form-label">Slider Showroom Name</label>
                                    <input type="text" id="slider_showroom_name" class="form-control" name="slider_showroom_name" value="{{$showroom->slider_showroom_name}}">
                                </div>

                                <div class="mb-3 col-md-4">
                                    <label for="slider_showroom_name_color" class="form-label">Slider Showroom Text Color</label>
                                    <input type="text" id="slider_showroom_name_color" class="form-control colorpicker" name="slider_showroom_name_color" value="{{$showroom->slider_showroom_name_color}}">
                                </div>

                                <div class="col-md-4 mb-2">
                                    @php($fontsize = fontSize())
                                    <label for="slider_showroom_name_font_size" class="form-label">Slider Showroom Text Font Size</label>
                                    <select class="form-control select2" name="slider_showroom_name_font_size">
                                        <option value="">Select</option>
                                        @for($i=$fontsize['start']; $i<=$fontsize['end']; $i+=$fontsize['range'])
                                            <option value="{{$i}}px" {{$showroom->slider_showroom_name_font_size == $i.'px' ? 'selected' : ''}}>{{$i}}px</option>
                                        @endfor
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    @php($fontfamily = fontFamily())
                                    <label for="slider_showroom_name_font_family" class="form-label">Slider Showroom Text Font Family</label>
                                    <select class="form-control select2" name="slider_showroom_name_font_family">
                                        <option value="">Select</option>
                                        @foreach($fontfamily as $family)
                                            <option value="{{$family['key']}}" {{$showroom->slider_showroom_name_font_family == $family['key'] ? 'selected' : ''}}>{{$family['value']}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-4 mt-2">
                                    <label for="rating" class="form-label">Rating<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="rating" id="rating" value="{{$showroom->rating}}">
                                    @if ($errors->has('rating')) <div class="text-danger">{{ $errors->first('rating') }}</div>@endif
                                    <div id="error"></div>
                                </div>
    
                                <div class="col-md-4 mb-2">
                                    <label for="number_of_rating" class="form-label">Number of Rating<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" maxlength="5" name="number_of_rating" id="number_of_rating" value="{{$showroom->number_of_rating}}">
                                    @if ($errors->has('number_of_rating')) <div class="text-danger">{{ $errors->first('number_of_rating') }}</div>@endif
                                    <div id="error"></div>
                                </div>

                                <div class="col-md-4 mb-2">
                                    <label for="map_link">Map Link</label>
                                    <input type="text" id="map_link" class="form-control" name="map_link" value="{{$showroom->map_link }}">
                                </div>
                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary submit">Submit</button>
                                <a href="{{ route('showroom_list') }}" class="btn btn-danger">Cancel</a>
                            </div>
                        </form>
                    @endforeach 
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
@section('javascript')
<script>
    $(document).ready(function () {

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


        $(".edit_form").validate({
            rules: {
                'slider_image': {
                    extension: "jpg,jpeg,png,webp,svg",
                },
                'image': {
                    extension: "jpg,jpeg,png,webp,svg",
                },
                'name': {
                    required: true,
                },
                'car_id[]': { 
                    required: true,
                },
                'address': {
                    required: true,
                },
                'working_hours': {
                    required: true,
                },
                'contact_number': {
                    required: true,
                    maxlength:"10",
                    minlength:"10",
                },
                'email': {
                    required: true,
                },
                'address_icon': {
                    extension: "jpg,jpeg,png,webp,svg",
                },
                'working_hours_icon': {
                    extension: "jpg,jpeg,png,webp,svg",
                },
                'contact_number_icon': {
                    extension: "jpg,jpeg,png,webp,svg",
                },
                'email_icon': {
                    extension: "jpg,jpeg,png,webp,svg",
                },
                'rating': {
                    required: true,
                    number: true,
                    max: 5
                },
                'number_of_rating': {
                    required: true,
                    number: true,
                },
            },
            messages: {
                'slider_image': {
                    extension: "Image must be jpg,jpeg,png,svg or webp.",
                },
                'image': {
                    extension: "Image must be jpg,jpeg,png,svg or webp.",
                },
                'name': {
                    required: "The showroom name field is required.",
                },
                'car_id[]': { 
                    required: "The car field is required.",
                },
                'address': {
                    required: "The address field is required.",
                },
                'working_hours': {
                    required: "The working hours field is required.",
                },
                'contact_number': {
                    required: "The contact number field is required.",
                },
                'email': {
                    required: "The email field is required.",
                },
                'address_icon': {
                    extension: "Image must be jpg,jpeg,png,svg or webp.",
                },
                'working_hours_icon': {
                    extension: "Image must be jpg,jpeg,png,svg or webp.",
                },
                'contact_number_icon': {
                    extension: "Image must be jpg,jpeg,png,svg or webp.",
                },
                'email_icon': {
                    extension: "Image must be jpg,jpeg,png,svg or webp.",
                },
                'rating': {
                    required: "The rating field is required.",
                    max: "The rating must not be greater than 5."
                },
                'number_of_rating': {
                    required: "The number of rating field is required.",
                },
            },
            errorPlacement: function(error, element) {
            if (element.attr("name") == "car_id[]") {
                error.appendTo('#errorcardiv');
                return;
            }
            if (element.attr("name") == "address") {
                error.appendTo(element.next('.error'));
                return;
            } else {
                error.insertAfter(element);
            }
        }
        });

        $('.colorpicker').colorpicker();

    });
</script>
@endsection

