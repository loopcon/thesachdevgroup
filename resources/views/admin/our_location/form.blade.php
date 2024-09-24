@extends('admin.layout.header')
@section('css')
    <link type="text/css" class="js-stylesheet" href="{{ url('public/plugins/parsley/parsley.css') }}" rel="stylesheet">
@endsection
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
                    <form action="{{ route('our_location_insert') }}" method="POST" class="our_location_form" enctype="multipart/form-data" data-parsley-validate="">
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-md-4">
                                <label for="image" class="form-label">Image<span class="text-danger">*</span></label>
                                <input type="hidden" name="old_image" id="old_image" value="{{isset($record->image) ? $record->image : old('old_image')}}">
                                @if(isset($record->image) && $record->image)
                                    <img src="{{url('public/our_location/'.$record->image)}}" width="100" style="margin-bottom: 10px; margin-left: 5px;">
                                @endif  
                                <input type="file" id="image" class="form-control image" name="image" required>
                                <small class="image_type">(Height:352px,Width:1349px; Image Type : jpg,jpeg,png,svg,webp)</small>
                            </div>

                            <div class="col-md-4">
                                <label for="title">Title<span class="text-danger">*</span></label>
                                <input type="text" id="title" class="form-control" name="title" value="{{isset($record->title) ? $record->title : old('title')}}" required>
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

                            <div class="col-md-4 mb-3">
								<label for="meta_title">Meta Title</label>
								<input type="text" class="form-control" name="meta_title" value="{{isset($record->meta_title) ? $record->meta_title : old('meta_title')}}">
							</div>

							<div class="col-md-4">
								<label for="meta_keyword">Meta Keyword</label>
								<textarea class="form-control" name="meta_keyword">{{isset($record->meta_keyword) ? $record->meta_keyword : old('mera_keyword')}}</textarea>
							</div>

							<div class="col-md-4 mb-3">
								<label for="meta_description">Meta Description</label>
								<textarea class="form-control" name="meta_description">{{isset($record->meta_description) ? $record->meta_description : old('meta_description')}}</textarea>
							</div> 
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary submit">Update</button>
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
        // $(".our_location_form").validate({
        //     rules: {
        //         'image': {
        //             required: checkImage,
        //             extension: "jpg,jpeg,png,webp,svg",
        //         },
        //         'title': {
        //             required: true,
        //         },
        //     },
        //     messages: {
        //         'image': {
        //             required: "The image field is required.",
        //             extension: "Image must be jpg,jpeg,png,svg or webp.",
        //         },
        //         'title': {
        //             required: "The title field is required.",
        //         },
        //     },
        //     submitHandler: function(form) {
        //         $(form).find('.submit').prop("disabled", true);
        //         form.submit();
        //     }
        // });

        // function checkImage() {
        //     var old_image = $('#old_image').val();
        //     var image = $('#image').val();

        //     if(old_image != '' || image != ''){
        //         return false;
        //     }
        //     return true;
        // }

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