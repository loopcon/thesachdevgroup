@extends('admin.layout.header')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            @include('admin.alerts')
        </div>
          <div class="col-sm-6">
            <h1>Home Detail</h1>
          </div>
        </div>
      </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('home_detail_insert') }}" method="POST" class="home_detail_form" enctype="multipart/form-data">
                        @csrf

                        @if(isset($home_details) && count($home_details) > 0)
                            @foreach($home_details as $home_detail)

                            <div class="form-row">
                              <div class="col-md-4 mb-3">
                                  <label for="image">Image<span class="text-danger">*</span></label><small>(Height:479px,Width:540px; Image Type : jpg,jpeg,png,svg,webp)</small>
                                
                                  <input type="hidden" name="old_image" id="old_image" value="{{$home_detail->image}}">

                                  @if(isset($home_detail->image) && isset($home_detail->image))
                                    <img src="{{url('public/home_detail/'.$home_detail->image)}}" width="100" style="margin-bottom: 10px; margin-left: 5px;">
                                  @endif
                                  <input type="file" id="image" class="form-control image" name="image">
                                  <div class="error"></div>
                              </div>
                              <div class="col-md-4 mb-3">
                                <label for="title">Title<span class="text-danger">*</span></label>
                                <input type="text" id="title" class="form-control" name="title" value="{{ $home_detail->title}}">
                                <div class="error"></div>
                              </div>
                              <div class="col-md-4 mb-3">
                                <label for="title_color">Title Text Color</label>
                                <input type="text" class="form-control colorpicker" name="title_color" id="title_color" value="{{ $home_detail->title_color}}">
                                <div class="error"></div>
                            </div>
                            </div>

                            <div class="form-row">
                             
                              <div class="col-md-4 mb-3">
                                @php($fontsize = fontSize())
                                <label for="title_font_size">Title Text Font Size</label>
                                <select class="form-control select2" name="title_font_size">
                                  <option selected="selected" disabled="disabled">Select</option>
                                  @for($i=$fontsize['start']; $i<=$fontsize['end']; $i+=$fontsize['range'])
                                    <option value="{{$i}}px" {{$home_detail->title_font_size == $i.'px' ? 'selected' : ''}}>{{$i}}px</option>
                                  @endfor
                                </select>
                                <div class="error"></div>
                              </div>
                              <div class="col-md-4 mb-3">
                                @php($fontfamily = fontFamily())
                                <label for="title_font_family">Title Text Font Family</label>
                                <select class="form-control select2" name="title_font_family">
                                  <option selected="selected" disabled="disabled">Select</option>
                                  @foreach($fontfamily as $family)
                                    <option value="{{$family['key']}}" {{$home_detail->title_font_family == $family['key'] ? 'selected' : ''}}>{{$family['value']}}</option>
                                  @endforeach
                                </select>
                                  <div class="error"></div>
                              </div>

                              <div class="col-md-4 mb-3">
                                <label for="sub_title">Sub Title<span class="text-danger">*</span></label>
                                <input type="text" id="sub_title" class="form-control" name="sub_title" value="{{ $home_detail->sub_title}}">
                                  <div class="error"></div>
                              </div>
                              
                            </div>

                            <div class="form-row">
                              <div class="col-md-4 mb-3">
                                  <label for="sub_title_color">Sub Title Text Color</label>
                                  <input type="text" class="form-control colorpicker" name="sub_title_color" id="sub_title_color" value="{{ $home_detail->sub_title_color}}">
                                  <div class="error"></div>
                              </div>
                              <div class="col-md-4 mb-3">
                                <label for="sub_title_font_size">Sub Title Text Font Size</label>
                                <select class="form-control select2" name="sub_title_font_size">
                                  <option selected="selected" disabled="disabled">Select</option>
                                  @for($i=$fontsize['start']; $i<=$fontsize['end']; $i+=$fontsize['range'])
                                    <option value="{{$i}}px" {{$home_detail->sub_title_font_size == $i.'px' ? 'selected' : ''}}>{{$i}}px</option>
                                  @endfor
                                </select>
                                <div class="error"></div>
                              </div>
                              <div class="col-md-4 mb-3">
                                <label for="sub_title_font_family">Sub Title Text Font Family</label>
                                <select class="form-control select2" name="sub_title_font_family">
                                  <option selected="selected" disabled="disabled">Select</option>
                                  @foreach($fontfamily as $family)
                                    <option value="{{$family['key']}}" {{$home_detail->sub_title_font_family == $family['key'] ? 'selected' : ''}}>{{$family['value']}}</option>
                                  @endforeach
                                </select>
                                  <div class="error"></div>
                              </div>
                            </div>


                            <div class="mb-3">
                              <label for="description">Description</label>
                              <textarea class="ckeditor form-control" name="description">{{$home_detail->description}}</textarea>
                                <div class="error"></div>
                            </div>
                            
                            <div class="form-row">
                              <div class="col-md-4 mb-3">
                                  <label for="description_color">Description Text Color</label>
                                  <input type="text" class="form-control colorpicker" name="description_color" id="description_color" value="{{ $home_detail->description_color}}">
                                  <div class="error"></div>
                              </div>
                              <div class="col-md-4 mb-3">
                                <label for="description_font_size">Description Text Font Size</label>
                                <select class="form-control select2" name="description_font_size">
                                  <option selected="selected" disabled="disabled">Select</option>
                                  @for($i=$fontsize['start']; $i<=$fontsize['end']; $i+=$fontsize['range'])
                                    <option value="{{$i}}px" {{$home_detail->description_font_size == $i.'px' ? 'selected' : ''}}>{{$i}}px</option>
                                  @endfor
                                </select>
                                <div class="error"></div>
                              </div>
                              <div class="col-md-4 mb-3">
                                <label for="description_font_family">Description Text Font Family</label>
                                <select class="form-control select2" name="description_font_family">
                                  <option selected="selected" disabled="disabled">Select</option>
                                  @foreach($fontfamily as $family)
                                    <option value="{{$family['key']}}" {{$home_detail->description_font_family == $family['key'] ? 'selected' : ''}}>{{$family['value']}}</option>
                                  @endforeach
                                </select>
                                  <div class="error"></div>
                              </div>
                            </div>

                            <div class="form-row">

                              <div class="form-group col-md-4">
                                <label for="our_story_image">Mission Vision Image<span class="text-danger">*</span></label><small>(Height:367px,Width:350px; Image Type : jpg,jpeg,png,svg,webp)</small>
                                
                                  <input type="hidden" name="mission_vision_image" id="mission_vision_image" value="{{$home_detail->our_story_image}}">

                                  @if(isset($home_detail->our_story_image) && isset($home_detail->our_story_image))
                                    <img src="{{url('public/our_story_image/'.$home_detail->our_story_image)}}" width="100" style="margin-bottom: 10px; margin-left: 5px;">
                                  @endif
                                <input type="file" id="our_story_image" class="form-control our_story_image" name="our_story_image">
                                <div class="error"></div>
                              </div>
                            </div>
    
                            @endforeach
                        @else

                        <div class="form-row">
                          <div class="col-md-4 mb-3">
                              <label for="image">Image<span class="text-danger">*</span></label><small>(Height:479px,Width:540px; Image Type : jpg,jpeg,png,svg,webp)</small>
                              <input type="file" id="image" class="form-control image" name="image">
                              <div class="error"></div>
                          </div>
                          <div class="col-md-4 mb-3">
                            <label for="title">Title<span class="text-danger">*</span></label>
                            <input type="text" id="title" class="form-control" name="title">
                            <div class="error"></div>
                          </div>

                          <div class="col-md-4 mb-3">
                            <label for="title_color">Title Text Color</label>
                            <input type="text" class="form-control colorpicker" name="title_color" id="title_color">
                            <div class="error"></div>
                        </div>
                        </div>
                        

                        <div class="form-row">
                          <div class="col-md-4 mb-3">
                            @php($fontsize = fontSize())
                            <label for="title_font_size">Title Text Font Size</label>
                            <select class="form-control select2" name="title_font_size">
                              <option selected="selected" disabled="disabled">Select</option>
                              @for($i=$fontsize['start']; $i<=$fontsize['end']; $i+=$fontsize['range'])
                                  <option value="{{$i}}px">{{$i}}px</option>
                              @endfor
                            </select>
                            <div class="error"></div>
                          </div>
                          <div class="col-md-4 mb-3">
                            @php($fontfamily = fontFamily())
                            <label for="title_font_family">Title Text Font Family</label>
                            <select class="form-control select2" name="title_font_family">
                              <option selected="selected" disabled="disabled">Select</option>
                                  @foreach($fontfamily as $family)
                                    <option value="{{$family['key']}}">{{$family['value']}}</option>
                                  @endforeach
                            </select>
                              <div class="error"></div>
                          </div>
                          <div class="col-md-4 mb-3">
                            <label for="sub_title">Sub Title<span class="text-danger">*</span></label>
                            <input type="text" id="sub_title" class="form-control" name="sub_title">
                              <div class="error"></div>
                          </div>

                        </div>

                      <div class="form-row">
                        <div class="col-md-4 mb-3">
                          <label for="sub_title_color" class="form-label">Sub Title Text Color</label>
                          <input type="text" class="form-control colorpicker" name="sub_title_color" id="sub_title_color">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="sub_title_font_size" class="form-label">Sub Title Text Font Size</label>
                            <select class="form-control select2" name="sub_title_font_size">
                                <option selected="selected" disabled="disabled">Select</option>
                                @for($i=$fontsize['start']; $i<=$fontsize['end']; $i+=$fontsize['range'])
                                  <option value="{{$i}}px">{{$i}}px</option>
                                @endfor
                          </select>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="sub_title_font_family" class="form-label">Sub Title Text Font Family</label>
                            <select class="form-control select2" name="sub_title_font_family">
                                <option selected="selected" disabled="disabled">Select</option>
                                @foreach($fontfamily as $family)
                                  <option value="{{$family['key']}}">{{$family['value']}}</option>
                                @endforeach
                          </select>
                        </div>
                      </div>

                        <div class="mb-3">
                          <label for="description">Description</label>
                          <textarea class="ckeditor form-control" name="description"></textarea>
                            <div class="error"></div>
                        </div>
                        

                        <div class="form-row">
                          <div class="col-md-4 mb-3">
                            <label for="description_color" class="form-label">Description Text Color</label>
                            <input type="text" class="form-control colorpicker" name="description_color" id="description_color">
                          </div>
  
                          <div class="col-md-4 mb-3">
                              <label for="description_font_size" class="form-label">Description Text Font Size</label>
                              <select class="form-control select2" name="description_font_size">
                                  <option selected="selected" disabled="disabled">Select</option>
                                  @for($i=$fontsize['start']; $i<=$fontsize['end']; $i+=$fontsize['range'])
                                    <option value="{{$i}}px">{{$i}}px</option>
                                  @endfor
                            </select>
                          </div>
  
                          <div class="col-md-4 mb-3">
                              <label for="description_font_family" class="form-label">Description Text Font Family</label>
                              <select class="form-control select2" name="description_font_family">
                                  <option selected="selected" disabled="disabled">Select</option>
                                  @foreach($fontfamily as $family)
                                      <option value="{{$family['key']}}">{{$family['value']}}</option>
                                  @endforeach
                            </select>
                          </div>
                        </div>

                        <div class="form-row">

                          <div class="form-group col-md-4">
                            <label for="our_story_image">Mission Vision Image<span class="text-danger">*</span></label><small>(Height:367px,Width:350px; Image Type : jpg,jpeg,png,svg,webp)</small>
                            <input type="file" id="our_story_image" class="form-control our_story_image" name="our_story_image">
                            <div class="error"></div>
                          </div>

                        </div>

                        @endif
                  
                        <div class="form-row">
                          <div class="col-md-6">
                            <button type="submit" class="btn btn-primary">Submit</button>
                          </div>
                      </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
