@extends('admin.layout.header')
@section('css')
    <link class="js-stylesheet" href="{{ asset('plugins/select2/css/select2.css') }}" rel="stylesheet">
    <link class="js-stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h1>{{$site_title}}</h1>
          </div>
          <div class="col-sm-6 d-none d-sm-block">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">{{$site_title}}</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <form action="@if(isset($record->id)) {{ route('count_update', array('id' => encrypt($record->id))) }} @else{{ route('count_insert') }} @endif" method="POST" class="count_form" enctype="multipart/form-data">
                        @csrf
                        <div class="row">

                            <div class="mb-3 col-md-4">
                                <label for="icon" class="form-label">Icon<span class="text-danger">*</span></label><small>(Image Type : jpg,jpeg,png,webp)</small>
                                
                                <input type="hidden" name="old_image" id="old_image" value="{{isset($record->icon) ? $record->icon : old('old_image')}}">
                                
                                @if(isset($record->icon) && $record->icon)
                                    <img src="{{url('public/count_icon/'.$record->icon)}}" width="100" style="margin-bottom: 10px; margin-left: 5px;">
                                @endif  
                                <input type="file" id="icon" class="form-control" name="icon">
                                <div class="error"></div>
                            </div>

                            <div class="col-md-4">
                                <label for="amount" class="form-label">Amount<span class="text-danger">*</span></label>
                                <input type="number" id="amount" class="form-control" name="amount" value="{{isset($record->amount) ? $record->amount : old('amount')}}">
                                <div class="error"></div>
                            </div> 

                            <div class="col-md-4">
                                <label for="amount_color" class="form-label">Amount Text Color</label>
                                <input type="text" id="amount_color" class="form-control colorpicker" name="amount_color" value="{{isset($record->amount_color) ? $record->amount_color : old('amount_color')}}">
                                <div class="error"></div>
                            </div> 

                            <div class="mb-3 col-md-4">
                                @php($fontsize = fontSize())
                                <label for="amount_font_size" class="form-label">Amount Text Font Size</label>
                                <select class="form-control select2" name="amount_font_size">
                                    <option selected="selected" disabled="disabled">Select</option>
                                    @for($i=$fontsize['start']; $i<=$fontsize['end']; $i+=$fontsize['range'])
                                        <option value="{{$i}}px" @if(isset($record->amount_font_size) && $record->amount_font_size == $i.'px'){{'selected'}}@endif>{{$i}}px</option>
                                    @endfor
                                </select>
                            </div> 

                            <div class="col-md-4">
                                @php($fontfamily = fontFamily())
                                <label for="amount_font_family" class="form-label">Amount Text Font Family</label>
                                <select class="form-control select2" name="amount_font_family">
                                    <option selected="selected" disabled="disabled">Select</option>
                                    @foreach($fontfamily as $family)
                                        <option value="{{$family['key']}}" @if(isset($record->amount_font_family) && $record->amount_font_family == $family['key']){{'selected'}}@endif>{{$family['value']}}</option>
                                    @endforeach
                                </select>
                            </div> 

                            <div class="col-md-4">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" id="name" class="form-control" name="name" value="{{isset($record->name) ? $record->name : old('name')}}">
                                <div class="error"></div>
                            </div> 

                            <div class="mb-3 col-md-4">
                                <label for="name_color" class="form-label">Name Text Color</label>
                                <input type="text" id="name_color" class="form-control colorpicker" name="name_color" value="{{isset($record->name_color) ? $record->name_color : old('name_color')}}">
                                <div class="error"></div>
                            </div> 

                            <div class="col-md-4">
                                <label for="name_font_size" class="form-label">Name Text Font Size</label>
                                <select class="form-control select2" name="name_font_size">
                                    <option selected="selected" disabled="disabled">Select</option>
                                    @for($i=$fontsize['start']; $i<=$fontsize['end']; $i+=$fontsize['range'])
                                        <option value="{{$i}}px" @if(isset($record->name_font_size) && $record->name_font_size == $i.'px'){{'selected'}}@endif>{{$i}}px</option>
                                    @endfor
                                </select>
                            </div> 

                            <div class="col-md-4">
                                <label for="name_font_family" class="form-label">Name Text Font Family</label>
                                <select class="form-control select2" name="name_font_family">
                                <option selected="selected" disabled="disabled">Select</option>
                                @foreach($fontfamily as $family)
                                    <option value="{{$family['key']}}" @if(isset($record->name_font_family) && $record->name_font_family == $family['key']){{'selected'}}@endif>{{$family['value']}}</option>
                                @endforeach
                                </select>
                            </div> 

                            <div class="mb-3 col-md-4">
                                <label for="background_color" class="form-label">Background Color</label>
                                <input type="text" id="background_color" class="form-control colorpicker" name="background_color" value="{{isset($record->background_color) ? $record->background_color : old('background_color')}}">
                                <div class="error"></div>
                            </div> 

                        </div> 
                            
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary submit">Submit</button>
                            <a href="{{ route('count') }}" class="btn btn-danger">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
@section('javascript')
<script src="{{ asset('plugins/select2/js/select2.js') }}"></script>
<script src="{{ asset('plugins/select2/js/select2.min.js') }}"></script>
<script>
 $(document).ready(function () {
        $(".count_form").validate({
            rules: {
                'icon': {
                    required: checkIconImage,
                    extension: "jpg,jpeg,png,webp",
                },
                'amount': {
                    required: true,
                },
            },
            messages: {
                'icon': {
                    required: "The icon field is required.",
                    extension: "Image must be jpg,jpeg,png or webp.",
                },
                'amount': {
                    required: "The amount field is required.",
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

        function checkIconImage() {
            var old_image = $('#old_image').val();
            var icon = $('#icon').val();

            if(old_image != '' || icon != ''){
                return false;
            }
            return true;
        }
        
        $('.colorpicker').colorpicker();

    });
</script>
@endsection