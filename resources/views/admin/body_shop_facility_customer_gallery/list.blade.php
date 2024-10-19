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
                <a href="javascript:void(0)" class="btn btn-primary float-right ajax-form adm-table-addbtn">Add</a>
            </div>
            <div class="card-body">
                <section class="content">
                    <div class="container-fluid">
                        <table class="table table-bordered table-striped table adm-table-no-wrap adm-action-sticky">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Facility Image</th>
                                    <th>Customer Gallery Image</th>
                                    <th>Body Shop</th>
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
            ajax: "{{ route('body-shop-facility-customer-gallery-datatable') }}",
            columns: [
                {data: 'id', name: 'id', orderable: false, searchable: false},
                {data: 'facility_image', name: 'facility_image'},
                {data: 'customer_gallery_image', name: 'customer_gallery_image'},
                {data: 'body_shop_id', name: 'body_shop_id'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
    });

    $(document).on('click', '.delete', function() {
        var href = $(this).data('href');
        return new swal({
            title: "",
            text: "{{__('Are you sure? Delete this Body Shop Facility and Customer Gallery!')}}",
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
            url : '{{ route('body-shop-facility-customer-gallery-html') }}',
            method : 'post',
            data : {_token: CSRF_TOKEN, id:id},
            success : function(result){
                var result = $.parseJSON(result);
                $('#form-detail').html(result.html);
                $('#form_modal').modal('show');
                $('#body_shop_id').select2({width:'100%'});

                $('#form-detail form').validate({
                    rules: {
                        body_shop_id: {
                            required: true
                        },
                        facility_image: {
                            extension: "jpg|jpeg|png|webp"
                        },
                        customer_gallery_image: {
                            extension: "jpg|jpeg|png|webp"
                        }
                    },
                    messages: {
                        body_shop_id: {
                            required: "Please select a Body Shop"
                        },
                        facility_image: {
                            extension: "Please upload a valid image file (jpg, jpeg, png, webp)"
                        },
                        customer_gallery_image: {
                            extension: "Please upload a valid image file (jpg, jpeg, png, webp)"
                        }
                    },
                    submitHandler: function(form) {
                        $(form).find('.submit').prop("disabled", true);
                        form.submit();
                    }
                });
            }
        });
    }

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