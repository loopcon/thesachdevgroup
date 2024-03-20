@include('admin.master') 
    <div class="content-wrapper">
        <div class="content">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Brand</h1>
                    </div>
                    <div class="col-sm-6">
                        <a href="{{ route('brand') }}" class="btn btn-primary btn-sm float-right">Add</a>
                    </div>
                    </div>
                </div>
            </div>
            <section class="content">
                <div class="container-fluid">
                    <table class="table table-bordered data-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Image</th>
                                <th>Name</th>
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

<script type="text/javascript">
    $(function () {
        
        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('brand.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: '', orderable: false, searchable: false},
                {data: 'image', name: 'image'},
                {data: 'name', name: 'name'},
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
                    url: "brand_destroy/"+id,
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
          title: "Brand",
          text: '{{ $message }}',
          icon: "success",
          buttons: true,
      })
  @endif
</script>