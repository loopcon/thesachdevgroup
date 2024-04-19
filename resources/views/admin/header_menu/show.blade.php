@extends('admin.layout.header')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/sweetalert2/sweetalert2.css')}}">
@endsection
@section('content')

    <div class="content-wrapper">
        @php($has_permission = hasPermission('Header Menu'))
        @if(isset($has_permission) && $has_permission)
            @if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
                <div class="content">
                    <div class="content-header">
                        <div class="container-fluid">
                            <div class="row mb-2">
                                <div class="col-12">
                                    @include('admin.alerts')
                                </div>
                            <div class="col-sm-6">
                                <h5 class="m-0">Header Menu</h5>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="col-sm-12  text-end">
                            <a href="{{ route('header_menu') }}" class="btn btn-primary float-right adm-table-addbtn">Add</a>
                        </div>
                        <div class="card-body">
                            <section class="content">
                                <div class="container-fluid">
                                    {{-- <div class="adm-table-responsive"> --}}
                                        <table class="table table-bordered table-striped header_menu_data_table adm-header-menu adm-table-no-wrap adm-action-sticky">
                                            <thead>
                                                <tr>
                                                    <th style="width:45px;">No</th>
                                                    <th>Menu</th>
                                                    <th>Name</th>

                                                    <th>Name Color</th>
                                                    <th>Name Font Size</th>
                                                    <th>Name Font Family</th>

                                                    <th>Link</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    {{-- </div>     --}}
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            @endif
        @endif

        @php($has_permission = hasPermission('Header Menu Social Media Icon'))
        @if(isset($has_permission) && $has_permission)
            @if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
                <div class="content">
                    <div class="content-header">
                        <div class="container-fluid">
                            <div class="row mb-2">
                                <div class="col-sm-6">
                                    <h5 class="m-0">Header Menu Social Media Icon</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="col-sm-12  text-end">
                            <button type="button" class="btn btn-primary float-right adm-table-addbtn" data-toggle="modal" data-target="#SocialMediaIconInsertModal">
                                Add
                            </button>

                            <!-- Modal Insert Start-->
                            <div class="modal fade" id="SocialMediaIconInsertModal" tabindex="-1" role="dialog" aria-labelledby="SocialMediaIconInsertModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="SocialMediaIconInsertModalLabel">Header Menu Social Media Icon Create</h5>
                                            <button type="button" class="close Close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('header_menu_social_media_icon_insert') }}" method="POST" class="header_menu_social_media_icon_form" enctype="multipart/form-data">
                                            <div class="modal-body">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="icon" class="form-label">Icon<span class="text-danger">*</span></label>
                                                    <input type="file" id="icon" class="form-control icon" name="icon">
                                                    <div class="error"></div>
                                                    <small class="image_type">(Height:20px,Width:20px; Image Type : jpg,jpeg,png,svg,webp)</small>
                                                </div>

                                                <div class="form-group">
                                                    <label for="link" class="form-label">Link<span class="text-danger">*</span></label>
                                                    <input type="text" id="link" class="form-control link" name="link">
                                                    <div class="error"></div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary submit">Submit</button>
                                                <button type="button" class="btn btn-danger Close" data-dismiss="modal">Close</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal Insert End-->

                            <!-- Modal Edit Start-->
                            <div class="modal fade" id="SocialMediaIconEditModal" tabindex="-1" role="dialog" aria-labelledby="SocialMediaIconEditModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="SocialMediaIconEditModalLabel">Header Menu Social Media Icon Edit</h5>
                                            <button type="button" class="close Close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('social_media_icon_update') }}" method="POST" class="social_media_icon_edit_form" enctype="multipart/form-data">
                                            <div class="modal-body">
                                                @csrf

                                                <input type="hidden" class="id" name="id">

                                                <div class="form-group">
                                                    <label for="icon" class="form-label">Icon<span class="text-danger">*</span></label>
                                                    <img src="" width="100" class="image_icon" style="margin-bottom: 10px; margin-left: 5px;">
                                                    <input type="file" id="icon" class="form-control icon" name="icon">
                                                    <div class="error"></div>
                                                    <small class="image_type">(Height:20px,Width:20px; Image Type : jpg,jpeg,png,svg,webp)</small>
                                                </div>

                                                <div class="form-group">
                                                    <label for="link" class="form-label">Link<span class="text-danger">*</span></label>
                                                    <input type="text" id="link" class="form-control link" name="link">
                                                    <div class="error"></div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                                <button type="button" class="btn btn-danger Close" data-dismiss="modal">Close</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal Edit End-->

                        </div>
                        <div class="card-body">
                            <section class="content">
                                <div class="container-fluid">
                                    <table class="table table-bordered table-striped data-table adm-action-sticky adm-table-no-wrap">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Icon</th>
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
            @endif
        @endif

    </div>
