@extends('admin.layout.header')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/sweetalert2/sweetalert2.css')}}">
@endsection
@section('content')
    <div class="content-wrapper">

        @php($has_permission = hasPermission('Showroom'))
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
                            <h5 class="m-0">Showroom</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="col-sm-12  text-end">
                    <a href="{{ route('showroom') }}" class="btn btn-primary float-right adm-table-addbtn">Add</a>
                </div>
                <div class="card-body">
                    <section class="content">
                        <div class="container-fluid">
                                <table class="table table-bordered table-striped data-table adm-table-no-wrap adm-action-sticky">
                                    <thead>
                                        <tr>
                                            <th style="width:50px;">No</th>
                                            <th>Our Business</th>

                                            <th>Showroom Name</th>
                                            <th>Showroom Name Color</th> 
                                            <th>Showroom Name Font Size</th>
                                            <th>Showroom Name Font Family</th>
                                            <th>Brand</th>
                                            <th>Car</th>
                                            <th>Address</th>
                                            <th>Address Color</th>
                                            <th>Address Font Size</th>
                                            <th>Address Font Family</th>
                                            <th>Address Icon</th>
                                            <th>Working Hours</th>
                                            <th>Working Hours Color</th>
                                            <th>Working Hours Font Size</th>
                                            <th>Working Hours Font Family</th>
                                            <th>Working Hours Icon</th>
                                            <th>Contact Number</th>
                                            <th>Contact Number Color</th>
                                            <th>Contact Number Font Size</th>
                                            <th>Contact Number Font Family</th>
                                            <th>Contact Number Icon</th>
                                            <th>Email</th>
                                            <th>Email Color</th>
                                            <th>Email Font Size</th>
                                            <th>Email Font Family</th>
                                            <th>Email Icon</th>
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
      @endif
    @endif

        @php($has_permission = hasPermission('Showroom Facility Customer Gallery'))
        @if(isset($has_permission) && $has_permission)
            @if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
                <div class="content">
                    <div class="content-header">
                        <div class="container-fluid">
                            <div class="row mb-2">
                                <div class="col-sm-6">
                                    <h5 class="m-0">Showroom Facility Customer Gallery</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="col-sm-12  text-end">
                            <button type="button" class="btn btn-primary float-right adm-table-addbtn" data-toggle="modal" data-target="#FacilityCustomerGalleryInsertModal">
                                Add
                            </button>

                            <!-- Modal Insert Start-->
                            <div class="modal fade" id="FacilityCustomerGalleryInsertModal" tabindex="-1" role="dialog" aria-labelledby="FacilityCustomerGalleryInsertModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="FacilityCustomerGalleryInsertModalLabel">Showroom Facility Customer Gallery Create</h5>
                                            <button type="button" class="close Close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('showroom_facility_customer_gallery_insert') }}" method="POST" class="facility_customer_gallery_form" enctype="multipart/form-data">
                                            <div class="modal-body">
                                                @csrf

                                                <div class="form-group">
                                                    <label for="showroom_id" class="form-label">Showroom<span class="text-danger">*</span></label>
                                                    <select class="form-control showroom_id select2" name="showroom_id" id="showroom_id">
                                                        <option selected="selected" disabled="disabled" value="">Select</option>
                                                        @foreach($showrooms as $showroom)
                                                            <option value="{{$showroom->id}}">{{$showroom->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    <div id="errordiv"></div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="facility_image" class="form-label">Facility Image<span class="text-danger">*</span></label><small>(Image Type : jpg,jpeg,png,webp)</small>
                                                    <input type="file" id="facility_image" class="form-control facility_image" name="facility_image">
                                                    <div id="error"></div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="customer_gallery_image" class="form-label">Customer Gallery Image<span class="text-danger">*</span></label><small>(Image Type : jpg,jpeg,png,webp)</small>
                                                    <input type="file" id="customer_gallery_image" class="form-control customer_gallery_image" name="customer_gallery_image">
                                                    <div id="error"></div>
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
                            <div class="modal fade" id="FacilityCustomerGalleryEditModal" tabindex="-1" role="dialog" aria-labelledby="FacilityCustomerGalleryEditModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="FacilityCustomerGalleryEditModalLabel">Showroom Facility Customer Gallery Edit</h5>
                                            <button type="button" class="close Close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('showroom_facility_customer_gallery_update') }}" method="POST" class="showroom_facility_customer_gallery_edit_form" enctype="multipart/form-data">
                                            <div class="modal-body">
                                                @csrf

                                                <input type="hidden" class="id" name="id">

                                                <div class="form-group">
                                                    <label for="showroom_id" class="form-label">Select Showroom<span class="text-danger">*</span></label>
                                                    <select name="showroom_id" id="edit_showroom_id" class="form-control select2">
                                                        <option selected="selected" disabled="disabled">Select</option>
                                                        @foreach($showrooms as $showroom)
                                                            <option value="{{$showroom->id}}" data-id="{{$showroom->id}}">
                                                                {{$showroom->name}}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="facility_image" class="form-label">Facility Image<span class="text-danger">*</span></label><small>(Image Type : jpg,jpeg,png,webp)</small>
                                                    <img src="" width="100" class="facility_icon" style="margin-bottom: 10px; margin-left: 5px;">
                                                    <input type="file" id="facility_image" class="form-control facility_image" name="facility_image">
                                                    <div id="error"></div>
                                                </div> 

                                                <div class="form-group">
                                                    <label for="customer_gallery_image" class="form-label">Customer Gallery Image<span class="text-danger">*</span></label><small>(Image Type : jpg,jpeg,png,webp)</small>
                                                    <img src="" width="100" class="customer_gallery_icon" style="margin-bottom: 10px; margin-left: 5px;">
                                                    <input type="file" id="customer_gallery_image" class="form-control customer_gallery_image" name="customer_gallery_image">
                                                    <div id="error"></div>
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
                                    <table class="table table-bordered table-striped facility_customer_gallery_data_table adm-table-no-wrap adm-action-sticky">
                                        <thead>
                                            <tr>
                                                <th style="width:45px;">No</th>
                                                <th>Showroom</th>
                                                <th>Facility Image</th>
                                                <th>Customer Gallery Image</th>
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

    // $(document).ready(function () {

        $(function () {
            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                // scrollX: true,
                ajax: {
                    url:"{{ route('showroom.index') }}",
                    type:'POST',
                    data: {
                    _token:"{{ csrf_token() }}",
                },
                },
                columns: [
                    {data: 'DT_RowIndex', name: '', orderable: false, searchable: false},
                    {data: 'our_business_id', name: 'our_business_id'},
                    {data: 'name', name: 'name'},
                    {data: 'name_color', name: 'name_color'},
                    {data: 'name_font_size', name: 'name_font_size'},
                    {data: 'name_font_family', name: 'name_font_family'},
                    {data: 'brand', name: 'brand'},
                    {data: 'car', name: 'car'},
                    {data: 'address', name: 'address'},
                    {data: 'address_color', name: 'address_color'},
                    {data: 'address_font_size', name: 'address_font_size'},
                    {data: 'address_font_family', name: 'address_font_family'},
                    {data: 'address_icon', name: 'address_icon'},
                    {data: 'working_hours', name: 'working_hours'},
                    {data: 'working_hours_color', name: 'working_hours_color'},
                    {data: 'working_hours_font_size', name: 'working_hours_font_size'},
                    {data: 'working_hours_font_family', name: 'working_hours_font_family'},
                    {data: 'working_hours_icon', name: 'working_hours_icon'},
                    {data: 'contact_number', name: 'contact_number'},
                    {data: 'contact_number_color', name: 'contact_number_color'},
                    {data: 'contact_number_font_size', name: 'contact_number_font_size'},
                    {data: 'contact_number_font_family', name: 'contact_number_font_family'},
                    {data: 'contact_number_icon', name: 'contact_number_icon'},
                    {data: 'email', name: 'email'},
                    {data: 'email_color', name: 'email_color'},
                    {data: 'email_font_size', name: 'email_font_size'},
                    {data: 'email_font_family', name: 'email_font_family'},
                    {data: 'email_icon', name: 'email_icon'},
                    {data: 'description', name: 'description'},
                    {data: 'description_color', name: 'description_color'},
                    {data: 'description_font_size', name: 'description_font_size'},
                    {data: 'description_font_family', name: 'description_font_family'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
            
        });


        $(function () {
            var table = $('.facility_customer_gallery_data_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('showroom_facility_customer_gallery.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: '', orderable: false, searchable: false},
                    {data: 'showroom', name: 'showroom'},
                    {data: 'facility_image', name: 'facility_image'},
                    {data: 'customer_gallery_image', name: 'customer_gallery_image'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
            
        // });
      

        $(".facility_customer_gallery_form").validate({
            rules: {
                'showroom_id': {
                    required: true,
                },
                'facility_image': {
                    required: true,
                    extension: "jpg,jpeg,png,webp",
                },
                'customer_gallery_image': {
                    required: true,
                    extension: "jpg,jpeg,png,webp",
                },
            },
            messages: {
                'showroom_id': {
                    required: "The showroom field is required.",
                },
                'facility_image': {
                    required: "The facility image field is required.",
                    extension: "Image must be jpg,jpeg,png or webp.",
                },
                'customer_gallery_image': {
                    required: "The customer image field is required.",
                    extension: "Image must be jpg,jpeg,png or webp.",
                },
            },
            errorPlacement: function(error, element) {
                if(element.attr("name") == "showroom_id"){
                    error.appendTo('#errordiv');
                    return;
                }
                if(element.attr("name") == "name"){
                        error.appendTo('#error');
                        return;
                }else {
                    error.insertAfter(element);
                }
            },
            submitHandler: function(form) {
                $(form).find('.submit').prop("disabled", true);
                form.submit();
            }
        });
    });

    $(document).on('click', '.delete', function() {
        var href = $(this).data('href');
        return new swal({
            title: "",
            text: "{{__('Are you sure? Delete this Showroom!')}}",
            showCancelButton: true,
            confirmButtonText: "{{__('Yes, delete it!')}}",
            icon: "warning"
        }).then((result) => {
            if (result.isConfirmed) {
                location.href = href;
            }
        });
    });

    $(document).on('click', '#FacilityCustomerGalleryInsertModal .Close', function() {
        $('label.error').empty();
        $('#FacilityCustomerGalleryInsertModal #showroom_id').select2('destroy'); 
        $('#FacilityCustomerGalleryInsertModal #showroom_id').val('');
        $('#FacilityCustomerGalleryInsertModal #showroom_id').select2({ width: '100%' }); 
        $('.facility_image').val("");
        $('.customer_gallery_image').val("");
    });


    

    $(document).on('click', '#FacilityCustomerGalleryEditModal .Close', function() {
        $('label.error').empty();
        $('.facility_image').val("");
        $('.customer_gallery_image').val("");
    });

    $(document).on('click', '.edit', function() {
        var id = $(this).data('id');
        $.ajax({
            url:"{{ route('facility_customer_gallery_edit') }}",
            type: "post",
            data: {
                "id": id,
                _token:"{{ csrf_token() }}",
            },
            success: function(data) {
                $.each(data, function (key, dat) {
        
                    $('.showroom_facility_customer_gallery_edit_form #edit_showroom_id').select2('destroy');
                    $(".showroom_facility_customer_gallery_edit_form #edit_showroom_id").val(data.record.showroom_id);
                    $('.showroom_facility_customer_gallery_edit_form #edit_showroom_id').select2({ width: '100%' }); 
                    
                    if (data.record.facility_image) {
                        $('.facility_icon').attr('src', "{{ url('public/showroom_facility_image') }}" + '/' + data.record.facility_image);
                    }
                    if (data.record.customer_gallery_image) {
                        $('.customer_gallery_icon').attr('src', "{{ url('public/showroom_customer_gallery_image') }}" + '/' + data.record.customer_gallery_image);
                    }
                    $('.id').val(data.record.id);
                });
            },
           
        })
    });

    // $(document).ready(function () {
        $(".showroom_facility_customer_gallery_edit_form").validate({
            rules: {
                'facility_image': {
                    extension: "jpg,jpeg,png,webp",
                },
                'customer_gallery_image': {
                    extension: "jpg,jpeg,png,webp",
                },
            },
            messages: {
                'facility_image': {
                    extension: "Image must be jpg,jpeg,png or webp.",
                },
                'customer_gallery_image': {
                    extension: "Image must be jpg,jpeg,png or webp.",
                },
            },
        });
    // });

    $(document).on('click', '.showroom_facility_customer_gallery_delete', function() {
        var href = $(this).data('href');
        return new swal({
            title: "",
            text: "{{__('Are you sure? Delete this Showroom Facility Customer Gallery!')}}",
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
        $('.select2').select2({ width: '100%' });
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