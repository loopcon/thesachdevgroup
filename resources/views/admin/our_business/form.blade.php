@extends('admin.layout.header')
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
                    <form action="@if(isset($record->id)) {{ route('our-business-update', array('id' => encrypt($record->id))) }} @else{{ route('our-business-store') }} @endif" method="POST" class="our-business-form" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-4 adm-brand-errorbox">
                                <label for="page_link" class="form-label">page Link or Url<span class="text-danger">*</span></label>
                                <select class="form-control select2" name="page_link" id="page_link">
                                    <option value="">-- Select --</option>
                                    <option value="1" @if(isset($record->page_link) && $record->page_link == 1){{'selected'}} @endif>Our Page Link</option>
                                    <option value="0" @if(isset($record->page_link) && $record->page_link == 0){{'selected'}} @endif>Other Website Url</option>
                                </select>
                                @if ($errors->has('page_link')) <div class="text-danger">{{ $errors->first('page_link') }}</div>@endif
                            </div>

                            <div class="col-md-4 mt-3">
                                <label for="banner_image" class="form-label">Banner Image</label>
                                @if(isset($record->banner_image) && $record->banner_image)
                                    <img src="{{url('public/uploads/our_business/'.$record->banner_image)}}" width="100" style="margin-bottom:10px; margin-left:10px;">
                                @endif  
                                <input type="file" id="banner_image" class="form-control" name="banner_image" value="">
                                @if ($errors->has('banner_image')) <div class="text-danger">{{ $errors->first('banner_image') }}</div>@endif
                                <div class="error"></div>
                                <small class="image_type">(Hight:281,Width:1349; Image Type : jpg,jpeg,png,webp)</small>
                            </div>

                            <div class="col-md-4 page_url">
                                <label for="url" class="form-label">Url</label>
                                <input type="url" id="url" class="form-control" name="url" value="{{isset($record->url) ? $record->url : old('url')}}">
                            </div>

                            <div class="col-md-4 adm-brand-errorbox">
                                <label for="title" class="form-label">Business Title<span class="text-danger">*</span></label>
                                <select class="form-control select2" name="title" id="title">
                                    <option value="">-- Select --</option>
                                    @foreach($our_business as $value)
                                        <option value="{{$value->name}}"@if(isset($record->title) && $record->title == $value->name){{'selected'}}@endif>{{$value->name}}</option>
                                    @endforeach
                                </select>
                                <div id="error"></div>
                                @if ($errors->has('title')) <div class="text-danger">{{ $errors->first('title') }}</div>@endif
                            </div>

                            <div class="col-md-4">
                                <label for="title_font_color" class="form-label">Title Font Color</label>
                                <input type="text" id="title_font_color" class="form-control colorpicker" name="title_font_color" value="{{isset($record->title_font_color) ? $record->title_font_color : old('title_font_color')}}">
                            </div>
 
                            <div class="col-md-4 mt-2">
                                <label for="title_font_size" class="form-label">Title Font Size</label>
                                <select class="form-control select2" name="title_font_size">
                                    <option value="">Select</option>
                                    @for($i=24; $i<=50; $i+=2)
                                        <option value="{{$i}}px" @if(isset($record->title_font_size) && $record->title_font_size == $i.'px'){{'selected'}}@endif>{{$i}}px</option>
                                    @endfor
                                </select>
                            </div>

                            @php($fontfamily = fontFamily())
                            <div class="col-md-4 mt-2">
                                <label for="title_font_family" class="form-label">Title Font Family</label>
                                <select class="form-control select2" name="title_font_family">
                                    <option value="">Select</option>
                                    @foreach($fontfamily as $family)
                                        <option value="{{$family['key']}}" @if(isset($record->title_font_family) && $record->title_font_family == $family['key']){{'selected'}}@endif>{{$family['value']}}</option>
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
                                    <option value="">Select</option>
                                    @for($i=24; $i<=50; $i+=2)
                                        <option value="{{$i}}px" @if(isset($record->description_font_size) && $record->description_font_size == $i.'px'){{'selected'}}@endif>{{$i}}px</option>
                                    @endfor
                                </select>
                            </div>

                            <div class="col-md-4 mt-2">
                                <label for="description_font_family" class="form-label">Description Font Family</label>
                                <select class="form-control select2" name="description_font_family">
                                    <option value="">Select</option>
                                    @foreach($fontfamily as $family)
                                        <option value="{{$family['key']}}" @if(isset($record->description_font_family) && $record->description_font_family == $family['key']){{'selected'}}@endif>{{$family['value']}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4 mt-2">
                                <label for="description_font_color" class="form-label">Description Font Color</label>
                                <input type="text" class="form-control colorpicker" value="{{isset($record->description_font_color) ? $record->description_font_color : old('description_font_color')}}" name="description_font_color" id="description_font_color">
                            </div>

                            <div class="col-md-4 adm-select-car-drop adm-brand-errorbox car">
                                <label for="car_id" class="form-label">Select Car</label>
                                <select name="car_id[]" id="car_id" class="form-control select2" multiple>
                                    <option value="" disabled>Select</option>
                                    @foreach($cars as $car)
                                        <option value="{{$car->id}}"@if(isset($record->car_id) && in_array($car->id, json_decode($record->car_id)) == $car->id){{'selected'}}@endif>{{$car->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4 adm-select-car-drop adm-brand-errorbox service">
                                <label for="service_id" class="form-label">Service</label>
                                <select class="form-control select2" name="service_id[]" id="service_id" multiple>
                                    <option value="" disabled>-- Select Service --</option>
                                    @foreach($services as $value)
                                    <option value="{{$value->id}}"@if(isset($record->service_id) && in_array($value->id, json_decode($record->service_id)) == $value->id){{'selected'}}@endif>{{$value->name}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('service_id')) <div class="text-danger">{{ $errors->first('service_id') }}</div>@endif
                            </div>

                            <div class="mt-3 col-12">
                                <h5>Showroom Title</h5>
                                <hr>
                            </div>

                            <div class="col-md-4 mt-3">
                                <label for="showroom_title" class="form-label">Showroom Title</label>
                                <input type="text" id="showroom_title" class="form-control" name="showroom_title" value="{{isset($record->showroom_title) ? $record->showroom_title : old('showroom_title')}}">
                            </div>

                            <div class="col-md-4 mt-3">
                                <label for="showroom_title_color" class="form-label">Showroom Title Font Color</label>
                                <input type="text" id="showroom_title_color" class="form-control colorpicker" name="showroom_title_color" value="{{isset($record->showroom_title_color) ? $record->showroom_title_color : old('showroom_title_color')}}">
                            </div>
 
                            <div class="col-md-4 mt-2">
                                <label for="showroom_title_font_size" class="form-label">Showroom Title Font Size</label>
                                <select class="form-control select2" name="showroom_title_font_size">
                                    <option value="">Select</option>
                                    @for($i=24; $i<=50; $i+=2)
                                        <option value="{{$i}}px" @if(isset($record->showroom_title_font_size) && $record->showroom_title_font_size == $i.'px'){{'selected'}}@endif>{{$i}}px</option>
                                    @endfor
                                </select>
                            </div>

                            @php($fontfamily = fontFamily())
                            <div class="col-md-4 mt-2">
                                <label for="showroom_title_font_family" class="form-label">Showroom Title Font Family</label>
                                <select class="form-control select2" name="showroom_title_font_family">
                                    <option value="">Select</option>
                                    @foreach($fontfamily as $family)
                                        <option value="{{$family['key']}}" @if(isset($record->showroom_title_font_family) && $record->showroom_title_font_family == $family['key']){{'selected'}}@endif>{{$family['value']}}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="mt-3 col-12">
                                <h5>Service Center Title</h5>
                                <hr>
                            </div>
                            <div class="col-md-3">
                                <label for="service_center_title" class="form-label">Service Center Title</label>
                                <input type="text" id="service_center_title" class="form-control" name="service_center_title" value="{{isset($record->service_center_title) ? $record->service_center_title : old('service_center_title')}}">
                            </div>

                            <div class="col-md-3">
                                <label for="service_center_title_color" class="form-label">Service Center Title Font Color</label>
                                <input type="text" id="service_center_title_color" class="form-control colorpicker" name="service_center_title_color" value="{{isset($record->service_center_title_color) ? $record->service_center_title_color : old('service_center_title_color')}}">
                            </div>
 
                            <div class="col-md-3">
                                <label for="service_center_title_font_size" class="form-label">Service Center Title Font Size</label>
                                <select class="form-control select2" name="service_center_title_font_size">
                                    <option value="">Select</option>
                                    @for($i=24; $i<=50; $i+=2)
                                        <option value="{{$i}}px" @if(isset($record->service_center_title_font_size) && $record->service_center_title_font_size == $i.'px'){{'selected'}}@endif>{{$i}}px</option>
                                    @endfor
                                </select>
                            </div>

                            @php($fontfamily = fontFamily())
                            <div class="col-md-3">
                                <label for="service_center_title_font_family" class="form-label">Service Center Title Font Family</label>
                                <select class="form-control select2" name="service_center_title_font_family">
                                    <option value="">Select</option>
                                    @foreach($fontfamily as $family)
                                        <option value="{{$family['key']}}" @if(isset($record->service_center_title_font_family) && $record->service_center_title_font_family == $family['key']){{'selected'}}@endif>{{$family['value']}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mt-3 col-12">
                                <h5>Body Shop Title</h5>
                                <hr>
                            </div>
                            <div class="col-md-3">
                                <label for="body_shop_title" class="form-label">Body Shop Title</label>
                                <input type="text" id="body_shop_title" class="form-control" name="body_shop_title" value="{{isset($record->body_shop_title) ? $record->body_shop_title : old('body_shop_title')}}">
                            </div>

                            <div class="col-md-3">
                                <label for="body_shop_title_color" class="form-label">Body Shop Title Font Color</label>
                                <input type="text" id="body_shop_title_color" class="form-control colorpicker" name="body_shop_title_color" value="{{isset($record->body_shop_title_color) ? $record->body_shop_title_color : old('body_shop_title_color')}}">
                            </div>
 
                            <div class="col-md-3">
                                <label for="body_shop_title_font_size" class="form-label">Body Shop Title Font Size</label>
                                <select class="form-control select2" name="body_shop_title_font_size">
                                    <option value="">Select</option>
                                    @for($i=24; $i<=50; $i+=2)
                                        <option value="{{$i}}px" @if(isset($record->body_shop_title_font_size) && $record->body_shop_title_font_size == $i.'px'){{'selected'}}@endif>{{$i}}px</option>
                                    @endfor
                                </select>
                            </div>

                            @php($fontfamily = fontFamily())
                            <div class="col-md-3">
                                <label for="body_shop_title_font_family" class="form-label">Body Shop Title Font Family</label>
                                <select class="form-control select2" name="body_shop_title_font_family">
                                    <option value="">Select</option>
                                    @foreach($fontfamily as $family)
                                        <option value="{{$family['key']}}" @if(isset($record->body_shop_title_font_family) && $record->body_shop_title_font_family == $family['key']){{'selected'}}@endif>{{$family['value']}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mt-3 col-12">
                                <h5>Used Car Title</h5>
                                <hr>
                            </div>
                            <div class="col-md-3">
                                <label for="used_car_title" class="form-label">Used Car Title</label>
                                <input type="text" id="used_car_title" class="form-control" name="used_car_title" value="{{isset($record->used_car_title) ? $record->used_car_title : old('used_car_title')}}">
                            </div>

                            <div class="col-md-3">
                                <label for="used_car_title_color" class="form-label">Used Car Title Font Color</label>
                                <input type="text" id="used_car_title_color" class="form-control colorpicker" name="used_car_title_color" value="{{isset($record->used_car_title_color) ? $record->used_car_title_color : old('used_car_title_color')}}">
                            </div>
 
                            <div class="col-md-3">
                                <label for="used_car_title_font_size" class="form-label">Used Car Title Font Size</label>
                                <select class="form-control select2" name="used_car_title_font_size">
                                    <option value="">Select</option>
                                    @for($i=24; $i<=50; $i+=2)
                                        <option value="{{$i}}px" @if(isset($record->used_car_title_font_size) && $record->used_car_title_font_size == $i.'px'){{'selected'}}@endif>{{$i}}px</option>
                                    @endfor
                                </select>
                            </div>

                            @php($fontfamily = fontFamily())
                            <div class="col-md-3">
                                <label for="used_car_title_font_family" class="form-label">Used Car Title Font Family</label>
                                <select class="form-control select2" name="used_car_title_font_family">
                                    <option value="">Select</option>
                                    @foreach($fontfamily as $family)
                                        <option value="{{$family['key']}}" @if(isset($record->used_car_title_font_family) && $record->used_car_title_font_family == $family['key']){{'selected'}}@endif>{{$family['value']}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mt-3 col-12">
                                <h5>Insurance Title</h5>
                                <hr>
                            </div>
                            <div class="col-md-3">
                                <label for="insurance_title" class="form-label">Insurance Title</label>
                                <input type="text" id="insurance_title" class="form-control" name="insurance_title" value="{{isset($record->insurance_title) ? $record->insurance_title : old('insurance_title')}}">
                            </div>

                            <div class="col-md-3">
                                <label for="insurance_title_color" class="form-label">Insurance Title Font Color</label>
                                <input type="text" id="insurance_title_color" class="form-control colorpicker" name="insurance_title_color" value="{{isset($record->insurance_title_color) ? $record->insurance_title_color : old('insurance_title_color')}}">
                            </div>
 
                            <div class="col-md-3">
                                <label for="insurance_title_font_size" class="form-label">Insurance Title Font Size</label>
                                <select class="form-control select2" name="insurance_title_font_size">
                                    <option value="">Select</option>
                                    @for($i=24; $i<=50; $i+=2)
                                        <option value="{{$i}}px" @if(isset($record->insurance_title_font_size) && $record->insurance_title_font_size == $i.'px'){{'selected'}}@endif>{{$i}}px</option>
                                    @endfor
                                </select>
                            </div>

                            @php($fontfamily = fontFamily())
                            <div class="mb-3 col-md-3">
                                <label for="insurance_title_font_family" class="form-label">Insurance Title Font Family</label>
                                <select class="form-control select2" name="insurance_title_font_family">
                                    <option value="">Select</option>
                                    @foreach($fontfamily as $family)
                                        <option value="{{$family['key']}}" @if(isset($record->insurance_title_font_family) && $record->insurance_title_font_family == $family['key']){{'selected'}}@endif>{{$family['value']}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-12">
                                <h5>Why Choose Section</h5>
                                <hr>
                            </div>

                            <div class="col-md-4 mb-2">
                                <label for="why_choose_title" class="form-label">Why Choose Title</label>
                                <input type="text" class="form-control" value="{{isset($record->why_choose_title) ? $record->why_choose_title : old('why_choose_title')}}" name="why_choose_title" id="why_choose_title">
                            </div>

                            <div class="col-md-4 mb-2">
                                <label for="why_choose_title_color" class="form-label">Why Choose Title Color</label>
                                <input type="text" class="form-control colorpicker" value="{{isset($record->why_choose_title_color) ? $record->why_choose_title_color : old('why_choose_title_color')}}" name="why_choose_title_color" id="why_choose_title_color">
                            </div>

                            <div class="col-md-4">
                                <label for="why_choose_title_font_size" class="form-label">Why Choose Title Font Size</label>
                                <select class="form-control select2" name="why_choose_title_font_size">
                                    <option value="">Select</option>
                                    @for($i=24; $i<=50; $i+=2)
                                        <option value="{{$i}}px" @if(isset($record->why_choose_title_font_size) && $record->why_choose_title_font_size == $i.'px'){{'selected'}}@endif>{{$i}}px</option>
                                    @endfor
                                </select>
                            </div>

                            @php($fontfamily = fontFamily())
                            <div class="col-md-4 mt-2">
                                <label for="why_choose_title_font_family" class="form-label">Why Choose Title Font Family</label>
                                <select class="form-control select2" name="why_choose_title_font_family">
                                    <option value="">Select</option>
                                    @foreach($fontfamily as $family)
                                        <option value="{{$family['key']}}" @if(isset($record->why_choose_title_font_family) && $record->why_choose_title_font_family == $family['key']){{'selected'}}@endif>{{$family['value']}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6 mb-2 mt-2">
                                <label for="why_choose_image" class="form-label">Why Choose Image</label>
                                @if(isset($record->why_choose_image) && $record->why_choose_image)
                                    <img src="{{url('public/uploads/our_business_why_choose/'.$record->why_choose_image)}}" width="100" style="margin-bottom:10px; margin-left:10px;">
                                @endif  
                                <input type="file" id="why_choose_image" class="form-control" name="why_choose_image" value="">
                                @if ($errors->has('why_choose_image')) <div class="text-danger">{{ $errors->first('why_choose_image') }}</div>@endif
                                <div class="error"></div>
                                <small class="image_type">(Hight:405px,Width:540px; Image Type : jpg,jpeg,png,webp)</small>
                            </div>

                            <div class="col-md-12 mb-2">
                                <label for="why_choose_description" class="form-label">Why Choose Description</label>
                                <textarea class="form-control ckeditor" name="why_choose_description" id="why_choose_description">{{isset($record->why_choose_description) ? $record->why_choose_description : old('why_choose_description')}}</textarea>
                            </div>

                            <div class="col-md-4 mb-2 mt-2">
                                <label for="why_choose_description_color" class="form-label">Why Choose Description Color</label>
                                <input type="text" class="form-control colorpicker" value="{{isset($record->why_choose_description_color) ? $record->why_choose_description_color : old('why_choose_description_color')}}" name="why_choose_description_color" id="why_choose_description_color">
                            </div>

                            <div class="col-md-4 mt-2">
                                <label for="why_choose_description_font_size" class="form-label">Why Choose Description Font Size</label>
                                <select class="form-control select2" name="why_choose_description_font_size">
                                    <option value="">Select</option>
                                    @for($i=24; $i<=50; $i+=2)
                                        <option value="{{$i}}px" @if(isset($record->why_choose_description_font_size) && $record->why_choose_description_font_size == $i.'px'){{'selected'}}@endif>{{$i}}px</option>
                                    @endfor
                                </select>
                            </div>

                            @php($fontfamily = fontFamily())
                            <div class="col-md-4 mt-2">
                                <label for="why_choose_description_font_family" class="form-label">Why Choose Description Font Family</label>
                                <select class="form-control select2" name="why_choose_description_font_family">
                                    <option value="">Select</option>
                                    @foreach($fontfamily as $family)
                                        <option value="{{$family['key']}}" @if(isset($record->why_choose_description_font_family) && $record->why_choose_description_font_family == $family['key']){{'selected'}}@endif>{{$family['value']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary submit">Submit</button>
                            <a href="{{ route('our-business') }}" class="btn btn-danger">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
@section('javascript')
<script>
    $(document).ready(function () {
        $('.select2').select2({ width: '100%' });

        // CKEDITOR.replace('why_choose_description', {
        //     height:500,
        //     removePlugins : 'resize',
        //     filebrowserBrowseUrl : '<?php echo url("public/plugins/kcfinder/browse.php?opener=ckeditor&type=files") ?>',
        //     filebrowserImageBrowseUrl : '<?php echo url("public/plugins/kcfinder/browse.php?opener=ckeditor&type=images") ?>',
        //     filebrowserFlashBrowseUrl : '<?php echo url("public/plugins/kcfinder/browse.php?opener=ckeditor&type=flash") ?>',
        //     filebrowserUploadUrl : '<?php echo url("public/plugins/kcfinder/upload.php?opener=ckeditor&type=files") ?>',
        //     filebrowserImageUploadUrl : '<?php echo url("public/plugins/kcfinder/upload.php?opener=ckeditor&type=images") ?>',
        //     filebrowserFlashUploadUrl : '<?php echo url("public/plugins/kcfinder/upload.php?opener=ckeditor&type=flash") ?>',
        // });

        $('.page_url').hide();
        var page = $('#page_link').val();
        if(page == '0')
        {
            $('.page_url').show();
        }
        $(document).on('change','#page_link',function(){
            var page_link_url = $(this).val();
            if(page_link_url == 0)
            {
                $('.page_url').show();
            }else{
                $('.page_url').hide();
            }
        });
        $(".our-business-form").validate({
            rules: {
                'page_link': {
                    required: true,
                },
                'title': {
                    required: true,
                },
                'banner_image': {
                    extension: "jpg,jpeg,png,webp",
                },
                url: {
                    url: "url",
                },
            },
            messages: {
                'page_link': {
                    required: "Page Link or Url is required",
                },
                'title': {
                    required: "Title is required",
                },
                'banner_image': {
                    extension: "Banner Image must be jpg,jpeg,png or webp",
                },
                'url': {
                    url: "Enter valid url",
                },
            },
            submitHandler: function(form) {
                $(form).find('.submit').prop("disabled", true);
                form.submit();
            }
        });

        $('.colorpicker').colorpicker();

        // banner image validation
        var old_image = $('#old_image').val();
        var banner_image = $('#banner_image').val();
        if(old_image != '' || banner_image != ''){
            document.getElementById("banner_image").required = false;
        }else{
            document.getElementById("banner_image").required = true;
        }

        // $(document).on('change', '#car_id', function(){
        //     var car = $(this).val();
        //     $('.custom-select').find("option").hide();
        //     $('.custom-select').not(this).val("");
        //     console.log(car)
        //     if(car = null || car !='')
        //     {
        //         var car_flag = 0;
        //     }else{
        //         var car_flag = 1;
               
        //     }
        //     serviceBlankAndHide(car_flag);
        // })

        
        // $(document).on('change', '#service_id', function(){
        //     var service = $(this).val();
        //     if(service !='')
        //     {
        //         var service_flag = 0;
        //     }else{
        //         var service_flag = 1;
               
        //     }
        //     carBlankAndHide(service_flag);
        // })
    });

    // function serviceBlankAndHide(flag)
    // {
    //     if(flag==0)
    //     {
    //         $('#service_id').select2('destroy')
    //         $('#service_id').val('')
    //         $('#service_id').select2()
    //         $('.service').hide()
    //     }else{
    //         $('.service').show()
    //     }
    // }

    // function carBlankAndHide(flag)
    // {
    //     if(flag==0)
    //     {
    //         $('#car_id').select2('destroy')
    //         $('#car_id').val('')
    //         $('#car_id').select2()
    //         $('.car').hide()
    //     }else{
    //         $('.car').show()
    //     }
    // }
</script>
@endsection