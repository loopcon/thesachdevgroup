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
          <div class="col-sm-6">
            <h1>{{$site_title}}</h1>
          </div>
          <div class="col-sm-6 d-none d-sm-block">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">{{$site_title}}</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <form action="@if(isset($record->id)) {{ route('header_menu_social_media_icon_update', array('id' => encrypt($record->id))) }} @else{{ route('header_menu_social_media_icon_insert') }} @endif" method="POST" class="header_menu_social_media_icon_form" enctype="multipart/form-data">
                        @csrf
                        <div class="row">

                            <div class="mb-3 col-md-6">
                                <label for="icon" class="form-label">Icon<span class="text-danger">*</span></label>
                                @if(isset($record->icon) && $record->icon)
                                <input type="hidden" name="old_icon" value="{{$record->icon}}">
                                    <img src="{{url('public/header_menu_social_media_icon/'.$record->icon)}}" width="100">
                                @endif  
                                <input type="file" id="icon" class="form-control" name="icon">
                                <div class="error"></div>
                            </div>

                            <div class="col-md-6">
                                <label for="link" class="form-label">Link<span class="text-danger">*</span></label>
                                <input type="text" id="link" class="form-control" name="link" value="{{isset($record->link) ? $record->link : old('link')}}">
                                <div class="error"></div>
                            </div>

                             </div> 
                            
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary submit">Submit</button>
                            <a href="{{ route('header_menu_social_media_icon') }}" class="btn btn-default">Cancel</a>
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
        $(".header_menu_social_media_icon_form").validate({
            rules: {
                'icon': {
                    required: true,
                    extension: "jpg,jpeg,png",
                },
                'link': {
                    required: true,
                    url: "url",
                },
            },
            messages: {
                'icon': {
                    required: "The icon field is required.",
                    extension: "Please enter a value with a valid extension.",
                },
                'link': {
                    required: "The link field is required.",
                    url: "Please enter a valid link.",
                },
            },
            errorPlacement: function(error, element) {
                error.appendTo(element.parent().find('.error'));
            },
            submitHandler: function(form) {
                $(form).find('.submit').prop("disabled", true);
                form.submit();
            }
        });
    });
</script>
@endsection