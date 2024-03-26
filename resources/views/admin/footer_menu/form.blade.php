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
          <div class="col-sm-6 d-none d-sm-block">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">{{$site_title}}</li>
            </ol>
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
                                    <option value="our_services" @if(isset($record->menu_name) && $record->menu_name == 'our_services'){{'selected'}}@endif>Our Services</option>
                                    <option value="our_businesses" @if(isset($record->menu_name) && $record->menu_name == 'our_businesses'){{'selected'}}@endif>Our Businesses</option>
                                    <option value="useful_links" @if(isset($record->menu_name) && $record->menu_name == 'useful_links'){{'selected'}}@endif>Useful Links</option>
                                </select>
                                <div class="error"></div>
                            </div>

                            <div class="col-md-4">
                                <label for="name" class="form-label">Name<span class="text-danger">*</span></label>
                                <input type="text" id="name" class="form-control" name="name" value="{{isset($record->name) ? $record->name : old('name')}}">
                                <div class="error"></div>
                            </div>

                            <div class="col-md-4">
                                <label for="link" class="form-label">Link<span class="text-danger">*</span></label>
                                <input type="text" id="link" class="form-control" name="link" value="{{isset($record->link) ? $record->link : old('link')}}">
                                <div class="error"></div>
                            </div>

                            <div class="mb-3 col-md-4">
                                <label for="color" class="form-label">Name Text Color</label>
                                <input type="text" class="form-control colorpicker" name="color" id="color" value="{{isset($record->color) ? $record->color : old('color')}}">
                            </div>

                            <div class="col-md-4">
                                <label for="font_size" class="form-label">Name Text Font Size</label>
                                <select class="form-control select2" name="font_size">
                                    <option selected="selected" disabled="disabled">Select</option>
                                    @for($i=24; $i<=50; $i+=2)
                                        <option value="{{$i}}px" @if(isset($record->font_size) && $record->font_size == $i.'px'){{'selected'}}@endif>{{$i}}px</option>
                                    @endfor
                               </select>
                            </div>

                            <div class="col-md-4">
                                <label for="font_family" class="form-label">Name Text Font Family</label>
                                <select class="form-control select2" name="font_family">
                                    <option selected="selected" disabled="disabled">Select</option>
                                    <option value="poppins" @if(isset($record->font_family) && $record->font_family == 'poppins'){{'selected'}}@endif>Poppins</option>
                                    <option value="sans-serif" @if(isset($record->font_family) && $record->font_family == 'sans-serif'){{'selected'}}@endif>Sans Serif</option>
                               </select>
                            </div>

                             </div> 
                            
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary submit">Submit</button>
                            <a href="{{ route('footer_menu') }}" class="btn btn-default">Cancel</a>
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
        $(".footer_menu_form").validate({
            rules: {
                'menu_name': {
                    required: true,
                },
                'name': {
                    required: true,
                },
                'link': {
                    url: "url",
                },
            },
            messages: {
                'menu_name': {
                    required: "The menu field is required.",
                },
                'name': {
                    required: "The name field is required.",
                },
                'link': {
                    url: "Please enter a valid link.",
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
@endsection