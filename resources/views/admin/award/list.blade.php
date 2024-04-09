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
                    <div class="col-md-12">
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
            <a href="javascript:void(0)" class="btn btn-primary mt-2 mr-4 float-right  ajax-form" data-toggle="modal" data-target="#modal-default">Add</a>
            </div>
            <div class="card-body">
                <section class="content">
                    <div class="container-fluid">
                        <table class="table table-bordered table-striped table adm-table-no-wrap">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Showroom</th>
                                    <th>Name</th>
                                    <th>Image</th>
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
<meta name="csrf-token" content="{{ csrf_token() }}" />
<div class="modal fade" id="form_modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" id="form-detail">

        </div>
    </div>
</div>
@endsection
@section('javascript')
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="{{asset('plugins/sweetalert2/sweetalert2.js')}}" type="text/javascript"></script>
<script type="text/javascript">
    $(function () {
        var table = $('.table').DataTable({
            processing: true,
            serverSide: true,
            // scrollX: true,
            ajax: "{{ route('award-datatable') }}",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'showroom_id', name: 'showroom_id'},
                {data: 'name', name: 'name'},
                {data: 'image', name: 'image'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            ajax : {
                url : "{{ route('award-datatable') }}",
                type : "POST",
                data : function(d) {
                    d._token = "{{ csrf_token() }}"
                }
            }
        });
    });

    $(document).on('click', '.delete', function() {
        var href = $(this).data('href');
        return new swal({
            title: "",
            text: "{{__('Are you sure? Delete this Award!')}}",
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

    $(document).on('click', '.ajax-form', function(){
        var id = $(this).data('id');
        ajaxForm(id);
    });

    function ajaxForm(id = ''){
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url : '{{ route('ajax-award-html') }}',
            method : 'post',
            data : {_token: CSRF_TOKEN, id:id},
            success : function(result){
                var result = $.parseJSON(result);
                $('#form-detail').html(result.html);
                $('#form_modal').modal('show');
                $('#showroom_id').select2({width:'100%'});

            $(".award-form").validate({
                rules: {
                    'brand_id': {
                        required: true,
                    },
                    'image': {
                        extension: "jpg,jpeg,png,webp",
                    },
                },
                messages: {
                    'brand_id': {
                        required: "Brand is required",
                    },
                    'image': {
                        extension: "Image must be jpg,jpeg,png or webp",
                    },
                },
                submitHandler: function(form) {
                    $(form).find('.submit').prop("disabled", true);
                    form.submit();
                }
            });
            }
        });
    }
</script>
@endsection