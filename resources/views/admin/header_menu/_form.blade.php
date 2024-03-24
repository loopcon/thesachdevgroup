@extends('admin.layout.header')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h1>Header Menu</h1>
          </div>
          <div class="col-sm-6 d-none d-sm-block">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Header Menu</li>
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
                                    <div class="col-md-6">
                                        <label for="menu_name" class="form-label">Select Menu</label>
                                        <select class="form-control select2" name="menu_name">
                                            <option selected="selected" disabled="disabled">Select Menu</option>
                                            <option value="our_businesses"  {{$header_menu->menu_name == 'our_businesses' ? 'selected' : ''}}>Our Businesses</option>
                                            <option value="our_services" {{$header_menu->menu_name == 'our_services' ? 'selected' : ''}}>Our Services</option>
                                            <option value="awards_recognition" {{$header_menu->menu_name == 'awards_recognition' ? 'selected' : ''}}>Awards & Recognition</option>
                                            <option value="contact_us" {{$header_menu->menu_name == 'contact_us' ? 'selected' : ''}}>Contact Us</option>
                                       </select>
                                    </div>
        
                                    <div class="mb-3 col-md-6">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" id="name" class="form-control" name="name" value="{{$header_menu->name}}">
                                        <div class="error"></div>
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
            },
            messages: {
                'name': {
                    required: "The name field is required.",
                },
            },
            errorPlacement: function(error, element) {
                error.appendTo(element.parent().find('.error'));
            },
        });
    });
</script>
@endsection
  