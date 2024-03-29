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
          <div class="col-sm-6 d-none d-sm-block">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Home Detail</li>
            </ol>
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
                                  <label for="image">Image<span class="text-danger">*</span></label>
                                  @if($home_detail->image == null)
                                      <img src="{{url('public/no_image/notImg.png')}}" width="100">
                                  @else
                                      <img src="{{url('public/home_detail/'.$home_detail->image)}}" width="100">
                                  @endif
                                  <input type="file" id="image" class="form-control" name="image">
                                  <div class="error"></div>
                              </div>
                              <div class="col-md-4 mb-3">
                                <label for="title">Title<span class="text-danger">*</span></label>
                                <input type="text" id="title" class="form-control" name="title" value="{{ $home_detail->title}}">
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
                                  <label for="title_color">Title Text Color</label>
                                  <input type="text" class="form-control colorpicker" name="title_color" id="title_color" value="{{ $home_detail->title_color}}">
                                  <div class="error"></div>
                              </div>
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
                              <label for="description">Description<span class="text-danger">*</span></label>
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
                                <div class="col-md-4 mb-3">
                                  <label for="our_story_image">Mission Vision Image<span class="text-danger">*</span></label>
                                  @if($home_detail->our_story_image == null)
                                  <img src="{{url('public/no_image/notImg.png')}}" width="100">
                                  @else
                                      <img src="{{url('public/our_story_image/'.$home_detail->our_story_image)}}" width="100">
                                  @endif
                                  <input type="file" id="our_story_image" class="form-control" name="our_story_image">
                                  <div class="error"></div>
                              </div>

                              <div class="col-md-4 mb-3">
                                <label for="businesses_title">Businesses Title</label>
                                <input type="text" id="businesses_title" class="form-control" name="businesses_title" value="{{ $home_detail->businesses_title}}">
                                <div class="error"></div>
                              </div>

                              <div class="col-md-4 mb-3">
                                <label for="testimonials_title">Testimonials Title</label>
                                <input type="text" id="testimonials_title" class="form-control" name="testimonials_title" value="{{ $home_detail->testimonials_title}}">
                                <div class="error"></div>
                              </div>
    

                            </div>


                        <div class="col-12"><h5><b>Count</b></h5></div>
                        <hr>
                        <div class="form-row">
                          <div class="col-md-4 mb-3">
                              <label for="icon">Icon<span class="text-danger">*</span></label>
                              @if($home_detail->icon == null)
                                  <img src="{{url('public/no_image/notImg.png')}}" width="100">
                              @else
                                  <img src="{{url('public/icon/'.$home_detail->icon)}}" width="100">
                              @endif
                              <input type="file" class="form-control" name="icon" id="icon">
                              <div class="error"></div>
                          </div>
                          <div class="col-md-4 mb-3">
                            <label for="amount">Amount</label>
                            <input type="number" class="form-control" name="amount" id="amount" value="{{ $home_detail->amount}}">
                            <div class="error"></div>
                          </div>
                          <div class="col-md-4 mb-3">
                              <label for="name">Name</label>
                              <input type="text" class="form-control" name="name" id="name" value="{{ $home_detail->name}}">
                              <div class="error"></div>
                          </div>
                        </div>

                        <div class="form-row">
                          <div class="col-md-4 mb-3">
                            <label for="count_amount_color">Count Amount Text Color</label>
                            <input type="text" class="form-control colorpicker" name="count_amount_color" id="count_amount_color" value="{{ $home_detail->count_amount_color}}">
                            <div class="error"></div>
                          </div>
                          <div class="col-md-4 mb-3">
                            <label for="count_name_color">Count Name Text Color</label>
                            <input type="text" class="form-control colorpicker" name="count_name_color" id="count_name_color" value="{{ $home_detail->count_name_color}}">
                              <div class="error"></div>
                          </div>
                          <div class="col-md-4 mb-3">
                            <label for="count_background_color">Count Background Color</label>
                            <input type="text" class="form-control colorpicker" name="count_background_color" id="count_background_color" value="{{ $home_detail->count_background_color}}">
                              <div class="error"></div>
                          </div>
                        </div>

                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="count_amount_font_size">Count Amount Text Font Size</label>
                            <select class="form-control select2" name="count_amount_font_size">
                              <option selected="selected" disabled="disabled">Select</option>
                              @for($i=$fontsize['start']; $i<=$fontsize['end']; $i+=$fontsize['range'])
                                <option value="{{$i}}px" {{$home_detail->count_amount_font_size == $i.'px' ? 'selected' : ''}}>{{$i}}px</option>
                              @endfor
                            </select>
                            <div class="error"></div>
                          </div>
                          <div class="form-group col-md-6">
                            <label for="count_name_font_size">Count Name Text Font Size</label>
                              <select class="form-control select2" name="count_name_font_size">
                                <option selected="selected" disabled="disabled">Select</option>
                                @for($i=$fontsize['start']; $i<=$fontsize['end']; $i+=$fontsize['range'])
                                  <option value="{{$i}}px" {{$home_detail->count_name_font_size == $i.'px' ? 'selected' : ''}}>{{$i}}px</option>
                                @endfor
                              </select>
                              <div class="error"></div>
                          </div>
                        </div>

                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="count_amount_font_family">Count Amount Text Font Family</label>
                            <select class="form-control select2" name="count_amount_font_family">
                              <option selected="selected" disabled="disabled">Select</option>
                              @foreach($fontfamily as $family)
                                <option value="{{$family['key']}}" {{$home_detail->count_amount_font_family == $family['key'] ? 'selected' : ''}}>{{$family['value']}}</option>
                              @endforeach
                            </select>
                            <div class="error"></div>
                          </div>
                          <div class="form-group col-md-6">
                            <label for="count_name_font_family">Count Name Text Font Family</label>
                            <select class="form-control select2" name="count_name_font_family">
                              <option selected="selected" disabled="disabled">Select</option>
                                @foreach($fontfamily as $family)
                                  <option value="{{$family['key']}}" {{$home_detail->count_name_font_family == $family['key'] ? 'selected' : ''}}>{{$family['value']}}</option>
                                @endforeach
                            </select>
                              <div class="error"></div>
                          </div>
                        </div>

                            @endforeach
                        @else

                        <div class="form-row">
                          <div class="col-md-4 mb-3">
                              <label for="image">Image<span class="text-danger">*</span></label>
                              <input type="file" id="image" class="form-control" name="image">
                              <div class="error"></div>
                          </div>
                          <div class="col-md-4 mb-3">
                            <label for="title">Title<span class="text-danger">*</span></label>
                            <input type="text" id="title" class="form-control" name="title">
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
                              <label for="title_color">Title Text Color</label>
                              <input type="text" class="form-control colorpicker" name="title_color" id="title_color">
                              <div class="error"></div>
                          </div>
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
                          <label for="description">Description<span class="text-danger">*</span></label>
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
                              <label for="our_story_image">Mission Vision Image<span class="text-danger">*</span></label>
                              <input type="file" id="our_story_image" class="form-control" name="our_story_image">
                              <div class="error"></div>
                          </div>

                          <div class="form-group col-md-4">
                            <label for="businesses_title">Businesses Title</label>
                            <input type="text" id="businesses_title" class="form-control" name="businesses_title">
                            <div class="error"></div>
                        </div>


                        <div class="form-group col-md-4">
                          <label for="testimonials_title">Testimonials Title</label>
                          <input type="text" id="testimonials_title" class="form-control" name="testimonials_title">
                          <div class="error"></div>
                      </div>
                        </div>
                        
                        <div class="col-12"><h5><b>Count</b></h5></div>

                        <hr>
                        <div class="form-row">
                          <div class="col-md-4 mb-3">
                              <label for="icon">Icon</label>
                              <input type="file" class="form-control" name="icon" id="icon">
                              <div class="error"></div>
                          </div>
                          <div class="col-md-4 mb-3">
                            <label for="amount">Amount</label>
                            <input type="number" class="form-control" name="amount" id="amount">
                            <div class="error"></div>
                          </div>
                          <div class="col-md-4 mb-3">
                              <label for="name">Name</label>
                              <input type="text" class="form-control" name="name" id="name">
                              <div class="error"></div>
                          </div>
                        </div>

                        <div class="form-row">
                          <div class="col-md-4 mb-3">
                            <label for="count_amount_color">Count Amount Text Color</label>
                            <input type="text" class="form-control colorpicker" name="count_amount_color" id="count_amount_color">
                            <div class="error"></div>
                          </div>
                          <div class="col-md-4 mb-3">
                            <label for="count_name_color">Count Name Text Color</label>
                            <input type="text" class="form-control colorpicker" name="count_name_color" id="count_name_color">
                              <div class="error"></div>
                          </div>
                          <div class="col-md-4 mb-3">
                            <label for="count_background_color">Count Background Color</label>
                            <input type="text" class="form-control colorpicker" name="count_background_color" id="count_background_color">
                              <div class="error"></div>
                          </div>
                        </div>

                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="count_amount_font_size">Count Amount Text Font Size</label>
                            <select class="form-control select2" name="count_amount_font_size">
                              <option selected="selected" disabled="disabled">Select</option>
                              @for($i=$fontsize['start']; $i<=$fontsize['end']; $i+=$fontsize['range'])
                                <option value="{{$i}}px">{{$i}}px</option>
                              @endfor
                            </select>
                            <div class="error"></div>
                          </div>
                          <div class="form-group col-md-6">
                            <label for="count_name_font_size">Count Name Text Font Size</label>
                              <select class="form-control select2" name="count_name_font_size">
                                <option selected="selected" disabled="disabled">Select</option>
                                @for($i=$fontsize['start']; $i<=$fontsize['end']; $i+=$fontsize['range'])
                                  <option value="{{$i}}px">{{$i}}px</option>
                                @endfor
                              </select>
                              <div class="error"></div>
                          </div>
                        </div>

                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="count_amount_font_family">Count Amount Text Font Family</label>
                            <select class="form-control select2" name="count_amount_font_family">
                              <option selected="selected" disabled="disabled">Select</option>
                              @foreach($fontfamily as $family)
                                <option value="{{$family['key']}}">{{$family['value']}}</option>
                              @endforeach
                            </select>
                            <div class="error"></div>
                          </div>
                          <div class="form-group col-md-6">
                            <label for="count_name_font_family">Count Name Text Font Family</label>
                            <select class="form-control select2" name="count_name_font_family">
                              <option selected="selected" disabled="disabled">Select</option>
                              @foreach($fontfamily as $family)
                                <option value="{{$family['key']}}">{{$family['value']}}</option>
                              @endforeach
                            </select>
                              <div class="error"></div>
                          </div>
                        </div>

                        @endif
                  
                        <div class="form-row">
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-primary">
                                Submit
                            </button>
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
                    extension: "jpg,jpeg,png,webp",
                },
                'title': {
                    required: true,
                },
                'sub_title': {
                    required: true,
                },
                'description': {
                    required: true,
                },
                'our_story_image': {
                    extension: "jpg,jpeg,png,webp",
                },
                'icon': {
                    extension: "jpg,jpeg,png,webp",
                },
            },
            messages: {
                'image': {
                    extension: "The image must be an image.",
                },
                'title': {
                    required: "The title field is required.",
                },
                'sub_title': {
                    required: "The sub title field is required.",
                },
                'description': {
                    required: "The description field is required.",
                },
                'our_story_image': {
                    extension: "The image must be an image.",
                },
                'icon': {
                    extension: "Please enter a value with a valid extension.",
                },
            },
            errorPlacement: function(error, element) {
                error.appendTo(element.parent().find('.error'));
            },
        });
        $('.colorpicker').colorpicker();
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
       $('.ckeditor').ckeditor();
    });
</script>
@endsection
