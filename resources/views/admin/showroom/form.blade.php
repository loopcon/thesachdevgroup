@extends('admin.layout.header')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h1>Showroom Create</h1>
          </div>
          <div class="col-sm-6 d-none d-sm-block">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Showroom Create</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('showroom_insert') }}" method="POST" class="showroom_form" enctype="multipart/form-data">
                        @csrf

                        <div class="row">

                            <div class="mb-3 col-md-4">
                                <label for="our_business_id" class="form-label">Our Business<span class="text-danger">*</span></label>
                                <select class="form-control our_business_id select2" name="our_business_id" id="our_business_id">
                                    <option selected="selected" disabled="disabled" value="">Select</option>
                                    @foreach($our_business as $our_busines)
                                        <option value="{{$our_busines->id}}">{{$our_busines->title}}</option>
                                    @endforeach
                                </select>
                                <div id="errorbusinessdiv"></div>
                            </div>

                                <div class="col-md-4">
                                    <label for="name" class="form-label">Showroom Name<span class="text-danger">*</span></label>
                                    <input type="text" id="name" class="form-control" name="name">
                                    <div id="error"></div>
                                </div>

                                <div class="col-md-4">
                                    <label for="name_color" class="form-label">Showroom Name Text Color</label>
                                    <input type="text" class="form-control colorpicker" name="name_color" id="name_color">
                                </div>

                                <div class="col-md-4">
                                    @php($fontsize = fontSize())
                                    <label for="name_font_size" class="form-label">Showroom Name Text Font Size</label>
                                    <select class="form-control select2" name="name_font_size">
                                        <option selected="selected" disabled="disabled">Select</option>
                                        @for($i=$fontsize['start']; $i<=$fontsize['end']; $i+=$fontsize['range'])
                                            <option value="{{$i}}px">{{$i}}px</option>
                                        @endfor
                                </select>
                                </div>

                            
                                <div class="mb-3 col-md-4">
                                    @php($fontfamily = fontFamily())
                                    <label for="name_font_family" class="form-label">Showroom Name Text Font Family</label>
                                    <select class="form-control select2" name="name_font_family">
                                        <option selected="selected" disabled="disabled">Select</option>
                                        @foreach($fontfamily as $family)
                                            <option value="{{$family['key']}}">{{$family['value']}}</option>
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

                                <div class="col-md-4 adm-select-car-drop">
                                    <label for="car_id" class="form-label">Select Car<span class="text-danger">*</span></label>
                                    <select name="car_id[]" id="car_id" class="form-control select2" multiple>
                                        <option disabled>Select</option>
                                    </select>
                                    <div id="errorcardiv"></div>
                                </div>


                                <div class="mb-3 col-md-4">
                                    <label for="address" class="form-label">Address<span class="text-danger">*</span></label>
                                    <textarea class="form-control" name="address"></textarea>
                                    <div class="error"></div>
                                </div>

                                <div class="col-md-4">
                                    <label for="address_color" class="form-label">Address Text Color</label>
                                    <input type="text" class="form-control colorpicker" name="address_color" id="address_color">
                                </div>

                                <div class="col-md-4">
                                    @php($fontsize = fontSize())
                                    <label for="address_font_size" class="form-label">Address Text Font Size</label>
                                    <select class="form-control select2" name="address_font_size">
                                        <option selected="selected" disabled="disabled">Select</option>
                                        @for($i=$fontsize['start']; $i<=$fontsize['end']; $i+=$fontsize['range'])
                                            <option value="{{$i}}px">{{$i}}px</option>
                                        @endfor
                                </select>
                                </div>

                            
                                <div class="mb-3 col-md-4">
                                    @php($fontfamily = fontFamily())
                                    <label for="address_font_family" class="form-label">Address Text Font Family</label>
                                    <select class="form-control select2" name="address_font_family">
                                        <option selected="selected" disabled="disabled">Select</option>
                                        @foreach($fontfamily as $family)
                                            <option value="{{$family['key']}}">{{$family['value']}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label for="address_icon" class="form-label">Address Icon<span class="text-danger">*</span></label><small>(Image Type : jpg,jpeg,png,webp)</small>
                                    <input type="file" id="address_icon" class="form-control" name="address_icon">
                                    <div id="error"></div>
                                </div>

                                <div class="col-md-4">
                                    <label for="working_hours" class="form-label">Working Hours<span class="text-danger">*</span></label>
                                    <input type="text" id="working_hours" class="form-control" name="working_hours">
                                    <div id="error"></div>
                                </div>

                                <div class="mb-3 col-md-4">
                                    <label for="working_hours_color" class="form-label">Working Hours Text Color</label>
                                    <input type="text" class="form-control colorpicker" name="working_hours_color" id="working_hours_color">
                                </div>

                                <div class="mb-3 col-md-4">
                                    <label for="working_hours_font_size" class="form-label">Working Hours Text Font Size</label>
                                    <select class="form-control select2" name="working_hours_font_size">
                                        <option selected="selected" disabled="disabled">Select</option>
                                        @for($i=$fontsize['start']; $i<=$fontsize['end']; $i+=$fontsize['range'])
                                            <option value="{{$i}}px">{{$i}}px</option>
                                        @endfor
                                </select>
                                </div>

                                <div class="mb-3 col-md-4">
                                    <label for="working_hours_font_family" class="form-label">Working Hours Text Font Family</label>
                                    <select class="form-control select2" name="working_hours_font_family">
                                        <option selected="selected" disabled="disabled">Select</option>
                                        @foreach($fontfamily as $family)
                                            <option value="{{$family['key']}}">{{$family['value']}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label for="working_hours_icon" class="form-label">Working Hours Icon<span class="text-danger">*</span></label><small>(Image Type : jpg,jpeg,png,webp)</small>
                                    <input type="file" id="working_hours_icon" class="form-control" name="working_hours_icon">
                                    <div id="error"></div>
                                </div>

                                <div class="col-md-4">
                                    <label for="contact_number" class="form-label">Contact Number<span class="text-danger">*</span></label>
                                    <input type="number" id="contact_number" class="form-control" name="contact_number">
                                    <div class="error"></div>
                                </div>

                                <div class="mb-3 col-md-4">
                                    <label for="contact_number_color" class="form-label">Contact Number Text Color</label>
                                    <input type="text" class="form-control colorpicker" name="contact_number_color" id="contact_number_color">
                                </div>

                            
                                <div class="col-md-4">
                                    <label for="contact_number_font_size" class="form-label">Contact Number Text Font Size</label>
                                    <select class="form-control select2" name="contact_number_font_size">
                                        <option selected="selected" disabled="disabled">Select</option>
                                        @for($i=$fontsize['start']; $i<=$fontsize['end']; $i+=$fontsize['range'])
                                            <option value="{{$i}}px">{{$i}}px</option>
                                        @endfor
                                    </select>
                                </div>

                       
                                <div class="mb-3 col-md-4">
                                    <label for="contact_number_font_family" class="form-label">Contact Number Text Font Family</label>
                                    <select class="form-control select2" name="contact_number_font_family">
                                        <option selected="selected" disabled="disabled">Select</option>
                                        @foreach($fontfamily as $family)
                                            <option value="{{$family['key']}}">{{$family['value']}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label for="contact_number_icon" class="form-label">Contact Number Icon<span class="text-danger">*</span></label><small>(Image Type : jpg,jpeg,png,webp)</small>
                                    <input type="file" id="contact_number_icon" class="form-control" name="contact_number_icon">
                                    <div id="error"></div>
                                </div>

                                <div class="mb-3 col-md-4">
                                    <label for="email" class="form-label">Email<span class="text-danger">*</span></label>
                                    <input type="email" id="email" class="form-control" name="email">
                                    <div class="error"></div>
                                </div>

                                
                                <div class="col-md-4">
                                    <label for="email_color" class="form-label">Email Text Color</label>
                                    <input type="text" class="form-control colorpicker" name="email_color" id="email_color">
                                </div>

                                
                                <div class="col-md-4">
                                    <label for="email_color" class="form-label">Email Text Font Size</label>
                                    <select class="form-control select2" name="email_font_size">
                                        <option selected="selected" disabled="disabled">Select</option>
                                        @for($i=$fontsize['start']; $i<=$fontsize['end']; $i+=$fontsize['range'])
                                            <option value="{{$i}}px">{{$i}}px</option>
                                        @endfor
                                </select>
                                </div>

                        
                                <div class="mb-3 col-md-4">
                                    <label for="email_color" class="form-label">Email Text Font Family</label>
                                    <select class="form-control select2" name="email_font_family">
                                        <option selected="selected" disabled="disabled">Select</option>
                                        @foreach($fontfamily as $family)
                                            <option value="{{$family['key']}}">{{$family['value']}}</option>
                                        @endforeach
                                </select>
                                </div>

                                <div class="col-md-4">
                                    <label for="email_icon" class="form-label">Email Icon<span class="text-danger">*</span></label><small>(Image Type : jpg,jpeg,png,webp)</small>
                                    <input type="file" id="email_icon" class="form-control" name="email_icon">
                                    <div id="error"></div>
                                </div>

                                <div class="col-md-12 mt-2 mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="ckeditor form-control" name="description"></textarea>
                                    <div class="error"></div>
                                </div>
    
    
                                <div class="mb-3 col-md-4">
                                    <label for="description_color" class="form-label">Description Text Color</label>
                                    <input type="text" class="form-control colorpicker" name="description_color" id="description_color">
                                </div>
    
                                <div class="mb-3 col-md-4">
                                    <label for="description_font_size" class="form-label">Description Text Font Size</label>
                                    <select class="form-control select2" name="description_font_size">
                                        <option selected="selected" disabled="disabled">Select</option>
                                        @for($i=$fontsize['start']; $i<=$fontsize['end']; $i+=$fontsize['range'])
                                            <option value="{{$i}}px">{{$i}}px</option>
                                        @endfor
                                   </select>
                                </div>
    
                                <div class="col-md-4">
                                    <label for="description_font_family" class="form-label">Description Text Font Family</label>
                                    <select class="form-control select2" name="description_font_family">
                                        <option selected="selected" disabled="disabled">Select</option>
                                        @foreach($fontfamily as $family)
                                            <option value="{{$family['key']}}">{{$family['value']}}</option>
                                        @endforeach
                                   </select>
                                </div>
                            </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary submit">Submit</button>
                            <a href="{{ route('showroom_list') }}" class="btn btn-danger">Cancel</a>
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

        $('#brand_id').change(function () {
            var brand_id = $(this).val();
            if (brand_id) {
                $.ajax({
                    type: "GET",
                    url: "{{ route('getcars') }}",
                    data: { brand_id: brand_id },
                    success: function (cars) {
                        $('#car_id').empty();
                        $('#car_id').append('<option disabled>Select</option>');
                        $.each(cars, function (key, car) {
                            $('#car_id').append('<option value="' + car.id + '">' + car.name + '</option>');
                        });
                    }
                });
            } else {
                $('#car_id').empty();
            }
        });

        $(".showroom_form").validate({
            rules: {
                'our_business_id': {
                    required: true,
                },
                'name': {
                    required: true,
                },
                'brand_id': {
                    required: true,
                },
                'car_id[]': { 
                    required: true,
                },
                'address': {
                    required: true,
                },
                'working_hours': {
                    required: true,
                },
                'contact_number': {
                    required: true,
                    maxlength:"10",
                    minlength:"10",
                },
                'email': {
                    required: true,
                },
                'address_icon': {
                    extension: "jpg,jpeg,png,webp",
                },
                'working_hours_icon': {
                    extension: "jpg,jpeg,png,webp",
                },
                'contact_number_icon': {
                    extension: "jpg,jpeg,png,webp",
                },
                'email_icon': {
                    extension: "jpg,jpeg,png,webp",
                },
            },
            messages: {
                'our_business_id': {
                    required: "The our business field is required.",
                },
                'name': {
                    required: "The showroom name field is required.",
                },
                'brand_id': {
                    required: "The brand field is required.",
                },
                'car_id[]': { 
                    required: "The car field is required.",
                },
                'address': {
                    required: "The address field is required.",
                },
                'working_hours': {
                    required: "The working hours field is required.",
                },
                'contact_number': {
                    required: "The contact number field is required.",
                },
                'email': {
                    required: "The email field is required.",
                },
                'address_icon': {
                    extension: "Image must be jpg,jpeg,png or webp.",
                },
                'working_hours_icon': {
                    extension: "Image must be jpg,jpeg,png or webp.",
                },
                'contact_number_icon': {
                    extension: "Image must be jpg,jpeg,png or webp.",
                },
                'email_icon': {
                    extension: "Image must be jpg,jpeg,png or webp.",
                },
            },
            errorPlacement: function(error, element) {
                if(element.attr("name") == "our_business_id"){
                    error.appendTo('#errorbusinessdiv');
                    return;
                }
                if(element.attr("name") == "brand_id"){
                    error.appendTo('#errordiv');
                    return;
                }
                if(element.attr("name") == "car_id[]"){
                    error.appendTo('#errorcardiv');
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