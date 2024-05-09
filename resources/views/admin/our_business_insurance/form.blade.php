@extends('admin.layout.header')
@section('css')
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
                    <form action="@if(isset($record->id)) {{ route('our-business-insurance-update', array('id' => encrypt($record->id))) }} @else{{ route('our-business-insurance-store') }} @endif" method="POST" class="our-business-insurance-form" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-4 adm-brand-errorbox">
                                <label for="business_id" class="form-label">Our Business<span class="text-danger">*</span></label>
                                <select class="form-control select2" name="business_id" id="business_id">
                                    <option value="">-- Select Business--</option>
                                    @foreach($business as $value)
                                        <option value="{{$value->id}}" @if(isset($record->business_id) && $record->business_id == $value->id){{'selected'}} @endif>{{$value->title}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('business_id')) <div class="text-danger">{{ $errors->first('business_id') }}</div>@endif
                            </div>

                            <div class="col-md-4 page_url">
                                <label for="url" class="form-label">Url</label>
                                <input type="url" id="url" class="form-control" name="url" value="{{isset($record->url) ? $record->url : old('url')}}">
                            </div>

                            <div class="col-md-4">
                                <label for="name" class="form-label">Name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="name" name="name" value="{{isset($record->name) ? $record->name : old('name')}}">
                                @if ($errors->has('name')) <div class="text-danger">{{ $errors->first('name') }}</div>@endif
                                <div class="error"></div>
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
                            <div class="col-md-4">
                                <label for="name_font_family" class="form-label">Name Font Family</label>
                                <select class="form-control select2" name="name_font_family">
                                    <option value="">Select</option>
                                    @foreach($fontfamily as $family)
                                        <option value="{{$family['key']}}" @if(isset($record->name_font_family) && $record->name_font_family == $family['key']){{'selected'}}@endif>{{$family['value']}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4 mt-2 mb-3">
                                <label for="icon" class="form-label">Icon</label><span class="text-danger">*</span>
                                @if(isset($record->icon) && $record->icon)
                                    <img src="{{url('public/uploads/our_business_insurance/'.$record->icon)}}" width="100" style="margin-bottom:10px; margin-left:10px;">
                                @endif  
                                <input type="file" id="icon" class="form-control" name="icon" value="">
                                @if ($errors->has('icon')) <div class="text-danger">{{ $errors->first('icon') }}</div>@endif
                                <div class="error"></div>
                                <small class="image_type">(Hight:77px,Width:77px;Image Type : jpg,jpeg,png,webp)</small>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary submit">Submit</button>
                            <a href="{{ route('our-business-insurance') }}" class="btn btn-danger">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
@section('javascript')
<script src="{{ url('public/plugins/select2/js/select2.js') }}"></script>
<script src="{{ url('public/plugins/select2/js/select2.min.js') }}"></script>
<script>
    $(document).ready(function () {
        $('.select2').select2({ width: '100%' });

        $(".our-business-insurance-form").validate({
            rules: {
                'business_id': {
                    required: true,
                },
                'name': {
                    required: true,
                },
                'icon': {
                    extension: "jpg,jpeg,png,webp",
                },
                url: {
                    url: "url",
                },
            },
            messages: {
                'business_id': {
                    required: "Our Business is required",
                },
                'name': {
                    required: "Name is required",
                },
                'icon': {
                    extension: "Icon must be jpg,jpeg,png or webp",
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