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
                    <form action="@if(isset($record->id)) {{ route('award-update', array('id' => encrypt($record->id))) }} @else{{ route('award-store') }} @endif" method="POST" class="award-form" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-4 adm-brand-errorbox">
                                <label for="brand_id" class="form-label">Brand<span class="text-danger">*</span></label>
                                <select class="form-control select2" name="brand_id" id="brand_id">
                                    <option value="">-- Select Brand --</option>
                                    @foreach($brand as $value)
                                        <option value="{{$value->id}}"@if(isset($record->brand_id) && $record->brand_id == $value->id){{'selected'}}@endif>{{$value->name}}</option>
                                    @endforeach
                                </select>
                                <div id="error"></div>
                                @if ($errors->has('brand_id')) <div class="text-danger">{{ $errors->first('brand_id') }}</div>@endif
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="image" class="form-label">Image</label>&nbsp;<small>(Image Type : jpg,jpeg,png,webp)</small>
                                @if(isset($record->image) && $record->image)
                                    <img src="{{url('public/uploads/award/'.$record->image)}}" width="100" style="margin-bottom:10px; margin-left:5px;">
                                @endif  
                                <input type="file" id="image" class="form-control" name="image" value="">
                                @if ($errors->has('image')) <div class="text-danger">{{ $errors->first('image') }}</div>@endif
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary submit">Submit</button>
                            <a href="{{ route('awards') }}" class="btn btn-danger">Cancel</a>
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

        $(".award-form").validate({
            rules: {
                'brand_id': {
                    required: true,
                },
                'image': {
                    extension: "jpg,jpeg,png,webp",
                },
            },
            messages: {
                'brand_id': {
                    required: "Brand is required",
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
    });
</script>
@endsection