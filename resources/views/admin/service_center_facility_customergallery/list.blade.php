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
                <a href="{{ route('service-center-facility-customergallery-create') }}" class="btn btn-primary mt-2 mr-4 float-right">Add</a>
            </div>
            <div class="card-body">
                <section class="content">
                    <div class="container-fluid">
                        <table class="table table-bordered table-striped table adm-table-no-wrap adm-action-sticky">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Facility Image</th>
                                    <th>Customer Gallery Image</th>
                                    <th>Service Center</th>
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
            ajax: "{{ route('service-center-facility-customergallery-datatable') }}",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'facility_image', name: 'facility_image'},
                {data: 'customer_gallery_image', name: 'customer_gallery_image'},
                {data: 'service_center_id', name: 'service_center_id'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
    });

    $(document).on('click', '.delete', function() {
        var href = $(this).data('href');
        return new swal({
            title: "",
            text: "{{__('Are you sure? Delete this Service Center Facility and Customer Gallery!')}}",
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
        $('.dataTables_scrollBody').addClass('adm-table-responsive');
    });
</script>
@endsection