@extends('admin.layout.header')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h1>Car Edit</h1>
          </div>
          <div class="col-sm-6 d-none d-sm-block">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Car Edit</li>
            </ol>
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
                                <div class="mb-3 col-md-4">
                                    <label for="brand_id" class="form-label">Select Brand<span class="text-danger">*</span></label>
                                    <select name="brand_id" id="brand_id" class="form-control select2">
                                        <option selected="selected" disabled="disabled">Select</option>
                                        @foreach($brands as $brand)
                                            <option value="{{$brand->id}}" {{$car->brand_id == $brand->id  ? 'selected' : ''}}>
                                                {{$brand->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
    
                                <div class="col-md-4">
                                    <label for="image" class="form-label">Image<span class="text-danger">*</span></label>
                                    @if($car->image == null)
                                        <img src="{{url('public/no_image/notImg.png')}}" width="100">
                                    @else
                                        <img src="{{url('public/car/'.$car->image)}}" width="100">
                                    @endif
                                    <input type="file" id="image" class="form-control" name="image">
                                    <div class="error"></div>
                                </div>
    
                                <div class="col-md-4">
                                    <label for="name" class="form-label">Name<span class="text-danger">*</span></label>
                                    <input  type="text" class="form-control" name="name" value="{{$car->name}}">
                                    <div class="error"></div>
                                </div>
    
                                <div class="mb-3 col-md-4">
                                    <label for="price" class="form-label">Price<span class="text-danger">*</span></label>
                                    <input  type="text" class="form-control" name="price" value="{{$car->price}}">
                                    <div class="error"></div>
                                </div>
    
                                <div class="col-md-4">
                                    <label for="link" class="form-label">Link<span class="text-danger">*</span></label>
                                    <input  type="text" class="form-control" name="link" value="{{$car->link}}">
                                    <div class="error"></div>
                                </div>
    
                                <div class="col-md-4">
                                    <label for="name_color" class="form-label">Name Text Color</label>
                                    <input type="text" class="form-control colorpicker" name="name_color" id="name_color" value="{{$car->name_color}}">
                                </div>
    
                                <div class="mb-3 col-md-4">
                                    <label for="price_color" class="form-label">Price Text Color</label>
                                    <input type="text" class="form-control colorpicker" name="price_color" id="price_color" value="{{$car->price_color}}">
                                </div>
    
                               
                                <div class="col-md-4">
                                    <label for="name_font_size" class="form-label">Name Text Font Size</label>
                                    <select class="form-control select2" name="name_font_size">
                                        <option selected="selected" disabled="disabled">Select</option>
                                        @for($i=24; $i<=50; $i+=2)
                                            <option value="{{$i}}px" {{$car->name_font_size == $i.'px' ? 'selected' : ''}}>{{$i}}px</option>
                                        @endfor
                                   </select>
                                </div>
    
                                <div class="col-md-4">
                                    <label for="price_font_size" class="form-label">Price Text Font Size</label>
                                    <select class="form-control select2" name="price_font_size">
                                        <option selected="selected" disabled="disabled">Select</option>
                                        @for($i=24; $i<=50; $i+=2)
                                        <option value="{{$i}}px" {{$car->price_font_size == $i.'px' ? 'selected' : ''}}>{{$i}}px</option>
                                        @endfor
                                   </select>
                                </div>
    
                                <div class="mb-3 col-md-4">
                                    <label for="name_font_family" class="form-label">Name Text Font Family</label>
                                    <select class="form-control select2" name="name_font_family">
                                        <option selected="selected" disabled="disabled">Select</option>
                                        <option value="poppins"  {{$car->name_font_family == 'poppins' ? 'selected' : ''}}>Poppins</option>
                                            <option value="sans-serif" {{$car->name_font_family == 'sans-serif' ? 'selected' : ''}}>Sans Serif</option>
                                   </select>
                                </div>
    
                                <div class="col-md-4">
                                    <label for="price_font_family" class="form-label">Price Text Font Family</label>
                                    <select class="form-control select2" name="price_font_family">
                                        <option selected="selected" disabled="disabled">Select</option>
                                        <option value="poppins"  {{$car->price_font_family == 'poppins' ? 'selected' : ''}}>Poppins</option>
                                        <option value="sans-serif" {{$car->price_font_family == 'sans-serif' ? 'selected' : ''}}>Sans Serif</option>
                                   </select>
                                </div>
                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary submit">Submit</button>
                                <a href="{{ route('car.index') }}" class="btn btn-default">Cancel</a>
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
<script>
    $(document).ready(function () {
        $(".edit_form").validate({
            rules: {
                'image': {
                    extension: "jpg,jpeg,png",
                },
                'name': {
                    required: true,
                },
                'price': {
                    required: true,
                },
                'link': {
                    url: "url",
                    required: true,
                },
            },
            messages: {
                'image': {
                    extension: "The image must be an image.",
                },
                'name': {
                    required: "The name field is required.",
                },
                'price': {
                    required: "The price field is required.",
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
        $('.colorpicker').colorpicker();

    });
</script>
@endsection

  