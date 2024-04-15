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
                    <form action="{{ route('award-banner-update') }}" method="POST" class="award-banner-form" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <label for="award_title" class="form-label">Award Title<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="award_title" name="award_title" value="{{isset($record->award_title) ? $record->award_title : old('award_title')}}">
                                @if ($errors->has('award_title')) <div class="text-danger">{{ $errors->first('award_title') }}</div>@endif
                                <div class="error"></div>
                            </div>

                            <div class="col-md-4">
                                <label for="award_title_font_color" class="form-label">Award Title Font Color</label>
                                <input type="text" id="name_font_color" class="form-control colorpicker" name="award_title_font_color" value="{{isset($record->award_title_font_color) ? $record->award_title_font_color : old('award_title_font_color')}}">
                            </div>

                            <div class="col-md-4 mt-2">
                                <label for="award_title_font_size" class="form-label">Award Title Font Size</label>
                                <select class="form-control select2" name="award_title_font_size">
                                    <option value="">-- Select --</option>
                                    @for($i=24; $i<=50; $i+=2)
                                        <option value="{{$i}}px" @if(isset($record->award_title_font_size) && $record->award_title_font_size == $i.'px'){{'selected'}}@endif>{{$i}}px</option>
                                    @endfor
                                </select>
                            </div>

                            @php($fontfamily = fontFamily())
                            <div class="col-md-4 mt-2">
                                <label for="award_title_font_family" class="form-label">Name Font Family</label>
                                <select class="form-control select2" name="award_title_font_family">
                                    <option value="">-- Select --</option>
                                    @foreach($fontfamily as $family)
                                        <option value="{{$family['key']}}" @if(isset($record->award_title_font_family) && $record->award_title_font_family == $family['key']){{'selected'}}@endif>{{$family['value']}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-5 mb-3 mt-2">
                                <label for="banner_image" class="form-label">Award Banner Image<span class="text-danger">*</span></label><small>(Hight:478px,Width:1349px; Image Type : jpg,jpeg,png,webp)</small>
                                @if(isset($record->banner_image) && $record->banner_image)
                                    <img src="{{url('public/uploads/award_banner/'.$record->banner_image)}}" width="100" style="margin-bottom:10px; margin-left:5px;">
                                @endif  
                                <input type="file" id="banner_image" class="form-control" name="banner_image" value="">
                                @if ($errors->has('banner_image')) <div class="text-danger">{{ $errors->first('banner_image') }}</div>@endif
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary submit">Update</button>
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