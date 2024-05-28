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
                <a href="{{ route('career-form-export') }}" class="btn btn-success float-right adm-table-addbtn">Export</a>
            </div>
            <div class="card-body">
                <section class="content">
                    <div class="container-fluid">
                        <table class="table table-bordered table-striped adm-table-no-wrap adm-action-sticky">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Business</th>
                                    <th>Showroom</th>
                                    <th>Service Center</th>
                                    <th>Body Shop</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Contact No</th>
                                    <th>Email</th>
                                    <th>Post Applying For</th>
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
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection
@section('javascript')
<script src="{{asset('plugins/sweetalert2/sweetalert2.js')}}" type="text/javascript"></script>
<script type="text/javascript">
    var table = $('.table').DataTable({
        processing: true,
        serverSide: true,
        // scrollX: true,
        columns: [
            {data: 'id', name: 'id',orderable: false, searchable: false},
            {data: 'business_id', name: 'business_id'},
            {data: 'showroom_id', name: 'showroom_id'},
            {data: 'service_center_id', name: 'service_center_id'},
            {data: 'body_shop_id', name: 'body_shop_id'},
            {data: 'first_name', name: 'first_name'},
            {data: 'last_name', name: 'last_name'},
            {data: 'contact_no', name: 'contact_no'},
            {data: 'email', name: 'email'},
            {data: 'post_apply_for', name: 'post_apply_for'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ],
        ajax : {
            url : "{{ route('career-form-datatable') }}",
            type : "POST",
            data : function(d) {
                d._token = "{{ csrf_token() }}"
            }
        }
    });

    $(document).on('click', '.delete', function() {
        var href = $(this).data('href');
        return new swal({
            title: "",
            text: "{{__('Are you sure? Delete this Career Form!')}}",
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
    });
</script>
@endsection