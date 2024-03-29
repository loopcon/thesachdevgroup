@extends('admin.layout.header')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h1>Home Our Businesses Create</h1>
          </div>
          <div class="col-sm-6 d-none d-sm-block">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Home Our Businesses Create</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('home_our_businesses_insert') }}" method="POST" class="our_businesses_form" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row">
                            <div class="mb-3 col-md-4">
                                <label for="image" class="form-label">Image<span class="text-danger">*</span></label>
                                <input type="file" id="image" class="form-control" name="image">
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary submit">Submit</button>
                            <a href="{{ route('home_our_businesses.index') }}" class="btn btn-default">Cancel</a>
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
        $(".our_businesses_form").validate({
            rules: {
                'image': {
                    required: true,
                    extension: "jpg,jpeg,png,webp",
                },
            },
            messages: {
                'image': {
                    required: "The image field is required.",
                    extension: "The image must be an image.",
                },
            },
            submitHandler: function(form) {
                $(form).find('.submit').prop("disabled", true);
                form.submit();
            }
        });
    });
</script>
@endsection