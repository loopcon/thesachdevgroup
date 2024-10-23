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
            <h1>Header Menu Edit</h1>
          </div>
        </div>
      </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    @foreach($header_menus as $header_menu)
                        <form method="post" action="{{ route('header_menu_update', $header_menu->id) }}" class="edit_form" enctype="multipart/form-data" data-parsley-validate="">
                            @csrf
                            <input type="hidden" value="{{ $header_menu->id }}" class="id" name="id">
                                <div class="row">
                                    <div class="mb-3 col-md-4">
                                        <label for="menu_name" class="form-label">Select Menu<span class="text-danger">*</span></label>
                                        {{-- <select class="form-control select2 menu_name" name="menu_name" required>
                                            <option value="">Select</option>
                                            <option value="our_businesses" {{ old('menu_name', $header_menu->menu_name) == 'our_businesses' ? 'selected' : '' }}>Our Businesses</option>
                                            <option value="our_services" {{ old('menu_name', $header_menu->menu_name) == 'our_services' ? 'selected' : '' }}>Our Services</option>
                                            <option value="careers" {{ old('menu_name', $header_menu->menu_name) == 'careers' ? 'selected' : '' }}>Careers</option>
                                            <option value="awards_recognition" {{ old('menu_name', $header_menu->menu_name) == 'awards_recognition' ? 'selected' : '' }}>Awards & Recognition</option>
                                            <option value="contact_us" {{ old('menu_name', $header_menu->menu_name) == 'contact_us' ? 'selected' : '' }}>Contact Us</option>
                                       </select> --}}
                                        <select class="form-control select2 menu_name" name="menu_name">
                                            <option value="">Select</option>
                                            <option value="Our Businesses" {{ old('menu_name', $header_menu->menu_name) == 'Our Businesses' ? 'selected' : '' }}>Our Businesses</option>
                                            <option value="Our Services" {{ old('menu_name', $header_menu->menu_name) == 'Our Services' ? 'selected' : '' }}>Our Services</option>
                                            <option value="Careers" {{ old('menu_name', $header_menu->menu_name) == 'Careers' ? 'selected' : '' }}>Careers</option>
                                            <option value="Awards & Recognition" {{ old('menu_name', $header_menu->menu_name) == 'Awards & Recognition' ? 'selected' : '' }}>Awards & Recognition</option>
                                            <option value="Contact Us" {{ old('menu_name', $header_menu->menu_name) == 'Contact Us' ? 'selected' : '' }}>Contact Us</option>
                                        </select>
                                    </div>
        
                                    <div class="col-md-4">
                                        <label for="name" class="form-label">Name<span class="text-danger">*</span></label>
                                        <input type="text" id="name" class="form-control name" name="name" value="{{old('name', $header_menu->name)}}" required>
                                        <div class="error">@if ($errors->has('name')) <label id="name-error" class="error">{{ $errors->first('name') }}</label>@endif</div>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="color" class="form-label">Name Text Color</label>
                                        <input type="text" class="form-control colorpicker" name="color" id="color" value="{{old('color', $header_menu->color)}}">
                                    </div>

                                    <div class="mb-3 col-md-4">
                                        @php($fontsize = fontSize())
                                        <label for="font_size" class="form-label">Name Text Font Size</label>
                                        <select class="form-control select2" name="font_size">
                                            <option value="">Select</option>
                                            @for($i=$fontsize['start']; $i<=$fontsize['end']; $i+=$fontsize['range'])
                                                <option value="{{$i}}px" {{ old('font_size', $header_menu->font_size) == $i.'px' ? 'selected' : '' }}>{{$i}}px</option>
                                            @endfor
                                       </select>
                                    </div>

                                    <div class="col-md-4">
                                        @php($fontfamily = fontFamily())
                                        <label for="font_family" class="form-label">Name Text Font Family</label>
                                        <select class="form-control select2" name="font_family">
                                            <option value="">Select</option>
                                            @foreach($fontfamily as $family)   
                                                <option value="{{$family['key']}}" {{ old('font_family', $header_menu->font_family) == $family['key'] ? 'selected' : '' }}>{{$family['value']}}</option>
                                            @endforeach
                                       </select>
                                    </div>
        
                                    <div class="col-md-4">
                                        <label for="link" class="form-label">Link</label>
                                        <input type="text" id="link" class="form-control" name="link" value="{{old('link', $header_menu->link)}}">
                                        <div class="error">@if ($errors->has('link')) <label id="link-error" class="error">{{ $errors->first('link') }}</label>@endif</div>
                                    </div>

                                </div>
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-primary submit">Submit</button>
                                    <a href="{{ route('header_menu.index') }}" class="btn btn-danger">Cancel</a>
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
        //         'name': {
        //             required: true,
        //         },
        //         'link': {
        //             url: "url",
        //         },
        //     },
        //     messages: {
        //         'name': {
        //             required: "The name field is required.",
        //         },
        //         'link': {
        //             url: "Please enter a valid link.",
        //         },
        //     },
        //     errorPlacement: function(error, element) {
        //         error.appendTo(element.parent().find('.error'));
        //     },
        // });

        $('.colorpicker').colorpicker();
    });
</script>
@endsection
  