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
                    <form action="{{route('career-form-update',array('id' => encrypt($record->id)))}}" method="POST" id="career_form" enctype="multipart/form-data" data-parsley-validate="">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="first_name">First Name</label>
                                <input type="text" class="form-control" name="first_name" value="{{isset($record->first_name) ? $record->first_name : old('first_name')}}" id="first_name" required>
                                <span class="text-danger" id="first-name-error"></span>
                                @if ($errors->has('first_name')) <div class="text-danger">{{ $errors->first('first_name') }}</div>@endif
                            </div>

                            <div class="form-group col-md-6">
                                <label for="last_name">Last Name</label>
                                <input type="text" class="form-control" name="last_name" value="{{isset($record->last_name) ? $record->last_name : old('last_name')}}" id="last_name">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="email">Email Address</label>
                                <input type="email" class="form-control" name="email" value="{{isset($record->email) ? $record->email : old('email')}}" id="email" required>
                                <span class="text-danger" id="email-error"></span>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="contact_no">Contact No.</label>
                                <input type="text" class="form-control num_only" name="contact_no" value="{{isset($record->contact_no) ? $record->contact_no : old('contact_no')}}" id="contact_no" maxlength="10" required>
                                <span class="text-danger" id="contact-error"></span>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="post_apply_for">Post Applying For</label>
                                <input type="text" class="form-control" name="post_apply_for" value="{{isset($record->post_apply_for) ? $record->post_apply_for : old('post_apply_for')}}" id="post_apply_for">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="resume">Upload your Resume</label>
                                @if(isset($record->resume) && $record->resume)
                                <i class="fas fa-file-alt" style="font-size:36px;"></i>
                                @endif  
                                <input type="file" class="form-control" name="resume" accept="file/pdf, file/docx" id="resume">
                                @if ($errors->has('resume')) <div class="text-danger">{{ $errors->first('resume') }}</div>@endif
                            </div>
                        </div>
                        <button type="submit" id="submit" class="btn btn-primary">Submit</button>
                        <a href="{{ route('career-form') }}" class="btn btn-danger">Cancel</a>
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