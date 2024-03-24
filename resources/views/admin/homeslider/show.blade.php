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
                        <h1 class="m-0">Home Slider</h1>
                    </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="col-sm-12  text-end">
                    <a href="{{ route('homeslider') }}" class="btn btn-primary mt-2 float-right">Add</a>
                </div>
                <div class="card-body">
            <section class="content">
                <div class="container-fluid">
                    <table class="table table-bordered slider_table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Sub Title</th>
                                <th>Color</th>
                                <th>Font Size</th>
                                <th>Font Family</th>
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
            ajax: "{{ route('homeslider.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: '', orderable: false, searchable: false},
                {data: 'image', name: 'image'},
                {data: 'title', name: 'title'},
                {data: 'subtitle', name: 'subtitle'},
                {data: 'color', name: 'color'},
                {data: 'font_size', name: 'font_size'},
                {data: 'font_family', name: 'font_family'},
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
            icon: "question"
        }).then((result) => {
            if (result.isConfirmed) {
                location.href = href;
            }
        });
    });
</script>
@endsection