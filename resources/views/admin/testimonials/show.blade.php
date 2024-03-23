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
                            <table class="table table-bordered table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Image</th>
                                        <th>Color</th>
                                        <th>Font Size</th>
                                        <th>Font Family</th>
                                        <th>Description</th>
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
            ajax: "{{ route('testimonials.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: '', orderable: false, searchable: false},
                {data: 'name', name: 'name'},
                {data: 'image', name: 'image'},
                {data: 'color', name: 'color'},
                {data: 'font_size', name: 'font_size'},
                {data: 'font_family', name: 'font_family'},
                {data: 'description', name: 'description'},
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
      
    @if($message = session('message'))
      swal("{{ $message }}");
    @endif
      
    @if(session()->has('message'))
      swal({
          title: "Testimonials",
          text: '{{ $message }}',
          icon: "success",
          buttons: true,
      })
  @endif
</script>
@endsection