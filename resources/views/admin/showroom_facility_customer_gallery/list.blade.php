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
                <div class="col-sm-12  text-end">
                    <a href="{{ route('showroomFacilityCustomerGalleryCreate') }}" class="btn btn-primary mt-2 float-right">Add</a>
                </div>
                <div class="card-body">
                    <section class="content">
                        <div class="container-fluid">
                            <table class="table table-bordered table-striped data-table adm-table-no-wrap adm-action-sticky">
                                <thead>
                                    <tr>
                                        <th style="width:45px;">No</th>
                                        <th>Showroom</th>
                                        <th>Facility Image</th>
                                        <th>Customer Gallery Image</th>
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
    @endsection
    @section('javascript')
    <script src="{{asset('plugins/sweetalert2/sweetalert2.js')}}" type="text/javascript"></script>
    <script type="text/javascript">
    $(function () {
        
        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('showroom_facility_customer_gallery.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: '', orderable: false, searchable: false},
                {data: 'showroom', name: 'showroom'},
                {data: 'facility_image', name: 'facility_image'},
                {data: 'customer_gallery_image', name: 'customer_gallery_image'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
        
    });
      
        
$(document).on('click', '.delete', function() {
    var href = $(this).data('href');
    return new swal({
        title: "",
        text: "{{__('Are you sure? Delete this Mission Vision!')}}",
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