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
                    <form action="{{ route('contact_us_insert') }}" method="POST" class="contact_us_form" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-md-4">
                                <label for="image" class="form-label">Image<span class="text-danger">*</span></label>
                                <input type="hidden" name="old_image" id="old_image" value="{{isset($record->image) ? $record->image : old('old_image')}}">
                                @if(isset($record->image) && $record->image)
                                    <img src="{{url('public/contact_us/'.$record->image)}}" width="100" style="margin-bottom: 10px; margin-left: 5px;">
                                @endif  
                                <input type="file" id="image" class="form-control image" name="image">
                                @if($errors->has('image')) <div class="text-danger">{{ $errors->first('image')}}</div> @endif
                                <small class="image_type">(Height:478px,Width:1349px; Image Type : jpg,jpeg,png,svg,webp)</small>
                            </div>

                            <div class="col-md-4">
                                <label for="title">Title<span class="text-danger">*</span></label>
                                <input type="text" id="title" class="form-control" name="title" value="{{isset($record->title) ? $record->title : old('title')}}">
                                @if($errors->has('title')) <div class="text-danger">{{ $errors->first('title')}}</div> @endif
                            </div>

                            <div class="col-md-4">
                                <label for="title_color" class="form-label">Title Text Color</label>
                                <input type="text" class="form-control colorpicker" name="title_color" id="title_color" value="{{isset($record->title_color) ? $record->title_color : old('title_color')}}">
                            </div>

                            <div class="col-md-4 mb-3">
                                @php($fontsize = fontSize())
                                <label for="title_font_size" class="form-label">Title Text Font Size</label>
                                <select class="form-control select2" name="title_font_size">
                                    <option value="">Select</option>
                                    @for($i=$fontsize['start']; $i<=$fontsize['end']; $i+=$fontsize['range'])
                                        <option value="{{$i}}px" @if(isset($record->title_font_size) && $record->title_font_size == $i.'px'){{'selected'}}@endif>{{$i}}px</option>
                                    @endfor
                               </select>
                            </div>

                            <div class="col-md-4">
                                @php($fontfamily = fontFamily())
                                <label for="title_font_family" class="form-label">Title Text Font Family</label>
                                <select class="form-control select2" name="title_font_family">
                                    <option value="">Select</option>
                                    @foreach($fontfamily as $family)
                                        <option value="{{$family['key']}}" @if(isset($record->title_font_family) && $record->title_font_family == $family['key']){{'selected'}}@endif>{{$family['value']}}</option>
                                    @endforeach
                               </select>
                            </div>

                            <div class="col-md-4">
                                <label for="sub_title">Sub Title</label>
                                <input type="text" id="sub_title" class="form-control" name="sub_title" value="{{isset($record->sub_title) ? $record->sub_title : old('sub_title')}}">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="sub_title_color" class="form-label">Sub Title Text Color</label>
                                <input type="text" class="form-control colorpicker" name="sub_title_color" id="sub_title_color" value="{{isset($record->sub_title_color) ? $record->sub_title_color : old('sub_title_color')}}">
                            </div>

                            <div class="col-md-4">
                                @php($fontsize = fontSize())
                                <label for="sub_title_font_size" class="form-label">Sub Title Text Font Size</label>
                                <select class="form-control select2" name="sub_title_font_size">
                                    <option value="">Select</option>
                                    @for($i=$fontsize['start']; $i<=$fontsize['end']; $i+=$fontsize['range'])
                                        <option value="{{$i}}px" @if(isset($record->sub_title_font_size) && $record->sub_title_font_size == $i.'px'){{'selected'}}@endif>{{$i}}px</option>
                                    @endfor
                               </select>
                            </div>

                            <div class="col-md-4">
                                @php($fontfamily = fontFamily())
                                <label for="sub_title_font_family" class="form-label">Sub Title Text Font Family</label>
                                <select class="form-control select2" name="sub_title_font_family">
                                    <option value="" disabled="disabled">Select</option>
                                    @foreach($fontfamily as $family)
                                        <option value="{{$family['key']}}" @if(isset($record->sub_title_font_family) && $record->sub_title_font_family == $family['key']){{'selected'}}@endif>{{$family['value']}}</option>
                                    @endforeach
                               </select>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="form_title">Form Title</label>
                                <input type="text" id="form_title" class="form-control" name="form_title" value="{{isset($record->form_title) ? $record->form_title : old('form_title')}}">
                            </div>

                            <div class="col-md-4">
                                <label for="form_title_color" class="form-label">Form Title Text Color</label>
                                <input type="text" class="form-control colorpicker" name="form_title_color" id="form_title_color" value="{{isset($record->form_title_color) ? $record->form_title_color : old('form_title_color')}}">
                            </div>

                            <div class="col-md-4">
                                @php($fontsize = fontSize())
                                <label for="form_title_font_size" class="form-label">Form Title Text Font Size</label>
                                <select class="form-control select2" name="form_title_font_size">
                                    <option value="">Select</option>
                                    @for($i=$fontsize['start']; $i<=$fontsize['end']; $i+=$fontsize['range'])
                                        <option value="{{$i}}px" @if(isset($record->form_title_font_size) && $record->form_title_font_size == $i.'px'){{'selected'}}@endif>{{$i}}px</option>
                                    @endfor
                               </select>
                            </div>

                            <div class="col-md-4 mb-3">
                                @php($fontfamily = fontFamily())
                                <label for="form_title_font_family" class="form-label">Form Title Text Font Family</label>
                                <select class="form-control select2" name="form_title_font_family">
                                    <option value="">Select</option>
                                    @foreach($fontfamily as $family)
                                        <option value="{{$family['key']}}" @if(isset($record->form_title_font_family) && $record->form_title_font_family == $family['key']){{'selected'}}@endif>{{$family['value']}}</option>
                                    @endforeach
                               </select>
                            </div>

                            <div class="col-md-4">
                                <label for="form_sub_title">Form Sub Title</label>
                                <input type="text" id="form_sub_title" class="form-control" name="form_sub_title" value="{{isset($record->form_sub_title) ? $record->form_sub_title : old('form_sub_title')}}">
                            </div>

                            <div class="col-md-4">
                                <label for="form_sub_title_color" class="form-label">Form Sub Title Text Color</label>
                                <input type="text" class="form-control colorpicker" name="form_sub_title_color" id="form_sub_title_color" value="{{isset($record->form_sub_title_color) ? $record->form_sub_title_color : old('form_sub_title_color')}}">
                            </div>

                            <div class="col-md-4 mb-3">
                                @php($fontsize = fontSize())
                                <label for="form_sub_title_font_size" class="form-label">Form Sub Title Text Font Size</label>
                                <select class="form-control select2" name="form_sub_title_font_size">
                                    <option value="">Select</option>
                                    @for($i=$fontsize['start']; $i<=$fontsize['end']; $i+=$fontsize['range'])
                                        <option value="{{$i}}px" @if(isset($record->form_sub_title_font_size) && $record->form_sub_title_font_size == $i.'px'){{'selected'}}@endif>{{$i}}px</option>
                                    @endfor
                               </select>
                            </div>

                            <div class="col-md-4">
                                @php($fontfamily = fontFamily())
                                <label for="form_sub_title_font_family" class="form-label">Form Sub Title Text Font Family</label>
                                <select class="form-control select2" name="form_sub_title_font_family">
                                    <option value="">Select</option>
                                    @foreach($fontfamily as $family)
                                        <option value="{{$family['key']}}" @if(isset($record->form_sub_title_font_family) && $record->form_sub_title_font_family == $family['key']){{'selected'}}@endif>{{$family['value']}}</option>
                                    @endforeach
                               </select>
                            </div>

                            <div class="col-md-4">
                                <label for="map_link" class="form-label">Map Link</label>
                                <input type="text" class="form-control" name="map_link" id="map_link" value="{{isset($record->map_link) ? $record->map_link : old('map_link')}}">
                            </div>
                        </div>

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary submit">Submit</button>
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
        $(".contact_us_form").validate({
            rules: {
                'image': {
                    required: checkImage,
                    extension: "jpg,jpeg,png,webp,svg",
                },
                'title': {
                    required: true,
                },
            },
            messages: {
                'image': {
                    required: "The image field is required.",
                    extension: "Image must be jpg,jpeg,png,svg or webp.",
                },
                'title': {
                    required: "The title field is required.",
                },
            },
            submitHandler: function(form) {
                $(form).find('.submit').prop("disabled", true);
                form.submit();
            }
        });

        // image validation
        function checkImage() {
            var old_image = $('#old_image').val();
            var image = $('#image').val();

            if(old_image != '' || image != ''){
                return false;
            }
            return true;
        }

        $('.colorpicker').colorpicker();
    });
</script>
@endsection