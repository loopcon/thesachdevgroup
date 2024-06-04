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
                    <h1 class="m-0">Home Our Businesses</h1>
                </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('home_our_businesses_title_insert') }}" method="POST" class="our_businesses_title_form" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <label for="businesses_title">Businesses Title</label>
                            <input type="text" id="businesses_title" class="form-control" name="businesses_title" value="{{$record->businesses_title ?? null}}">
                        </div>

                        <div class="col-md-4">
                            <label for="businesses_title_color">Businesses Title Text Color</label>
                            <input type="text" class="form-control colorpicker" name="businesses_title_color" id="businesses_title_color" value="{{$record->businesses_title_color ?? null}}">
                        </div>

                        <div class="mb-3 col-md-4">
                            @php($fontsize = fontSize())
                            <label for="businesses_title_font_size">Businesses Title Text Font Size</label>
                            <select class="form-control select2" name="businesses_title_font_size">
                                <option value="">Select</option>
                                @for($i=$fontsize['start']; $i<=$fontsize['end']; $i+=$fontsize['range'])
                                    <option value="{{$i}}px" @if(isset($record->businesses_title_font_size) && $record->businesses_title_font_size == $i.'px'){{'selected'}}@endif>{{$i}}px</option>
                                @endfor
                            </select>
                        </div>

                        <div class="col-md-4">
                            @php($fontfamily = fontFamily())
                            <label for="businesses_title_font_family">Businesses Title Text Font Family</label>
                            <select class="form-control select2" name="businesses_title_font_family">
                                <option value="">Select</option>
                                @foreach($fontfamily as $family)
                                <option value="{{$family['key']}}" @if(isset($record->businesses_title_font_family) && $record->businesses_title_font_family == $family['key']){{'selected'}}@endif>{{$family['value']}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3 col-md-4">
                            <label for="background_color">Background Color</label>
                            <input type="text" id="background_color" class="form-control colorpicker" name="background_color" value="{{$record->background_color ?? null}}">
                        </div>
                    </div>  
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary submit">Submit</button>
                    </div>
                </form>
            </div>

            <div class="col-sm-12  text-end">
                <a href="{{ route('home_our_businesses') }}" class="btn btn-primary float-right adm-table-addbtn">Add</a>
            </div>
            <div class="card-body">
                <section class="content">
                    <div class="container-fluid">
                        <table class="table table-bordered table-striped data-table adm-table-no-wrap adm-action-sticky">
                            <thead>
                                <tr>
                                    <th style="width:45px;">No</th>
                                    <th>Image</th>
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
<script type="text/javascript">
    $(function () {
        
        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            // scrollX: true,
    
            ajax: "{{ route('home_our_businesses.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: '', orderable: false, searchable: false},
                {data: 'image', name: 'image'},
                {data: 'link', name: 'link'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
        
    });
      
          
    $(document).on('click', '.delete', function() {
        var href = $(this).data('href');
        return new swal({
            title: "",
            text: "{{__('Are you sure? Delete this Home Our Businesses!')}}",
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
    });

    $(document).ready(function () {
        $(".our_businesses_title_form").validate({
            rules: {
                'businesses_title': {
                    required: true,
                },
            },
            messages: {
                'businesses_title': {
                    required: "The businesses title field is required.",
                },
            },
        });
    });       
</script>
@endsection