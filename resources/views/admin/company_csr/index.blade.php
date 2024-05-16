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
                    <form action="{{ route('csr-update') }}" method="POST" class="service-center-form" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <label for="banner_image" class="form-label">Banner Image<span class="text-danger">*</span></label>
                                <input type="hidden" name="old_image" id="old_image" value="{{isset($record->banner_image) ? $record->banner_image : old('banner_image')}}">
                                @if(isset($record->banner_image) && $record->banner_image)
                                    <img src="{{url('public/uploads/companyCsrBanner/'.$record->banner_image)}}" width="100">
                                @endif  
                                <input type="file" id="banner_image" class="form-control" name="banner_image" required="" value="">
                                @if ($errors->has('banner_image')) <div class="text-danger">{{ $errors->first('banner_image') }}</div>@endif
                                <small class="image_type">(Hight:352px,Width:1349px; Image Type : jpg,jpeg,png,svg,webp)</small>
                            </div>

                            <div class="col-md-4">
                                <label for="title" class="form-label">Title<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="title" required="" name="title" value="{{isset($record->title) ? $record->title : old('title')}}">
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

                            <div class="col-md-4">
                                <label for="left_title" class="form-label">Left Title<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="left_title" required="" name="left_title" value="{{isset($record->left_title) ? $record->left_title : old('left_title')}}">
                                @if ($errors->has('left_title')) <div class="text-danger">{{ $errors->first('left_title') }}</div>@endif
                            </div>

                            <div class="col-md-4">
                                <label for="left_title_color" class="form-label">Left Title Color</label>
                                <input type="text" id="left_title_color" class="form-control colorpicker" name="left_title_color" value="{{isset($record->left_title_color) ? $record->left_title_color : old('left_title_color')}}">
                            </div>

                            <div class="col-md-4">
                                <label for="left_title_font_size" class="form-label">Left Title Font Size</label>
                                <select class="form-control select2" name="left_title_font_size">
                                    <option value="">Select</option>
                                    @for($i=24; $i<=50; $i+=2)
                                        <option value="{{$i}}px" @if(isset($record->left_title_font_size) && $record->left_title_font_size == $i.'px'){{'selected'}}@endif>{{$i}}px</option>
                                    @endfor
                                </select>
                            </div>

                            @php($fontfamily = fontFamily())
                            <div class="col-md-4 mt-2">
                                <label for="left_title_font_family" class="form-label">Left Title Font Family</label>
                                <select class="form-control select2" name="left_title_font_family">
                                    <option value="">Select</option>
                                    @foreach($fontfamily as $family)
                                        <option value="{{$family['key']}}" @if(isset($record->left_title_font_family) && $record->left_title_font_family == $family['key']){{'selected'}}@endif>{{$family['value']}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4 mt-2">
                                <label for="image" class="form-label">Image</label>
                                <input type="hidden" name="old_image" id="old_image" value="{{isset($record->image) ? $record->image : old('image')}}">
                                @if(isset($record->image) && $record->image)
                                    <img src="{{url('public/uploads/companyCsr/'.$record->image)}}" width="100">
                                @endif  
                                <input type="file" id="image" class="form-control" name="image" value="">
                                @if ($errors->has('image')) <div class="text-danger">{{ $errors->first('image') }}</div>@endif
                                <small class="image_type">(Hight:352px,Width:1349px; Image Type : jpg,jpeg,png,svg,webp)</small>
                            </div>

                            <div class="col-md-12 mt-2">
                                <label for="left_description" class="form-label">Left Description</label>
                                <textarea class="form-control ckeditor" id="left_description" name="left_description">{{isset($record->left_description) ? $record->left_description : old('left_description')}}</textarea>
                                @if ($errors->has('left_description')) <div class="text-danger">{{ $errors->first('left_description') }}</div>@endif
                            </div>

                            <div class="col-md-4 mt-2">
                                <label for="left_description_font_color" class="form-label">Left Description Font Color</label>
                                <input type="text" id="left_description_font_color" class="form-control colorpicker" name="left_description_font_color" value="{{isset($record->left_description_font_color) ? $record->left_description_font_color : old('left_description_font_color')}}">
                            </div>

                            <div class="col-md-4 mt-2">
                                <label for="left_description_font_size" class="form-label">Left Description Font Size</label>
                                <select class="form-control select2" name="left_description_font_size">
                                    <option value="">Select</option>
                                    @for($i=24; $i<=50; $i+=2)
                                        <option value="{{$i}}px" @if(isset($record->left_description_font_size) && $record->left_description_font_size == $i.'px'){{'selected'}}@endif>{{$i}}px</option>
                                    @endfor
                                </select>
                            </div>

                            @php($fontfamily = fontFamily())
                            <div class="col-md-4 mb-2 mt-2">
                                <label for="left_description_font_family" class="form-label">Left Description Font Family</label>
                                <select class="form-control select2" name="left_description_font_family">
                                    <option value="">Select</option>
                                    @foreach($fontfamily as $family)
                                        <option value="{{$family['key']}}" @if(isset($record->left_description_font_family) && $record->left_description_font_family == $family['key']){{'selected'}}@endif>{{$family['value']}}</option>
                                    @endforeach
                                </select>
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

        $(".service-center-form").validate({
            rules: {
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
    });
</script>
@endsection