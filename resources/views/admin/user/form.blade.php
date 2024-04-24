@extends('admin.layout.header')
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
                                <select class="form-control select2" name="role_id">
                                    <option value="">-- Select User Role --</option>
                                    @if(isset($role) && $role->count())
                                        @foreach($role as $value)
                                            <option value="{{$value->id}}"@if(isset($record->role_id) && $record->role_id == $value->id){{'selected'}}@endif>{{$value->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>

                            <div class="mb-3 col-md-4">
                                <label for="business_id" class="form-label">Our Business<span class="text-danger">*</span></label>
                                <select class="form-control select2" name="business_id">
                                    <option value="">-- Select Our Business --</option>
                                    @if(isset($our_business) && $our_business->count())
                                        @foreach($our_business as $value)
                                            <option value="{{$value->id}}"@if(isset($record->business_id) && $record->business_id == $value->id){{'selected'}}@endif>{{$value->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>

                            <div class="mb-3 col-md-4">
                                <label for="showroom_id" class="form-label">Showroom<span class="text-danger">*</span></label>
                                <select class="form-control select2" name="showroom_id">
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label for="name" class="form-label">Name<span class="text-danger">*</span></label>
                                <input type="text" id="name" class="form-control" name="name" value="{{isset($record->name) ? $record->name : ''}}">
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
  @endsection
  @section('javascript')
  <script>
    $(document).ready(function () {

        $('#business_id').on('change', function(){
            var business_id = $(this).val();
            if(!empty(business_id))
            {
                $.ajax({
                    method:'post',
                    url:'{{route('get-showroom')}}',
                    data:{business_id:business_id},
                    success : function(result)
                    {
                        var result = $.parseJson(result);
                    }
                })
            }
        })
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
            messages: {
                'name': {
                    required: "The name field is required.",
                },
                'email': {
                    required: "The email field is required.",
                },
                'password': {
                    minlength:"Your password must contain at least 1 lowercase, 1 special character, 1 number and password length should be minimum 8 character long.",
                }
            },
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
</script>
@endsection