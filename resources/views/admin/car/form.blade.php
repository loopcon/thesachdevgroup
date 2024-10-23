@extends('admin.layout.header')
@section('css')
    <link type="text/css" class="js-stylesheet" href="{{ url('public/plugins/parsley/parsley.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h1>Car Model Create</h1>
          </div>
        </div>
      </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('car_insert') }}" method="POST" class="car_form" enctype="multipart/form-data" data-parsley-validate="">
                        @csrf
                        <div class="row">
                            <div class="col-md-4 adm-brand-errorbox">
                                <label for="brand_id" class="form-label">Select Brand<span class="text-danger">*</span></label>
                                 <select name="brand_id" id="brand_id" class="form-control select2" required>
                                    <option value="">Select</option>
                                    @foreach($brands as $brand)
                                        <option value="{{$brand->id}}">
                                            {{$brand->name}}
                                        </option>
                                    @endforeach
                                </select>
                                <div id="errordiv"></div>
                            </div>

                            <div class="col-md-4 adm-brand-errorbox">
                                <label for="car_type" class="form-label">Car Type<span class="text-danger">*</span></label>
                                <select class="form-control select2" name="car_type" id="car_type">
                                    <option value="">-- Select Car Type--</option>
                                    <option value="1">Used Car</option>
                                    <option value="2">New Car</option>
                                    <option value="3">Other</option>
                                </select>
                                @if ($errors->has('car_type')) <div class="text-danger">{{ $errors->first('car_type') }}</div>@endif
                            </div>

                            <div class="col-md-4">
                                <label for="image" class="form-label">Image<span class="text-danger">*</span></label>
                                <input type="file" id="image" class="form-control" name="image" required>
                                <small class="image_type">(Height:219px,Width:348px; Image Type : jpg,jpeg,png,svg,webp)</small>
                            </div>

                            <div class="col-md-4">
                                <label for="name" class="form-label">Name<span class="text-danger">*</span></label>
                                <input type="text" id="name" class="form-control" name="name" required>
                                <div id="error"></div>
                            </div>

                            <div class="col-md-4">
                                <label for="name_color" class="form-label">Name Text Color</label>
                                <input type="text" class="form-control colorpicker" name="name_color" id="name_color">
                            </div>

                            <div class="col-md-4">
                                @php($fontsize = fontSize())
                                <label for="name_font_size" class="form-label">Name Text Font Size</label>
                                <select class="form-control select2" name="name_font_size">
                                    <option value="">Select</option>
                                    @for($i=$fontsize['start']; $i<=$fontsize['end']; $i+=$fontsize['range'])
                                        <option value="{{$i}}px">{{$i}}px</option>
                                    @endfor
                               </select>
                            </div>

                            <div class="mb-3 col-md-4">
                                @php($fontfamily = fontFamily())
                                <label for="name_font_family" class="form-label">Name Text Font Family</label>
                                <select class="form-control select2" name="name_font_family">
                                    <option value="">Select</option>
                                        @foreach($fontfamily as $family)
                                            <option value="{{$family['key']}}">{{$family['value']}}</option>
                                        @endforeach
                               </select>
                            </div>

                            <div class="mb-3 col-md-4">
                                <label for="price" class="form-label">Price<span class="text-danger">*</span></label>
                                <input type="text" id="price" class="form-control" name="price" required>
                            </div>

                            <div class="mb-3 col-md-4">
                                <label for="price_color" class="form-label">Price Text Color</label>
                                <input type="text" class="form-control colorpicker" name="price_color" id="price_color">
                            </div>

                            <div class="col-md-4">
                                <label for="price_font_size" class="form-label">Price Text Font Size</label>
                                <select class="form-control select2" name="price_font_size">
                                    <option value="">Select</option>
                                    @for($i=$fontsize['start']; $i<=$fontsize['end']; $i+=$fontsize['range'])
                                        <option value="{{$i}}px">{{$i}}px</option>
                                    @endfor
                               </select>
                            </div>

                            <div class="mb-3 col-md-4">
                                <label for="price_font_family" class="form-label">Price Text Font Family</label>
                                <select class="form-control select2" name="price_font_family">
                                    <option value="">Select</option>
                                        @foreach($fontfamily as $family)
                                            <option value="{{$family['key']}}">{{$family['value']}}</option>
                                        @endforeach
                               </select>
                            </div>

                            <div class="col-md-4">
                                <label for="link" class="form-label">Link<span class="text-danger">*</span></label>
                                <input type="text" id="link" class="form-control" name="link" required>
                            </div>

                            <div class="col-md-4">
                                <label for="driven" class="form-label">Driven<span class="text-danger">*</span></label>
                                <input type="text" id="driven" class="form-control num_only" name="driven" required>
                            </div>

                            <div class="col-md-4">
                                <label for="driven_color" class="form-label">Driven Font Color</label>
                                <input type="text" class="form-control colorpicker" name="driven_color" id="driven_color">
                            </div>

                            <div class="col-md-4">
                                @php($fontsize = fontSize())
                                <label for="driven_font_size" class="form-label">Driven Font Size</label>
                                <select class="form-control select2" name="driven_font_size">
                                    <option value="">Select</option>
                                    @for($i=$fontsize['start']; $i<=$fontsize['end']; $i+=$fontsize['range'])
                                        <option value="{{$i}}px">{{$i}}px</option>
                                    @endfor
                               </select>
                            </div>

                            <div class="mb-3 col-md-4">
                                @php($fontfamily = fontFamily())
                                <label for="driven_font_family" class="form-label">Driven Font Family</label>
                                <select class="form-control select2" name="driven_font_family">
                                    <option value="">Select</option>
                                        @foreach($fontfamily as $family)
                                            <option value="{{$family['key']}}">{{$family['value']}}</option>
                                        @endforeach
                               </select>
                            </div>

                            <div class="col-md-4">
                                <label for="fuel_type" class="form-label">Fuel Type<span class="text-danger">*</span></label>
                                <input type="text" id="fuel_type" class="form-control" name="fuel_type" required>
                            </div>

                            <div class="col-md-4">
                                <label for="fuel_type_color" class="form-label">Fuel Type Font Color</label>
                                <input type="text" class="form-control colorpicker" name="fuel_type_color" id="fuel_type_color">
                            </div>

                            <div class="col-md-4">
                                @php($fontsize = fontSize())
                                <label for="fuel_type_font_size" class="form-label">Fuel Type Font Size</label>
                                <select class="form-control select2" name="fuel_type_font_size">
                                    <option value="">Select</option>
                                    @for($i=$fontsize['start']; $i<=$fontsize['end']; $i+=$fontsize['range'])
                                        <option value="{{$i}}px">{{$i}}px</option>
                                    @endfor
                               </select>
                            </div>

                            <div class="mb-3 col-md-4">
                                @php($fontfamily = fontFamily())
                                <label for="fuel_type_font_family" class="form-label">Fuel Type Font Family</label>
                                <select class="form-control select2" name="fuel_type_font_family">
                                    <option value="">Select</option>
                                        @foreach($fontfamily as $family)
                                            <option value="{{$family['key']}}">{{$family['value']}}</option>
                                        @endforeach
                               </select>
                            </div>

                            <div class="col-md-4">
                                <label for="year" class="form-label">Year<span class="text-danger">*</span></label>
                                <input type="text" id="year" class="form-control" name="year" required>
                            </div>

                            <div class="col-md-4">
                                <label for="year_color" class="form-label">Year Font Color</label>
                                <input type="text" class="form-control colorpicker" name="year_color" id="year_color">
                            </div>

                            <div class="col-md-4">
                                @php($fontsize = fontSize())
                                <label for="year_font_size" class="form-label">year Font Size</label>
                                <select class="form-control select2" name="year_font_size">
                                    <option value="">Select</option>
                                    @for($i=$fontsize['start']; $i<=$fontsize['end']; $i+=$fontsize['range'])
                                        <option value="{{$i}}px">{{$i}}px</option>
                                    @endfor
                               </select>
                            </div>

                            <div class="mb-3 col-md-4">
                                @php($fontfamily = fontFamily())
                                <label for="year_font_family" class="form-label">Year Font Family</label>
                                <select class="form-control select2" name="year_font_family">
                                    <option value="">Select</option>
                                        @foreach($fontfamily as $family)
                                            <option value="{{$family['key']}}">{{$family['value']}}</option>
                                        @endforeach
                               </select>
                            </div>

                            <div class="col-md-4">
                                <label for="body_style" class="form-label">Body Style<span class="text-danger">*</span></label>
                                <input type="text" id="body_style" class="form-control" name="body_style" required>
                            </div>

                            <div class="col-md-4">
                                <label for="body_style_color" class="form-label">Body Style Font Color</label>
                                <input type="text" class="form-control colorpicker" name="body_style_color" id="body_style_color">
                            </div>

                            <div class="col-md-4">
                                @php($fontsize = fontSize())
                                <label for="body_style_font_size" class="form-label">Body Style Font Size</label>
                                <select class="form-control select2" name="body_style_font_size">
                                    <option value="">Select</option>
                                    @for($i=$fontsize['start']; $i<=$fontsize['end']; $i+=$fontsize['range'])
                                        <option value="{{$i}}px">{{$i}}px</option>
                                    @endfor
                               </select>
                            </div>

                            <div class="mb-3 col-md-4">
                                @php($fontfamily = fontFamily())
                                <label for="body_style_font_family" class="form-label">Body Style Font Family</label>
                                <select class="form-control select2" name="body_style_font_family">
                                    <option value="">Select</option>
                                        @foreach($fontfamily as $family)
                                            <option value="{{$family['key']}}">{{$family['value']}}</option>
                                        @endforeach
                               </select>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary submit">Submit</button>
                            <a href="{{ route('car.index') }}" class="btn btn-danger">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
@section('javascript')
<script type="text/javascript" src="{{ url('public/plugins/parsley/parsley.js') }}"></script>
<script>
    $(document).ready(function () {
        // $(".car_form").validate({
        //     rules: {
        //         // 'driven': {
        //         //     number: true,
        //         // },
        //         'year': {
        //             number: true,
        //         },
        //         'car_type': {
        //             required: true,
        //         },
        //     },
        // });
        $('.colorpicker').colorpicker();
    });
</script>
@endsection