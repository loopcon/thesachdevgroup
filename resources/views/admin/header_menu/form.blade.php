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
                    <form action="{{ route('header_menu_insert') }}" method="POST" class="header_menu_form" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <label for="menu_name" class="form-label">Select Menu</label>
                                <select class="form-control select2" name="menu_name">
                                    <option selected="selected" disabled="disabled">Select Menu</option>
                                    <option value="our_businesses">Our Businesses</option>
                                    <option value="our_services">Our Services</option>
                                    <option value="awards_recognition">Awards & Recognition</option>
                                    <option value="contact_us">Contact Us</option>
                                </select>
                                <div class="error"></div>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" id="name" class="form-control" name="name">
                                <div class="error"></div>
                            </div>

                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary submit">Submit</button>
                            <a href="{{ route('header_menu.index') }}" class="btn btn-default">Cancel</a>
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
        $(".header_menu_form").validate({
            rules: {
                'menu_name': {
                    required: true,
                },
                'name': {
                    required: true,
                },
            },
            messages: {
                'menu_name': {
                    required: "The menu field is required.",
                },
                'name': {
                    required: "The name field is required.",
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
    });
</script>
@endsection