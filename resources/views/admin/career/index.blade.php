@extends('admin.layout.header')
@section('css')
    <link class="js-stylesheet" href="{{ url('public/plugins/select2/css/select2.css') }}" rel="stylesheet">
    <link class="js-stylesheet" href="{{ url('public/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <link type="text/css" class="js-stylesheet" href="{{ url('public/plugins/parsley/parsley.css') }}" rel="stylesheet">
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
                    <form action="{{ route('career-update') }}" method="POST" class="service-center-form" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <label for="offer_main_title" class="form-label">Offer Main Title<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="offer_main_title" required="" name="offer_main_title" value="{{isset($record->offer_main_title) ? $record->offer_main_title : old('offer_main_title')}}">
                                @if ($errors->has('offer_main_title')) <div class="text-danger">{{ $errors->first('offer_main_title') }}</div>@endif
                            </div>

                            <div class="col-md-4">
                                <label for="offer_main_title_color" class="form-label">Offer Main Title Color</label>
                                <input type="text" id="offer_main_title_color" class="form-control colorpicker" name="offer_main_title_color" value="{{isset($record->offer_main_title_color) ? $record->offer_main_title_color : old('offer_main_title_color')}}">
                            </div>

                            <div class="col-md-4">
                                <label for="offer_main_title_font_size" class="form-label">Offer Main Title Font Size</label>
                                <select class="form-control select2" name="offer_main_title_font_size">
                                    <option value="">Select</option>
                                    @for($i=24; $i<=50; $i+=2)
                                        <option value="{{$i}}px" @if(isset($record->offer_main_title_font_size) && $record->offer_main_title_font_size == $i.'px'){{'selected'}}@endif>{{$i}}px</option>
                                    @endfor
                                </select>
                            </div>

                            @php($fontfamily = fontFamily())
                            <div class="col-md-4 mt-2">
                                <label for="offer_main_title_font_family" class="form-label">Offer Main Title Font Family</label>
                                <select class="form-control select2" name="offer_main_title_font_family">
                                    <option value="">Select</option>
                                    @foreach($fontfamily as $family)
                                        <option value="{{$family['key']}}" @if(isset($record->offer_main_title_font_family) && $record->offer_main_title_font_family == $family['key']){{'selected'}}@endif>{{$family['value']}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4 mt-2">
                                <label for="banner_image" class="form-label">Banner Image<span class="text-danger">*</span></label>
                                <input type="hidden" name="old_image" id="old_image" value="{{isset($record->banner_image) ? $record->banner_image : old('banner_image')}}">
                                @if(isset($record->banner_image) && $record->banner_image)
                                    <img src="{{url('public/uploads/career/'.$record->banner_image)}}" width="100">
                                @endif  
                                <input type="file" id="banner_image" class="form-control" name="banner_image" required="" value="">
                                @if ($errors->has('banner_image')) <div class="text-danger">{{ $errors->first('banner_image') }}</div>@endif
                                <small class="image_type">(Hight:478px,Width:1349px; Image Type : jpg,jpeg,png,svg,webp)</small>
                            </div>

                            <div class="col-md-4 mt-2">
                                <label for="offer_first_icon" class="form-label">Offer First Icon</label>
                                @if(isset($record->offer_first_icon) && $record->offer_first_icon)
                                    <img src="{{url('public/uploads/career_icon1/'.$record->offer_first_icon)}}" width="100">
                                @endif  
                                <input type="file" id="offer_first_icon" class="form-control" name="offer_first_icon" value="">
                                @if ($errors->has('offer_first_icon')) <div class="text-danger">{{ $errors->first('offer_first_icon') }}</div>@endif
                                <div class="error"></div>
                                <small class="image_type">(Hight:64px,Width:64px; Image Type : jpg,jpeg,png,svg,webp)</small>
                            </div>

                            <div class="col-md-4">
                                <label for="offer_first_title" class="form-label">Offer First Title</label>
                                <input type="text" class="form-control" id="offer_first_title" name="offer_first_title" value="{{isset($record->offer_first_title) ? $record->offer_first_title : old('offer_first_title')}}">
                                @if ($errors->has('offer_first_title')) <div class="text-danger">{{ $errors->first('offer_first_title') }}</div>@endif
                            </div>

                            <div class="col-md-4">
                                <label for="offer_first_title_color" class="form-label">Offer First Title Color</label>
                                <input type="text" id="offer_first_title_color" class="form-control colorpicker" name="offer_first_title_color" value="{{isset($record->offer_first_title_color) ? $record->offer_first_title_color : old('offer_first_title_color')}}">
                            </div>

                            <div class="col-md-4">
                                <label for="offer_first_title_font_size" class="form-label">Offer First Title Font Size</label>
                                <select class="form-control select2" name="offer_first_title_font_size">
                                    <option value="">Select</option>
                                    @for($i=24; $i<=50; $i+=2)
                                        <option value="{{$i}}px" @if(isset($record->offer_first_title_font_size) && $record->offer_first_title_font_size == $i.'px'){{'selected'}}@endif>{{$i}}px</option>
                                    @endfor
                                </select>
                            </div>

                            @php($fontfamily = fontFamily())
                            <div class="col-md-4 mt-2">
                                <label for="offer_first_title_font_family" class="form-label">Offer First Title Font Family</label>
                                <select class="form-control select2" name="offer_first_title_font_family">
                                    <option value="">Select</option>
                                    @foreach($fontfamily as $family)
                                        <option value="{{$family['key']}}" @if(isset($record->offer_first_title_font_family) && $record->offer_first_title_font_family == $family['key']){{'selected'}}@endif>{{$family['value']}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4 mt-2">
                                <label for="offer_first_description" class="form-label">Offer First Description</label>
                                <textarea class="form-control" name="offer_first_description" id="offer_first_description">{{isset($record->offer_first_description) ? $record->offer_first_description : old('offer_first_description')}}</textarea>
                            </div>

                            <div class="col-md-4 mt-2">
                                <label for="offer_first_description_font_size" class="form-label">Offer First Description Font Size</label>
                                <select class="form-control select2" name="offer_first_description_font_size">
                                    <option value="">-- Select --</option>
                                    @for($i=24; $i<=50; $i+=2)
                                        <option value="{{$i}}px" @if(isset($record->offer_first_description_font_size) && $record->offer_first_description_font_size == $i.'px'){{'selected'}}@endif>{{$i}}px</option>
                                    @endfor
                                </select>
                            </div>

                            <div class="col-md-4 mt-2">
                                <label for="offer_first_description_font_family" class="form-label">Offer First Description Font Family</label>
                                <select class="form-control select2" name="offer_first_description_font_family">
                                    <option value="">-- Select --</option>
                                    @foreach($fontfamily as $family)
                                        <option value="{{$family['key']}}" @if(isset($record->offer_first_description_font_family) && $record->offer_first_description_font_family == $family['key']){{'selected'}}@endif>{{$family['value']}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4 mt-2">
                                <label for="offer_first_description_font_color" class="form-label">Offer First Description Font Color</label>
                                <input type="text" class="form-control colorpicker" value="{{isset($record->offer_first_description_font_color) ? $record->offer_first_description_font_color : old('offer_first_description_font_color')}}" name="offer_first_description_font_color" id="offer_first_description_font_color">
                            </div>

                            <div class="col-md-4 mt-2">
                                <label for="offer_second_icon" class="form-label">Offer Second Icon</label>
                                @if(isset($record->offer_second_icon) && $record->offer_second_icon)
                                    <img src="{{url('public/uploads/career_icon2/'.$record->offer_second_icon)}}" width="100">
                                @endif  
                                <input type="file" id="offer_second_icon" class="form-control" name="offer_second_icon" value="">
                                @if ($errors->has('offer_second_icon')) <div class="text-danger">{{ $errors->first('offer_second_icon') }}</div>@endif
                                <div class="error"></div>
                                <small class="image_type">(Hight:64px,Width:64px; Image Type : jpg,jpeg,png,svg,webp)</small>
                            </div>

                            <div class="col-md-4">
                                <label for="offer_second_title" class="form-label">Offer Second Title</label>
                                <input type="text" class="form-control" id="offer_second_title" name="offer_second_title" value="{{isset($record->offer_second_title) ? $record->offer_second_title : old('offer_second_title')}}">
                                @if ($errors->has('offer_second_title')) <div class="text-danger">{{ $errors->first('offer_second_title') }}</div>@endif
                            </div>

                            <div class="col-md-4">
                                <label for="offer_second_title_color" class="form-label">Offer Second Title Color</label>
                                <input type="text" id="offer_second_title_color" class="form-control colorpicker" name="offer_second_title_color" value="{{isset($record->offer_second_title_color) ? $record->offer_second_title_color : old('offer_second_title_color')}}">
                            </div>

                            <div class="col-md-4">
                                <label for="offer_second_title_font_size" class="form-label">Offer Second Title Font Size</label>
                                <select class="form-control select2" name="offer_second_title_font_size">
                                    <option value="">Select</option>
                                    @for($i=24; $i<=50; $i+=2)
                                        <option value="{{$i}}px" @if(isset($record->offer_second_title_font_size) && $record->offer_second_title_font_size == $i.'px'){{'selected'}}@endif>{{$i}}px</option>
                                    @endfor
                                </select>
                            </div>

                            @php($fontfamily = fontFamily())
                            <div class="col-md-4 mt-2">
                                <label for="offer_second_title_font_family" class="form-label">Offer Second Title Font Family</label>
                                <select class="form-control select2" name="offer_second_title_font_family">
                                    <option value="">Select</option>
                                    @foreach($fontfamily as $family)
                                        <option value="{{$family['key']}}" @if(isset($record->offer_second_title_font_family) && $record->offer_second_title_font_family == $family['key']){{'selected'}}@endif>{{$family['value']}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4 mt-2">
                                <label for="offer_second_description" class="form-label">Offer Second Description</label>
                                <textarea class="form-control" name="offer_second_description" id="offer_second_description">{{isset($record->offer_second_description) ? $record->offer_second_description : old('offer_second_description')}}</textarea>
                            </div>

                            <div class="col-md-4 mt-2">
                                <label for="offer_second_description_font_size" class="form-label">Offer Second Description Font Size</label>
                                <select class="form-control select2" name="offer_second_description_font_size">
                                    <option value="">-- Select --</option>
                                    @for($i=24; $i<=50; $i+=2)
                                        <option value="{{$i}}px" @if(isset($record->offer_second_description_font_size) && $record->offer_second_description_font_size == $i.'px'){{'selected'}}@endif>{{$i}}px</option>
                                    @endfor
                                </select>
                            </div>

                            <div class="col-md-4 mt-2">
                                <label for="offer_second_description_font_family" class="form-label">Offer Second Description Font Family</label>
                                <select class="form-control select2" name="offer_second_description_font_family">
                                    <option value="">-- Select --</option>
                                    @foreach($fontfamily as $family)
                                        <option value="{{$family['key']}}" @if(isset($record->offer_second_description_font_family) && $record->offer_second_description_font_family == $family['key']){{'selected'}}@endif>{{$family['value']}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4 mt-2">
                                <label for="offer_second_description_font_color" class="form-label">Offer Second Description Font Color</label>
                                <input type="text" class="form-control colorpicker" value="{{isset($record->offer_second_description_font_color) ? $record->offer_second_description_font_color : old('offer_second_description_font_color')}}" name="offer_second_description_font_color" id="offer_second_description_font_color">
                            </div>

                            <div class="col-md-4 mt-2">
                                <label for="offer_third_icon" class="form-label">Offer Third Icon</label>
                                @if(isset($record->offer_third_icon) && $record->offer_third_icon)
                                    <img src="{{url('public/uploads/career_icon3/'.$record->offer_third_icon)}}" width="100">
                                @endif  
                                <input type="file" id="offer_third_icon" class="form-control" name="offer_third_icon" value="">
                                @if ($errors->has('offer_third_icon')) <div class="text-danger">{{ $errors->first('offer_third_icon') }}</div>@endif
                                <small class="image_type">(Hight:64px,Width:64px; Image Type : jpg,jpeg,png,svg,webp)</small>
                            </div>

                            <div class="col-md-4">
                                <label for="offer_third_title" class="form-label">Offer Third Title</label>
                                <input type="text" class="form-control" id="offer_third_title" name="offer_third_title" value="{{isset($record->offer_third_title) ? $record->offer_third_title : old('offer_third_title')}}">
                                @if ($errors->has('offer_third_title')) <div class="text-danger">{{ $errors->first('offer_third_title') }}</div>@endif
                            </div>

                            <div class="col-md-4">
                                <label for="offer_third_title_color" class="form-label">Offer Third Title Color</label>
                                <input type="text" id="offer_third_title_color" class="form-control colorpicker" name="offer_third_title_color" value="{{isset($record->offer_third_title_color) ? $record->offer_third_title_color : old('offer_third_title_color')}}">
                            </div>

                            <div class="col-md-4">
                                <label for="offer_third_title_font_size	" class="form-label">Offer Third Title Font Size</label>
                                <select class="form-control select2" name="offer_third_title_font_size	">
                                    <option value="">Select</option>
                                    @for($i=24; $i<=50; $i+=2)
                                        <option value="{{$i}}px" @if(isset($record->offer_third_title_font_size	) && $record->offer_third_title_font_size	 == $i.'px'){{'selected'}}@endif>{{$i}}px</option>
                                    @endfor
                                </select>
                            </div>

                            @php($fontfamily = fontFamily())
                            <div class="col-md-4 mt-2">
                                <label for="offer_third_title_font_family" class="form-label">Offer Third Title Font Family</label>
                                <select class="form-control select2" name="offer_third_title_font_family">
                                    <option value="">Select</option>
                                    @foreach($fontfamily as $family)
                                        <option value="{{$family['key']}}" @if(isset($record->offer_third_title_font_family) && $record->offer_third_title_font_family == $family['key']){{'selected'}}@endif>{{$family['value']}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4 mt-2">
                                <label for="offer_third_description" class="form-label">Offer Third Description</label>
                                <textarea class="form-control" name="offer_third_description" id="offer_third_description">{{isset($record->offer_third_description) ? $record->offer_third_description : old('offer_third_description')}}</textarea>
                            </div>

                            <div class="col-md-4 mt-2">
                                <label for="offer_third_description_font_size" class="form-label">Offer Third Description Font Size</label>
                                <select class="form-control select2" name="offer_third_description_font_size">
                                    <option value="">-- Select --</option>
                                    @for($i=24; $i<=50; $i+=2)
                                        <option value="{{$i}}px" @if(isset($record->offer_third_description_font_size) && $record->offer_third_description_font_size == $i.'px'){{'selected'}}@endif>{{$i}}px</option>
                                    @endfor
                                </select>
                            </div>

                            <div class="col-md-4 mt-2">
                                <label for="offer_third_description_font_family" class="form-label">Offer Third Description Font Family</label>
                                <select class="form-control select2" name="offer_third_description_font_family">
                                    <option value="">-- Select --</option>
                                    @foreach($fontfamily as $family)
                                        <option value="{{$family['key']}}" @if(isset($record->offer_third_description_font_family) && $record->offer_third_description_font_family == $family['key']){{'selected'}}@endif>{{$family['value']}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4 mt-2">
                                <label for="offer_third_description_font_color" class="form-label">Offer Third Description Font Color</label>
                                <input type="text" class="form-control colorpicker" value="{{isset($record->offer_third_description_font_color) ? $record->offer_third_description_font_color : old('offer_third_description_font_color')}}" name="offer_third_description_font_color" id="offer_third_description_font_color">
                            </div>

                            <div class="col-md-4">
                                <label for="vacancy_title" class="form-label">Vacancy Title</label>
                                <input type="text" class="form-control" id="vacancy_title" name="vacancy_title" value="{{isset($record->vacancy_title) ? $record->vacancy_title : old('vacancy_title')}}">
                                @if ($errors->has('vacancy_title')) <div class="text-danger">{{ $errors->first('vacancy_title') }}</div>@endif
                            </div>

                            <div class="col-md-4">
                                <label for="vacancy_title_color" class="form-label">Vacancy Title Font Color</label>
                                <input type="text" id="vacancy_title_color" class="form-control colorpicker" name="vacancy_title_color" value="{{isset($record->vacancy_title_color) ? $record->vacancy_title_color : old('vacancy_title_color')}}">
                            </div>

                            <div class="col-md-4">
                                <label for="vacancy_title_font_size" class="form-label">Vacancy Title Font Size</label>
                                <select class="form-control select2" name="vacancy_title_font_size">
                                    <option value="">Select</option>
                                    @for($i=24; $i<=50; $i+=2)
                                        <option value="{{$i}}px" @if(isset($record->vacancy_title_font_size) && $record->vacancy_title_font_size == $i.'px'){{'selected'}}@endif>{{$i}}px</option>
                                    @endfor
                                </select>
                            </div>

                            @php($fontfamily = fontFamily())
                            <div class="col-md-4 mt-2">
                                <label for="vacancy_title_font_family" class="form-label">Vacancy Title Font Family</label>
                                <select class="form-control select2" name="vacancy_title_font_family">
                                    <option value="">Select</option>
                                    @foreach($fontfamily as $family)
                                        <option value="{{$family['key']}}" @if(isset($record->vacancy_title_font_family) && $record->vacancy_title_font_family == $family['key']){{'selected'}}@endif>{{$family['value']}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label for="vacancy_sub_title" class="form-label">Vacancy Sub Title</label>
                                <input type="text" class="form-control" id="vacancy_sub_title" name="vacancy_sub_title" value="{{isset($record->vacancy_sub_title) ? $record->vacancy_sub_title : old('vacancy_sub_title')}}">
                                @if ($errors->has('vacancy_sub_title')) <div class="text-danger">{{ $errors->first('vacancy_sub_title') }}</div>@endif
                            </div>

                            <div class="col-md-4">
                                <label for="vacancy_sub_title_color" class="form-label">Vacancy Sub Title Font Color</label>
                                <input type="text" id="vacancy_sub_title_color" class="form-control colorpicker" name="vacancy_sub_title_color" value="{{isset($record->vacancy_sub_title_color) ? $record->vacancy_sub_title_color : old('vacancy_sub_title_color')}}">
                            </div>

                            <div class="col-md-4">
                                <label for="vacancy_sub_title_font_size" class="form-label">Vacancy Sub Title Font Size</label>
                                <select class="form-control select2" name="vacancy_sub_title_font_size">
                                    <option value="">Select</option>
                                    @for($i=24; $i<=50; $i+=2)
                                        <option value="{{$i}}px" @if(isset($record->vacancy_sub_title_font_size) && $record->vacancy_sub_title_font_size == $i.'px'){{'selected'}}@endif>{{$i}}px</option>
                                    @endfor
                                </select>
                            </div>

                            @php($fontfamily = fontFamily())
                            <div class="col-md-4 mb-3">
                                <label for="vacancy_sub_title_font_family" class="form-label">Vacancy Sub Title Font Family</label>
                                <select class="form-control select2" name="vacancy_sub_title_font_family">
                                    <option value="">Select</option>
                                    @foreach($fontfamily as $family)
                                        <option value="{{$family['key']}}" @if(isset($record->vacancy_sub_title_font_family) && $record->vacancy_sub_title_font_family == $family['key']){{'selected'}}@endif>{{$family['value']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary submit">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
@section('javascript')
<script src="{{ url('public/plugins/parsley/parsley.js') }}"></script>
<script src="{{ url('public/plugins/select2/js/select2.js') }}"></script>
<script>
    $(document).ready(function () {
        $('.select2').select2({ width: '100%' });

        $(".service-center-form").validate({
            rules: {
            },
            submitHandler: function(form) {
                $(form).find('.submit').prop("disabled", true);
                form.submit();
            }
        });

        $('.colorpicker').colorpicker();

        // banner image validation
        var old_image = $('#old_image').val();
        var banner_image = $('#banner_image').val();
        if(old_image != '' || banner_image != ''){
            document.getElementById("banner_image").required = false;
        }else{
            document.getElementById("banner_image").required = true;
        }
    });
</script>
@endsection