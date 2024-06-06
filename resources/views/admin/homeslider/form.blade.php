@extends('admin.layout.header')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h1>Home Slider Create</h1>
          </div>
          {{-- <div class="col-sm-6 d-none d-sm-block">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Home Slider Create</li>
            </ol>
          </div> --}}
        </div>
      </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('homeslider_insert') }}" method="POST" class="slider_form" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-md-4">
                                <label for="image" class="form-label">Image<span class="text-danger">*</span></label>
                                <input type="file" id="image" class="form-control" name="image">
                                <small class="image_type">(Height:478px,Width:1349px; Image Type : jpg,jpeg,png,svg,webp)</small>
                            </div>

                            <div class="col-md-4">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" id="title" class="form-control" name="title">
                            </div>

                            <div class="col-md-4">
                                <label for="title_color" class="form-label">Title Text Color</label>
                                <input type="text" class="form-control colorpicker" name="title_color" id="title_color">
                            </div>

                            <div class="mb-3 col-md-4">
                                @php($fontsize = fontSize())
                                <label for="title_font_size" class="form-label">Title Text Font Size</label>
                                <select class="form-control select2" name="title_font_size">
                                    <option value="">Select</option>
                                    @for($i=$fontsize['start']; $i<=$fontsize['end']; $i+=$fontsize['range'])
                                        <option value="{{$i}}px">{{$i}}px</option>
                                    @endfor
                               </select>
                            </div>

                            <div class="col-md-4">
                                @php($fontfamily = fontFamily())
                                <label for="title_font_family" class="form-label">Title Text Font Family</label>
                                <select class="form-control select2" name="title_font_family">
                                    <option value="">Select</option>
                                    @foreach($fontfamily as $family)
                                        <option value="{{$family['key']}}">{{$family['value']}}</option>
                                    @endforeach
                               </select>
                            </div>

                            <div class="mb-3 col-md-4">
                                <label for="subtitle" class="form-label">Sub Title</label>
                                <input type="text" id="subtitle" class="form-control" name="subtitle">
                            </div>

                            <div class="col-md-4">
                                <label for="sub_title_color" class="form-label">Sub Title Text Color</label>
                                <input type="text" class="form-control colorpicker" name="sub_title_color" id="sub_title_color">
                            </div>

                            <div class="mb-3 col-md-4">
                                <label for="sub_title_font_size" class="form-label">Sub Title Text Font Size</label>
                                <select class="form-control select2" name="sub_title_font_size">
                                    <option value="">Select</option>
                                    @for($i=$fontsize['start']; $i<=$fontsize['end']; $i+=$fontsize['range'])
                                        <option value="{{$i}}px">{{$i}}px</option>
                                    @endfor
                               </select>
                            </div>

                            <div class="col-md-4">
                                <label for="sub_title_font_family" class="form-label">Sub Title Text Font Family</label>
                                <select class="form-control select2" name="sub_title_font_family">
                                    <option value="">Select</option>
                                    @foreach($fontfamily as $family)
                                        <option value="{{$family['key']}}">{{$family['value']}}</option>
                                    @endforeach
                               </select>
                            </div>

                            <div class="mb-3 col-md-4">
                                @php($position = position())
                                <label for="text_position" class="form-label">Text Position</label>
                                <select class="form-control select2" name="text_position">
                                    <option value="">Select</option>
                                    @foreach($position as $pos)
                                        <option value="{{$pos['key']}}">{{$pos['value']}}</option>
                                    @endforeach
                               </select>
                            </div>
                        </div>

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary submit">Submit</button>
                            <a href="{{ route('homeslider.index') }}" class="btn btn-danger">Cancel</a>
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
    $(".slider_form").validate({
        rules: {
            'image': {
                required: true,
                extension: "jpg,jpeg,png,webp,svg",
            },
        },
        messages: {
            'image': {
                required: "The image field is required.",
                extension: "Image must be jpg,jpeg,png,svg or webp.",
            },
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