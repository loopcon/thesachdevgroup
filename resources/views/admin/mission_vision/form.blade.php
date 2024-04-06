@extends('admin.layout.header')
@section('css')
    <link class="js-stylesheet" href="{{ asset('plugins/select2/css/select2.css') }}" rel="stylesheet">
    <link class="js-stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h1>{{$site_title}}</h1>
          </div>
          <div class="col-sm-6 d-none d-sm-block">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">{{$site_title}}</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <form action="@if(isset($record->id)) {{ route('mission_vision_update', array('id' => encrypt($record->id))) }} @else{{ route('mission_vision_insert') }} @endif" method="POST" class="mission_vision_form" enctype="multipart/form-data">
                        @csrf
                        <div class="row">

                            <div class="mb-3 col-md-4">
                                <label for="icon" class="form-label">Icon<span class="text-danger">*</span></label><small>(Image Type : jpg,jpeg,png,webp)</small>
                                
                                <input type="hidden" name="old_image" id="old_image" value="{{isset($record->icon) ? $record->icon : old('old_image')}}">
                                
                                @if(isset($record->icon) && $record->icon)
                                    <img src="{{url('public/mission_vision/'.$record->icon)}}" width="100" style="margin-bottom: 10px; margin-left: 5px;">
                                @endif  
                                <input type="file" id="icon" class="form-control" name="icon">
                                <div class="error"></div>
                            </div>

                            <div class="col-md-4">
                                <label for="icon_name" class="form-label">Icon Name<span class="text-danger">*</span></label>
                                <input type="text" id="icon_name" class="form-control" name="icon_name" value="{{isset($record->icon_name) ? $record->icon_name : old('icon_name')}}">
                                <div class="error"></div>
                            </div>

                            <div class="mb-3 col-md-4">
                                <label for="icon_name_color" class="form-label">Icon Name Text Color</label>
                                <input type="text" class="form-control colorpicker" name="icon_name_color" id="icon_name_color" value="{{isset($record->icon_name_color) ? $record->icon_name_color : old('icon_name_color')}}">
                            </div>

                            <div class="mb-3 col-md-4">
                                @php($fontsize = fontSize())
                                <label for="icon_name_font_size" class="form-label">Icon Name Text Font Size</label>
                                <select class="form-control select2" name="icon_name_font_size">
                                    <option selected="selected" disabled="disabled">Select</option>
                                    @for($i=$fontsize['start']; $i<=$fontsize['end']; $i+=$fontsize['range'])
                                        <option value="{{$i}}px" @if(isset($record->icon_name_font_size) && $record->icon_name_font_size == $i.'px'){{'selected'}}@endif>{{$i}}px</option>
                                    @endfor
                               </select>
                            </div>

                            <div class="col-md-4">
                                @php($fontfamily = fontFamily())
                                <label for="icon_name_font_family" class="form-label">Icon Name Text Font Family</label>
                                <select class="form-control select2" name="icon_name_font_family">
                                    <option selected="selected" disabled="disabled">Select</option>
                                    @foreach($fontfamily as $family)
                                        <option value="{{$family['key']}}" @if(isset($record->icon_name_font_family) && $record->icon_name_font_family == $family['key']){{'selected'}}@endif>{{$family['value']}}</option>
                                    @endforeach
                               </select>
                            </div>

                            <div class="col-md-4">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" id="title" class="form-control" name="title" value="{{isset($record->title) ? $record->title : old('title')}}">
                                <div class="error"></div>
                            </div>

                            <div class="mb-3 col-md-4">
                                <label for="title_color" class="form-label">Title Text Color</label>
                                <input type="text" class="form-control colorpicker" name="title_color" id="title_color" value="{{isset($record->title_color) ? $record->title_color : old('title_color')}}">
                            </div>

                            <div class="col-md-4">
                                <label for="title_font_size" class="form-label">Title Text Font Size</label>
                                <select class="form-control select2" name="title_font_size">
                                    <option selected="selected" disabled="disabled">Select</option>
                                    @for($i=$fontsize['start']; $i<=$fontsize['end']; $i+=$fontsize['range'])
                                        <option value="{{$i}}px" @if(isset($record->title_font_size) && $record->title_font_size == $i.'px'){{'selected'}}@endif>{{$i}}px</option>
                                    @endfor
                               </select>
                            </div>

                            <div class="col-md-4">
                                <label for="title_font_family" class="form-label">Title Text Font Family</label>
                                <select class="form-control select2" name="title_font_family">
                                    <option selected="selected" disabled="disabled">Select</option>
                                    @foreach($fontfamily as $family)
                                        <option value="{{$family['key']}}" @if(isset($record->title_font_family) && $record->title_font_family == $family['key']){{'selected'}}@endif>{{$family['value']}}</option>
                                    @endforeach
                               </select>
                            </div>

                            <div class="col-md-12 mt-2 mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="ckeditor form-control" name="description">{{isset($record->description) ? $record->description : old('description')}}</textarea>
                                <div class="error"></div>
                            </div>

                            <div class="mb-3 col-md-4">
                                <label for="description_color" class="form-label">Description Text Color</label>
                                <input type="text" class="form-control colorpicker" name="description_color" id="description_color" value="{{isset($record->description_color) ? $record->description_color : old('description_color')}}">
                            </div>

                            <div class="mb-3 col-md-4">
                                <label for="description_font_size" class="form-label">Description Text Font Size</label>
                                <select class="form-control select2" name="description_font_size">
                                    <option selected="selected" disabled="disabled">Select</option>
                                    @for($i=$fontsize['start']; $i<=$fontsize['end']; $i+=$fontsize['range'])
                                        <option value="{{$i}}px" @if(isset($record->description_font_size) && $record->description_font_size == $i.'px'){{'selected'}}@endif>{{$i}}px</option>
                                    @endfor
                               </select>
                            </div>

                            <div class="col-md-4">
                                <label for="description_font_family" class="form-label">Description Text Font Family</label>
                                <select class="form-control select2" name="description_font_family">
                                    <option selected="selected" disabled="disabled">Select</option>
                                    @foreach($fontfamily as $family)
                                        <option value="{{$family['key']}}" @if(isset($record->description_font_family) && $record->description_font_family == $family['key']){{'selected'}}@endif>{{$family['value']}}</option>
                                    @endforeach
                                </select>
                            </div>

                             </div> 
                            
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary submit">Submit</button>
                            <a href="{{ route('mission_vision') }}" class="btn btn-danger">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
@section('javascript')
<script src="{{ asset('plugins/select2/js/select2.js') }}"></script>
<script src="{{ asset('plugins/select2/js/select2.min.js') }}"></script>
<script>
 $(document).ready(function () {
        $(".mission_vision_form").validate({
            rules: {
                'icon': {
                    required: checkIconImage,
                    extension: "jpg,jpeg,png,webp",
                },
                'icon_name': {
                    required: true,
                },
            },
            messages: {
                'icon': {
                    required: "The icon field is required.",
                    extension: "Image must be jpg,jpeg,png or webp.",
                },
                'icon_name': {
                    required: "The icon name field is required.",
                },
            },
            errorPlacement: function(error, element) {
                error.appendTo(element.parent().find('.error'));
            },
            submitHandler: function(form) {
                $(form).find('.submit').prop("disabled", true);
                form.submit();
            }
        });

        function checkIconImage() {
            var old_image = $('#old_image').val();
            var icon = $('#icon').val();

            if(old_image != '' || icon != ''){
                return false;
            }
            return true;
        }

    $('.colorpicker').colorpicker();

    });
</script>
@endsection