@extends('admin.layout.header')
@section('css')
    <link type="text/css" class="js-stylesheet" href="{{ url('public/plugins/parsley/parsley.css') }}" rel="stylesheet">
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
                    <form action="{{route('booked-insurance-update', array('id' => encrypt($record->id))) }}" method="post" class="service-form" enctype="maltipart/form-data" data-parsley-validate="">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <label for="name" class="form-label">First Name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="first_name" value="{{isset($record->first_name) ? $record->first_name : old('first_name')}}" required>
                            </div>
                            <div class="col-md-4">
                                <label for="name" class="form-label">Phone<span class="text-danger">*</span></label>
                                <input  type="tel" class="form-control num_only" name="phone" value="{{isset($record->phone) ? $record->phone : old('phone')}}" maxlength="10" pattern="[0-9]{10}" title="Please enter a 10-digit contact number" required>
                            </div>
                        
                            <div class="col-md-4 mt-2">
                                <label for="name" class="form-label">Email<span class="text-danger">*</span></label>
                                <input type="email" class="form-control" name="email" value="{{isset($record->email) ? $record->email : old('email')}}" required>
                            </div>

                            <div class="col-md-4 mb-2">
                                <label for="brand_id" class="form-label">Brand</label>
                                <select id="brand_id" class="form-control select2" name="brand_id">
                                    <option value="">Choose Brand</option>
                                    @if(isset($brands) && $brands)
                                        @foreach($brands as $data)
                                            <option value="{{$data->id}}" {{$record->brand_id == $data->id ? 'selected' : ''}}>{{$data->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label for="name" class="form-label">Description</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" name="description" rows="3">{{isset($record->description) ? $record->description : old('$record->description')}}</textarea>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary bookservice-button">Submit</button>
                        <a href="{{ route('booked-insurance') }}" class="btn btn-danger">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
@section('javascript')
<script src="{{ url('public/plugins/parsley/parsley.js') }}"></script>
<script src="{{ url('public/plugins/select2/js/select2.js') }}"></script>
<script src="{{ url('public/plugins/select2/js/select2.min.js') }}"></script>
<script>
    $(document).ready(function () {
        $('.select2').select2({ width: '100%' });
    });
</script>
@endsection