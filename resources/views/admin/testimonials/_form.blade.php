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
            <h1>Testimonials Edit</h1>
          </div>
        </div>
      </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    @foreach($testimonials as $testimonial)
                        <form method="post" action="{{ route('testimonials_update', $testimonial->id) }}" class="edit_form" enctype="multipart/form-data" data-parsley-validate="">
                            @csrf
                            <input type="hidden" value="{{ $testimonial->id }}" class="id" name="id">
                            <div class="row">
                                <div class="mb-3 col-md-4">
                                    <label for="image" class="form-label">Image<span class="text-danger">*</span></label>
                                    <input type="hidden" name="old_image" id="old_image" value="{{$testimonial->image}}">
                                    @if(isset($testimonial->image) && isset($testimonial->image))
                                        <img src="{{url('public/testimonials/'.$testimonial->image)}}" width="100" style="margin-bottom:10px; margin-left:10px;">
                                    @endif
                                    <input type="file" id="image" class="form-control" name="image" required>
                                    @if ($errors->has('image')) <div class="text-danger">{{ $errors->first('image') }}</div>@endif
                                    <small class="image_type">(Height:90px,Width:90px; Image Type : jpg,jpeg,png,svg,webp)</small>
                                </div>

                                <div class="col-md-4">
                                    <label for="name" class="form-label">Name<span class="text-danger">*</span></label>
                                    <input  type="text" class="form-control" name="name" value="{{$testimonial->name}}" required>
                                    @if ($errors->has('name')) <div class="text-danger">{{ $errors->first('name') }}</div>@endif
                                </div>

                                <div class="mb-3 col-md-4">
                                    <label for="name_color" class="form-label">Name Text Color</label>
                                    <input type="text" class="form-control colorpicker" name="name_color" id="name_color" value="{{$testimonial->name_color}}">
                                </div>

                                <div class="col-md-4">
                                    @php($fontsize = fontSize())
                                    <label for="name_font_size">Name Text Font Size</label>
                                    <select class="form-control select2" name="name_font_size">
                                        <option value="">Select</option>
                                        @for($i=$fontsize['start']; $i<=$fontsize['end']; $i+=$fontsize['range'])
                                            <option value="{{$i}}px" {{$testimonial->name_font_size == $i.'px' ? 'selected' : ''}}>{{$i}}px</option>
                                        @endfor
                                    </select>
                                </div>

                                <div class="mb-3 col-md-4">
                                    @php($fontfamily = fontFamily())
                                    <label for="name_font_family">Name Text Font Family</label>
                                    <select class="form-control select2" name="name_font_family">
                                        <option value="">Select</option>
                                        @foreach($fontfamily as $family)
                                            <option value="{{$family['key']}}" {{$testimonial->name_font_family == $family['key'] ? 'selected' : ''}}>{{$family['value']}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3 col-md-4">
                                    <label for="name_background_color" class="form-label">Name Background Color</label>
                                    <input type="text" class="form-control colorpicker" name="name_background_color" id="name_background_color" value="{{$testimonial->name_background_color}}">
                                </div>

                                <div class="col-md-12 mt-2 mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control" name="description" id="description">{{$testimonial->description}}</textarea>
                                </div>

                                <?php /**<div class="mb-3 col-md-4">
                                    <label for="description_color" class="form-label">Description Text Color</label>
                                    <input type="text" class="form-control colorpicker" name="description_color" id="description_color" value="{{$testimonial->description_color}}">
                                    <div class="error"></div>
                                </div>

                                <div class="col-md-4 mt-2">
                                    <label for="description_font_size">Description Text Font Size</label>
                                    <select class="form-control select2" name="description_font_size">
                                        <option value="">Select</option>
                                        @for($i=$fontsize['start']; $i<=$fontsize['end']; $i+=$fontsize['range'])
                                            <option value="{{$i}}px" {{$testimonial->description_font_size == $i.'px' ? 'selected' : ''}}>{{$i}}px</option>
                                        @endfor
                                    </select>
                                </div>

                                <div class="col-md-4 mt-2" >
                                    <label for="description_font_family">Description Text Font Family</label>
                                    <select class="form-control select2" name="description_font_family">
                                        <option value="">Select</option>
                                        @foreach($fontfamily as $family)
                                            <option value="{{$family['key']}}" {{$testimonial->description_font_family == $family['key'] ? 'selected' : ''}}>{{$family['value']}}</option>
                                        @endforeach
                                    </select>
                                </div>**/ ?>
                            </div>

                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <a href="{{ route('testimonials.index') }}" class="btn btn-danger">Cancel</a>
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
<script src="{{ url('public/plugins/parsley/parsley.js') }}"></script>
<script src="{{asset('public/plugins/ckeditor/ckeditor.js')}}"  type="text/javascript"></script>
<script>
    $(document).ready(function () {

         CKEDITOR.replace('description', {
            height:300,
        });

        // $(".edit_form").validate({
        //     ignore: [],
        //     rules: {
        //         'name': {
        //             required: true,
        //         },
        //         image: {
        //             extension: "jpg,jpeg,png,webp,svg",
        //         },
        //     },
        //     messages: {
        //         'name': {
        //             required: "The name field is required.",
        //         },
        //         image: {
        //             extension: "Image must be jpg,jpeg,png,svg or webp.",
        //         },
        //     },
        //     errorPlacement: function(error, element) {
        //         error.appendTo(element.parent().find('.error'));
        //     },
        // });

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
  