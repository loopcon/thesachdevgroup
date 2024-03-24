@extends('admin.layout.header')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h1>Home Slider</h1>
          </div>
          <div class="col-sm-6 d-none d-sm-block">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Home Slider</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    @foreach($homesliders as $homeslider)
                        <form method="post" action="{{ route('homeslider_update', $homeslider->id) }}" class="edit_form" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" value="{{ $homeslider->id }}" class="id" name="id">
                           
                            <div class="row">
                                <div class="mb-3 col-md-4">
                                    <label for="image" class="form-label">Image</label>
                                    @if($homeslider->image == null)
                                    <img src="{{asset('no_image/notImg.png')}}" width="100">
                                    @else
                                    <img src="{{url('public/home_slider/'.$homeslider->image)}}" width="100">
                                @endif
                                    <input type="file" id="image" class="form-control" name="image">
                                </div>
    
                                <div class="col-md-4">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" id="title" class="form-control" name="title" value="{{$homeslider->title}}">
                                </div>
    
                                <div class="mb-3 col-md-4">
                                    <label for="subtitle" class="form-label">Sub Title</label>
                                    <input type="text" id="subtitle" class="form-control" name="subtitle" value="{{$homeslider->subtitle}}">
                                </div>
    
    
                                <div class="mb-3 col-md-4">
                                    <label for="color" class="form-label">Color</label>
                                    <input type="text" class="form-control colorpicker" name="color" id="color" value="{{$homeslider->color}}">
                                </div>
    
                                <div class="mb-3 col-md-4">
                                    <label for="font_size" class="form-label">Font Size</label>
                                    <select class="form-control select2" name="font_size">
                                        <option selected="selected" disabled="disabled">Select Font Size</option>
                                        @for($i=24; $i<=50; $i+=2)
                                            <option value="{{$i}}px" {{$homeslider->font_size == $i.'px' ? 'selected' : ''}}>{{$i}}px</option>
                                        @endfor
                                   </select>
                                </div>
    
                                <div class="col-md-4">
                                    <label for="font_family" class="form-label">Font Family</label>
                                    <select class="form-control select2" name="font_family">
                                        <option selected="selected" disabled="disabled">Select Font Family</option>
                                        <option value="poppins"  {{$homeslider->font_family == 'poppins' ? 'selected' : ''}}>Poppins</option>
                                        <option value="sans-serif" {{$homeslider->font_family == 'sans-serif' ? 'selected' : ''}}>Sans Serif</option>
                                   </select>
                                </div>
    
                                
                                <div class="mb-3 col-md-4">
                                    <label for="image" class="form-label">Text Position</label>
                                    <select class="form-control select2" name="text_position">
                                        <option selected="selected" disabled="disabled">Text Position</option>
                                        <option value="left" {{$homeslider->text_position == 'left' ? 'selected' : ''}}>Left</option>
                                        <option value="right" {{$homeslider->text_position == 'right' ? 'selected' : ''}}>Right</option>
                                   </select>
                                </div>
    
                            </div>
    
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary submit">Submit</button>
                                <a href="{{ route('homeslider.index') }}" class="btn btn-default">Cancel</a>
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
                image: {
                    extension: "jpg,jpeg,png",
                },
            },
            messages: {
                image: {
                    extension: "The image must be an image.",
                },
            },
        });

        $('.colorpicker').colorpicker();
    });
</script>
@endsection