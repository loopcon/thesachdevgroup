@extends('admin.layout.header')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/sweetalert2/sweetalert2.css')}}">
<style>
    .dt-buttons{
        float:right;
    }
    .search{
        margin-left: 514px;
    }
    .export-btn{
        margin-bottom: 14px;
    }
    /*.paginate{*/
    /*    margin-top: 15px;*/
    /*}*/
</style>
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
            <?php /**<div class="col-sm-12  text-end">
                <a href="{{ route('career-form-export') }}" class="btn btn-success float-right adm-table-addbtn">Export</a>
            </div>**/ ?>
            <div class="card-body">
                <section class="content">
                    <div class="container-fluid">
                        <div class="row mb-4">
                            <div class="form-group col-md-4">
                                <label for="from_date">From Date</label>
                                <input type="date" class="form-control" name="from_date" value="" id="from_date">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="to_date">To Date</label>
                                <input type="date" class="form-control" name="to_date" value="" id="to_date">
                            </div>
                        </div>
                        <table class="table table-bordered table-striped adm-table-no-wrap adm-action-sticky">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Business</th>
                                    <th>Showroom</th>
                                    <th>Service Center</th>
                                    <th>Body Shop</th>
                                    <th>Used Car</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Contact No</th>
                                    <th>Email</th>
                                    <th>Post Applying For</th>
                                    <th>Created At</th>
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
        // dom: 'Blfrtip',
        dom: "<'row'<'col-sm-6'><'col-sm-6 export-btn'B><'col-sm-3'l><'col-sm-3 search'f>>" +
         "<'row'<'col-sm-12'tr>>" +
         "<'row'<'col-sm-7'i><'col-sm-5 paginate'p>>",
         buttons: [
            {
                extend: 'excel',
                text: 'Export',
                title:'career form',
                rows: '"visible',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10,11], // 11 field export
                    modifier: {
                            page: 'all' // Export all rows, not just the visible ones
                        }
                },
                // className: 'btn-success mb-3'
            }
        ],

        processing: true,
        // serverSide: true,
        // scrollX: true,
        columns: [
            {data: 'id', name: 'id',orderable: false, searchable: false},
            {data: 'business_id', name: 'business_id'},
            {data: 'showroom_id', name: 'showroom_id'},
            {data: 'service_center_id', name: 'service_center_id'},
            {data: 'body_shop_id', name: 'body_shop_id'},
            {data: 'used_car_id', name: 'used_car_id'},
            {data: 'first_name', name: 'first_name'},
            {data: 'last_name', name: 'last_name'},
            {data: 'contact_no', name: 'contact_no'},
            {data: 'email', name: 'email'},
            {data: 'post_apply_for', name: 'post_apply_for'},
            {data: 'created_at', name: 'created_at'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ],
        ajax : {
            url : "{{ route('career-form-datatable') }}",
            type : "POST",
            data : function(d) {
                d._token = "{{ csrf_token() }}",
                d.from_date = $('#from_date').val(),
                d.to_date = $('#to_date').val()
            }
        }
    });
        
    $(document).on('change','#from_date',function(){
        table.ajax.reload();
    });
        
    $(document).on('change','#to_date',function(){
        table.ajax.reload();
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