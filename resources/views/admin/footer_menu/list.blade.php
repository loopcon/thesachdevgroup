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
                    <form action="{{ route('footer_menu_description_insert') }}" method="POST" class="footer_menu_description_form" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 mt-2 mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="ckeditor form-control" name="description">{{$record->description ?? null}}</textarea>
                            </div>

                            <?php /**<div class="mb-3 col-md-4">
                                <label for="description_color" class="form-label">Description Text Color</label>
                                <input type="text" class="form-control colorpicker" name="description_color" id="description_color" value="{{$record->description_color ?? null}}">
                            </div>

                            <div class="col-md-4">
                                @php($fontsize = fontSize())
                                <label for="description_font_size" class="form-label">Description Text Font Size</label>
                                <select class="form-control select2" name="description_font_size">
                                    <option value="">Select</option>
                                    @for($i=$fontsize['start']; $i<=$fontsize['end']; $i+=$fontsize['range'])
                                        <option value="{{$i}}px" @if(isset($record->description_font_size) && $record->description_font_size == $i.'px'){{'selected'}}@endif>{{$i}}px</option>
                                    @endfor
                               </select>
                            </div>

                            <div class="col-md-4">
                                @php($fontfamily = fontFamily())
                                <label for="description_font_family" class="form-label">Description Text Font Family</label>
                                <select class="form-control select2" name="description_font_family">
                                    <option value="">Select</option>
                                    @foreach($fontfamily as $family)
                                        <option value="{{$family['key']}}" @if(isset($record->description_font_family) && $record->description_font_family == $family['key']){{'selected'}}@endif>{{$family['value']}}</option>
                                    @endforeach
                               </select>
                            </div>**/ ?>
                        </div>  
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary submit">Update</button>
                        </div>
                    </form>
                </div>

                <div class="col-sm-12  text-end">
                    <a href="{{ route('footerMenuCreate') }}" class="btn btn-primary float-right adm-table-addbtn">Add</a>
                </div>
                <div class="card-body">
                    <section class="content">
                        <div class="container-fluid">
                            <table class="table table-bordered table-striped data-table footer_menu adm-table-no-wrap adm-action-sticky">
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
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
    @endsection
    @section('javascript')
    <script src="{{asset('plugins/sweetalert2/sweetalert2.js')}}" type="text/javascript"></script>
    <script src="{{asset('public/plugins/ckeditor/ckeditor.js')}}"  type="text/javascript"></script>
    <script type="text/javascript">
    $(function () {
        
        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            // scrollX: true,
            ajax: "{{ route('footer_menu.index') }}",
            columns: [
                {data: 'id', name: 'id', orderable: false, searchable: false},
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
      
        
$(document).on('click', '.delete', function() {
    var href = $(this).data('href');
    return new swal({
        title: "",
        text: "{{__('Are you sure? Delete this Footer Menu!')}}",
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
    $('.colorpicker').colorpicker();
    
    CKEDITOR.replace('description', {
        height:300,
    });
}); 

</script>
@endsection