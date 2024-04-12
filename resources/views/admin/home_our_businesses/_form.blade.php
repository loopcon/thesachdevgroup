@extends('admin.layout.header')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h1>Home Our Businesses Edit</h1>
          </div>
          <div class="col-sm-6 d-none d-sm-block">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Home Our Businesses Edit</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    @foreach($home_our_businesses as $home_our_businesse)
                        <form method="post" action="{{ route('home_our_businesses_update', $home_our_businesse->id) }}" class="edit_form" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" value="{{ $home_our_businesse->id }}" class="id" name="id">
                            <div class="row">
                                <div class="mb-3 col-md-4">
                                    <label for="image" class="form-label">Image<span class="text-danger">*</span></label><small>(Image Type : jpg,jpeg,png,webp)</small>
                                    @if(isset($home_our_businesse->image) && isset($home_our_businesse->image))
                                        <img src="{{url('public/home_our_businesses/'.$home_our_businesse->image)}}" width="100" style="margin-bottom: 10px; margin-left: 5px;">
                                    @endif
                                    <input type="file" id="image" class="form-control" name="image">
                                </div>

                                <div class="col-md-4">
                                    <label for="businesses_title">Businesses Title</label>
                                    <input type="text" id="businesses_title" class="form-control" name="businesses_title" value="{{$home_our_businesse->businesses_title}}">
                                </div>

                                <div class="col-md-4">
                                    <label for="businesses_title_color">Businesses Title Text Color</label>
                                    <input type="text" class="form-control colorpicker" name="businesses_title_color" id="businesses_title_color" value="{{$home_our_businesse->businesses_title_color}}">
                                </div>

                                <div class="mb-3 col-md-4">
                                    @php($fontsize = fontSize())
                                    <label for="businesses_title_font_size">Businesses Title Text Font Size</label>
                                    <select class="form-control select2" name="businesses_title_font_size">
                                        <option selected="selected" disabled="disabled">Select</option>
                                        @for($i=$fontsize['start']; $i<=$fontsize['end']; $i+=$fontsize['range'])
                                            <option value="{{$i}}px" {{$home_our_businesse->businesses_title_font_size == $i.'px' ? 'selected' : ''}}>{{$i}}px</option>
                                        @endfor
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    @php($fontfamily = fontFamily())
                                    <label for="businesses_title_font_family">Businesses Title Text Font Family</label>
                                    <select class="form-control select2" name="businesses_title_font_family">
                                      <option selected="selected" disabled="disabled">Select</option>
                                      @foreach($fontfamily as $family)
                                        <option value="{{$family['key']}}" {{$home_our_businesse->businesses_title_font_family == $family['key'] ? 'selected' : ''}}>{{$family['value']}}</option>
                                      @endforeach
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label for="link">Link</label>
                                    <input type="text" id="link" class="form-control" name="link" value="{{$home_our_businesse->link}}">
                                </div>

                                <div class="mb-3 col-md-4">
                                    <label for="background_color">Background Color</label>
                                    <input type="text" id="background_color" class="form-control colorpicker" name="background_color" value="{{$home_our_businesse->background_color}}">
                                </div>

                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary submit">Submit</button>
                                <a href="{{ route('home_our_businesses.index') }}" class="btn btn-danger">Cancel</a>
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
                    extension: "jpg,jpeg,png,webp,svg",
                },
            },
            messages: {
                image: {
                    extension: "Image must be jpg,jpeg,png or webp.",
                },
            },
        });
        $('.colorpicker').colorpicker();
    });
</script>
@endsection
  