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
                            <h1 class="m-0">{{$site_title}}</h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('mission_vision_image_insert') }}" method="POST" class="mission_vision_title_form" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-md-4">
                                <label for="image">Image<span class="text-danger">*</span></label>
                                <input type="hidden" name="old_image" id="old_image" value="{{$record->image ?? null}}">
                                    @if(isset($record->image) && isset($record->image))
                                        <img src="{{url('public/mission_vision_image/'.$record->image)}}" width="100" style="margin-bottom: 10px; margin-left: 5px;">
                                    @endif
                                <input type="file" id="image" class="form-control image" name="image">
                                <small class="image_type">(Height:367px,Width:350px; Image Type : jpg,jpeg,png,svg,webp)</small>
                            </div>
                        </div>  
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary submit">Update</button>
                        </div>
                    </form>
                </div>


                <div class="col-sm-12  text-end">
                    <a href="{{ route('missionVisionCreate') }}" class="btn btn-primary float-right adm-table-addbtn">Add</a>
                </div>
                <div class="card-body">
                    <section class="content">
                        <div class="container-fluid">
                            <table class="table table-bordered table-striped data-table adm-table-no-wrap adm-action-sticky">
                                <thead>
                                    <tr>
                                        <th style="width:45px;">No</th>
                                        <th>Icon</th>
                                        <th>Icon Name</th>

                                        <th>Icon Name Color</th>
                                        <th>Icon Name Font Size</th>
                                        <th>Icon Name Font Family</th>

                                        <th>Title</th>

                                        <th>Title Color</th>
                                        <th>Title Font Size</th>
                                        <th>Title Font Family</th>

                                        <th>Description</th>
                                        
                                        <!--<th>Description Color</th>-->
                                        <!--<th>Description Font Size</th>-->
                                        <!--<th>Description Font Family</th>-->
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
            ajax: "{{ route('mission_vision.index') }}",
            columns: [
                {data: 'id', name: 'id', orderable: false, searchable: false},
                {data: 'icon', name: 'icon'},
                {data: 'icon_name', name: 'icon_name'},
               
                {data: 'icon_name_color', name: 'icon_name_color'},
                {data: 'icon_name_font_size', name: 'icon_name_font_size'},
                {data: 'icon_name_font_family', name: 'icon_name_font_family'},

                {data: 'title', name: 'title'},

                {data: 'title_color', name: 'title_color'},
                {data: 'title_font_size', name: 'title_font_size'},
                {data: 'title_font_family', name: 'title_font_family'},
                
                {data: 'description', name: 'description'},
                // {data: 'description_color', name: 'description_color'},
                // {data: 'description_font_size', name: 'description_font_size'},
                // {data: 'description_font_family', name: 'description_font_family'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
        
    });
      
        
$(document).on('click', '.delete', function() {
    var href = $(this).data('href');
    return new swal({
        title: "",
        text: "{{__('Are you sure? Delete this Mission Vision!')}}",
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


    $(document).ready(function () {
        $(".mission_vision_title_form").validate({
            rules: {
                'image': {
                    required: checkImage,
                    extension: "jpg,jpeg,png,webp,svg",
                },
            },
            messages: {
                'image': {
                    required: "The image field is required.",
                    extension: "Image must be jpg,jpeg,png,svg or webp.",
                },
            },
        });

        function checkImage() {
          var old_image = $('#old_image').val();
          if(old_image){
            return false;
          }
        }

    });

</script>
@endsection