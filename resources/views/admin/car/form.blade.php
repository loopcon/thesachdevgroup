@extends('admin.layout.header')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h1>Car</h1>
          </div>
          <div class="col-sm-6 d-none d-sm-block">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Car</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('car_insert') }}" method="POST" class="car_form" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="mb-3 col-md-4">
                                <label for="brand_id" class="form-label">Select Brand</label>
                                 <select name="brand_id" id="brand_id" class="form-control select2">
                                    <option selected="selected" disabled="disabled">Select Brand</option>

                                    @foreach($brands as $brand)
                                        <option value="{{$brand->id}}">
                                            {{$brand->name}}
                                        </option>
                                    @endforeach
                                </select>
                                <div id="errordiv"></div>
                            </div>

                            <div class="col-md-4">
                                <label for="image" class="form-label">Image</label>
                                <input type="file" id="image" class="form-control" name="image">
                                <div class="error"></div>
                            </div>

                            <div class="col-md-4">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" id="name" class="form-control" name="name">
                                <div id="error"></div>
                            </div>

                            <div class="mb-3 col-md-4">
                                <label for="price" class="form-label">Price</label>
                                <input type="text" id="price" class="form-control" name="price">
                                <div class="error"></div>
                            </div>

                            <div class="col-md-4">
                                <label for="link" class="form-label">Link</label>
                                <input type="text" id="link" class="form-control" name="link">
                                <div class="error"></div>
                            </div>

                            <div class="col-md-4">
                                <label for="name_color" class="form-label">Name Color</label>
                                <input type="text" class="form-control colorpicker" name="name_color" id="name_color">
                            </div>

                            <div class="mb-3 col-md-4">
                                <label for="price_color" class="form-label">Price Color</label>
                                <input type="text" class="form-control colorpicker" name="price_color" id="price_color">
                            </div>

                           
                            <div class="col-md-4">
                                <label for="name_font_size" class="form-label">Name Select Font Size</label>
                                <select class="form-control select2" name="name_font_size">
                                    <option selected="selected" disabled="disabled">Name Select Font Size</option>
                                    @for($i=24; $i<=50; $i+=2)
                                        <option value="{{$i}}px">{{$i}}px</option>
                                    @endfor
                               </select>
                            </div>

                            <div class="col-md-4">
                                <label for="price_font_size" class="form-label">Price Select Font Size</label>
                                <select class="form-control select2" name="price_font_size">
                                    <option selected="selected" disabled="disabled">Price Select Font Size</option>
                                    @for($i=24; $i<=50; $i+=2)
                                        <option value="{{$i}}px">{{$i}}px</option>
                                    @endfor
                               </select>
                            </div>

                            <div class="mb-3 col-md-4">
                                <label for="name_font_family" class="form-label">Name Select Font Family</label>
                                <select class="form-control select2" name="name_font_family">
                                    <option selected="selected" disabled="disabled">Name Select Font Family</option>
                                        <option value="poppins">Poppins</option>
                                        <option value="sans-serif">Sans Serif</option>
                               </select>
                            </div>

                            <div class="col-md-4">
                                <label for="price_font_family" class="form-label">Price Select Font Family</label>
                                <select class="form-control select2" name="price_font_family">
                                    <option selected="selected" disabled="disabled">Price Select Font Family</option>
                                        <option value="poppins">Poppins</option>
                                        <option value="sans-serif">Sans Serif</option>
                               </select>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary submit">Submit</button>
                            <a href="{{ route('car.index') }}" class="btn btn-default">Cancel</a>
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
        $(".car_form").validate({
            rules: {
                'brand_id': {
                    required: true,
                },
                'image': {
                    required: true,
                    extension: "jpg,jpeg,png",
                },
                'name': {
                    required: true,
                },
                'price': {
                    required: true,
                },
                'link': {
                    url: "url",
                    required: true,
                },
            },
            messages: {
                'brand_id': {
                    required: "The brand field is required.",
                },
                'image': {
                    required: "The image field is required.",
                    extension: "The image must be an image.",
                },
                'name': {
                    required: "The name field is required.",
                },
                'price': {
                    required: "The price field is required.",
                },
                'link': {
                    required: "The link field is required.",
                    url: "Please enter a valid link",
                },
            },
            errorPlacement: function(error, element) {
                if(element.attr("name") == "brand_id"){
                    error.appendTo('#errordiv');
                    return;
                }
                if(element.attr("name") == "name"){
                        error.appendTo('#error');
                        return;
                }else {
                    error.insertAfter(element);
                }
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