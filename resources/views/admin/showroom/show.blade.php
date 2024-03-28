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
                            <h1 class="m-0">Showroom</h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="col-sm-12  text-end">
                    <a href="{{ route('showroom') }}" class="btn btn-primary mt-2 float-right">Add</a>
                </div>
                <div class="card-body">
            <section class="content">
                <div class="container-fluid">
                    <table class="table table-bordered data-table">
                        <thead>
                            <tr>
                                <th style="width:65px;">No</th>
                                <th>Showroom Name</th>
                                <th>Brand</th>
                                <th>Car</th>
                                <th>Address</th>
                                <th>Working Hours</th>
                                <th>Contact Number</th>
                                <th>Email</th>
                                <th>Address Color</th>
                                <th>Address Font Size</th>
                                <th>Address Font Family</th>

                                <th>Working Hours Color</th>
                                <th>Working Hours Font Size</th>
                                <th>Working Hours Font Family</th>

                                <th>Contact Number Color</th>
                                <th>Contact Number Font Size</th>
                                <th>Contact Number Font Family</th>

                                <th>Email Color</th>
                                <th>Email Font Size</th>
                                <th>Email Font Family</th>

                                <th>Facilitie Image</th>
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
            scrollX: true,
            ajax: "{{ route('showroom.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: '', orderable: false, searchable: false},
                {data: 'name', name: 'name'},
                {data: 'brand', name: 'brand'},
                {data: 'car', name: 'car'},
                {data: 'address', name: 'address'},
                {data: 'working_hours', name: 'working_hours'},
                {data: 'contact_number', name: 'contact_number'},
                {data: 'email', name: 'email'},

                {data: 'address_color', name: 'address_color'},
                {data: 'address_font_size', name: 'address_font_size'},
                {data: 'address_font_family', name: 'address_font_family'},

                {data: 'working_hours_color', name: 'working_hours_color'},
                {data: 'working_hours_font_size', name: 'working_hours_font_size'},
                {data: 'working_hours_font_family', name: 'working_hours_font_family'},

                {data: 'contact_number_color', name: 'contact_number_color'},
                {data: 'contact_number_font_size', name: 'contact_number_font_size'},
                {data: 'contact_number_font_family', name: 'contact_number_font_family'},

                {data: 'email_color', name: 'email_color'},
                {data: 'email_font_size', name: 'email_font_size'},
                {data: 'email_font_family', name: 'email_font_family'},

                {data: 'facilitie_image', name: 'facilitie_image'},
                {data: 'customer_gallery_image', name: 'customer_gallery_image'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
        
    });
      

    $(document).on('click', '.delete', function() {
        var href = $(this).data('href');
        return new swal({
            title: "",
            text: "{{__('Are you sure? Delete this Showroom!')}}",
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