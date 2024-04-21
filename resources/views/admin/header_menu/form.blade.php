@extends('admin.layout.header')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h1>Header Menu Create</h1>
          </div>
        </div>
      </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('header_menu_insert') }}" method="POST" class="header_menu_form" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="mb-3 col-md-4">
                                <label for="menu_name" class="form-label">Select Menu<span class="text-danger">*</span></label>
                                <select class="form-control select2 menu_name" name="menu_name">
                                    <option selected="selected" disabled="disabled">Select</option>
                                    {{-- <option value="our_businesses" @if(old('menu_name') == 'our_businesses'){{'selected'}}@endif>Our Businesses</option>
                                    <option value="our_services" @if(old('menu_name') == 'our_services'){{'selected'}}@endif>Our Services</option>
                                    <option value="careers" @if(old('menu_name') == 'careers'){{'selected'}}@endif>Careers</option>
                                    <option value="awards_recognition" @if(old('menu_name') == 'awards_recognition'){{'selected'}}@endif>Awards & Recognition</option>
                                    <option value="contact_us" @if(old('menu_name') == 'contact_us'){{'selected'}}@endif>Contact Us</option> --}}
                                    
                                    <option value="Our Businesses" @if(old('menu_name') == 'Our Businesses'){{'selected'}}@endif>Our Businesses</option>
                                    <option value="Our Services" @if(old('menu_name') == 'Our Services'){{'selected'}}@endif>Our Services</option>
                                    <option value="Careers" @if(old('menu_name') == 'Careers'){{'selected'}}@endif>Careers</option>
                                    <option value="Awards & Recognition" @if(old('menu_name') == 'Awards & Recognition'){{'selected'}}@endif>Awards & Recognition</option>
                                    <option value="Contact Us" @if(old('menu_name') == 'Contact Us'){{'selected'}}@endif>Contact Us</option>

                                </select>
                                {{-- <div class="error"></div> --}}
                                <div class="error">@if ($errors->has('menu_name')) <label id="menu_name-error" class="error">{{ $errors->first('menu_name') }}</label>@endif</div>
                            </div>

                            <div class="col-md-4">
                                <label for="name" class="form-label">Name<span class="text-danger">*</span></label>
                                <input type="text" id="name" class="form-control name" name="name" value="{{old('name')}}">
                                {{-- <div class="error"></div> --}}
                                <div class="error">@if ($errors->has('name')) <label id="name-error" class="error">{{ $errors->first('name') }}</label>@endif</div>
                            </div>

                            <div class="col-md-4">
                                <label for="color" class="form-label">Name Text Color</label>
                                <input type="text" class="form-control colorpicker" name="color" id="color" value="{{old('color')}}">
                            </div>

                            <div class="mb-3 col-md-4">
                                @php($fontsize = fontSize())
                                <label for="font_size" class="form-label">Name Text Font Size</label>
                                <select class="form-control select2" name="font_size">
                                    <option selected="selected" disabled="disabled">Select</option>
                                    @for($i=$fontsize['start']; $i<=$fontsize['end']; $i+=$fontsize['range'])
                                        <option value="{{$i}}px" @if(old('font_size') == $i.'px'){{'selected'}}@endif>{{$i}}px</option>
                                    @endfor
                               </select>
                            </div>

                            <div class="col-md-4">
                                @php($fontfamily = fontFamily())
                                <label for="font_family" class="form-label">Name Text Font Family</label>
                                <select class="form-control select2" name="font_family">
                                    <option selected="selected" disabled="disabled">Select</option>
                                    @foreach($fontfamily as $family)
                                        <option value="{{$family['key']}}" @if(old('font_family') == $family['key']){{'selected'}}@endif>{{$family['value']}}</option>
                                    @endforeach
                               </select>
                            </div>

                            <div class="col-md-4">
                                <label for="link" class="form-label">Link</label>
                                <input type="text" id="link" class="form-control link" name="link" value="{{old('link')}}">
                                <div class="error">@if ($errors->has('link')) <label id="link-error" class="error">{{ $errors->first('link') }}</label>@endif</div>
                                {{-- <div class="error"></div> --}}
                            </div>
                            
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary submit" onclick="this.disabled='disabled';this.form.submit();">Submit</button>
                            <a href="{{ route('header_menu.index') }}" class="btn btn-danger">Cancel</a>
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

        // $('.menu_name').on('change', function() {
        //     $('.name').val('');
        // });

        // $(".header_menu_form").validate({
        //     rules: {
        //         'menu_name': {
        //             required: true,
        //         },
        //         'name': {
        //             required: true,
        //         },
        //         'link': {
        //             url: "url",
        //         },
        //     },
        //     messages: {
        //         'menu_name': {
        //             required: "The menu field is required.",
        //         },
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
        //     submitHandler: function(form) {
        //         $(form).find('.submit').prop("disabled", true);
        //         form.submit();
        //     }
        // });
      
        

    $('.colorpicker').colorpicker();

    });

    
</script>
@endsection