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
            <h1>Home Our Businesses Create</h1>
          </div>
        </div>
      </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('home_our_businesses_insert') }}" method="POST" class="our_businesses_form" enctype="multipart/form-data" data-parsley-validate="">
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="image" class="form-label">Image<span class="text-danger">*</span></label>
                                <input type="file" id="image" class="form-control" name="image">
                                <small class="image_type">(Height:145px,Width:145px; Image Type : jpg,jpeg,png,svg,webp)</small>
                            </div>

                            <div class="col-md-6">
                                <label for="link">Link</label>
                                <input type="text" id="link" class="form-control" name="link">
                            </div>
                        </div>

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary submit">Submit</button>
                            <a href="{{ route('home_our_businesses.index') }}" class="btn btn-danger">Cancel</a>
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
        // $(".our_businesses_form").validate({
        //     rules: {
        //         'image': {
        //             required: true,
        //             extension: "jpg,jpeg,png,webp,svg",
        //         },
        //         'link': {
        //             url: "url",
        //         },
        //     },
        //     messages: {
        //         'image': {
        //             required: "The image field is required.",
        //             extension: "Image must be jpg,jpeg,png,svg or webp.",
        //         },
        //         'link': {
        //             url: "Please enter a valid link.",
        //         },
        //     },
        //     submitHandler: function(form) {
        //         $(form).find('.submit').prop("disabled", true);
        //         form.submit();
        //     }
        // });
        $('.colorpicker').colorpicker();
    });
</script>
@endsection