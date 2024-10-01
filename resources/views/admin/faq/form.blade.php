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
            <div class="card">
                <div class="card-body">
                    <form action="@if(isset($record->id)) {{ route('faq-update', array('id' => encrypt($record->id))) }} @else{{ route('faq-store') }} @endif" method="POST" class="faq-form" enctype="multipart/form-data" data-parsley-validate="">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <label for="name" class="form-label">Name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="name" name="name" value="{{isset($record->name) ? $record->name : old('name')}}" required>
                                @if ($errors->has('name')) <div class="text-danger">{{ $errors->first('name') }}</div>@endif
                                <div class="error"></div>
                            </div>

                            <div class="col-md-12 mt-2 mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" name="description">{{isset($record->description) ? $record->description : old('description')}}</textarea>
                                <div class="error"></div>
                            </div>

                            {{-- <div class="col-md-4">
                                <label for="meta_title">Meta Title</label>
                                <input type="text" class="form-control" name="meta_title" value="{{isset($record->meta_title) ? $record->meta_title : old('meta_title')}}">
                            </div>

                            <div class="col-md-4">
                                <label for="meta_keyword">Meta Keyword</label>
                                <textarea class="form-control" name="meta_keyword">{{isset($record->meta_keyword) ? $record->meta_keyword : old('mera_keyword')}}</textarea>
                            </div>

                            <div class="col-md-4">
                                <label for="meta_description">Meta Description</label>
                                <textarea class="form-control" name="meta_description">{{isset($record->meta_description) ? $record->meta_description : old('meta_description')}}</textarea>
                            </div> --}} 
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary submit">Submit</button>
                            <a href="{{ route('faq') }}" class="btn btn-danger">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
@section('javascript')
<script src="{{ url('public/plugins/parsley/parsley.js') }}"></script>
<script src="{{asset('public/plugins/ckeditor/ckeditor.js')}}"  type="text/javascript"></script>
<script>
    $(document).ready(function () {
        $('.select2').select2({ width: '100%' });

        CKEDITOR.replace('description', {
            height:300,
        });

        // $(".faq-form").validate({
        //     rules: {
        //         'name': {
        //             required: true,
        //         },
        //     },
        //     messages: {
        //         'name': {
        //             required: "Name is required",
        //         },
        //     },
        //     submitHandler: function(form) {
        //         $(form).find('.submit').prop("disabled", true);
        //         form.submit();
        //     }
        // });

        $('.colorpicker').colorpicker();
    });
</script>
@endsection