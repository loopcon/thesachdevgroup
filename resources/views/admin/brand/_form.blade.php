@extends('admin.layout.header')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h1>Brand</h1>
          </div>
          <div class="col-sm-6 d-none d-sm-block">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Brand</li>
            </ol>
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
                                <div class="col-md-4">
                                    <label for="image" class="form-label">Image</label>
                                    @if($brand->image == null)
                                        <img src="{{url('public/no_image/notImg.png')}}" width="100">
                                    @else
                                        <img src="{{url('public/brand/'.$brand->image)}}" width="100">
                                    @endif
                                    <input type="file" id="image" class="form-control" name="image">
                                    <div class="error"></div>
                                </div>
    
                                <div class="col-md-4">
                                    <label for="name" class="form-label">Name</label>
                                    <input  type="text" class="form-control" name="name" value="{{$brand->name}}">
                                    <div class="error"></div>
                                </div>
    
                                <div class="col-md-4">
                                    <label for="color" class="form-label">Color</label>
                                    <input type="text" class="form-control colorpicker" name="color" id="color" value="{{$brand->color}}">
                                </div>
    
                                <div class="mb-3 col-md-4">
                                    <label for="font_size" class="form-label">Font Size</label>
                                    <select class="form-control select2" name="font_size">
                                        <option selected="selected" disabled="disabled">Select Font Size</option>
                                        @for($i=24; $i<=50; $i+=2)
                                            <option value="{{$i}}px" {{$brand->font_size == $i.'px' ? 'selected' : ''}}>{{$i}}px</option>
                                        @endfor
                                   </select>
                                </div>
    
                                <div class="col-md-4">
                                    <label for="font_family" class="form-label">Font Family</label>
                                    <select class="form-control select2" name="font_family">
                                        <option selected="selected" disabled="disabled">Select Font Family</option>
                                        <option value="poppins"  {{$brand->font_family == 'poppins' ? 'selected' : ''}}>Poppins</option>
                                        <option value="sans-serif" {{$brand->font_family == 'sans-serif' ? 'selected' : ''}}>Sans Serif</option>
                                   </select>
                                </div>
                            </div>
    
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary submit">Submit</button>
                                <a href="{{ route('brand.index') }}" class="btn btn-default">Cancel</a>
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
            },
            messages: {
                'image': {
                    extension: "The image must be an image.",
                },
                'name': {
                    required: "The name field is required.",
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

  