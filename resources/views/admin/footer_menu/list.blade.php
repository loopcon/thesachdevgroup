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
                    <a href="{{ route('footerMenuCreate') }}" class="btn btn-primary mt-2 float-right">Add</a>
                </div>
                <div class="card-body">
            <section class="content">
                <div class="container-fluid">
                    <table class="table table-bordered table-striped data-table footer_menu">
                        <thead>
                            <tr>
                                <th style="width:65px;">No</th>
                                <th>Menu</th>
                                <th>Name</th>
                                <th>Link</th>
                                <th>Name Color</th>
                                <th>Name Font Size</th>
                                <th>Name Font Family</th>
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
            ajax: "{{ route('footer_menu.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: '', orderable: false, searchable: false},
                {data: 'menu_name', name: 'menu_name'},
                {data: 'name', name: 'name'},
                {data: 'link', name: 'link'},
                {data: 'color', name: 'color'},
                {data: 'font_size', name: 'font_size'},
                {data: 'font_family', name: 'font_family'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
        
    });
      
        
$(document).on('click', '.delete', function() {
    var href = $(this).data('href');
    return new swal({
        title: "",
        text: "{{__('Are you sure? Delete this Footer Menu!')}}",
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