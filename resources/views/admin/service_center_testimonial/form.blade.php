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
                    <form action="@if(isset($record->id)) {{ route('service-center-testimonial-update', array('id' => encrypt($record->id))) }} @else{{ route('service-center-testimonial-store') }} @endif" method="POST" class="service-center-testimonial-form" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-4 adm-brand-errorbox">
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
                                <label for="title" class="form-label">Name Background Color</label>
                                <input type="text" id="name_background_color" class="form-control colorpicker" name="name_background_color" value="{{isset($record->name_background_color) ? $record->name_background_color : old('name_background_color')}}">
                                @if ($errors->has('name_background_color')) <div class="text-danger">{{ $errors->first('name_background_color') }}</div>@endif
                                <div class="error"></div>
                            </div>

                            <div class="col-md-4 mt-2">
                                <label for="description" class="form-label">Description</label>
                                <textarea id="description" class="form-control" name="description">{{isset($record->description) ? $record->description : old('description')}}</textarea>
                                @if ($errors->has('description')) <div class="text-danger">{{ $errors->first('description') }}</div>@endif
                                <div class="error"></div>
                            </div>

                            <div class="col-md-4 mt-2">
                                <label for="description_text_color" class="form-label">Description Text Color</label>
                                <input type="text" id="description_text_color" class="form-control colorpicker" name="description_text_color" value="{{isset($record->description_text_color) ? $record->description_text_color : old('description_text_color')}}">
                                @if ($errors->has('description_text_color')) <div class="text-danger">{{ $errors->first('description_text_color') }}</div>@endif
                                <div class="error"></div>
                            </div>

                            <div class="col-md-4 mt-2">
                                <label for="description_text_size" class="form-label">Description Text Size</label>
                                <select class="form-control select2" name="description_text_size">
                                    <option value="">-- Select --</option>
                                    @for($i=24; $i<=50; $i+=2)
                                        <option value="{{$i}}px" @if(isset($record->description_text_size) && $record->description_text_size == $i.'px'){{'selected'}}@endif>{{$i}}px</option>
                                    @endfor
                                </select>
                            </div>

                            @php($fontfamily = fontFamily())
                            <div class="col-md-4 mt-2">
                                <label for="description_font_family" class="form-label">Description Font Family</label>
                                <select class="form-control select2" name="description_font_family">
                                    <option value="">-- Select --</option>
                                    @foreach($fontfamily as $family)
                                        <option value="{{$family['key']}}" @if(isset($record->description_font_family) && $record->description_font_family == $family['key']){{'selected'}}@endif>{{$family['value']}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4 mt-2 mb-3">
                                <label for="image" class="form-label">Image<span class="text-danger">*</span></label><span><small>(Hight:90,Width:90; Image Type : jpg,jpeg,png,webp)</small><span>
                                @if(isset($record->image) && $record->image)
                                    <img src="{{url('public/uploads/service_center_testimonial/'.$record->image)}}" width="100">
                                @endif  
                                <input type="file" id="image" class="form-control" name="image" value="">
                                @if ($errors->has('image')) <div class="text-danger">{{ $errors->first('image') }}</div>@endif
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary submit">Submit</button>
                            <a href="{{ route('service-center-testimonial') }}" class="btn btn-danger">Cancel</a>
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

        $(".service-center-testimonial-form").validate({
            rules: {
                'name': {
                    required: true,
                },
                'service_center_id': {
                    required: true,
                },
                'image': {
                    extension: "jpg,jpeg,png,webp",
                },
            },
            messages: {
                'name': {
                    required: "Name is required",
                },
                'service_center_id': {
                    required: "Service Center is required",
                },
                'image': {
                    extension: "Image must be jpg,jpeg,png or webp",
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