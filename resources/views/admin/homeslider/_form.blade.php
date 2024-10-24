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
            <h1>Home Slider Edit</h1>
          </div>
        </div>
      </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    @foreach($homesliders as $homeslider)
                        <form method="post" action="{{ route('homeslider_update', $homeslider->id) }}" class="edit_form" enctype="multipart/form-data" data-parsley-validate="">
                            @csrf
                            <input type="hidden" value="{{ $homeslider->id }}" class="id" name="id">
                            <div class="row">
                                <div class="mb-3 col-md-4">
                                    <label for="image" class="form-label">Image<span class="text-danger">*</span></label>
                                    <input type="hidden" name="old_image" id="old_image" value="{{isset($homeslider->image) ? $homeslider->image : old('image')}}">
                                    @if(isset($homeslider->image) && isset($homeslider->image))
                                        <img src="{{url('public/home_slider/'.$homeslider->image)}}" width="100" style="margin-bottom:10px; margin-left:5px;"> 
                                    @endif
                                    <input type="file" id="image" class="form-control" name="image" required>
                                    <small class="image_type">(Height:478px,Width:1349px; Image Type : jpg,jpeg,png,svg,webp)</small>
                                </div>
    
                                <div class="col-md-4">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" id="title" class="form-control" name="title" value="{{$homeslider->title}}">
                                </div>

                                <div class="mb-3 col-md-4">
                                    <label for="title_color" class="form-label">Title Text Color</label>
                                    <input type="text" class="form-control colorpicker" name="title_color" id="title_color" value="{{$homeslider->title_color}}">
                                </div>

                                <div class="mb-3 col-md-4">
                                    @php($fontsize = fontSize())
                                    <label for="title_font_size" class="form-label">Title Text Font Size</label>
                                    <select class="form-control select2" name="title_font_size">
                                        <option value="">Select</option>
                                        @for($i=$fontsize['start']; $i<=$fontsize['end']; $i+=$fontsize['range'])
                                            <option value="{{$i}}px" {{$homeslider->title_font_size == $i.'px' ? 'selected' : ''}}>{{$i}}px</option>
                                        @endfor
                                   </select>
                                </div>
    
                                <div class="col-md-4">
                                    @php($fontfamily = fontFamily())
                                    <label for="title_font_family" class="form-label">Title Text Font Family</label>
                                    <select class="form-control select2" name="title_font_family">
                                        <option value="">Select</option>
                                        @foreach($fontfamily as $family)
                                            <option value="{{$family['key']}}" {{$homeslider->title_font_family == $family['key'] ? 'selected' : ''}}>{{$family['value']}}</option>
                                        @endforeach
                                   </select>
                                </div>

                                <div class="mb-3 col-md-4">
                                    <label for="subtitle" class="form-label">Sub Title</label>
                                    <input type="text" id="subtitle" class="form-control" name="subtitle" value="{{$homeslider->subtitle}}">
                                </div>
    
                                <div class="mb-3 col-md-4">
                                    <label for="sub_title_color" class="form-label">Sub Title Text Color</label>
                                    <input type="text" class="form-control colorpicker" name="sub_title_color" id="sub_title_color" value="{{$homeslider->sub_title_color}}">
                                </div>
    
                                <div class="mb-3 col-md-4">
                                    <label for="sub_title_font_size" class="form-label">Sub Title Text Font Size</label>
                                    <select class="form-control select2" name="sub_title_font_size">
                                        <option value="">Select</option>
                                        @for($i=$fontsize['start']; $i<=$fontsize['end']; $i+=$fontsize['range'])
                                        <option value="{{$i}}px" {{$homeslider->sub_title_font_size == $i.'px' ? 'selected' : ''}}>{{$i}}px</option>
                                    @endfor
                                   </select>
                                </div>
    
                                <div class="col-md-4">
                                    <label for="sub_title_font_family" class="form-label">Sub Title Text Font Family</label>
                                    <select class="form-control select2" name="sub_title_font_family">
                                        <option value="">Select</option>
                                        @foreach($fontfamily as $family)
                                            <option value="{{$family['key']}}" {{$homeslider->sub_title_font_family == $family['key'] ? 'selected' : ''}}>{{$family['value']}}</option>
                                        @endforeach
                                   </select>
                                </div>
                                
                                <div class="mb-3 col-md-4">
                                    @php($position = position())
                                    <label for="image" class="form-label">Text Position</label>
                                    <select class="form-control select2" name="text_position">
                                        <option value="">Select</option>
                                        @foreach($position as $pos)
                                            <option value="{{$pos['key']}}" {{$homeslider->text_position == $pos['key'] ? 'selected' : ''}}>{{$pos['value']}}</option>
                                        @endforeach
                                   </select>
                                </div>
                            </div>
    
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary submit">Submit</button>
                                <a href="{{ route('homeslider.index') }}" class="btn btn-danger">Cancel</a>
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
<script>
    $(document).ready(function () {
        // $(".edit_form").validate({
        //     rules: {
        //         image: {
        //             extension: "jpg,jpeg,png,webp,svg",
        //         },
        //     },
        //     messages: {
        //         image: {
        //             extension: "Image must be jpg,jpeg,png,svg or webp.",
        //         },
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