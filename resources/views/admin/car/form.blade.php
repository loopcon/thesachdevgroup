@extends('admin.layout.header')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h1>Car Module Create</h1>
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
                                <label for="our_business_id" class="form-label">Select Our Business<span class="text-danger">*</span></label>
                                <select class="form-control our_business_id select2" name="our_business_id" id="our_business_id">
                                    <option selected="selected" disabled="disabled" value="">Select</option>
                                    @foreach($our_business as $our_busines)
                                        <option value="{{$our_busines->id}}">{{$our_busines->title}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label for="brand_id" class="form-label">Select Brand<span class="text-danger">*</span></label>
                                 <select name="brand_id" id="brand_id" class="form-control select2">
                                    <option selected="selected" disabled="disabled">Select</option>

                                    @foreach($brands as $brand)
                                        <option value="{{$brand->id}}">
                                            {{$brand->name}}
                                        </option>
                                    @endforeach
                                </select>
                                <div id="errordiv"></div>
                            </div>

                            <div class="col-md-4">
                                <label for="image" class="form-label">Image<span class="text-danger">*</span></label>
                                <input type="file" id="image" class="form-control" name="image">
                                <div class="error"></div>
                                <small class="image_type">(Height:219px,Width:348px; Image Type : jpg,jpeg,png,svg,webp)</small>
                            </div>

                            <div class="col-md-4">
                                <label for="name" class="form-label">Name<span class="text-danger">*</span></label>
                                <input type="text" id="name" class="form-control" name="name">
                                <div id="error"></div>
                            </div>

                            <div class="col-md-4">
                                <label for="name_color" class="form-label">Name Text Color</label>
                                <input type="text" class="form-control colorpicker" name="name_color" id="name_color">
                            </div>

                            <div class="col-md-4">
                                @php($fontsize = fontSize())
                                <label for="name_font_size" class="form-label">Name Text Font Size</label>
                                <select class="form-control select2" name="name_font_size">
                                    <option selected="selected" disabled="disabled">Select</option>
                                    @for($i=$fontsize['start']; $i<=$fontsize['end']; $i+=$fontsize['range'])
                                        <option value="{{$i}}px">{{$i}}px</option>
                                    @endfor
                               </select>
                            </div>

                            <div class="mb-3 col-md-4">
                                @php($fontfamily = fontFamily())
                                <label for="name_font_family" class="form-label">Name Text Font Family</label>
                                <select class="form-control select2" name="name_font_family">
                                    <option selected="selected" disabled="disabled">Select</option>
                                        @foreach($fontfamily as $family)
                                            <option value="{{$family['key']}}">{{$family['value']}}</option>
                                        @endforeach
                               </select>
                            </div>

                            <div class="mb-3 col-md-4">
                                <label for="price" class="form-label">Price<span class="text-danger">*</span></label>
                                <input type="text" id="price" class="form-control" name="price">
                                <div class="error"></div>
                            </div>

                            <div class="mb-3 col-md-4">
                                <label for="price_color" class="form-label">Price Text Color</label>
                                <input type="text" class="form-control colorpicker" name="price_color" id="price_color">
                            </div>

                           
                            <div class="col-md-4">
                                <label for="price_font_size" class="form-label">Price Text Font Size</label>
                                <select class="form-control select2" name="price_font_size">
                                    <option selected="selected" disabled="disabled">Select</option>
                                    @for($i=$fontsize['start']; $i<=$fontsize['end']; $i+=$fontsize['range'])
                                        <option value="{{$i}}px">{{$i}}px</option>
                                    @endfor
                               </select>
                            </div>

                            <div class="mb-3 col-md-4">
                                <label for="price_font_family" class="form-label">Price Text Font Family</label>
                                <select class="form-control select2" name="price_font_family">
                                    <option selected="selected" disabled="disabled">Select</option>
                                        @foreach($fontfamily as $family)
                                            <option value="{{$family['key']}}">{{$family['value']}}</option>
                                        @endforeach
                               </select>
                            </div>

                            <div class="col-md-4">
                                <label for="link" class="form-label">Link<span class="text-danger">*</span></label>
                                <input type="text" id="link" class="form-control" name="link">
                                <div class="error"></div>
                            </div>

                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary submit">Submit</button>
                            <a href="{{ route('car.index') }}" class="btn btn-danger">Cancel</a>
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
                    extension: "jpg,jpeg,png,webp,svg",
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
                    extension: "Image must be jpg,jpeg,png,svg or webp.",
                },
                'name': {
                    required: "The name field is required.",
                },
                'price': {
                    required: "The price field is required.",
                },
                'link': {
                    required: "The link field is required.",
                    url: "Please enter a valid link.",
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