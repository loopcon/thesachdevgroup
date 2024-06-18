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
                <div class="row m-0">
                    <div class="mt-3 col-md-3 select-menu">
                        <label for="business_id" class="form-label">Our Business<span class="text-danger">*</span></label>
                        <select class="form-control select2" name="business_id" id="business_id">
                            <option value="">-- Select --</option>
                            @if(isset($our_business) && $our_business->count())
                                @foreach($our_business as $value)
                                    <option value="{{$value->id}}">{{$value->title}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <div class="mt-3 col-md-3 select-menu">
                        <label for="showroom_id" class="form-label">Showroom<span class="text-danger">*</span></label>
                        <select class="form-control select2" name="showroom_id" id="showroom_id">
                            <option value="">-- Select --</option>
                            @if(isset($showroom) && $showroom->count())
                                @foreach($showroom as $value)
                                    <option value="{{$value->id}}">{{$value->name}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <div class="mt-3 col-md-3 select-menu">
                        <label for="service_center_id" class="form-label">Service Center<span class="text-danger">*</span></label>
                        <select class="form-control select2" name="service_center_id" id="service_center_id">
                            <option value ="">-- Select --</option>
                            @if(isset($service_center) && $service_center->count())
                                @foreach($service_center as $value)
                                    <option value="{{$value->id}}">{{$value->name}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <div class="mt-3 col-md-3 select-menu">
                        <label for="body_shop_id" class="form-label">Bosy Shop<span class="text-danger">*</span></label>
                        <select class="form-control select2" name="body_shop_id" id="body_shop_id">
                            <option value="">-- Select --</option>
                            @if(isset($body_shop) && $body_shop->count())
                                @foreach($body_shop as $value)
                                    <option value="{{$value->id}}">{{$value->name}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <div class="mt-3 col-md-3 select-menu">
                        <label for="used_car_id" class="form-label">Used Car<span class="text-danger">*</span></label>
                        <select class="form-control select2" name="used_car_id" id="used_car_id">
                            <option value="">-- Select --</option>
                            @if(isset($used_car) && $used_car->count())
                                @foreach($used_car as $value)
                                    <option value="{{$value->id}}">{{$value->name}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <div class="col-md-12 text-end">
                    <a href="{{ route('user-create') }}" class="btn btn-primary float-right adm-table-addbtn">Add</a>
                </div>
                <div class="card-body">
                    <section class="content">
                        <div class="container-fluid">
                            <table class="table table-bordered table-striped table adm-table-no-wrap adm-action-sticky">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Our Business</th>
                                        <th>Showroom</th>
                                        <th>Service Center</th>
                                        <th>Body Shop</th>
                                        <th>Used Car</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Action</th>
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
    // $(function () {
        var userTable = $('.table').DataTable({
            processing: true,
            serverSide: true,
            columns: [
                {data: 'id', name: 'id',orderable: false, searchable: false},
                {data: 'business_id', name: 'business_id'},
                {data: 'showroom_id', name: 'showroom_id'},
                {data: 'service_center_id', name: 'service_center_id'},
                {data: 'body_shop_id', name: 'body_shop_id'},
                {data: 'used_car_id', name: 'used_car_id'},
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            "ajax" : {
                    url : "{{ route('user-datatable') }}",
                    type : "POST",
                    data : function(d) {
                        d._token = "{{ csrf_token() }}",
                        d.business_id = $('#business_id').val(),
                        d.showroom_id = $('#showroom_id').val(),
                        d.service_center_id = $('#service_center_id').val(),
                        d.body_shop_id = $('#body_shop_id').val()
                        d.used_car_id = $('#used_car_id').val()
                    }
                }
        });
    // });

    $(document).on('change', '#business_id',function(){
        userTable.ajax.reload();
    });

    $(document).on('change', '#showroom_id',function(){
        userTable.ajax.reload();
    });

    $(document).on('change', '#service_center_id',function(){
        userTable.ajax.reload();
    });

    $(document).on('change', '#body_shop_id',function(){
        userTable.ajax.reload();
    });

    $(document).on('change', '#used_car_id',function(){
        userTable.ajax.reload();
    });

    $(document).on('click', '.delete', function() {
        var href = $(this).data('href');
        return new swal({
            title: "",
            text: "{{__('Are you sure? Delete this User!')}}",
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