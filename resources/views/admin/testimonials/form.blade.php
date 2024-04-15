@extends('admin.layout.header')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h1>Testimonials Create</h1>
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

                            <div class="mb-3 col-md-4">
                                <label for="testimonials_title" class="form-label">Testimonials Title</label>
                                <input type="text" id="testimonials_title" class="form-control" name="testimonials_title">
                                <div class="error"></div>
                            </div>

                            <div class="col-md-4">
                                <label for="testimonials_title_color" class="form-label">Testimonials Title Text Color</label>
                                <input type="text" class="form-control colorpicker" name="testimonials_title_color" id="testimonials_title_color">
                            </div>

                            <div class="col-md-4">
                                @php($fontsize = fontSize())
                                <label for="testimonials_title_font_size" class="form-label">Testimonials Title Text Font Size</label>
                                <select class="form-control select2" name="testimonials_title_font_size">
                                    <option selected="selected" disabled="disabled">Select</option>
                                    @for($i=$fontsize['start']; $i<=$fontsize['end']; $i+=$fontsize['range'])
                                        <option value="{{$i}}px">{{$i}}px</option>
                                    @endfor
                                </select>
                            </div>

                            <div class="mb-3 col-md-4">
                                @php($fontfamily = fontFamily())
                                <label for="testimonials_title_font_family">Testimonials Title Text Font Family</label>
                                <select class="form-control select2" name="testimonials_title_font_family">
                                    <option selected="selected" disabled="disabled">Select</option>
                                    @foreach($fontfamily as $family)
                                        <option value="{{$family['key']}}">{{$family['value']}}</option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="col-md-4">
                                <label for="name" class="form-label">Image<span class="text-danger">*</span></label><small>(Height:90px,Width:90px; Image Type : jpg,jpeg,png,svg,webp)</small>
                                <input type="file" id="image" class="form-control" name="image">
                                <div class="error"></div>
                            </div>

                            <div class="col-md-4">
                                <label for="name" class="form-label">Name<span class="text-danger">*</span></label>
                                <input type="text" id="name" class="form-control" name="name">
                                <div class="error"></div>
                            </div>

                            <div class="col-md-4">
                                <label for="name_color" class="form-label">Name Text Color</label>
                                <input type="text" class="form-control colorpicker" name="name_color" id="name_color">
                            </div>

                            <div class="col-md-4">
                                <label for="name_font_size" class="form-label">Name Text Font Size</label>
                                <select class="form-control select2" name="name_font_size">
                                    <option selected="selected" disabled="disabled">Select</option>
                                    @for($i=$fontsize['start']; $i<=$fontsize['end']; $i+=$fontsize['range'])
                                        <option value="{{$i}}px">{{$i}}px</option>
                                    @endfor
                               </select>
                            </div>

                            <div class="mb-3 col-md-4">
                                <label for="name_font_family" class="form-label">Name Text Font Family</label>
                                <select class="form-control select2" name="name_font_family">
                                    <option selected="selected" disabled="disabled">Select</option>
                                    @foreach($fontfamily as $family)
                                        <option value="{{$family['key']}}">{{$family['value']}}</option>
                                    @endforeach
                               </select>
                            </div>

                            <div class="mb-3 col-md-4">
                                <label for="name_background_color" class="form-label">Name Background Color</label>
                                <input type="text" class="form-control colorpicker" name="name_background_color" id="name_background_color">
                            </div>

                            <div class="col-md-12 mt-2 mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="ckeditor form-control" name="description"></textarea>
                                <div class="error"></div>
                            </div>

                            <div class="mb-3 col-md-4">
                                <label for="description_color" class="form-label">Description Text Color</label>
                                <input type="text" class="form-control colorpicker" name="description_color" id="description_color">
                            </div>

                            <div class="col-md-4">
                                <label for="description_font_size" class="form-label">Description Text Font Size</label>
                                <select class="form-control select2" name="description_font_size">
                                    <option selected="selected" disabled="disabled">Select</option>
                                    @for($i=$fontsize['start']; $i<=$fontsize['end']; $i+=$fontsize['range'])
                                        <option value="{{$i}}px">{{$i}}px</option>
                                    @endfor
                               </select>
                            </div>

                            <div class="col-md-4">
                                <label for="description_font_family" class="form-label">Description Text Font Family</label>
                                <select class="form-control select2" name="description_font_family">
                                    <option selected="selected" disabled="disabled">Select</option>
                                    @foreach($fontfamily as $family)
                                        <option value="{{$family['key']}}">{{$family['value']}}</option>
                                    @endforeach
                               </select>
                            </div>

                        </div>

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary submit">Submit</button>
                            <a href="{{ route('testimonials.index') }}" class="btn btn-danger">Cancel</a>
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
                    extension: "jpg,jpeg,png,webp,svg",
                },
            },
            messages: {
                'name': {
                    required: "The name field is required.",
                },
                'image': {
                    required: "The image field is required.",
                    extension: "Image must be jpg,jpeg,png,svg or webp.",
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