@section('javascript')
<script>
    $(document).ready(function () {
        $(".home_detail_form").validate({
            ignore: [],
            rules: {
                'image': {
                    required: checkImage,
                    extension: "jpg,jpeg,png,webp,svg",
                },
                'title': {
                    required: true,
                },
                'sub_title': {
                    required: true,
                },
                'our_story_image': {
                  required: checkMissionVisionImage,  
                  extension: "jpg,jpeg,png,webp,svg",
                },
            },
            messages: {
                'image': {
                    required: "The image field is required.",
                    extension: "Image must be jpg,jpeg,png,svg or webp.",
                },
                'title': {
                    required: "The title field is required.",
                },
                'sub_title': {
                    required: "The sub title field is required.",
                },
                'our_story_image': {
                    required: "The mission vision image field is required.",
                    extension: "Image must be jpg,jpeg,png,svg or webp.",
                },
            },
            errorPlacement: function(error, element) {
                error.appendTo(element.parent().find('.error'));
            },
        });

        function checkImage() {
          var old_image = $('#old_image').val();
          if(old_image){
            return false;
          }
        }

        function checkMissionVisionImage() {
          var mission_vision_image = $('#mission_vision_image').val();
          if(mission_vision_image){
            return false;
          }
        }


        $('.colorpicker').colorpicker();
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
       $('.ckeditor').ckeditor();
    });
</script>
@endsection
