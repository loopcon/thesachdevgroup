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
                <a href="{{ route('showroom-testimonial-create') }}" class="btn btn-primary mt-2 mr-4 float-right">Add</a>
            </div>
            <div class="card-body">
                <section class="content">
                    <div class="container-fluid">
                        <table class="table table-bordered table-striped table adm-table-no-wrap adm-action-sticky">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Image</th>
                                    <th>Name Text Size</th>
                                    <th>Name Text Color</th>
                                    <th>Name Font Family</th>
                                    <th>Name Background Color</th>
                                    <th>Description Text Size</th>
                                    <th>Description Text Color</th>
                                    <th>Description Font Family</th>
                                    <th>Showroom</th>
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
            scrollX: true,
            ajax: "{{ route('showroom-testimonial-datatable') }}",
            columns: [
                {data: 'id', name: '', orderable: false, searchable: false},
                {data: 'name', name: 'name'},
                {data: 'image', name: 'image'},
                {data: 'name_text_size', name: 'name_text_size'},
                {data: 'name_text_color', name: 'name_text_color'},
                {data: 'name_font_family', name: 'name_font_family'},
                {data: 'name_background_color', name: 'name_background_color'},
                {data: 'description_text_size', name: 'description_text_size'},
                {data: 'description_text_color', name: 'description_text_color'},
                {data: 'description_font_family', name: 'description_font_family'},
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

    $(document).ready(function(){
        $('.dataTables_scrollBody').addClass('adm-table-responsive');
    });
</script>
@endsection