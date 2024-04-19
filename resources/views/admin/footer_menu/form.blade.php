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
                    <form action="@if(isset($record->id)) {{ route('footer_menu_update', array('id' => encrypt($record->id))) }} @else{{ route('footer_menu_insert') }} @endif" method="POST" class="footer_menu_form" enctype="multipart/form-data">
                        @csrf
                        <div class="row">

                            <div class="mb-3 col-md-4">
                                <label for="menu_name" class="form-label">Select Menu<span class="text-danger">*</span></label>
                                <select class="form-control select2" name="menu_name">
                                    <option selected="selected" disabled="disabled">Select</option>
                                    <option value="our_services" {{(old('menu_name') == 'our_services' ? 'selected' : (old('menu_name') == '' && isset($record->menu_name) && $record->menu_name == 'our_services' ? 'selected' : ''))}}>Our Services</option>
                                    <option value="our_businesses" {{(old('menu_name') == 'our_businesses' ? 'selected' : (old('menu_name') == '' && isset($record->menu_name) && $record->menu_name == 'our_businesses' ? 'selected' : ''))}}>Our Businesses</option>
                                    <option value="useful_links" {{(old('menu_name') == 'useful_links' ? 'selected' : (old('menu_name') == '' && isset($record->menu_name) && $record->menu_name == 'useful_links' ? 'selected' : ''))}}>Useful Links</option>
                                </select>
                                <div class="error">@if ($errors->has('menu_name')) <label id="menu_name-error" class="error">{{ $errors->first('menu_name') }}</label>@endif</div>
                            </div>

                            <div class="col-md-4">
                                <label for="name" class="form-label">Name<span class="text-danger">*</span></label>
                                <input type="text" id="name" class="form-control" name="name" value="{{ old('name') ?  old('name') : (isset($record->name) ? $record->name :  '')}}">
                                <div class="error">@if ($errors->has('name')) <label id="name-error" class="error">{{ $errors->first('name') }}</label>@endif</div>
                            </div>

                            <div class="mb-3 col-md-4">
                                <label for="color" class="form-label">Name Text Color</label>
                                <input type="text" id="color" class="form-control colorpicker" name="color" value="{{ old('color') ?  old('color') : (isset($record->color) ? $record->color :  '')}}">
                            </div>

                            <div class="mb-3 col-md-4">
                                @php($fontsize = fontSize())
                                <label for="font_size" class="form-label">Name Text Font Size</label>
                                <select class="form-control select2" name="font_size">
                                    <option selected="selected" disabled="disabled">Select</option>
                                    @for($i=$fontsize['start']; $i<=$fontsize['end']; $i+=$fontsize['range'])
                                        @php ($selected = '')
                                        @if(old('font_size') == $i.'px')
                                            @php ($selected = 'selected')
                                        @elseif(old('font_size') == '' && isset($record->font_size) && $record->font_size == $i.'px') 
                                            @php ($selected = 'selected')  
                                        @endif
                                        <option value="{{$i}}px" {{$selected}}>{{$i}}px</option>
                                    @endfor
                               </select>
                            </div>

                            <div class="col-md-4">
                                @php($fontfamily = fontFamily())
                                <label for="font_family" class="form-label">Name Text Font Family</label>
                                <select class="form-control select2" name="font_family">
                                    <option selected="selected" disabled="disabled">Select</option>
                                    @foreach($fontfamily as $family)
                                        @php ($selected_font_family = '')
                                        @if(old('font_family') == $family['key'])
                                            @php ($selected_font_family = 'selected')
                                        @elseif(old('font_family') == '' && isset($record->font_family) && $record->font_family == $family['key']) 
                                            @php ($selected_font_family = 'selected')  
                                        @endif
                                        <option value="{{$family['key']}}" {{$selected_font_family}}>{{$family['key']}}</option>
                                    @endforeach
                               </select>
                            </div>

                            <div class="col-md-4">
                                <label for="link" class="form-label">Link</label>
                                <input type="text" id="link" class="form-control" name="link" value="{{ old('link') ?  old('link') : (isset($record->link) ? $record->link :  '')}}">
                                {{-- <div class="error"></div> --}}
                                <div class="error">@if ($errors->has('link')) <label id="link-error" class="error">{{ $errors->first('link') }}</label>@endif</div>
                            </div>
                        </div> 
                            
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary submit" onclick="this.disabled='disabled';this.form.submit();">Submit</button>
                            <a href="{{ route('footer_menu') }}" class="btn btn-danger">Cancel</a>
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
    // $(".footer_menu_form").validate({
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