@endsection
@section('javascript')
<script src="{{asset('plugins/sweetalert2/sweetalert2.js')}}" type="text/javascript"></script>
<script type="text/javascript">
    $(function () {
        
        var table = $('.header_menu_data_table').DataTable({
            processing: true,
            serverSide: true,
            scrollX: false,
            ajax: "{{ route('header_menu.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: '', orderable: false, searchable: false},
                {data: 'menu_name', name: 'menu_name'},
                {data: 'name', name: 'name'},
                
                {data: 'color', name: 'color'},
                {data: 'font_size', name: 'font_size'},
                {data: 'font_family', name: 'font_family'},

                {data: 'link', name: 'link'},
                
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
        
    });

    $(function () {
        
        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('header_menu_social_media_icon.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: '', orderable: false, searchable: false},
                {data: 'icon', name: 'icon'},
                {data: 'link', name: 'link'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
        
    });
      
        
$(document).on('click', '.delete', function() {
    var href = $(this).data('href');
    return new swal({
        title: "",
        text: "{{__('Are you sure? Delete this Header Menu!')}}",
        showCancelButton: true,
        confirmButtonText: "{{__('Yes, delete it!')}}",
        icon: "warning"
    }).then((result) => {
        if (result.isConfirmed) {
            location.href = href;
        }
    });
});

    $(document).ready(function () {
        $(".header_menu_social_media_icon_form").validate({
            rules: {
                'icon': {
                    required: true,
                    extension: "jpg,jpeg,png,webp,svg",
                },
                'link': {
                    required: true,
                    url: "url",
                },
            },
            messages: {
                'icon': {
                    required: "The icon field is required.",
                    extension: "Image must be jpg,jpeg,png,svg or webp.",
                },
                'link': {
                    required: "The link field is required.",
                    url: "Please enter a valid link.",
                },
            },
            errorPlacement: function(error, element) {
                error.appendTo(element.parent().find('.error'));
            },
            submitHandler: function(form) {
                $(form).find('.submit').prop("disabled", true);
                form.submit();
            }
        });
    });

    

    
    $(document).on('click', '.Close', function() {
        $('.error').empty();
        $('.icon').val("");
        $('.link').val("");
    });

    
    $(document).on('click', '.edit', function() {
        var id = $(this).data('id');
        $.ajax({
            url:"{{ route('header_menu_social_media_icon_edit') }}",
            type: "post",
            data: {
                "id": id,
                _token:"{{ csrf_token() }}",
            },
            success: function(data) {
                $.each(data, function (key, dat) {
                    $('.link').val(data.record.link);
                    if (data.record.icon) {
                        $('.image_icon').attr('src', "{{ url('public/header_menu_social_media_icon') }}" + '/' + data.record.icon);
                    }
                    $('.id').val(data.record.id);
                });
            },
           
        })
    });


    
    $(document).ready(function () {
        $(".social_media_icon_edit_form").validate({
            rules: {
                'icon': {
                    extension: "jpg,jpeg,png,webp,svg",
                },
                'link': {
                    required: true,
                    url: "url",
                },
            },
            messages: {
                'icon': {
                    extension: "Image must be jpg,jpeg,png,svg or webp.",
                },
                'link': {
                    required: "The link field is required.",
                    url: "Please enter a valid link.",
                },
            },
            errorPlacement: function(error, element) {
                error.appendTo(element.parent().find('.error'));
            },
        });
    });
    

$(document).on('click', '.header_menu_social_media_icon_delete', function() {
    var href = $(this).data('href');
    return new swal({
        title: "",
        text: "{{__('Are you sure? Delete this Header Menu Social Media Icon!')}}",
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