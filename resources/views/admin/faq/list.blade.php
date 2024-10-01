@extends('admin.layout.header')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/sweetalert2/sweetalert2.css')}}">
    <link type="text/css" class="js-stylesheet" href="{{ url('public/plugins/parsley/parsley.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="content-wrapper">
    <div class="content">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-md-12">
                        @include('admin.alerts')
                    </div>
                    <div class="col-sm-6">
                        <h1 class="m-0">{{$site_title}}</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="col-md-12 text-left">
                <h5 class="title ml-3 mt-3">Faq Title</h5>
                <form action="{{ route('faq-title-update') }}" method="POST" class="faq-form" enctype="multipart/form-data" data-parsley-validate="">
                    @csrf
                    <div class="row">
                        <div class="col-md-3 mt-3 mb-3">
                            <label for="title" class="form-label">Title<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="title" name="title" value="{{isset($record->title) ? $record->title : old('title')}}" required>
                            @if ($errors->has('title')) <div class="text-danger">{{ $errors->first('title') }}</div>@endif
                            <div class="error"></div>
                        </div>

                        <div class="col-md-3 mt-3">
                            <label for="title_color" class="form-label">Title Color</label>
                            <input type="text" class="form-control colorpicker" id="title_color" name="title_color" value="{{isset($record->title_color) ? $record->title_color : old('title_color')}}">
                            @if ($errors->has('title_color')) <div class="text-danger">{{ $errors->first('title_color') }}</div>@endif
                            <div class="error"></div>
                        </div>

                        <div class="col-md-3 mt-3 select-menu">
                            <label for="title_font_size" class="form-label">Title Font Size</label>
                            <select class="form-control select2" name="title_font_size">
                                <option value="">-- Select --</option>
                                @for($i=24; $i<=50; $i+=2)
                                    <option value="{{$i}}px" @if(isset($record->title_font_size) && $record->title_font_size == $i.'px'){{'selected'}}@endif>{{$i}}px</option>
                                @endfor
                            </select>
                        </div>

                        @php($fontfamily = fontFamily())
                        <div class="col-md-3 mt-3 select-menu">
                            <label for="title_font_family" class="form-label">Title Font Family</label>
                            <select class="form-control select2" name="title_font_family">
                                <option value="">-- Select --</option>
                                @foreach($fontfamily as $family)
                                    <option value="{{$family['key']}}" @if(isset($record->title_font_family) && $record->title_font_family == $family['key']){{'selected'}}@endif>{{$family['value']}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
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
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary submit">Update</button>
                    </div>
                </form>
            </div>

            <div class="col-sm-12  text-end">
                <a href="{{ route('faq-create') }}" class="btn btn-primary float-right adm-table-addbtn">Add</a>
            </div>
            <div class="card-body">
                <section class="content">
                    <div class="container-fluid">
                        <table class="table table-bordered table-striped table adm-action-sticky">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Questions</th>
                                    <th>Answers</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
@endsection
@section('javascript')
<script src="{{asset('plugins/sweetalert2/sweetalert2.js')}}" type="text/javascript"></script>
<script src="{{ url('public/plugins/parsley/parsley.js') }}"></script>
<script type="text/javascript">
    $(function () {
        var table = $('.table').DataTable({
            processing: true,
            serverSide: true,
            // scrollX: true,
            ajax: "{{ route('faq-datatable') }}",
            columns: [
                {data: 'id', name: 'id',orderable: false, searchable: false},
                {data: 'name', name: 'name'},
                {data: 'description', name: 'description'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
    });

    $(document).on('click', '.delete', function() {
        var href = $(this).data('href');
        return new swal({
            title: "",
            text: "{{__('Are you sure? Delete this Faq!')}}",
            showCancelButton: true,
            confirmButtonText: "{{__('Yes, delete it!')}}",
            icon: "warning"
        }).then((result) => {
            if (result.isConfirmed) {
                location.href = href;
            }
        });
    });

    $(document).ready(function(){
        $('.adm-action-sticky').parent().css('max-width', '100%');
        $('.adm-action-sticky').parent().css('padding', '0px');
        $('table').parent().addClass('adm-table-responsive');
        $('.dataTables_length').parent().css('padding', '0px');
        $('.dataTables_filter').parent().css('padding', '0px');
        $('.dataTables_info').parent().css('padding-left', '0px');
        $('.paging_simple_numbers').parent().css('padding-right', '0px');
        $('.adm-table-responsive').parent().css('margin', '0px');
        $('.adm-table-responsive').parent().siblings().css('margin', '0px');

        $('.colorpicker').colorpicker();
    });
    
</script>
@endsection