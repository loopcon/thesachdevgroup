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
            <div class="col-12">
                @include('admin.alerts')
            </div>
          <div class="col-sm-6">
            <h1>{{$site_title}}</h1>
          </div>
        </div>
      </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <form action="@if(isset($record->id)) {{ route('showroom-model-update', array('id' => encrypt($record->id))) }} @else{{ route('showroom-model-store') }} @endif" method="POST" class="showroom_form" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <label for="showroom_id" class="form-label">Select Showroom<span class="text-danger">*</span></label>
                                <select class="form-control select2" name="showroom_id" id="showroom_id">
                                    <option value="">Select</option>
                                    @foreach($showrooms as $value)
                                        <option value="{{$value->id}}"@if(isset($record->showroom_id) && $record->showroom_id == $value->id){{'selected'}}@endif>{{$value->name}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('showroom_id')) <div class="text-danger">{{ $errors->first('showroom_id') }}</div>@endif
                                <div id="errordiv"></div>
                            </div>

                            <div class="col-md-4">
                                <label for="title" class="form-label">Title<span class="text-danger">*</span></label>
                                <input type="text" id="title" class="form-control" name="title" value="{{isset($record->title) ? $record->title : old('title')}}">
                                @if ($errors->has('title')) <div class="text-danger">{{ $errors->first('title') }}</div>@endif
                                <div class="error"></div>
                            </div>

                            
                            <div class="col-md-4">
                                <label for="image" class="form-label">Image</label>&nbsp;<small>(Image Type : jpg,jpeg,png,webp)</small>
                                @if(isset($record->image) && $record->image)
                                    <img src="{{url('public/uploads/showroom_model/'.$record->image)}}" width="100" style="margin-bottom:10px;margin-left:5px;">
                                @endif  
                                <input type="file" id="image" class="form-control" name="image" value="">
                                @if ($errors->has('image')) <div class="text-danger">{{ $errors->first('image') }}</div>@endif
                                <div class="error"></div>
                            </div>

                            <div class="col-md-4 mt-2">
                                <label for="title_text_color" class="form-label">Title Text Color</label>
                                <input type="text" class="form-control colorpicker" value="{{isset($record->title_text_color) ? $record->title_text_color : old('title_text_color')}}" name="title_text_color" id="title_text_color">
                            </div>

                            @php($fontsize = fontSize())
                            <div class="col-md-4 mt-2">
                                <label for="title_text_size" class="form-label">Title Text Size</label>
                                <select class="form-control select2" name="title_text_size">
                                    <option value="">Select</option>
                                    @for($i=$fontsize['start']; $i<=$fontsize['end']; $i+=$fontsize['range'])
                                        <option value="{{$i}}px" @if(isset($record->title_text_size) && $record->title_text_size == $i.'px'){{'selected'}}@endif>{{$i}}px</option>
                                    @endfor
                                </select>
                            </div>

                            @php($fontfamily = fontFamily())
                            <div class="col-md-4 mt-2 mb-3">
                                <label for="title_font_family" class="form-label">Title Font Family</label>
                                <select class="form-control select2" name="title_font_family">
                                    <option value="">Select</option>
                                    @foreach($fontfamily as $family)
                                        <option value="{{$family['key']}}" @if(isset($record->title_font_family) && $record->title_font_family == $family['key']){{'selected'}}@endif>{{$family['value']}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <?php /* <div class="col-md-4 mb-3">
                                <label for="image_size" class="form-label">Image Size</label>
                                <select class="form-control select2" name="image_size">
                                    <option value="">Select</option>
                                    @for($i=24; $i<=50; $i+=2)
                                        <option value="{{$i}}px" @if(isset($record->image_size) && $record->image_size == $i.'px'){{'selected'}}@endif>{{$i}}px</option>
                                    @endfor
                                </select>
                            </div> */ ?>
                        </div>

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary submit">Submit</button>
                            <a href="{{ route('showroom-model') }}" class="btn btn-default">Cancel</a>
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
        $('.select2').select2({ width: '100%' });

        $('#brand_id').change(function () {
            var brand_id = $(this).val();
            if (brand_id) {
                $.ajax({
                    type: "GET",
                    url: "{{ route('getcars') }}",
                    data: { brand_id: brand_id },
                    success: function (cars) {
                        $('#car_id').empty();
                        $('#car_id').append('<option disabled>Select Car</option>');
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
            },
            messages: {
                'brand_id': {
                    required: "Brand is required",
                },
                'car_id[]': { 
                    required: "Car is required",
                },
                'address': {
                    required: "Address is required",
                },
                'working_hours': {
                    required: "Working hours is required",
                },
                'contact_number': {
                    required: "Contact number is required",
                },
                'email': {
                    required: "Email is required",
                },
            },
            errorPlacement: function(error, element) {
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

        $('body').on('click' ,".add",function(){
            var $tr = $(this).closest('.sub_table');
            var $clone = $tr.clone();

            $clone.find('input').val('');
            $clone.find('span:nth-child(3)').remove();

            $tr.after($clone);
            sr_change();
        });

        $('body').on('click' ,".minus",function(event){
            if($(".sub_table").length > 1){

                $(this).closest(".sub_table").remove();
                sr_change();
            }
        });

        $('body').on('click' ,".customer_gallery_add",function(){
            var $tr = $(this).closest('.customer_gallery_table');
            var $clone = $tr.clone();

            $clone.find('input').val('');
            $clone.find('span:nth-child(3)').remove();

            $tr.after($clone);
            sr_change();
        });

        $('body').on('click' ,".customer_gallery_minus",function(event){
            if($(".customer_gallery_table").length > 1){

                $(this).closest(".customer_gallery_table").remove();
                sr_change();
            }
        });
        $('.colorpicker').colorpicker();
    });
</script>
@endsection