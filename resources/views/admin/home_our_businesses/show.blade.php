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
                    <h1 class="m-0">Home Our Businesses</h1>
                </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="col-sm-12  text-end">
                <a href="{{ route('home_our_businesses') }}" class="btn btn-primary mt-2 float-right adm-table-addbtn">Add</a>
            </div>
            <div class="card-body">
                <section class="content">
                    <div class="container-fluid">
                        <table class="table table-bordered table-striped data-table adm-table-no-wrap adm-action-sticky">
                            <thead>
                                <tr>
                                    <th style="width:45px;">No</th>
                                    <th>Image</th>
                                    <th>Businesses Title</th>

                                    <th>Businesses Title Color</th>
                                    <th>Businesses Title Font Size</th>
                                    <th>Businesses Title Font Family</th>
                                    
                                    <th>Link</th>
                                    <th>Background Color</th>
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
            // scrollX: true,
    
            ajax: "{{ route('home_our_businesses.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: '', orderable: false, searchable: false},
                {data: 'image', name: 'image'},

                {data: 'businesses_title', name: 'businesses_title'},

                {data: 'businesses_title_color', name: 'businesses_title_color'},
                {data: 'businesses_title_font_size', name: 'businesses_title_font_size'},
                {data: 'businesses_title_font_family', name: 'businesses_title_font_family'},

                {data: 'link', name: 'link'},

                {data: 'background_color', name: 'background_color'},

                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
        
    });
      
          
    $(document).on('click', '.delete', function() {
        var href = $(this).data('href');
        return new swal({
            title: "",
            text: "{{__('Are you sure? Delete this Home Our Businesses!')}}",
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