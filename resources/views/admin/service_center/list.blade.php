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
                <a href="{{ route('service-center-create') }}" class="btn btn-primary mt-2 mr-4 float-right">Add</a>
            </div>
            <div class="card-body">
                <!-- <section class="content">
                    <div class="container-fluid"> -->
                        <table class="table table-bordered table-striped table">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Name Color</th>
                                    <th>Name Font Size</th>
                                    <th>Name Font Family</th>
                                    <th>Image</th>
                                    <th>Description Font Size</th>
                                    <th>Description Font Family</th>
                                    <th>Description Font Color</th>
                                    <th>Address</th>
                                    <th>Address Icon</th>
                                    <th>Address Font Size</th>
                                    <th>Address Font Family</th>
                                    <th>Address Font Color</th>
                                    <th>Working Hours</th>
                                    <th>Working Hours Icon</th>
                                    <th>Working Hours Font Size</th>
                                    <th>Working Hours Font Family</th>
                                    <th>Working Hours Font Color</th>
                                    <th>Contact Number</th>
                                    <th>Contact Icon</th>
                                    <th>Contact Font Size</th>
                                    <th>Contact Font Family</th>
                                    <th>Contact Font Color</th>
                                    <th>Email</th>
                                    <th>Email Icon</th>
                                    <th>Email Font Size</th>
                                    <th>Email Font Family</th>
                                    <th>Email Font Color</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    <!-- </div>
                </section> -->
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
            scrollX: true,
            ajax: "{{ route('service-center-datatable') }}",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'name_color', name: 'name_color'},
                {data: 'name_font_size', name: 'name_font_size'},
                {data: 'name_font_family', name: 'name_font_family'},
                {data: 'image', name: 'image'},
                {data: 'description_font_size', name: 'description_font_size'},
                {data: 'description_font_family', name: 'description_font_family'},
                {data: 'description_font_color', name: 'description_font_color'},
                {data: 'address', name: 'address'},
                {data: 'address_icon', name: 'address_icon'},
                {data: 'address_font_size', name: 'address_font_size'},
                {data: 'address_font_family', name: 'address_font_family'},
                {data: 'address_font_color', name: 'address_font_color'},
                {data: 'working_hours', name: 'working_hours'},
                {data: 'working_hours_icon', name: 'working_hours_icon'},
                {data: 'working_hours_font_size', name: 'working_hours_font_size'},
                {data: 'working_hours_font_family', name: 'working_hours_font_family'},
                {data: 'working_hours_font_color', name: 'working_hours_font_color'},
                {data: 'contact_number', name: 'contact_number'},
                {data: 'contact_icon', name: 'contact_icon'},
                {data: 'contact_font_size', name: 'contact_font_size'},
                {data: 'contact_font_family', name: 'contact_font_family'},
                {data: 'contact_font_color', name: 'contact_font_color'},
                {data: 'email', name: 'email'},
                {data: 'email_icon', name: 'email_icon'},
                {data: 'email_font_size', name: 'email_font_size'},
                {data: 'email_font_family', name: 'email_font_family'},
                {data: 'email_font_color', name: 'email_font_color'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
    });

    $(document).on('click', '.delete', function() {
        var href = $(this).data('href');
        return new swal({
            title: "",
            text: "{{__('Are you sure? Delete this Service Center!')}}",
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