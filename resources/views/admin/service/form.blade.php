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
                    <form action="@if(isset($record->id)) {{ route('service-update', array('id' => encrypt($record->id))) }} @else{{ route('service-store') }} @endif" method="POST" class="service-form" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <label for="service_center_id" class="form-label">Service Center<span class="text-danger">*</span></label>
                                <select class="form-control select2" name="service_center_id" id="service_center_id">
                                    <option value="">-- Select Service Center --</option>
                                    @foreach($service_center as $value)
                                        <option value="{{$value->id}}"@if(isset($record->service_center_id) && $record->service_center_id == $value->id){{'selected'}}@endif>{{$value->name}}</option>
                                    @endforeach
                                </select>
                                <div id="error"></div>
                                @if ($errors->has('service_center_id')) <div class="text-danger">{{ $errors->first('service_center_id') }}</div>@endif
                            </div>
                            <div class="col-md-4">
                                <label for="name" class="form-label">Name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="name" name="name" value="{{isset($record->name) ? $record->name : old('name')}}">
                                @if ($errors->has('name')) <div class="text-danger">{{ $errors->first('name') }}</div>@endif
                                <div class="error"></div>
                            </div>

                            <div class="col-md-4">
                                <label for="title" class="form-label">Name Font Color</label>
                                <input type="text" id="name_font_color" class="form-control colorpicker" name="name_font_color" value="{{isset($record->name_font_color) ? $record->name_font_color : old('name_font_color')}}">
                                @if ($errors->has('name_font_color')) <div class="text-danger">{{ $errors->first('name_font_color') }}</div>@endif
                                <div class="error"></div>
                            </div>

                            <div class="col-md-4 mt-2">
                                <label for="name_font_size" class="form-label">Name Font Size</label>
                                <select class="form-control select2" name="name_font_size">
                                    <option value="">-- Select --</option>
                                    @for($i=24; $i<=50; $i+=2)
                                        <option value="{{$i}}px" @if(isset($record->name_font_size) && $record->name_font_size == $i.'px'){{'selected'}}@endif>{{$i}}px</option>
                                    @endfor
                                </select>
                            </div>

                            @php($fontfamily = fontFamily())
                            <div class="col-md-4 mt-2">
                                <label for="name_font_family" class="form-label">Name Font Family</label>
                                <select class="form-control select2" name="name_font_family">
                                    <option value="">-- Select --</option>
                                    @foreach($fontfamily as $family)
                                        <option value="{{$family['key']}}" @if(isset($record->name_font_family) && $record->name_font_family == $family['key']){{'selected'}}@endif>{{$family['value']}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4 mt-2">
                                <label for="url" class="form-label">Url<span class="text-danger">*</span></label>
                                <input type="urls" class="form-control" id="url" name="url" value="{{isset($record->url) ? $record->url : old('url')}}">
                                @if ($errors->has('url')) <div class="text-danger">{{ $errors->first('url') }}</div>@endif
                                <div class="error"></div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="icon" class="form-label">Icon<span class="text-danger">*</span></label>
                                @if(isset($record->icon) && $record->icon)
                                    <img src="{{url('public/uploads/service/'.$record->icon)}}" width="100">
                                @endif  
                                <input type="file" id="icon" class="form-control" name="icon" value="">
                                @if ($errors->has('icon')) <div class="text-danger">{{ $errors->first('icon') }}</div>@endif
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary submit">Submit</button>
                            <a href="{{ route('service') }}" class="btn btn-default">Cancel</a>
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

        $(".service-form").validate({
            rules: {
                'name': {
                    required: true,
                },
                'service_center_id': {
                    required: true,
                },
                'icon': {
                    extension: "jpg,jpeg,png,webp",
                },
                'url': {
                    required: true,
                    url: "url",
                },
            },
            messages: {
                'name': {
                    required: "Name is required",
                },
                'service_center_id': {
                    required: "Service Center is required",
                },
                'icon': {
                    extension: "Image must be jpg,jpeg,png or webp",
                },
                'url': {
                    required: "Url is required",
                    url: "Enter valid url",
                },
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