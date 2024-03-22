@include('admin.master')

<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h1>Home Slider</h1>
          </div>
          <div class="col-sm-6 d-none d-sm-block">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Home Slider</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('homeslider_insert') }}" method="POST" class="slider_form" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Image</label>
                            <div class="col-md-6">
                                <input type="file" id="image" class="form-control" name="image">
                                @if ($errors->has('image'))
                                    <span class="text-danger">{{ $errors->first('image') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label text-md-right">Title</label>
                            <div class="col-md-6">
                                <input type="text" id="title" class="form-control" name="title">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="subtitle" class="col-md-4 col-form-label text-md-right">Sub Title</label>
                            <div class="col-md-6">
                                <input type="text" id="subtitle" class="form-control" name="subtitle">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="color" class="col-md-4 col-form-label text-md-right">Color</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control colorpicker" name="color" id="color">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="font_size" class="col-md-4 col-form-label text-md-right">Font Size</label>
                            <div class="col-md-6">
                               <select class="form-control select2" name="font_size">
                                    <option selected="selected" disabled="disabled">Select Font Size</option>
                                    @for($i=24; $i<=50; $i+=2)
                                        <option value="{{$i}}px">{{$i}}px</option>
                                    @endfor
                               </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="font_family" class="col-md-4 col-form-label text-md-right">Font Family</label>
                            <div class="col-md-6">
                               <select class="form-control select2" name="font_family">
                                    <option selected="selected" disabled="disabled">Select Font Family</option>
                                        <option value="poppins">Poppins</option>
                                        <option value="sans-serif">Sans Serif</option>
                               </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="text_position" class="col-md-4 col-form-label text-md-right">Text Position</label>
                            <div class="col-md-6">
                               <select class="form-control select2" name="text_position">
                                    <option selected="selected" disabled="disabled">Text Position</option>
                                        <option value="left">Left</option>
                                        <option value="right">Right</option>
                               </select>
                            </div>
                        </div>


                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary submit">
                                Submit
                            </button>
                            <a href="{{ route('homeslider.index') }}" class="btn btn-default">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
  </div>
<script>
 $(document).ready(function () {
    $(".slider_form").validate({
        rules: {
            'image': {
                required: true,
                extension: "jpg,jpeg,png",
            },
        },
        messages: {
            'image': {
                required: "Image is required",
                extension: "Please enter a value with a valid extension.",
            },
        },
        submitHandler: function(form) {
            $(form).find('.submit').prop("disabled", true);
            form.submit();
        }
    });

    $('.colorpicker').colorpicker();

});

</script>