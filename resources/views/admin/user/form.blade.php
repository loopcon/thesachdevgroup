@extends('admin.layout.header')
@section('css')
    <link type="text/css" class="js-stylesheet" href="{{ url('public/plugins/parsley/parsley.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h1>{{$site_title}}</h1>
          </div>
          <!-- <div class="col-sm-6 d-none d-sm-block">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">user Create</li>
            </ol>
          </div> -->
        </div>
      </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <form action="@if(isset($record)) {{ route('user-update',array('id' => encrypt($record->id))) }} @else{{ route('user-store') }} @endif" method="POST" class="user-form" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-md-4">
                                <label for="role_id" class="form-label">User Role<span class="text-danger">*</span></label>
                                <select class="form-control select2" name="role_id" required="">
                                    <option value="">-- Select User Role --</option>
                                    @if(isset($role) && $role->count())
                                        @foreach($role as $value)
                                            <option value="{{$value->id}}"@if(isset($record->role_id) && $record->role_id == $value->id){{'selected'}}@endif>{{$value->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @if ($errors->has('role_id')) <div class="text-danger">{{ $errors->first('role_id') }}</div>@endif
                                <div class="error"></div>
                            </div>

                            <div class="mb-3 col-md-4">
                                <label for="business_id" class="form-label">Our Business<span class="text-danger">*</span></label>
                                <select class="form-control select2" name="business_id" id="business_id" required>
                                    <option value="">-- Select Our Business --</option>
                                    @if(isset($our_business) && $our_business->count())
                                        @foreach($our_business as $value)
                                            <option value="{{$value->id}}"@if(isset($record->business_id) && $record->business_id == $value->id){{'selected'}}@endif>{{$value->title}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <div class="error"></div>
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
                                <input type="text" id="name" class="form-control" name="name" value="{{isset($record->name) ? $record->name : ''}}" required>
                                @if ($errors->has('name')) <div class="text-danger">{{ $errors->first('name') }}</div>@endif
                                <div class="error"></div>
                            </div>  

                            <div class="col-md-4">
                                <label for="email" class="form-label">Email<span class="text-danger">*</span></label>
                                <input type="text" id="email" class="form-control" name="email" value="{{isset($record->email) ? $record->email : ''}}">
                                @if ($errors->has('email')) <div class="text-danger">{{ $errors->first('email') }}</div>@endif
                                <div class="error"></div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="password">Password<span class="text-danger">*</span></label>
                                <input type="text" id="password" name="password" value="{{isset($record->visible_password) ? $record->visible_password : ''}}" required="" class="form-control">
                                @if ($errors->has('password')) <div class="text-danger">{{ $errors->first('password') }}</div>@endif
                                <small>(Password must contain at least one special character,capital)</small>
                                @if ($errors->has('password')) <div class="text-danger">{{ $errors->first('password') }}</div>@endif
                                <div class="error"></div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="password">Confirm Password<span class="text-danger">*</span></label>
                                <input type="text" name="cpassword" class="form-control" required data-parsley-equalto="#password" value="{{isset($record->visible_password) ? $record->visible_password : ''}}">
                                @if ($errors->has('cpassword')) <div class="text-danger">{{ $errors->first('cpassword') }}</div>@endif
                            </div>
                        </div>

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary submit">Submit</button>
                            <a href="{{ route('user') }}" class="btn btn-danger">Cancel</a>
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
<script type="text/javascript" src="{{ url('public/plugins/parsley/parsley.js') }}"></script>
  <script>
    $(document).ready(function () {
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

        // form validation
        $(".user-form").validate({
            rules: {
                'name': {
                    required: true,
                },
                'email': {
                    required: true,
                },
                'password': {
                    required: true,
                    minlength:"6",
                },
            },
            // messages: {
            //     'name': {
            //         required: "The name field is required.",
            //     },
            //     'email': {
            //         required: "The email field is required.",
            //     },
            //     'password': {
            //         required: "The password field is required.",
            //         minlength:"Your password must contain at least 1 lowercase, 1 special character, 1 number and password length should be minimum 8 character long.",
            //     }
            // },
            errorPlacement: function(error, element) {
                error.appendTo(element.parent().find('.error'));
            },
            submitHandler: function(form) {
                $(form).find('.submit').prop("disabled", true);
                form.submit();
            }
        });
        $('.colorpicker').colorpicker();
    });
    // end form validation

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