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
                    <form action="@if(isset($record->id)) {{ route('service-center-facility-customergallery-update', array('id' => encrypt($record->id))) }} @else{{ route('service-center-facility-customergallery-store') }} @endif" method="POST" class="service-center-facility-gallery-form" enctype="multipart/form-data">
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

                            <div class="col-md-4 mt-2">
                                <label for="facility_image" class="form-label">Facility Image<span class="text-danger">*</span></label>
                                @if(isset($record->facility_image) && $record->facility_image)
                                    <img src="{{url('public/uploads/service_center_facility_image/'.$record->facility_image)}}" width="100">
                                @endif  
                                <input type="file" id="facility_image" class="form-control" name="facility_image" value="">
                                @if ($errors->has('facility_image')) <div class="text-danger">{{ $errors->first('facility_image') }}</div>@endif
                                <div class="error"></div>
                            </div>

                            <div class="col-md-4 mt-2 mb-2">
                                <label for="customer_gallery_image" class="form-label">Customer Gallery Image<span class="text-danger">*</span></label>
                                @if(isset($record->customer_gallery_image) && $record->customer_gallery_image)
                                    <img src="{{url('public/uploads/service_center_customer_gallery_image/'.$record->customer_gallery_image)}}" width="100">
                                @endif  
                                <input type="file" id="customer_gallery_image" class="form-control" name="customer_gallery_image" value="">
                                @if ($errors->has('customer_gallery_image')) <div class="text-danger">{{ $errors->first('customer_gallery_image') }}</div>@endif
                                <div class="error"></div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary submit">Submit</button>
                            <a href="{{ route('service-center-facility-customergallery') }}" class="btn btn-default">Cancel</a>
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

        $(".service-center-facility-gallery-form").validate({
            rules: {
                'facility_image': {
                    extension: "jpg,jpeg,png,webp",
                },
                'customer_gallery_image': {
                    extension: "jpg,jpeg,png,webp",
                },
            },
            messages: {
                'facility_image': {
                    extension: "Image must be jpg,jpeg,png or webp",
                },
                'customer_gallery_image': {
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