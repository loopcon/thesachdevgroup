@extends('admin.layout.header')
@section('css')
    <link type="text/css" class="js-stylesheet" href="{{ url('public/plugins/parsley/parsley.css') }}" rel="stylesheet">
    <link class="js-stylesheet" href="{{ url('public/plugins/select2/css/select2.css') }}" rel="stylesheet">
    <link class="js-stylesheet" href="{{ url('public/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
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
                    <form action="{{route('career-form-update',array('id' => encrypt($record->id)))}}" method="POST" id="career_form" class="user-form" enctype="multipart/form-data" data-parsley-validate="">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="first_name">First Name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="first_name" value="{{isset($record->first_name) ? $record->first_name : old('first_name')}}" id="first_name" required>
                                @if ($errors->has('first_name')) <div class="text-danger">{{ $errors->first('first_name') }}</div>@endif
                            </div>

                            <div class="form-group col-md-6">
                                <label for="last_name">Last Name</label>
                                <input type="text" class="form-control" name="last_name" value="{{isset($record->last_name) ? $record->last_name : old('last_name')}}" id="last_name">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="email">Email Address<span class="text-danger">*</span></label>
                                <input type="email" class="form-control" name="email" value="{{isset($record->email) ? $record->email : old('email')}}" id="email" required>
                                @if($errors->has('address')) <div class="text-danger">{{ $errors->first('address')}}</div> @endif
                                <span class="text-danger" id="email-error"></span>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="contact_no">Contact No.<span class="text-danger">*</span></label>
                                <input type="text" class="form-control num_only" name="contact_no" value="{{isset($record->contact_no) ? $record->contact_no : old('contact_no')}}" id="contact_no" maxlength="10" required>
                                @if($errors->has('contact_no')) <div class="text-danger">{{ $errors->first('contact_no')}}</div> @endif
                                <span class="text-danger" id="contact-error"></span>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="post_apply_for">Post Applying For</label>
                                <input type="text" class="form-control" name="post_apply_for" value="{{isset($record->post_apply_for) ? $record->post_apply_for : old('post_apply_for')}}" id="post_apply_for">
                            </div>

                            <div class="form-group col-md-6">
                                @if(isset($record->resume) && $record->resume)
                                <label for="resume">Download your Resume</label>
                                <a href="{{url('public/uploads/career/resume/'.$record->resume)}}" download><i class="fas fa-file-alt" style="font-size:36px;"></i><a>
                                @endif  
                            </div>
                        </div>

                        <button type="submit" id="submit" class="btn btn-primary">Submit</button>
                        <a href="{{ route('career-form') }}" class="btn btn-danger">Cancel</a>
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
<script src="{{ url('public/plugins/select2/js/select2.min.js') }}"></script>
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