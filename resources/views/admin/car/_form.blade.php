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
            <h1>Car Model Edit</h1>
          </div>
        </div>
      </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    @foreach($cars as $car)
                        <form method="post" action="{{ route('car_update', $car->id) }}" class="edit_form" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" value="{{ $car->id }}" class="id" name="id">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="brand_id" class="form-label">Select Brand<span class="text-danger">*</span></label>
                                    <select name="brand_id" id="brand_id" class="form-control select2">
                                        <option value="">Select</option>
                                        @foreach($brands as $brand)
                                            <option value="{{$brand->id}}" {{$car->brand_id == $brand->id  ? 'selected' : ''}}>
                                                {{$brand->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
    
                                <div class="col-md-4">
                                    <label for="image" class="form-label">Image<span class="text-danger">*</span></label>
                                    <input type="hidden" name="old_image" id="old_image" value="{{isset($car->image) ? $car->image : ''}}">
                                    @if(isset($car->image) && isset($car->image))
                                        <img src="{{url('public/car/'.$car->image)}}" width="100" style="margin-bottom: 10px; margin-left: 5px;">
                                    @endif
                                    <input type="file" id="image" class="form-control" name="image" requird>
                                    <div class="error"></div>
                                    <small class="image_type">(Height:219px,Width:348px; Image Type : jpg,jpeg,png,svg,webp)</small>
                                </div>
    
                                <div class="col-md-4">
                                    <label for="name" class="form-label">Name<span class="text-danger">*</span></label>
                                    <input  type="text" class="form-control" name="name" value="{{$car->name}}" required>
                                    <div class="error"></div>
                                </div>

                                <div class="col-md-4">
                                    <label for="name_color" class="form-label">Name Text Color</label>
                                    <input type="text" class="form-control colorpicker" name="name_color" id="name_color" value="{{$car->name_color}}">
                                </div>

                                <div class="col-md-4">
                                    @php($fontsize = fontSize())
                                    <label for="name_font_size" class="form-label">Name Text Font Size</label>
                                    <select class="form-control select2" name="name_font_size">
                                        <option value="">Select</option>
                                        @for($i=$fontsize['start']; $i<=$fontsize['end']; $i+=$fontsize['range'])
                                            <option value="{{$i}}px" {{$car->name_font_size == $i.'px' ? 'selected' : ''}}>{{$i}}px</option>
                                        @endfor
                                   </select>
                                </div>

                                <div class="mb-3 col-md-4">
                                    @php($fontfamily = fontFamily())
                                    <label for="name_font_family" class="form-label">Name Text Font Family</label>
                                    <select class="form-control select2" name="name_font_family">
                                        <option value="">Select</option>
                                        @foreach($fontfamily as $family)
                                            <option value="{{$family['key']}}" {{$car->name_font_family == $family['key'] ? 'selected' : ''}}>{{$family['value']}}</option>
                                        @endforeach
                                   </select>
                                </div>
    
                                <div class="mb-3 col-md-4">
                                    <label for="price" class="form-label">Price<span class="text-danger">*</span></label>
                                    <input  type="text" class="form-control" name="price" value="{{$car->price}}" required>
                                    <div class="error"></div>
                                </div>

                                <div class="mb-3 col-md-4">
                                    <label for="price_color" class="form-label">Price Text Color</label>
                                    <input type="text" class="form-control colorpicker" name="price_color" id="price_color" value="{{$car->price_color}}">
                                </div>
    
                                <div class="col-md-4">
                                    <label for="price_font_size" class="form-label">Price Text Font Size</label>
                                    <select class="form-control select2" name="price_font_size">
                                        <option value="">Select</option>
                                        @for($i=$fontsize['start']; $i<=$fontsize['end']; $i+=$fontsize['range'])
                                            <option value="{{$i}}px" {{$car->price_font_size == $i.'px' ? 'selected' : ''}}>{{$i}}px</option>
                                        @endfor
                                   </select>
                                </div>
    
                                <div class="mb-3 col-md-4">
                                    <label for="price_font_family" class="form-label">Price Text Font Family</label>
                                    <select class="form-control select2" name="price_font_family">
                                        <option value="">Select</option>
                                        @foreach($fontfamily as $family)
                                            <option value="{{$family['key']}}" {{$car->price_font_family == $family['key'] ? 'selected' : ''}}>{{$family['value']}}</option>
                                        @endforeach
                                   </select>
                                </div>
    
                                <div class="col-md-4">
                                    <label for="link" class="form-label">Link<span class="text-danger">*</span></label>
                                    <input  type="text" class="form-control" name="link" value="{{$car->link}}" required>
                                    <div class="error"></div>
                                </div>

                                <div class="col-md-4">
                                    <label for="driven" class="form-label">Driven<span class="text-danger">*</span></label>
                                    <input type="text" id="driven" class="form-control" name="driven" value="{{$car->driven}}" required>
                                </div>

                                <div class="col-md-4">
                                    <label for="driven_color" class="form-label">Driven Font Color</label>
                                    <input type="text" class="form-control colorpicker" name="driven_color" value="{{$car->driven_color}}" id="driven_color">
                                </div>

                                <div class="col-md-4">
                                    @php($fontsize = fontSize())
                                    <label for="driven_font_size" class="form-label">Driven Font Size</label>
                                    <select class="form-control select2" name="driven_font_size">
                                        <option value="">Select</option>
                                        @for($i=$fontsize['start']; $i<=$fontsize['end']; $i+=$fontsize['range'])
                                            <option value="{{$i}}px" {{$car->driven_font_size == $i.'px' ? 'selected' : ''}}>{{$i}}px</option>
                                        @endfor
                                    </select>
                                </div>

                                <div class="mb-3 col-md-4">
                                    @php($fontfamily = fontFamily())
                                    <label for="driven_font_family" class="form-label">Driven Font Family</label>
                                    <select class="form-control select2" name="driven_font_family">
                                        <option value="">Select</option>
                                        @foreach($fontfamily as $family)
                                            <option value="{{$family['key']}}" {{$car->driven_font_family == $family['key'] ? 'selected' : ''}}>{{$family['value']}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label for="fuel_type" class="form-label">Fuel Type<span class="text-danger">*</span></label>
                                    <input type="text" id="fuel_type" class="form-control" name="fuel_type" value="{{$car->fuel_type}}" required>
                                </div>

                                <div class="col-md-4">
                                    <label for="fuel_type_color" class="form-label">Fuel Type Font Color</label>
                                    <input type="text" class="form-control colorpicker" name="fuel_type_color" value="{{$car->fuel_type_color}}" id="fuel_type_color">
                                </div>

                                <div class="col-md-4">
                                    @php($fontsize = fontSize())
                                    <label for="fuel_type_font_size" class="form-label">Fuel Type Font Size</label>
                                    <select class="form-control select2" name="fuel_type_font_size">
                                        <option value="">Select</option>
                                        @for($i=$fontsize['start']; $i<=$fontsize['end']; $i+=$fontsize['range'])
                                            <option value="{{$i}}px" {{$car->fuel_type_font_size == $i.'px' ? 'selected' : ''}}>{{$i}}px</option>
                                        @endfor
                                    </select>
                                </div>

                                <div class="mb-3 col-md-4">
                                    @php($fontfamily = fontFamily())
                                    <label for="fuel_type_font_family" class="form-label">Fuel Type Font Family</label>
                                    <select class="form-control select2" name="fuel_type_font_family">
                                        <option value="">Select</option>
                                        @foreach($fontfamily as $family)
                                            <option value="{{$family['key']}}" {{$car->fuel_type_font_family == $family['key'] ? 'selected' : ''}}>{{$family['value']}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label for="year" class="form-label">Year<span class="text-danger">*</span></label>
                                    <input type="text" id="year" class="form-control" name="year" value="{{$car->year}}" required>
                                </div>

                                <div class="col-md-4">
                                    <label for="year_color" class="form-label">Year Font Color</label>
                                    <input type="text" class="form-control colorpicker" name="year_color" value="{{$car->year_color}}" id="year_color">
                                </div>

                                <div class="col-md-4">
                                    @php($fontsize = fontSize())
                                    <label for="year_font_size" class="form-label">year Font Size</label>
                                    <select class="form-control select2" name="year_font_size">
                                        <option value="">Select</option>
                                        @for($i=$fontsize['start']; $i<=$fontsize['end']; $i+=$fontsize['range'])
                                            <option value="{{$i}}px" {{$car->year_font_size == $i.'px' ? 'selected' : ''}}>{{$i}}px</option>
                                        @endfor
                                    </select>
                                </div>

                                <div class="mb-3 col-md-4">
                                    @php($fontfamily = fontFamily())
                                    <label for="year_font_family" class="form-label">Year Font Family</label>
                                    <select class="form-control select2" name="year_font_family">
                                        <option value="">Select</option>
                                        @foreach($fontfamily as $family)
                                            <option value="{{$family['key']}}" {{$car->year_font_family == $family['key'] ? 'selected' : ''}}>{{$family['value']}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label for="body_style" class="form-label">Body Style<span class="text-danger">*</span></label>
                                    <input type="text" id="body_style" class="form-control" name="body_style" value="{{$car->body_style}}" required>
                                </div>

                                <div class="col-md-4">
                                    <label for="body_style_color" class="form-label">Body Style Font Color</label>
                                    <input type="text" class="form-control colorpicker" name="body_style_color" value="{{$car->body_style_color}}" id="body_style_color">
                                </div>

                                <div class="col-md-4">
                                    @php($fontsize = fontSize())
                                    <label for="body_style_font_size" class="form-label">Body Style Font Size</label>
                                    <select class="form-control select2" name="body_style_font_size">
                                        <option value="">Select</option>
                                        @for($i=$fontsize['start']; $i<=$fontsize['end']; $i+=$fontsize['range'])
                                            <option value="{{$i}}px" {{$car->body_style_font_size == $i.'px' ? 'selected' : ''}}>{{$i}}px</option>
                                        @endfor
                                    </select>
                                </div>

                                <div class="mb-3 col-md-4">
                                    @php($fontfamily = fontFamily())
                                    <label for="body_style_font_family" class="form-label">Body Style Font Family</label>
                                    <select class="form-control select2" name="body_style_font_family">
                                        <option value="">Select</option>
                                        @foreach($fontfamily as $family)
                                            <option value="{{$family['key']}}" {{$car->body_style_font_family == $family['key'] ? 'selected' : ''}}>{{$family['value']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary submit">Submit</button>
                                <a href="{{ route('car.index') }}" class="btn btn-danger">Cancel</a>
                            </div>
                        </form>
                    @endforeach 
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
        $(".edit_form").validate({
            rules: {
                // 'driven': {
                //     number: true,
                // },
                'year': {
                    number: true,
                },
            },
        });
        $('.colorpicker').colorpicker();

        // image validation
        var old_image = $('#old_image').val();
        var image = $('#image').val();
        if(old_image != '' || image != ''){
            document.getElementById("image").required = false;
        }else{
            document.getElementById("image").required = true;
        }
    });
</script>
@endsection

  