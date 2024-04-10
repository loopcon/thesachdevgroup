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
                        <h1 class="m-0">Home Slider</h1>
                    </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="col-sm-12  text-end">
                    <a href="{{ route('homeslider') }}" class="btn btn-primary float-right adm-table-addbtn">Add</a>
                </div>
                <div class="card-body">
                    <section class="content">
                        <div class="container-fluid">
                            <table class="table table-bordered table-striped slider_table adm-table-no-wrap adm-action-sticky">
                                <thead>
                                    <tr>
                                        <th style="width:45px;">No</th>
                                        <th>Image</th>
                                        <th>Title</th>

                                        <th>Title Color</th>
                                        <th>Title Font Size</th>
                                        <th>Title Font Family</th>

                                        <th>Sub Title</th>
                                      
                                        <th>Sub Title Color</th>
                                        <th>Sub Title Font Size</th>
                                        <th>Sub Title Font Family</th>

                                        <th>Text Position</th>
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
        var table = $('.slider_table').DataTable({
            processing: true,
            serverSide: true,
            // scrollX: true,
            ajax: "{{ route('homeslider.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: '', orderable: false, searchable: false},
                {data: 'image', name: 'image'},
                {data: 'title', name: 'title'},

                {data: 'title_color', name: 'title_color'},
                {data: 'title_font_size', name: 'title_font_size'},
                {data: 'title_font_family', name: 'title_font_family'},

                {data: 'subtitle', name: 'subtitle'},

                {data: 'sub_title_color', name: 'sub_title_color'},
                {data: 'sub_title_font_size', name: 'sub_title_font_size'},
                {data: 'sub_title_font_family', name: 'sub_title_font_family'},

                {data: 'text_position', name: 'text_position'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
    });

    $(document).on('click', '.delete', function() {
        var href = $(this).data('href');
        return new swal({
            title: "",
            text: "{{__('Are you sure? Delete this Home Slider!')}}",
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