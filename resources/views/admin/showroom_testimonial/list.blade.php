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
                <div class="col-sm-6">
                    <h1 class="m-0">{{$site_title}}</h1>
                </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="col-sm-12  text-end">
                <a href="{{ route('showroom-testimonial-create') }}" class="btn btn-primary mt-2 mr-4 float-right">Add</a>
            </div>
            <div class="card-body">
                <section class="content">
                    <div class="container-fluid">
                        <table class="table table-bordered table">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Image</th>
                                    <th>Description</th>
                                    <th>Showroom</th>
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
        var table = $('.table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('showroom-testimonial-datatable') }}",
            columns: [
                {data: 'id', name: '', orderable: false, searchable: false},
                {data: 'name', name: 'name'},
                {data: 'image', name: 'image'},
                {data: 'description', name: 'description'},
                {data: 'showroom', name: 'showroom'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
    });

    $(document).on('click', '.delete', function() {
        var href = $(this).data('href');
        return new swal({
            title: "",
            text: "{{__('Are you sure? Delete this Showroom Testimonial!')}}",
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