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
        </div>
      </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <form action="@if(isset($record->id)) {{ route('used_car_update', array('id' => encrypt($record->id))) }} @else{{ route('used_car_insert') }} @endif" method="POST" class="used_car_form" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-md-4">
                                <label for="image" class="form-label">Image<span class="text-danger">*</span></label>
                                
                                <input type="hidden" name="old_image" id="old_image" value="{{isset($record->image) ? $record->image : old('old_image')}}">
                                
                                @if(isset($record->image) && $record->image)
                                    <img src="{{url('public/used_car_image/'.$record->image)}}" width="100" style="margin-bottom: 10px; margin-left: 5px;">
                                @endif  
                                <input type="file" id="image" class="form-control" name="image">
                                <div class="error"></div>
                                <small class="image_type">(Height:243px,Width:325px; Image Type : jpg,jpeg,png,svg,webp)</small>
                            </div>

                            <div class="col-md-4">
                                <label for="name" class="form-label">Name<span class="text-danger">*</span></label>
                                <input type="text" id="name" class="form-control" name="name" value="{{isset($record->name) ? $record->name : old('name')}}">
                                <div class="error"></div>
                            </div>

                            <div class="col-md-4">
                                <label for="name_color" class="form-label">Name Text Color</label>
                                <input type="text" class="form-control colorpicker" name="name_color" id="name_color" value="{{isset($record->name_color) ? $record->name_color : old('name_color')}}">
                            </div>

                            <div class="mb-3 col-md-4">
                                @php($fontsize = fontSize())
                                <label for="name_font_size" class="form-label">Name Text Font Size</label>
                                <select class="form-control select2" name="name_font_size">
                                    <option selected="selected" disabled="disabled">Select</option>
                                    @for($i=$fontsize['start']; $i<=$fontsize['end']; $i+=$fontsize['range'])
                                        <option value="{{$i}}px" @if(isset($record->name_font_size) && $record->name_font_size == $i.'px'){{'selected'}}@endif>{{$i}}px</option>
                                    @endfor
                               </select>
                            </div>

                            <div class="col-md-4">
                                @php($fontfamily = fontFamily())
                                <label for="name_font_family" class="form-label">Name Text Font Family</label>
                                <select class="form-control select2" name="name_font_family">
                                    <option selected="selected" disabled="disabled">Select</option>
                                    @foreach($fontfamily as $family)
                                        <option value="{{$family['key']}}" @if(isset($record->name_font_family) && $record->name_font_family == $family['key']){{'selected'}}@endif>{{$family['value']}}</option>
                                    @endforeach
                               </select>
                            </div>

                            <div class="col-md-4">
                                <label for="link" class="form-label">Link</label>
                                <input type="text" id="link" class="form-control" name="link" value="{{isset($record->link) ? $record->link : old('link')}}">
                                <div class="error"></div>
                            </div>

                            
                            <div class="mb-3 col-md-4">
                                <label for="rating" class="form-label">Rating<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="rating" id="rating" value="{{isset($record->rating) ? $record->rating : old('rating')}}">
                                <div class="error"></div>
                            </div>

                            <div class="col-md-4">
                                <label for="number_of_rating" class="form-label">Number of Rating<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" maxlength="5" name="number_of_rating" id="number_of_rating" value="{{isset($record->number_of_rating) ? $record->number_of_rating : old('number_of_rating')}}">
                                <div class="error"></div>
                            </div>
                        </div> 
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary submit">Submit</button>
                            <a href="{{ route('used_car') }}" class="btn btn-danger">Cancel</a>
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
        $(".used_car_form").validate({
            rules: {
                'image': {
                    required: checkImage,
                    extension: "jpg,jpeg,png,webp,svg",
                },
                'name': {
                    required: true,
                },
                'link': {
                    url: "url",
                },
                'rating': {
                    required: true,
                    number: true,
                    max: 5
                },
                'number_of_rating': {
                    required: true,
                    number: true,
                },
            },
            messages: {
                'image': {
                    required: "The image field is required.",
                    extension: "Image must be jpg,jpeg,png,svg or webp.",
                },
                'name': {
                    required: "The name field is required.",
                },
                'link': {
                    url: "Please enter a valid link.",
                },
                'rating': {
                    required: "The rating field is required.",
                    max: "The rating must not be greater than 5."
                },
                'number_of_rating': {
                    required: "The number of rating field is required.",
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