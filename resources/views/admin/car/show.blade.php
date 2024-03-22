@extends('admin.layout.header')
@section('content')
<div class="content-wrapper">
    <div class="content">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Car</h1>
                </div>
                <div class="col-sm-6">
                    <a href="{{ route('car') }}" class="btn btn-primary btn-sm float-right">Add</a>
                </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <section class="content">
                    <div class="container-fluid">
                        <table class="table table-bordered data-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Brand</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Link</th>
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
<script type="text/javascript">
    $(function () {
        
        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('car.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: '', orderable: false, searchable: false},
                {data: 'brand', name: 'brand'},
                {data: 'image', name: 'image'},
                {data: 'name', name: 'name'},
                {data: 'price', name: 'price'},
                {data: 'link', name: 'link'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
        
    });
      
          
    $(document).on('click', '#smallButton', function(event) {
        var form =  $(this).closest("form");
        var name = $(this).data("name");
        event.preventDefault();
        swal({
            title: `Are you sure you want to delete this record?`,
            text: "If you delete this, it will be gone forever.",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                var id = $(this).data('id');
                $.ajax({
                    url: "car_destroy/"+id,
                    type: 'DELETE',
                    data: {
                        "id": id,
                        _token:"{{ csrf_token() }}",
                    },
                    success: function(data) {
                        $('.data-table').DataTable().ajax.reload();
                    },
                    error: function(data) {
                        console.log("No! You are wrong!");
                    }
                })
            }
        });
    });
      
    @if($message = session('message'))
      swal("{{ $message }}");
    @endif
      
    @if(session()->has('message'))
      swal({
          title: "Car",
          text: '{{ $message }}',
          icon: "success",
          buttons: true,
      })
  @endif
</script>
@endsection