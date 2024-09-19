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
    .paginate{
        margin-top: 15px;
    }
</style>
@endsection
@section('content') 
    <div class="content-wrapper">
        <div class="content">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-12">
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
                    <a href="{{ route('payment-export') }}" class="btn btn-success float-right adm-table-addbtn">Export</a>
                </div>**/ ?>
                {{-- <div class="col-md-12 text-end">
                    <a href="{{ route('user-create') }}" class="btn btn-primary float-right adm-table-addbtn">Add</a>
                </div> --}}
                <div class="card-body">
                    <section class="content">
                        <div class="container-fluid">
                            <div class="row mb-4">
                                <div class="mt-3 col-md-4 select-menu">
                                    <label for="business_id" class="form-label">Business</label>
                                    <select class="form-control select2" name="business_id" id="business_id">
                                        <option value="">-- Select --</option>
                                        @if(isset($businesses) && $businesses->count())
                                            @foreach($businesses as $value)
                                                <option value="{{$value->title}}">{{$value->title}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
            
                                <div class="mt-3 col-md-4 select-menu">
                                    <label for="service" class="form-label">Services</label>
                                    <select class="form-control select2" name="service" id="service">
                                        <option value="">-- Select --</option>
                                        {{-- @if(isset($services) && $services->count())
                                            @foreach($services as $service)
                                                <option value="{{$service->name}}">{{$service->name}}</option>
                                            @endforeach
                                        @endif --}}
                                    </select>
                                </div>
                                
                                <div class="mt-3 col-md-4 select-menu">
                                    <label for="location" class="form-label">Location</label>
                                    <select class="form-control select2" name="location" id="location">
                                        <option value="">-- Select --</option>
                                        {{-- @if(isset($locations) && $locations->count())
                                            @foreach($locations as $location)
                                                <option value="{{$location->id}}">{{$location->nikname}}</option>
                                            @endforeach
                                        @endif --}}
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="from_date">From Date</label>
                                    <input type="date" class="form-control" name="from_date" value="" id="from_date">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="to_date">To Date</label>
                                    <input type="date" class="form-control" name="to_date" value="" id="to_date">
                                </div>
                            </div>
        
                            <table class="table table-bordered table-striped table adm-table-no-wrap"> {{-- adm-action-sticky --}}
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Payment To</th>
                                        <th>Payment Towards</th>
                                        <th>Location</th>
                                        <th>Name</th>
                                        <th>Mobile No</th>
                                        <th>Email</th>
                                        <th>Registeration No</th>
                                        <th>Address</th>
                                        <th>Paid Amount</th>
                                        <th>Transaction Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection
@section('javascript')
<script src="{{asset('plugins/sweetalert2/sweetalert2.js')}}" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function() {
        var userTable = $('.table').DataTable({
            dom: "<'row'<'col-sm-6'><'col-sm-6 export-btn'B><'col-sm-3'l><'col-sm-3 search'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-7'i><'col-sm-5 paginate'p>>",
            buttons: [
                {
                    extend: 'excel',
                    text: 'Export',
                    title:'Payment',
                    rows: '"visible',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10], // 11 field export
                        modifier: {
                            page: 'all' // Export all rows, not just the visible ones
                        }
                    },
                    // className: 'btn-success mb-3'
                }
            ],
            processing: true,
            // serverSide: true,
            columns: [
                { data: 'id', name: 'id',orderable: false, searchable: false },
                { data: 'payment_to', name: 'payment_to' },
                { data: 'payment_towards', name: 'payment_towards' },
                { data: 'loc_id', name: 'loc_id' },
                { data: 'name', name: 'name' },
                { data: 'mobile_no', name: 'mobile_no' },
                { data: 'emailid', name: 'emailid' },
                { data: 'registeration_no', name: 'registeration_no' },
                { data: 'near_location', name: 'near_location' },
                { data: 'paid_amount', name: 'paid_amount' },
                { data: 'transaction_time', name: 'transaction_time' }
            ],
            "ajax" : {
                url : "{{ route('payment-datatable') }}",
                type : "POST",
                data : function(d) {
                    d._token = "{{ csrf_token() }}",
                    d.business_id = $('#business_id').val(),
                    d.service = $('#service').val(),
                    d.from_date = $('#from_date').val(),
                    d.to_date = $('#to_date').val(),
                    d.location = $('#location').val()
                }
            }
        });

        $(document).on('change', '#business_id',function(){
            var business_id = $(this).val();
            if (business_id) {
                $.ajax({
                    url: '{{route("get-service-data")}}',
                    type: 'GET',
                    data: { business_id: business_id },
                    success: function(data) {
                        $('#service').empty().append('<option value="">-- Select --</option>');
                        $('#location').empty().append('<option value="">-- Select --</option>');
                        
                        $.each(data.services, function(index, value) {
                            $('#service').append('<option value="'+ value.name +'">'+ value.name +'</option>');
                        });

                        // $.each(data.locations, function(index, value) {
                        //     $('#location').append('<option value="'+ value.id +'">'+ value.nikname +'</option>');
                        // });
                    }
                });
            } else {
                $('#service').empty().append('<option value="">-- Select --</option>');
                $('#location').empty().append('<option value="">-- Select --</option>');
            }

            userTable.ajax.reload();
        });

        $(document).on('change', '#service',function(){
            var business_id = $('#business_id').val();
            var service = $(this).val();
            if (business_id) {
                $.ajax({
                    url: '{{route("get-location-data")}}',
                    type: 'GET',
                    data: {
                        business_id: business_id,
                        service: service
                    },
                    success: function(data) {
                        // $('#service').empty().append('<option value="">-- Select --</option>');
                        $('#location').empty().append('<option value="">-- Select --</option>');
                        
                        // $.each(data.services, function(index, value) {
                        //     $('#service').append('<option value="'+ value.name +'">'+ value.name +'</option>');
                        // });

                        $.each(data.locations, function(index, value) {
                            $('#location').append('<option value="'+ value.id +'">'+ value.nikname +'</option>');
                        });
                    }
                });
            } else {
                // $('#service').empty().append('<option value="">-- Select --</option>');
                $('#location').empty().append('<option value="">-- Select --</option>');
            }

            userTable.ajax.reload();
        });

        $(document).on('change', '#location',function(){
            userTable.ajax.reload();
        });
        
        $(document).on('change', '#from_date',function(){
            userTable.ajax.reload();
        });
        
        $(document).on('change', '#to_date',function(){
            userTable.ajax.reload();
        });
    });


    // $(document).on('change', '#showroom_id',function(){
    //     userTable.ajax.reload();
    // });

    // $(document).on('change', '#service_center_id',function(){
    //     userTable.ajax.reload();
    // });

    // $(document).on('change', '#body_shop_id',function(){
    //     userTable.ajax.reload();
    // });

    // $(document).on('change', '#used_car_id',function(){
    //     userTable.ajax.reload();
    // });


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