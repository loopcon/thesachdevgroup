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
                            <h1 class="m-0">Car</h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="col-sm-12  text-end">
                    <a href="{{ route('car') }}" class="btn btn-primary mt-2 float-right">Add</a>
                </div>
                <div class="card-body">
            <section class="content">
                <div class="container-fluid">
                    <table class="table table-bordered table-striped data-table adm-table-no-wrap">
                        <thead>
                            <tr>
                                <th style="width:36px;">No</th>
                                <th>Brand</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Link</th>
                                <th>Name Color</th>
                                <th>Price Color</th>
                                <th>Name Font Size</th>
                                <th>Price Font Size</th>
                                <th>Name Font Family</th>
                                <th>Price Font Family</th>
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
            scrollX: true,
            ajax: "{{ route('car.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: '', orderable: false, searchable: false},
                {data: 'brand', name: 'brand'},
                {data: 'image', name: 'image'},
                {data: 'name', name: 'name'},
                {data: 'price', name: 'price'},
                {data: 'link', name: 'link'},
                {data: 'name_color', name: 'name_color'},
                {data: 'price_color', name: 'price_color'},
                {data: 'name_font_size', name: 'name_font_size'},
                {data: 'price_font_size', name: 'price_font_size'},
                {data: 'name_font_family', name: 'name_font_family'},
                {data: 'price_font_family', name: 'price_font_family'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
        
    });

    $(document).on('click', '.delete', function() {
        var href = $(this).data('href');
        return new swal({
            title: "",
            text: "{{__('Are you sure? Delete this Car!')}}",
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