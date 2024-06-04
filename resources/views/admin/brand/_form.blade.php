@extends('admin.layout.header')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h1>Brand Edit</h1>
          </div>
        </div>
      </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    @foreach($brands as $brand)
                        <form method="post" action="{{ route('brand_update', $brand->id) }}" class="edit_form" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" value="{{ $brand->id }}" class="id" name="id">
                            <div class="row">
                                <div class="mb-3 col-md-4">
                                    <label for="image" class="form-label">Image<span class="text-danger">*</span></label>
                                    @if(isset($brand->image) && isset($brand->image))
                                        <img src="{{url('public/brand/'.$brand->image)}}" width="100" style="margin-bottom: 10px;">
                                    @endif
                                    <input type="file" id="image" class="form-control" name="image">
                                    <div class="error"></div>
                                    <small class="image_type">(Height:145px,Width:145px;Image Type : jpg,jpeg,png,svg,webp)</small>
                                </div>
    
                                <div class="col-md-4">
                                    <label for="name" class="form-label">Name<span class="text-danger">*</span></label>
                                    <input  type="text" class="form-control" name="name" value="{{$brand->name}}">
                                    <div class="error"></div>
                                </div>
    
                                <div class="col-md-4">
                                    <label for="color" class="form-label">Name Text Color</label>
                                    <input type="text" class="form-control colorpicker" name="color" id="color" value="{{$brand->color}}">
                                </div>
    
                                <div class="mb-3 col-md-4">
                                    @php($fontsize = fontSize())
                                    <label for="font_size" class="form-label">Name Text Font Size</label>
                                    <select class="form-control select2" name="font_size">
                                        <option value="">Select</option>
                                        @for($i=$fontsize['start']; $i<=$fontsize['end']; $i+=$fontsize['range'])
                                            <option value="{{$i}}px" {{$brand->font_size == $i.'px' ? 'selected' : ''}}>{{$i}}px</option>
                                        @endfor
                                   </select>
                                </div>
    
                                <div class="col-md-4">
                                    @php($fontfamily = fontFamily())
                                    <label for="font_family" class="form-label">Name Text Font Family</label>
                                    <select class="form-control select2" name="font_family">
                                        <option value="">Select</option>
                                        @foreach($fontfamily as $family)
                                            <option value="{{$family['key']}}" {{$brand->font_family == $family['key'] ? 'selected' : ''}}>{{$family['value']}}</option>
                                        @endforeach
                                   </select>
                                </div>

                                <div class="col-md-4">
                                    <label for="link" class="form-label">Link<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" value="{{$brand->link}}" name="link">
                                    <div class="error"></div>
                                </div>

                                <div class="box-footer">
                                    <button type="submit" class="btn btn-primary submit">Submit</button>
                                    <a href="{{ route('brand.index') }}" class="btn btn-danger">Cancel</a>
                                </div>
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
                    extension: "jpg,jpeg,png,webp,svg",
                },
                'name': {
                    required: true,
                },
                'link': {
                    required: true,
                    url: "url",
                },
            },
            messages: {
                'image': {
                    extension: "Image must be jpg,jpeg,png,svg or webp.",
                },
                'name': {
                    required: "The name field is required.",
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

  