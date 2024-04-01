@extends('admin.layout.header')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/sweetalert2/sweetalert2.css')}}">
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
            <div class="col-sm-12  text-end">
                <a href="{{ route('service-create') }}" class="btn btn-primary mt-2 mr-4 float-right">Add</a>
            </div>
            <div class="card-body">
                <section class="content">
                    <div class="container-fluid">
                        <table class="table table-bordered table-striped table">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Name Color</th>
                                    <th>Name Font Size</th>
                                    <th>Name Font Family</th>
                                    <th>Icon</th>
                                    <th>Url</th>
                                    <!-- <th>Service Center</th> -->
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
<script type="text/javascript">
    $(function () {
        var table = $('.table').DataTable({
            processing: true,
            serverSide: true,
            // scrollX: true,
            ajax: "{{ route('service-datatable') }}",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'name_font_color', name: 'name_font_color'},
                {data: 'name_font_size', name: 'name_font_size'},
                {data: 'name_font_family', name: 'name_font_family'},
                {data: 'icon', name: 'icon'},
                {data: 'url', name: 'url'},
                // {data: 'service_center_id', name: 'service_center_id'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
    });

    $(document).on('click', '.delete', function() {
        var href = $(this).data('href');
        return new swal({
            title: "",
            text: "{{__('Are you sure? Delete this Service!')}}",
            showCancelButton: true,
            confirmButtonText: "{{__('Yes, delete it!')}}",
            icon: "warning"
        }).then((result) => {
            if (result.isConfirmed) {
                location.href = href;
            }
        });
    });
</script>
@endsection