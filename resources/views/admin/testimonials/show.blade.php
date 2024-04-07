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
                            <h1 class="m-0">Testimonials</h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="col-md-12 text-end">
                    <a href="{{ route('testimonials') }}" class="btn btn-primary mt-2 mr-4 float-right">Add</a>
                </div>
                <div class="card-body">
                    <section class="content">
                        <div class="container-fluid">
                            <table class="table table-bordered table-striped table adm-table-no-wrap adm-action-sticky">
                                <thead>
                                    <tr>
                                        <th style="width:45px;">No</th>
                                        <th>Testimonials Title</th>

                                        <th>Testimonials Title Color</th>
                                        <th>Testimonials Title Font Size</th>
                                        <th>Testimonials Title Font Family</th>

                                        <th>Image</th>

                                        <th>Name</th>

                                        <th>Name Color</th>
                                        <th>Name Font Size</th>
                                        <th>Name Font Family</th>

                                        <th>Name Background Color</th>

                                        <th>Description</th>

                                        <th>Description Color</th>
                                        <th>Description Font Size</th>
                                        <th>Description Font Family</th>
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
@endsection
@section('javascript')
<script src="{{asset('plugins/sweetalert2/sweetalert2.js')}}" type="text/javascript"></script>
<script type="text/javascript">
    $(function () {
        var testimonialTable = $('.table').DataTable({
            processing: true,
            serverSide: true,
            scrollX: true,
            ajax: "{{ route('testimonials.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: '', orderable: false, searchable: false},

                {data: 'testimonials_title', name: 'testimonials_title'},

                {data: 'testimonials_title_color', name: 'testimonials_title_color'},
                {data: 'testimonials_title_font_size', name: 'testimonials_title_font_size'},
                {data: 'testimonials_title_font_family', name: 'testimonials_title_font_family'},

                {data: 'image', name: 'image'},

                {data: 'name', name: 'name'},

                {data: 'name_color', name: 'name_color'},
                {data: 'name_font_size', name: 'name_font_size'},
                {data: 'name_font_family', name: 'name_font_family'},

                {data: 'name_background_color', name: 'name_background_color'},

                {data: 'description', name: 'description'},

                {data: 'description_color', name: 'description_color'},
                {data: 'description_font_size', name: 'description_font_size'},
                {data: 'description_font_family', name: 'description_font_family'},
                
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
    });

    $(document).on('click', '.delete', function() {
        var href = $(this).data('href');
        return new swal({
            title: "",
            text: "{{__('Are you sure? Delete this Testimonial!')}}",
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