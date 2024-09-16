@extends('admin.layout.header')
@section('css')
    <link class="js-stylesheet" href="{{ url('public/plugins/parsley/parsley.css') }}" rel="stylesheet">
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
            <div class="row">
                <div class="col-12 col-md-3 col-xl-3">
                    <div class="card">
                        <div class="card-header">
                        </div>
                        <div class="list-group list-group-flush" role="tablist">
                            @if($email_templates)
                                @foreach($email_templates as $key => $value)
                                    <a href="#tab-{{$value->label}}" class="list-group-item list-group-item-action {{ $key == 0 ? 'active' : ''}}" data-toggle="tab" role="tab">{{$value->value}}</a>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-9 col-xl-9">
                    <div class="tab-content">
                        @if($email_templates)
                            @foreach($email_templates as $key => $value)
                                <div class="tab-pane fade {{ $key == 0 ? 'active show' : ''}}" id="tab-{{$value->label}}" role="tabpanel">
                                    <div class="card">
                                        <form role="form" action="{{route('email-template-update')}}" name="{{$value->label}}" method="post" data-parsley-validate enctype="multipart/form-data">
                                            @csrf
                                            <div class="card-body">
                                                <div class="mb-3">
                                                    <h2 class="col-form-label">{{$value->value}}</h2>
                                                    <textarea class="ckeditor form-control" name="{{$value->label}}" id="{{$value->label}}" required="" style="height: 1000px">{{$value->template}}</textarea>
                                                    <input type="hidden" name="id" value="{{$value->label}}">
                                                </div>
                                            </div>
                                            <div class="card-footer text-end">
                                                <button type="submit" class="btn btn-primary">{{__('Update')}}</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
@section('javascript')
<script src="{{ url('public/plugins/parsley/parsley.js') }}"></script>
<script src="{{asset('public/plugins/ckeditor/ckeditor.js')}}"  type="text/javascript"></script>
 CKEDITOR.replace('ckeditor', {
            height:300,
        });
@endsection