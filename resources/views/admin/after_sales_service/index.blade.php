@extends('admin.layout.header')
@section('css')
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
                    <form action="{{ route('after-sales-service-update') }}" method="POST" class="service-center-form" enctype="multipart/form-data" data-parsley-validate="">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <label for="banner_image" class="form-label">Banner Image<span class="text-danger">*</span></label>
                                <input type="hidden" name="old_image" id="old_image" value="{{isset($record->banner_image) ? $record->banner_image : old('banner_image')}}">
                                @if(isset($record->banner_image) && $record->banner_image)
                                    <img src="{{url('public/uploads/afterSalesService/'.$record->banner_image)}}" width="100">
                                @endif  
                                <input type="file" id="banner_image" class="form-control" name="banner_image" required="" value="">
                                @if ($errors->has('banner_image')) <div class="text-danger">{{ $errors->first('banner_image') }}</div>@endif
                                <small class="image_type">(Hight:478px,Width:1349px; Image Type : jpg,jpeg,png,svg,webp)</small>
                            </div>

                            <div class="col-md-4">
                                <label for="title" class="form-label">Title<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="title" required="" name="title" value="{{isset($record->title) ? $record->title : old('title')}}" required>
                                @if ($errors->has('title')) <div class="text-danger">{{ $errors->first('title') }}</div>@endif
                            </div>

                            <div class="col-md-4">
                                <label for="title_color" class="form-label">Title Color</label>
                                <input type="text" id="title_color" class="form-control colorpicker" name="title_color" value="{{isset($record->title_color) ? $record->title_color : old('title_color')}}">
                            </div>

                            <div class="col-md-4">
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

                            <div class="col-md-4">
                                <label for="description" class="form-label">Description<span class="text-danger">*</span></label>
                                <textarea class="form-control" id="description" required="" name="description">{{isset($record->description) ? $record->description : old('description')}}</textarea>
                                @if ($errors->has('description')) <div class="text-danger">{{ $errors->first('description') }}</div>@endif
                            </div>

                            <div class="col-md-4">
                                <label for="description_font_color" class="form-label">Description Font Color</label>
                                <input type="text" id="description_font_color" class="form-control colorpicker" name="description_font_color" value="{{isset($record->description_font_color) ? $record->description_font_color : old('description_font_color')}}">
                            </div>

                            <div class="col-md-4">
                                <label for="description_font_size" class="form-label">Description Font Size</label>
                                <select class="form-control select2" name="description_font_size">
                                    <option value="">Select</option>
                                    @for($i=24; $i<=50; $i+=2)
                                        <option value="{{$i}}px" @if(isset($record->description_font_size) && $record->description_font_size == $i.'px'){{'selected'}}@endif>{{$i}}px</option>
                                    @endfor
                                </select>
                            </div>

                            @php($fontfamily = fontFamily())
                            <div class="col-md-4 mb-2">
                                <label for="description_font_family" class="form-label">Description Font Family</label>
                                <select class="form-control select2" name="description_font_family">
                                    <option value="">Select</option>
                                    @foreach($fontfamily as $family)
                                        <option value="{{$family['key']}}" @if(isset($record->description_font_family) && $record->description_font_family == $family['key']){{'selected'}}@endif>{{$family['value']}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4 mb-4 adm-select-car-drop adm-brand-errorbox">
                                <label for="brand_id" class="form-label">Brand<span class="text-danger">*</span></label>
                                <select class="form-control select2" name="brand_id[]" id="brand_id" required multiple>
                                    <option value="" disabled>-- Select Brand --</option>
                                    @foreach($brands as $value)
                                    <option value="{{$value->id}}"@if(isset($record->brand_id) && in_array($value->id, json_decode($record->brand_id)) == $value->id){{'selected'}}@endif>{{$value->name}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('brand_id')) <div class="text-danger">{{ $errors->first('brand_id') }}</div>@endif
                            </div>

                            <div class="col-md-4">
                                <label for="book_service_form_title" class="form-label">Book Service Form Title</label>
                                <input type="text" class="form-control" id="book_service_form_title" name="book_service_form_title" value="{{isset($record->book_service_form_title) ? $record->book_service_form_title : old('book_service_form_title')}}">
                                @if ($errors->has('book_service_form_title')) <div class="text-danger">{{ $errors->first('book_service_form_title') }}</div>@endif
                            </div>

                            <div class="col-md-4">
                                <label for="book_service_form_title_color" class="form-label">Book Service Form Title Color</label>
                                <input type="text" id="book_service_form_title_color" class="form-control colorpicker" name="book_service_form_title_color" value="{{isset($record->book_service_form_title_color) ? $record->book_service_form_title_color : old('book_service_form_title_color')}}">
                            </div>

                            <div class="col-md-4">
                                <label for="book_service_form_title_font_size" class="form-label">Book Service Form Title Font Size</label>
                                <select class="form-control select2" name="book_service_form_title_font_size">
                                    <option value="">Select</option>
                                    @for($i=24; $i<=50; $i+=2)
                                        <option value="{{$i}}px" @if(isset($record->book_service_form_title_font_size) && $record->book_service_form_title_font_size == $i.'px'){{'selected'}}@endif>{{$i}}px</option>
                                    @endfor
                                </select>
                            </div>

                            @php($fontfamily = fontFamily())
                            <div class="col-md-4 mt-2">
                                <label for="book_service_form_title_font_family" class="form-label">Book Service Form Title Font Family</label>
                                <select class="form-control select2" name="book_service_form_title_font_family">
                                    <option value="">Select</option>
                                    @foreach($fontfamily as $family)
                                        <option value="{{$family['key']}}" @if(isset($record->book_service_form_title_font_family) && $record->book_service_form_title_font_family == $family['key']){{'selected'}}@endif>{{$family['value']}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4 mb-3">
								<label for="meta_title">Meta Title</label>
								<input type="text" class="form-control" name="meta_title" value="{{isset($record->meta_title) ? $record->meta_title : old('meta_title')}}">
							</div>

							<div class="col-md-4">
								<label for="meta_keyword">Meta Keyword</label>
								<textarea class="form-control" name="meta_keyword">{{isset($record->meta_keyword) ? $record->meta_keyword : old('mera_keyword')}}</textarea>
							</div>

							<div class="col-md-4 mb-3">
								<label for="meta_description">Meta Description</label>
								<textarea class="form-control" name="meta_description">{{isset($record->meta_description) ? $record->meta_description : old('meta_description')}}</textarea>
							</div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary submit">Update</button>
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
        $('.select2').select2({ width: '100%' });

        // $(".service-center-form").validate({
        //     rules: {
        //     },
        //     submitHandler: function(form) {
        //         $(form).find('.submit').prop("disabled", true);
        //         form.submit();
        //     }
        // });

        $('.colorpicker').colorpicker();

        // banner image validation
        var old_image = $('#old_image').val();
        var banner_image = $('#banner_image').val();
        if(old_image != '' || banner_image != ''){
            document.getElementById("banner_image").required = false;
        }else{
            document.getElementById("banner_image").required = true;
        }
    });
</script>
@endsection