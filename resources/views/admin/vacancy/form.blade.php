@extends('admin.layout.header')
@section('css')
    <link class="js-stylesheet" href="{{ url('public/plugins/select2/css/select2.css') }}" rel="stylesheet">
    <link class="js-stylesheet" href="{{ url('public/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <link type="text/css" class="js-stylesheet" href="{{ url('public/plugins/parsley/parsley.css') }}" rel="stylesheet">
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
                    <form action="@if(isset($record->id)) {{ route('vacancy-update', array('id' => encrypt($record->id))) }} @else{{ route('vacancy-store') }} @endif" method="POST" class="service-center-form" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-4 adm-brand-errorbox">
                                <label for="business_id" class="form-label">Our Business<span class="text-danger">*</span></label>
                                <select class="form-control select2" name="business_id" id="business_id" required="">
                                    <option value="">-- Select Business --</option>
                                    @foreach($business as $value)
                                        <option value="{{$value->id}}" @if(isset($record->business_id) && $record->business_id == $value->id){{'selected'}} @endif>{{$value->title}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('business_id')) <div class="text-danger">{{ $errors->first('business_id') }}</div>@endif
                            </div>

                            <div class="mb-3 col-md-4 showroom">
                                <label for="showroom_id" class="form-label">Showroom</label>
                                <select class="form-control select2" name="showroom_id" id="showroom_id">
                                </select>
                            </div>

                            <div class="mb-3 col-md-4 service-center">
                                <label for="service_center_id" class="form-label">Service Center</label>
                                <select class="form-control select2" name="service_center_id" id="service_center_id">
                                </select>
                            </div>

                            <div class="mb-3 col-md-4 body-shop">
                                <label for="body_shop_id" class="form-label">Body Shop</label>
                                <select class="form-control select2" name="body_shop_id" id="body_shop_id">
                                </select>
                            </div>

                            <div class="mb-3 col-md-4 used-car">
                                <label for="used_car_id" class="form-label">Used Car</label>
                                <select class="form-control select2" name="used_car_id" id="used_car_id">
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label for="name" class="form-label">Name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="name" required="" name="name" value="{{isset($record->name) ? $record->name : old('name')}}">
                                @if ($errors->has('name')) <div class="text-danger">{{ $errors->first('name') }}</div>@endif
                            </div>

                            <div class="col-md-4">
                                <label for="name_font_color" class="form-label">Name Font Color</label>
                                <input type="text" id="name_font_color" class="form-control colorpicker" name="name_font_color" value="{{isset($record->name_font_color) ? $record->name_font_color : old('name_font_color')}}">
                            </div>

                            <div class="col-md-4">
                                <label for="name_font_size" class="form-label">Name Font Size</label>
                                <select class="form-control select2" name="name_font_size">
                                    <option value="">Select</option>
                                    @for($i=24; $i<=50; $i+=2)
                                        <option value="{{$i}}px" @if(isset($record->name_font_size) && $record->name_font_size == $i.'px'){{'selected'}}@endif>{{$i}}px</option>
                                    @endfor
                                </select>
                            </div>

                            @php($fontfamily = fontFamily())
                            <div class="col-md-4 mt-2">
                                <label for="name_font_family" class="form-label">Name Font Family</label>
                                <select class="form-control select2" name="name_font_family">
                                    <option value="">Select</option>
                                    @foreach($fontfamily as $family)
                                        <option value="{{$family['key']}}" @if(isset($record->name_font_family) && $record->name_font_family == $family['key']){{'selected'}}@endif>{{$family['value']}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4 mt-2">
                                <label for="image" class="form-label">Image</label>
                                @if(isset($record->image) && $record->image)
                                    <img src="{{url('public/uploads/vacancy/'.$record->image)}}" width="50">
                                @endif  
                                <input type="file" id="image" class="form-control" name="image" value="">
                                @if ($errors->has('image')) <div class="text-danger">{{ $errors->first('image') }}</div>@endif
                                <div class="error"></div>
                                <small class="image_type">(Image Type : jpg,jpeg,png,svg,webp)</small>
                            </div>

                            <div class="col-md-4 mt-2">
                                <label for="icon" class="form-label">Icon</label>
                                @if(isset($record->icon) && $record->icon)
                                    <img src="{{url('public/uploads/vacancy_icon/'.$record->icon)}}" width="50">
                                @endif  
                                <input type="file" id="icon" class="form-control" name="icon" value="">
                                @if ($errors->has('icon')) <div class="text-danger">{{ $errors->first('icon') }}</div>@endif
                                <div class="error"></div>
                                <small class="image_type">(Image Type : jpg,jpeg,png,svg,webp)</small>
                            </div>

                            <div class="col-md-4 mt-2">
                                <label for="icon_background_color" class="form-label">Icon Background Color</label>
                                <input type="text" id="icon_background_color" class="form-control colorpicker" name="icon_background_color" value="{{isset($record->icon_background_color) ? $record->icon_background_color : old('icon_background_color')}}">
                            </div>

                            <div class="col-md-4 mt-2">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" name="description" id="description">{{isset($record->description) ? $record->description : old('description')}}</textarea>
                            </div>

                            <div class="col-md-4 mt-2">
                                <label for="description_font_size" class="form-label">Description Font Size</label>
                                <select class="form-control select2" name="description_font_size">
                                    <option value="">-- Select --</option>
                                    @for($i=24; $i<=50; $i+=2)
                                        <option value="{{$i}}px" @if(isset($record->description_font_size) && $record->description_font_size == $i.'px'){{'selected'}}@endif>{{$i}}px</option>
                                    @endfor
                                </select>
                            </div>

                            <div class="col-md-4 mt-2">
                                <label for="description_font_family" class="form-label">Description Font Family</label>
                                <select class="form-control select2" name="description_font_family">
                                    <option value="">-- Select --</option>
                                    @foreach($fontfamily as $family)
                                        <option value="{{$family['key']}}" @if(isset($record->description_font_family) && $record->description_font_family == $family['key']){{'selected'}}@endif>{{$family['value']}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4 mt-2">
                                <label for="description_font_color" class="form-label">Description Font Color</label>
                                <input type="text" class="form-control colorpicker" value="{{isset($record->description_font_color) ? $record->description_font_color : old('description_font_color')}}" name="description_font_color" id="description_font_color">
                            </div>

                            <div class="col-md-4">
                                <label for="experience" class="form-label">Experience</label>
                                <input type="text" class="form-control" id="experience" name="experience" value="{{isset($record->experience) ? $record->experience : old('experience')}}">
                            </div>

                            <div class="col-md-4">
                                <label for="work_level" class="form-label">Work Level</label>
                                <input type="text" class="form-control" id="work_level" name="work_level" value="{{isset($record->work_level) ? $record->work_level : old('work_level')}}">
                            </div>

                            <div class="col-md-4">
                                <label for="employee_type" class="form-label">Employee Type</label>
                                <input type="text" class="form-control" id="employee_type" name="employee_type" value="{{isset($record->employee_type) ? $record->employee_type : old('employee_type')}}">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="offer_salary" class="form-label">Offer Salary</label>
                                <input type="text" class="form-control" id="offer_salary" name="offer_salary" value="{{isset($record->offer_salary) ? $record->offer_salary : old('offer_salary')}}">
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary submit">Submit</button>
                            <a href="{{ route('vacancies') }}" class="btn btn-danger">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection
@section('javascript')
<script src="{{ url('public/plugins/parsley/parsley.js') }}"></script>
<script src="{{ url('public/plugins/select2/js/select2.js') }}"></script>
<script>
    $(document).ready(function () {
        $('.select2').select2({ width: '100%' });

         // business selection
         var business_id = "{{isset($record->business_id) && $record->business_id ? $record->business_id : ''}}";
        if(business_id)
        {
            getBusiness(business_id);
        }
        $(document).on('change','#business_id',function(){
            var business_id = $(this).val();
            getBusiness(business_id);
        })
        // end business selection

        // showroom dropdown event
        $(document).on('change', '#showroom_id', function(){
            var showroom = $(this).val();
            if(showroom !='')
            {
                var showroom_flag = 0;
            }else{
                var showroom_flag = 1;
               
            }
            serviceCenterBlankAndHide(showroom_flag);
            bodyShopBlankAndHide(showroom_flag);
            usedCarBlankAndHide(showroom_flag);
        })
        // end showroom dropdown event

        // service center dropdown event
        $(document).on('change', '#service_center_id', function(){
            var service_center = $(this).val();
            if(service_center !='')
            {
                var service_flag = 0;
            }else{
                var service_flag = 1;
            }
            showroomBlankAndHide(service_flag);
            bodyShopBlankAndHide(service_flag);
            usedCarBlankAndHide(service_flag);
        })
        // end service center dropdown event

        // body shop dropdown event
        $(document).on('change', '#body_shop_id', function(){
            var body_shop = $(this).val();
            if(body_shop !='')
            {
                var bodyshop_flag = 0;
            }else{
                var bodyshop_flag = 1;
            }
            showroomBlankAndHide(bodyshop_flag);
            serviceCenterBlankAndHide(bodyshop_flag);
            usedCarBlankAndHide(bodyshop_flag);
        })
        // end body dropdown event

        // used car dropdown event
        $(document).on('change', '#used_car_id', function(){
            var used_car = $(this).val();
            console.log(used_car);
            if(used_car !='')
            {
               var usedcar_flag = 0;
            }else{
               var usedcar_flag = 1;
            }
            showroomBlankAndHide(usedcar_flag);
            serviceCenterBlankAndHide(usedcar_flag);
            bodyShopBlankAndHide(usedcar_flag);
        })
        // end used car dropdown event

        $(".service-center-form").validate({
            rules: {
            },
            submitHandler: function(form) {
                $(form).find('.submit').prop("disabled", true);
                form.submit();
            }
        });

        $('.colorpicker').colorpicker();
    });

    function getBusiness(business_id)
    {
        if(business_id !="" && business_id != null)
        {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                method:'post',
                url:'{{route('get-business')}}',
                data:{_token: CSRF_TOKEN,business_id:business_id},
                success : function(result){
                    var result = JSON.parse(result);
                    $('#showroom_id').html(result.html);
                    $('#service_center_id').html(result.service_center_html);
                    $('#body_shop_id').html(result.body_shop_html);
                    $('#used_car_id').html(result.usedcar_html);

                    var showroom_id = "{{ isset($record->showroom_id) ? $record->showroom_id : '' }}";
                    $('#showroom_id').val(showroom_id);
                    var service_center_id = "{{ isset($record->service_center_id) ? $record->service_center_id : '' }}";
                    $('#service_center_id').val(service_center_id);
                    var body_shop_id = "{{ isset($record->body_shop_id) ? $record->body_shop_id : '' }}";
                    $('#body_shop_id').val(body_shop_id);
                    var used_car_id = "{{ isset($record->used_car_id) ? $record->used_car_id : '' }}";
                    $('#used_car_id').val(used_car_id);
                }
            })
        } else {
            $('#showroom_id').empty();
            $('#service_center_id').empty();
            $('#body_shop_id').empty();
            $('#used_car_id').empty();
        }
    }

    function serviceCenterBlankAndHide(flag)
    {
        if(flag==0)
        {
            $('#service_center_id').select2('destroy')
            $('#service_center_id').val('')
            $('#service_center_id').select2()
            $('.service-center').hide()
        }else{
            $('.service-center').show()
        }
    }

    function bodyShopBlankAndHide(flag)
    {
        if(flag==0)
        {
            $('#body_shop_id').select2('destroy')
            $('#body_shop_id').val('')
            $('#body_shop_id').select2()
            $('.body-shop').hide()
        }else{
            $('.body-shop').show()
        }
    }

    function usedCarBlankAndHide(flag)
    {
        if(flag==0)
        {
            $('#used_car_id').select2('destroy')
            $('#used_car_id').val('')
            $('#used_car_id').select2()
            $('.used-car').hide()
        }else{
            $('.used-car').show()
        }
    }

    function showroomBlankAndHide(flag)
    {
        if(flag==0)
        {
            $('#showroom_id').select2('destroy')
            $('#showroom_id').val('')
            $('#showroom_id').select2()
            $('.showroom').hide()
        }else{
            $('.showroom').show()
        }
    }
</script>
@endsection