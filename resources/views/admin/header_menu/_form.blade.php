@extends('admin.layout.header')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h1>Header Menu Edit</h1>
          </div>
          <div class="col-sm-6 d-none d-sm-block">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Header Menu Edit</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    @foreach($header_menus as $header_menu)
                        <form method="post" action="{{ route('header_menu_update', $header_menu->id) }}" class="edit_form" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" value="{{ $header_menu->id }}" class="id" name="id">
                           
                                <div class="row">
                                    <div class="mb-3 col-md-4">
                                        <label for="menu_name" class="form-label">Select Menu<span class="text-danger">*</span></label>
                                        <select class="form-control select2" name="menu_name">
                                            <option selected="selected" disabled="disabled">Select</option>
                                            <option value="our_businesses"  {{$header_menu->menu_name == 'our_businesses' ? 'selected' : ''}}>Our Businesses</option>
                                            <option value="our_services" {{$header_menu->menu_name == 'our_services' ? 'selected' : ''}}>Our Services</option>
                                            <option value="awards_recognition" {{$header_menu->menu_name == 'awards_recognition' ? 'selected' : ''}}>Awards & Recognition</option>
                                            <option value="contact_us" {{$header_menu->menu_name == 'contact_us' ? 'selected' : ''}}>Contact Us</option>
                                       </select>
                                    </div>
        
                                    <div class="col-md-4">
                                        <label for="name" class="form-label">Name<span class="text-danger">*</span></label>
                                        <input type="text" id="name" class="form-control" name="name" value="{{$header_menu->name}}">
                                        <div class="error"></div>
                                    </div>
        
                                    <div class="col-md-4">
                                        <label for="link" class="form-label">Link<span class="text-danger">*</span></label>
                                        <input type="text" id="link" class="form-control" name="link" value="{{$header_menu->link}}">
                                        <div class="error"></div>
                                    </div>

                                    <div class="mb-3 col-md-4">
                                        <label for="color" class="form-label">Name Text Color</label>
                                        <input type="text" class="form-control colorpicker" name="color" id="color" value="{{$header_menu->color}}">
                                    </div>

                                    <div class="col-md-4">
                                        <label for="font_size" class="form-label">Name Text Font Size</label>
                                        <select class="form-control select2" name="font_size">
                                            <option selected="selected" disabled="disabled">Select</option>
                                            @for($i=24; $i<=50; $i+=2)
                                                <option value="{{$i}}px" {{$header_menu->font_size == $i.'px' ? 'selected' : ''}}>{{$i}}px</option>
                                            @endfor
                                       </select>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="font_family" class="form-label">Name Text Font Family</label>
                                        <select class="form-control select2" name="font_family">
                                            <option selected="selected" disabled="disabled">Select</option>
                                            <option value="poppins"  {{$header_menu->font_family == 'poppins' ? 'selected' : ''}}>Poppins</option>
                                            <option value="sans-serif" {{$header_menu->font_family == 'sans-serif' ? 'selected' : ''}}>Sans Serif</option>
                                       </select>
                                    </div>

                                </div>
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-primary submit">Submit</button>
                                    <a href="{{ route('header_menu.index') }}" class="btn btn-default">Cancel</a>
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
<script>
    $(document).ready(function () {
        $(".edit_form").validate({
            rules: {
                'name': {
                    required: true,
                },
                'link': {
                    url: "url",
                },
            },
            messages: {
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
        });
        $('.colorpicker').colorpicker();
    });
</script>
@endsection
  