@extends('admin.layout.header')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h1>Home Slider</h1>
          </div>
          <div class="col-sm-6 d-none d-sm-block">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Home Slider</li>
            </ol>
          </div>
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
                            <div class="col-md-4">
                                <label for="image" class="form-label">Image</label>
                                <input type="file" id="image" class="form-control" name="image">
                            </div>

                            <div class="col-md-4">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" id="title" class="form-control" name="title">
                            </div>

                            <div class="mb-3 col-md-4">
                                <label for="subtitle" class="form-label">Sub Title</label>
                                <input type="text" id="subtitle" class="form-control" name="subtitle">
                            </div>


                            <div class="col-md-4">
                                <label for="color" class="form-label">Color</label>
                                <input type="text" class="form-control colorpicker" name="color" id="color">
                            </div>

                            <div class="mb-3 col-md-4">
                                <label for="font_size" class="form-label">Font Size</label>
                                <select class="form-control select2" name="font_size">
                                    <option selected="selected" disabled="disabled">Select Font Size</option>
                                    @for($i=24; $i<=50; $i+=2)
                                        <option value="{{$i}}px">{{$i}}px</option>
                                    @endfor
                               </select>
                            </div>

                            <div class="col-md-4">
                                <label for="font_family" class="form-label">Font Family</label>
                                <select class="form-control select2" name="font_family">
                                    <option selected="selected" disabled="disabled">Select Font Family</option>
                                        <option value="poppins">Poppins</option>
                                        <option value="sans-serif">Sans Serif</option>
                               </select>
                            </div>

                            
                            <div class="mb-3 col-md-4">
                                <label for="text_position" class="form-label">Text Position</label>
                                <select class="form-control select2" name="text_position">
                                    <option selected="selected" disabled="disabled">Text Position</option>
                                    <option value="left">Left</option>
                                    <option value="right">Right</option>
                               </select>
                            </div>

                        </div>

                      

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary submit">Submit</button>
                            <a href="{{ route('homeslider.index') }}" class="btn btn-default">Cancel</a>
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
                extension: "jpg,jpeg,png",
            },
        },
        messages: {
            'image': {
                required: "The image field is required.",
                extension: "The image must be an image.",
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