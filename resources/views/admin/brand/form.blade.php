@extends('admin.layout.header')
@section('css')
    <link class="js-stylesheet" href="{{ asset('plugins/parsley/parsley.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h1>Brand Create</h1>
          </div>
        </div>
      </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('brand_insert') }}" method="POST" class="brand_form" enctype="multipart/form-data" data-parsley-validate="">
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-md-4">
                                <label for="image" class="form-label">Image<span class="text-danger">*</span></label>
                                <input type="file" id="image" class="form-control" name="image" required>
                                <small class="image_type">(Height:145px,Width:145px; Image Type : jpg,jpeg,png,svg,webp)</small>
                            </div>

                            <div class="col-md-4">
                                <label for="name" class="form-label">Name<span class="text-danger">*</span></label>
                                <input type="text" id="name" class="form-control" name="name" required>
                            </div>

                            <div class="col-md-4">
                                <label for="color" class="form-label">Name Text Color</label>
                                <input type="text" class="form-control colorpicker" name="color" id="color">
                            </div>

                            <div class="mb-3 col-md-4">
                                @php($fontsize = fontSize())
                                <label for="font_size" class="form-label">Name Text Font Size</label>
                                <select class="form-control select2" name="font_size">
                                    <option value="">Select</option>
                                    @for($i=$fontsize['start']; $i<=$fontsize['end']; $i+=$fontsize['range'])
                                        <option value="{{$i}}px">{{$i}}px</option>
                                    @endfor
                                </select>
                            </div>

                            <div class="col-md-4">
                                @php($fontfamily = fontFamily())
                                <label for="font_family" class="form-label">Name Text Font Family</label>
                                <select class="form-control select2" name="font_family">
                                    <option value="">Select</option>
                                    @foreach($fontfamily as $family)
                                        <option value="{{$family['key']}}">{{$family['value']}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label for="link" class="form-label">Link<span class="text-danger">*</span></label>
                                <input type="text" id="link" class="form-control" name="link">
                            </div>
                        </div>

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary submit">Submit</button>
                            <a href="{{ route('brand.index') }}" class="btn btn-danger">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
@section('javascript')
<script src="{{ asset('plugins/parsley/parsley.js') }}"></script>
<script>
    $(document).ready(function () {
        // $(".brand_form").validate({
        //     rules: {
        //         'image': {
        //             required: true,
        //             extension: "jpg,jpeg,png,webp,svg",
        //         },
        //         'name': {
        //             required: true,
        //         },
        //         'link': {
        //             required: true,
        //             url: "url",
        //         },
        //     },
        //     messages: {
        //         'image': {
        //             required: "The image field is required.",
        //             extension: "Image must be jpg,jpeg,png,svg or webp.",
        //         },
        //         'name': {
        //             required: "The name field is required.",
        //         },
        //         'link': {
        //             required: "The link field is required.",
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