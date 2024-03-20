@include('admin.master')

<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h1>Testimonials</h1>
          </div>
          <div class="col-sm-6 d-none d-sm-block">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Testimonials</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('testimonials_insert') }}" method="POST" class="testimonials_form" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>
                            <div class="col-md-6">
                                <input type="text" id="name" class="form-control" name="name">
                                <div class="error"></div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Image</label>
                            <div class="col-md-6">
                                <input type="file" id="image" class="form-control" name="image">
                                <div class="error"></div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Description</label>
                            <div class="col-md-6"> 
                                <textarea class="ckeditor form-control" name="description"></textarea>
                                <div class="error"></div>
                            </div>
                        </div>
                        
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary submit">
                                Submit
                            </button>
                            <a href="{{ route('testimonials.index') }}" class="btn btn-default">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
  </div>
<script>
    $(document).ready(function () {
        $(".testimonials_form").validate({
            ignore: [],
            rules: {
                'name': {
                    required: true,
                },
                'image': {
                    required: true,
                    extension: "jpg,jpeg,png",
                },
                'description': {
                    required: true,
                },
            },
            messages: {
                'name': {
                    required: "Name is required",
                },
                'image': {
                    required: "Image is required",
                    extension: "Please enter a value with a valid extension.",
                },
                'description': {
                    required: "Description is required",
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

<script type="text/javascript">
    $(document).ready(function() {
       $('.ckeditor').ckeditor();
    });
</script>
