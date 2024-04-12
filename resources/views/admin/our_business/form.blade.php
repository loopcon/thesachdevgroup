@extends('admin.layout.header')
@section('css')
    <link class="js-stylesheet" href="{{ url('public/plugins/select2/css/select2.css') }}" rel="stylesheet">
    <link class="js-stylesheet" href="{{ url('public/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                @include('admin.alerts')
            </div>
          <div class="col-sm-6">
            <h1>{{$site_title}}</h1>
          </div>
        </div>
      </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <form action="@if(isset($record->id)) {{ route('our-business-update', array('id' => encrypt($record->id))) }} @else{{ route('our-business-store') }} @endif" method="POST" class="our-business-form" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-4 adm-brand-errorbox">
                                <label for="page_link" class="form-label">page Link or Url<span class="text-danger">*</span></label>
                                <select class="form-control select2" name="page_link" id="page_link">
                                    <option value="">-- Select --</option>
                                    <option value="1" @if(isset($record->page_link) && $record->page_link == 1){{'selected'}} @endif>Page Link</option>
                                    <option value="0" @if(isset($record->page_link) && $record->page_link == 0){{'selected'}} @endif>Url</option>
                                </select>
                                @if ($errors->has('page_link')) <div class="text-danger">{{ $errors->first('page_link') }}</div>@endif
                            </div>

                            <div class="col-md-4 page_url">
                                <label for="url" class="form-label">Url</label>
                                <input type="url" id="url" class="form-control" name="url" value="{{isset($record->url) ? $record->url : old('url')}}">
                            </div>

                            <div class="col-md-4 adm-brand-errorbox">
                                <label for="title" class="form-label">Business Title<span class="text-danger">*</span></label>
                                <select class="form-control select2" name="title" id="title">
                                    <option value="">-- Select --</option>
                                    @foreach($our_business as $value)
                                        <option value="{{$value->name}}"@if(isset($record->title) && $record->title == $value->name){{'selected'}}@endif>{{$value->name}}</option>
                                    @endforeach
                                </select>
                                <div id="error"></div>
                                @if ($errors->has('title')) <div class="text-danger">{{ $errors->first('title') }}</div>@endif
                            </div>

                            <div class="col-md-4">
                                <label for="title_font_color" class="form-label">Title Font Color</label>
                                <input type="text" id="title_font_color" class="form-control colorpicker" name="title_font_color" value="{{isset($record->title_font_color) ? $record->title_font_color : old('title_font_color')}}">
                            </div>
 
                            <div class="col-md-4 mt-2">
                                <label for="title_font_size" class="form-label">Title Font Size</label>
                                <select class="form-control select2" name="title_font_size">
                                    <option value="">Select</option>
                                    @for($i=24; $i<=50; $i+=2)
                                        <option value="{{$i}}px" @if(isset($record->title_font_size) && $record->title_font_size == $i.'px'){{'selected'}}@endif>{{$i}}px</option>
                                    @endfor
                                </select>
                            </div>

                            @php($fontfamily = fontFamily())
                            <div class="col-md-4 mt-2">
                                <label for="title_font_family" class="form-label">Title Font Family</label>
                                <select class="form-control select2" name="title_font_family">
                                    <option value="">Select</option>
                                    @foreach($fontfamily as $family)
                                        <option value="{{$family['key']}}" @if(isset($record->title_font_family) && $record->title_font_family == $family['key']){{'selected'}}@endif>{{$family['value']}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4 mt-2">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" name="description" id="description">{{isset($record->description) ? $record->description : old('description')}}</textarea>
                            </div>

                            <div class="col-md-4 mt-2">
                                <label for="description_font_size" class="form-label">Description Font Size</label>
                                <select class="form-control select2" name="description_font_size">
                                    <option value="">Select</option>
                                    @for($i=24; $i<=50; $i+=2)
                                        <option value="{{$i}}px" @if(isset($record->description_font_size) && $record->description_font_size == $i.'px'){{'selected'}}@endif>{{$i}}px</option>
                                    @endfor
                                </select>
                            </div>

                            <div class="col-md-4 mt-2">
                                <label for="description_font_family" class="form-label">Description Font Family</label>
                                <select class="form-control select2" name="description_font_family">
                                    <option value="">Select</option>
                                    @foreach($fontfamily as $family)
                                        <option value="{{$family['key']}}" @if(isset($record->description_font_family) && $record->description_font_family == $family['key']){{'selected'}}@endif>{{$family['value']}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4 mt-2 mb-3">
                                <label for="description_font_color" class="form-label">Description Font Color</label>
                                <input type="text" class="form-control colorpicker" value="{{isset($record->description_font_color) ? $record->description_font_color : old('description_font_color')}}" name="description_font_color" id="description_font_color">
                            </div>

                            <div class="col-md-5 mt-2">
                                <label for="banner_image" class="form-label">Banner Image</label><span class="text-danger">*</span><small>(Hight:281,Width:1349; Image Type : jpg,jpeg,png,webp)</small></span>
                                @if(isset($record->banner_image) && $record->banner_image)
                                    <img src="{{url('public/uploads/our_business/'.$record->banner_image)}}" width="100" style="margin-bottom:10px; margin-left:10px;">
                                @endif  
                                <input type="file" id="banner_image" class="form-control" name="banner_image" value="">
                                @if ($errors->has('banner_image')) <div class="text-danger">{{ $errors->first('banner_image') }}</div>@endif
                                <div class="error"></div>
                            </div>

                            <div class="col-12">
                                <h5>Why Choose Section</h5>
                                <hr>
                            </div>

                            <div class="col-md-4 mb-2">
                                <label for="why_choose_title" class="form-label">Why Choose Title</label>
                                <input type="text" class="form-control" value="{{isset($record->why_choose_title) ? $record->why_choose_title : old('why_choose_title')}}" name="why_choose_title" id="why_choose_title">
                            </div>

                            <div class="col-md-4 mb-2">
                                <label for="why_choose_title_color" class="form-label">Why Choose Title Color</label>
                                <input type="text" class="form-control colorpicker" value="{{isset($record->why_choose_title_color) ? $record->why_choose_title_color : old('why_choose_title_color')}}" name="why_choose_title_color" id="why_choose_title_color">
                            </div>

                            <div class="col-md-4">
                                <label for="why_choose_title_font_size" class="form-label">Why Choose Title Font Size</label>
                                <select class="form-control select2" name="why_choose_title_font_size">
                                    <option value="">Select</option>
                                    @for($i=24; $i<=50; $i+=2)
                                        <option value="{{$i}}px" @if(isset($record->why_choose_title_font_size) && $record->why_choose_title_font_size == $i.'px'){{'selected'}}@endif>{{$i}}px</option>
                                    @endfor
                                </select>
                            </div>

                            @php($fontfamily = fontFamily())
                            <div class="col-md-4 mt-2">
                                <label for="why_choose_title_font_family" class="form-label">Why Choose Title Font Family</label>
                                <select class="form-control select2" name="why_choose_title_font_family">
                                    <option value="">Select</option>
                                    @foreach($fontfamily as $family)
                                        <option value="{{$family['key']}}" @if(isset($record->why_choose_title_font_family) && $record->why_choose_title_font_family == $family['key']){{'selected'}}@endif>{{$family['value']}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6 mb-2 mt-2">
                                <label for="why_choose_image" class="form-label">Why Choose Image</label>&nbsp;<small>(Hight:540,Width:405; Image Type : jpg,jpeg,png,webp)</small>
                                @if(isset($record->why_choose_image) && $record->why_choose_image)
                                    <img src="{{url('public/uploads/why_choose_image/'.$record->why_choose_image)}}" width="100" style="margin-bottom:10px; margin-left:10px;">
                                @endif  
                                <input type="file" id="why_choose_image" class="form-control" name="why_choose_image" value="">
                                @if ($errors->has('why_choose_image')) <div class="text-danger">{{ $errors->first('why_choose_image') }}</div>@endif
                                <div class="error"></div>
                            </div>

                            <div class="col-md-12 mb-2">
                                <label for="why_choose_description" class="form-label">Why Choose Description</label>
                                <textarea class="ckeditor form-control" value="{{isset($record->why_choose_description) ? $record->why_choose_description : old('why_choose_description')}}" name="why_choose_description" id="why_choose_description"></textarea>
                            </div>

                            <div class="col-md-4 mb-2 mt-2">
                                <label for="why_choose_description_color" class="form-label">Why Choose Description Color</label>
                                <input type="text" class="form-control colorpicker" value="{{isset($record->why_choose_description_color) ? $record->why_choose_description_color : old('why_choose_description_color')}}" name="why_choose_description_color" id="why_choose_description_color">
                            </div>

                            <div class="col-md-4 mt-2">
                                <label for="why_choose_description_font_size" class="form-label">Why Choose Description Font Size</label>
                                <select class="form-control select2" name="why_choose_description_font_size">
                                    <option value="">Select</option>
                                    @for($i=24; $i<=50; $i+=2)
                                        <option value="{{$i}}px" @if(isset($record->why_choose_description_font_size) && $record->why_choose_description_font_size == $i.'px'){{'selected'}}@endif>{{$i}}px</option>
                                    @endfor
                                </select>
                            </div>

                            @php($fontfamily = fontFamily())
                            <div class="col-md-4 mt-2">
                                <label for="why_choose_description_font_family" class="form-label">Why Choose Description Font Family</label>
                                <select class="form-control select2" name="why_choose_description_font_family">
                                    <option value="">Select</option>
                                    @foreach($fontfamily as $family)
                                        <option value="{{$family['key']}}" @if(isset($record->why_choose_description_font_family) && $record->why_choose_description_font_family == $family['key']){{'selected'}}@endif>{{$family['value']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary submit">Submit</button>
                            <a href="{{ route('our-business') }}" class="btn btn-danger">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
@section('javascript')
<script src="{{ url('public/plugins/select2/js/select2.js') }}"></script>
<script src="{{ url('public/plugins/select2/js/select2.min.js') }}"></script>
<script>
    $(document).ready(function () {
        $('.select2').select2({ width: '100%' });

        $('.page_url').hide();
        var page = $('#page_link').val();
        if(page == '0')
        {
            $('.page_url').show();
        }
        $(document).on('change','#page_link',function(){
            var page_link_url = $(this).val();
            if(page_link_url == 0)
            {
                $('.page_url').show();
            }else{
                $('.page_url').hide();
            }
        });
        $(".our-business-form").validate({
            rules: {
                'page_link': {
                    required: true,
                },
                'title': {
                    required: true,
                },
                'banner_image': {
                    extension: "jpg,jpeg,png,webp",
                },
                url: {
                    url: "url",
                },
            },
            messages: {
                'page_link': {
                    required: "Page Link or Url is required",
                },
                'title': {
                    required: "title is required",
                },
                'banner_image': {
                    extension: "Banner Image must be jpg,jpeg,png or webp",
                },
                'url': {
                    url: "Enter valid url",
                },
            },
            submitHandler: function(form) {
                $(form).find('.submit').prop("disabled", true);
                form.submit();
            }
        });

        $('.colorpicker').colorpicker();
    });
</script>
@endsection