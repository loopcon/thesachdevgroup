@extends('admin.layout.header')
@section('css')
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
            <div class="col-12 col-xl-6">
                <div class="card">
                    <div class="card-body">
                    <form method="post" action="{{route('change-password')}}" data-parsley-validate>
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">{{__('Old Password')}} <span class="text-danger">*</span></label>
                            <input type="text" placeholder="{{trans('Old Password')}}" required="" class="form-control" value="" name="old_password" data-parsley-required-message="{{ __("This value is required.")}}">
                            @if ($errors->has('old_password')) <div class="text-danger">{{ $errors->first('old_password') }}</div>@endif
                        </div>
                        <div class="mb-3">
                            <label class="form-label">{{__('New Password')}} <span class="text-danger">*</span></label>
                            <input type="text" placeholder="{{trans('New Password')}}" required="" class="form-control" value="" name="new_password" id="new_password" data-parsley-minlength="6" data-parsley-required-message="{{ __("This value is required.")}}" data-parsley-error-message="{{__('This value is too short. It should have 6 characters or more.')}}">
                            @if ($errors->has('new_password')) <div class="text-danger">{{ $errors->first('new_password') }}</div>@endif
                        </div>
                        <div class="mb-3">
                            <label class="form-label">{{__('Confirm Password')}}<span class="text-danger">*</span></label>
                            <input type="text" placeholder="{{trans('Confirm Password')}}" required="" class="form-control" value="" name="confirm_new_password" data-parsley-equalto="#new_password" data-parsley-required-message="Please re-enter your new password." data-parsley-error-message="{{__('Confirm password should match password field.')}}">
                            @if ($errors->has('confirm_new_password')) <div class="text-danger">{{ $errors->first('confirm_new_password') }}</div>@endif
                        </div>
                        <button type="submit" class="btn btn-primary">{{__('Submit')}}</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
  </div>
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection
@section('javascript')
<script type="text/javascript" src="{{ url('public/plugins/parsley/parsley.js') }}"></script>
@endsection