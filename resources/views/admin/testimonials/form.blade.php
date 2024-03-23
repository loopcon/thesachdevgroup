@extends('admin.layout.header')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h1>Testimonials</h1>
          </div>
          <div class="col-sm-6 d-none d-sm-block">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Testimonials</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('testimonials_insert') }}" method="POST" class="testimonials_form" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <label for="name" class="form-label">Name<span class="text-danger">*</span></label>
                                <input type="text" id="name" class="form-control" name="name">
                                <div class="error"></div>
                            </div>

                            <div class="col-md-4">
                                <label for="name" class="form-label">Image<span class="text-danger">*</span></label>
                                <input type="file" id="image" class="form-control" name="image">
                                <div class="error"></div>
                            </div>

                            <div class="col-md-4">
                                <label for="color" class="form-label">Color</label>
                                <input type="text" class="form-control colorpicker" name="color" id="color">
                            </div>

                            <div class="col-md-4 mt-2">
                                <label for="font_size" class="form-label">Font Size</label>
                                <select class="form-control select2" name="font_size">
                                    <option selected="selected" disabled="disabled">Select Font Size</option>
                                    @for($i=24; $i<=50; $i+=2)
                                        <option value="{{$i}}px">{{$i}}px</option>
                                    @endfor
                                </select>
                            </div>

                            <div class="col-md-4 mt-2">
                                <label for="font_family" class="form-label">Font Family</label>
                                <select class="form-control select2" name="font_family">
                                    <option selected="selected" disabled="disabled">Select Font Family</option>
                                        <option value="poppins">Poppins</option>
                                        <option value="sans-serif">Sans Serif</option>
                                </select>
                            </div>

                            <div class="col-md-12 mt-2 mb-3">
                                <label for="name" class="form-label">Description<span class="text-danger">*</span></label>
                                <textarea class="ckeditor form-control" name="description"></textarea>
                                <div class="error"></div>
                            </div>
                        </div>

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary submit">Submit</button>
                            <a href="{{ route('testimonials.index') }}" class="btn btn-default">Cancel</a>
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
        $(".testimonials_form").validate({
            ignore: [],
            rules: {
                'name': {
                    required: true,
                },
                'image': {
                    required: true,
                    extension: "jpg,jpeg,png",
                },
                'description': {
                    required: true,
                },
            },
            messages: {
                'name': {
                    required: "Name is required",
                },
                'image': {
                    required: "Image is required",
                    extension: "Please enter a value with a valid extension.",
                },
                'description': {
                    required: "Description is required",
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

        $('.colorpicker').colorpicker();

    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
       $('.ckeditor').ckeditor();
    });
</script>
@endsection
