@extends('admin.layout.header')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
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
                                  <label for="image">Image</label>
                                  <input type="file" id="image" class="form-control" name="image">
                                  <div class="error"></div>
                                  @if($home_detail->image == null)
                                      <img src="{{asset('public/no_image/notImg.png')}}" width="100">
                                  @else
                                      <img src="{{asset('public/home_detail/'.$home_detail->image)}}" width="100">
                                  @endif
                              </div>
                              <div class="col-md-4 mb-3">
                                <label for="title">Title</label>
                                <input type="text" id="title" class="form-control" name="title" value="{{ $home_detail->title}}">
                                <div class="error"></div>
                              </div>
                              <div class="col-md-4 mb-3">
                                <label for="sub_title">Sub Title</label>
                                <input type="text" id="sub_title" class="form-control" name="sub_title" value="{{ $home_detail->sub_title}}">
                                  <div class="error"></div>
                              </div>
                            </div>


                            <div class="mb-3">
                              <label for="description">Description</label>
                              <textarea class="ckeditor form-control" name="description">{{$home_detail->description}}</textarea>
                                <div class="error"></div>
                            </div>
                            
                            <div class="form-row">
                              <div class="form-group col-md-6">
                                  <label for="our_story_image">Our Story Image</label>
                                  <input type="file" id="our_story_image" class="form-control" name="our_story_image">
                                  <div class="error"></div>
                                  @if($home_detail->our_story_image == null)
                                        <img src="{{asset('public/no_image/notImg.png')}}" width="100">
                                    @else
                                        <img src="{{asset('public/our_story_image/'.$home_detail->our_story_image)}}" width="100">
                                    @endif
                              </div>
                              <div class="form-group col-md-6">
                                <label for="our_story_title">Our Story Title</label>
                                <input type="text" id="our_story_title" class="form-control" name="our_story_title" value="{{ $home_detail->our_story_title}}">
                                <div class="error"></div>
                              </div>
                            </div>

                            <div class="mb-3">
                              <label for="our_story_description">Our Story Description</label>
                              <textarea class="ckeditor form-control" name="our_story_description">{{ $home_detail->our_story_description}}</textarea>
                              <div class="error"></div>
                            </div>

                            <div class="form-row">
                              <div class="form-group col-md-6">
                                <label for="our_mission_title">Our Mission Title</label>
                                <input type="text" id="our_mission_title" class="form-control" name="our_mission_title" value="{{ $home_detail->our_mission_title}}">
                                <div class="error"></div>
                              </div>
                              <div class="form-group col-md-6">
                                <label for="our_vision_title">Our Vision Title</label>
                                  <input type="text" id="our_vision_title" class="form-control" name="our_vision_title" value="{{ $home_detail->our_vision_title}}">
                                  <div class="error"></div>
                              </div>
                            </div>

                            <div class="mb-3">
                              <label for="our_mission_description">Our Mission Description</label>
                              <textarea class="ckeditor form-control" name="our_mission_description">{{ $home_detail->our_mission_description}}</textarea>
                              <div class="error"></div>
                            </div>
    
                            <div class="mb-3">
                              <label for="our_vision_description">Our Vision Description</label>
                              <textarea class="ckeditor form-control" name="our_vision_description">{{ $home_detail->our_vision_description}}</textarea>
                              <div class="error"></div>
                            </div>

                            
                        <div class="form-row">
                          <div class="col-md-4 mb-3">
                              <label for="color">Color</label>
                              <input type="text" class="form-control colorpicker" name="color" id="color" value="{{ $home_detail->color}}">
                              <div class="error"></div>
                          </div>
                          <div class="col-md-4 mb-3">
                            <label for="font_size">Select Font Size</label>
                            <select class="form-control select2" name="font_size">
                              <option selected="selected" disabled="disabled">Select Font Size</option>
                              @for($i=24; $i<=50; $i+=2)
                                  <option value="{{$i}}px" {{$home_detail->font_size == $i.'px' ? 'selected' : ''}}>{{$i}}px</option>
                              @endfor
                            </select>
                            <div class="error"></div>
                          </div>
                          <div class="col-md-4 mb-3">
                            <label for="font_family">Select Font Family</label>
                            <select class="form-control select2" name="font_family">
                              <option selected="selected" disabled="disabled">Select Font Family</option>
                              <option value="poppins"  {{$home_detail->font_family == 'poppins' ? 'selected' : ''}}>Poppins</option>
                              <option value="sans-serif" {{$home_detail->font_family == 'sans-serif' ? 'selected' : ''}}>Sans Serif</option>
                            </select>
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
                              @if($home_detail->icon == null)
                                  <img src="{{asset('public/no_image/notImg.png')}}" width="100">
                              @else
                                  <img src="{{asset('public/icon/'.$home_detail->icon)}}" width="100">
                              @endif
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
                            <label for="count_amount_color">Count Amount Color</label>
                            <input type="text" class="form-control colorpicker" name="count_amount_color" id="count_amount_color" value="{{ $home_detail->count_amount_color}}">
                            <div class="error"></div>
                          </div>
                          <div class="col-md-4 mb-3">
                            <label for="count_name_color">Count Name Color</label>
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
                            <label for="count_amount_font_size">Count Amount Select Font Size</label>
                            <select class="form-control select2" name="count_amount_font_size">
                              <option selected="selected" disabled="disabled">Count Amount Select Font Size</option>
                              @for($i=24; $i<=50; $i+=2)
                                <option value="{{$i}}px" {{$home_detail->count_amount_font_size == $i.'px' ? 'selected' : ''}}>{{$i}}px</option>
                              @endfor
                            </select>
                            <div class="error"></div>
                          </div>
                          <div class="form-group col-md-6">
                            <label for="count_name_font_size">Count Name Select Font Size</label>
                              <select class="form-control select2" name="count_name_font_size">
                                <option selected="selected" disabled="disabled">Count Name Select Font Size</option>
                                @for($i=24; $i<=50; $i+=2)
                                    <option value="{{$i}}px" {{$home_detail->count_name_font_size == $i.'px' ? 'selected' : ''}}>{{$i}}px</option>
                                @endfor
                              </select>
                              <div class="error"></div>
                          </div>
                        </div>

                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="count_amount_font_family">Count Amount Select Font Family</label>
                            <select class="form-control select2" name="count_amount_font_family">
                              <option selected="selected" disabled="disabled">Count Amount Select Font Family</option>
                              <option value="poppins"  {{$home_detail->count_amount_font_family == 'poppins' ? 'selected' : ''}}>Poppins</option>
                              <option value="sans-serif" {{$home_detail->count_amount_font_family == 'sans-serif' ? 'selected' : ''}}>Sans Serif</option>
                            </select>
                            <div class="error"></div>
                          </div>
                          <div class="form-group col-md-6">
                            <label for="count_name_font_family">Count Name Select Font Family</label>
                            <select class="form-control select2" name="count_name_font_family">
                              <option selected="selected" disabled="disabled">Count Name Select Font Family</option>
                                <option value="poppins"  {{$home_detail->count_name_font_family == 'poppins' ? 'selected' : ''}}>Poppins</option>
                                <option value="sans-serif" {{$home_detail->count_name_font_family == 'sans-serif' ? 'selected' : ''}}>Sans Serif</option>
                            </select>
                              <div class="error"></div>
                          </div>
                        </div>

                            @endforeach
                        @else

                        <div class="form-row">
                          <div class="col-md-4 mb-3">
                              <label for="image">Image</label>
                              <input type="file" id="image" class="form-control" name="image">
                              <div class="error"></div>
                          </div>
                          <div class="col-md-4 mb-3">
                            <label for="title">Title</label>
                            <input type="text" id="title" class="form-control" name="title">
                            <div class="error"></div>
                          </div>
                          <div class="col-md-4 mb-3">
                            <label for="sub_title">Sub Title</label>
                            <input type="text" id="sub_title" class="form-control" name="sub_title">
                              <div class="error"></div>
                          </div>
                        </div>

                        <div class="mb-3">
                          <label for="description">Description</label>
                          <textarea class="ckeditor form-control" name="description"></textarea>
                            <div class="error"></div>
                        </div>
                        
                        <div class="form-row">
                          <div class="form-group col-md-6">
                              <label for="our_story_image">Our Story Image</label>
                              <input type="file" id="our_story_image" class="form-control" name="our_story_image">
                              <div class="error"></div>
                          </div>
                          <div class="form-group col-md-6">
                            <label for="our_story_title">Our Story Title</label>
                            <input type="text" id="our_story_title" class="form-control" name="our_story_title">
                            <div class="error"></div>
                          </div>
                        </div>
                        
                        <div class="mb-3">
                          <label for="our_story_description">Our Story Description</label>
                          <textarea class="ckeditor form-control" name="our_story_description"></textarea>
                          <div class="error"></div>
                        </div>
                        
                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="our_mission_title">Our Mission Title</label>
                            <input type="text" id="our_mission_title" class="form-control" name="our_mission_title">
                            <div class="error"></div>
                          </div>
                          <div class="form-group col-md-6">
                            <label for="our_vision_title">Our Vision Title</label>
                              <input type="text" id="our_vision_title" class="form-control" name="our_vision_title">
                              <div class="error"></div>
                          </div>
                        </div>

                        <div class="mb-3">
                          <label for="our_mission_description">Our Mission Description</label>
                          <textarea class="ckeditor form-control" name="our_mission_description"></textarea>
                          <div class="error"></div>
                        </div>

                        <div class="mb-3">
                          <label for="our_vision_description">Our Vision Description</label>
                          <textarea class="ckeditor form-control" name="our_vision_description"></textarea>
                          <div class="error"></div>
                        </div>

                        <div class="form-row">
                          <div class="col-md-4 mb-3">
                              <label for="color">Color</label>
                              <input type="text" class="form-control colorpicker" name="color" id="color">
                              <div class="error"></div>
                          </div>
                          <div class="col-md-4 mb-3">
                            <label for="font_size">Select Font Size</label>
                            <select class="form-control select2" name="font_size">
                              <option selected="selected" disabled="disabled">Select Font Size</option>
                              @for($i=24; $i<=50; $i+=2)
                                  <option value="{{$i}}px">{{$i}}px</option>
                              @endfor
                            </select>
                            <div class="error"></div>
                          </div>
                          <div class="col-md-4 mb-3">
                            <label for="font_family">Select Font Family</label>
                            <select class="form-control select2" name="font_family">
                              <option selected="selected" disabled="disabled">Select Font Family</option>
                                  <option value="poppins">Poppins</option>
                                  <option value="sans-serif">Sans Serif</option>
                            </select>
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
                            <label for="count_amount_color">Count Amount Color</label>
                            <input type="text" class="form-control colorpicker" name="count_amount_color" id="count_amount_color">
                            <div class="error"></div>
                          </div>
                          <div class="col-md-4 mb-3">
                            <label for="count_name_color">Count Name Color</label>
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
                            <label for="count_amount_font_size">Count Amount Select Font Size</label>
                            <select class="form-control select2" name="count_amount_font_size">
                              <option selected="selected" disabled="disabled">Count Amount Select Font Size</option>
                              @for($i=24; $i<=50; $i+=2)
                                  <option value="{{$i}}px">{{$i}}px</option>
                              @endfor
                            </select>
                            <div class="error"></div>
                          </div>
                          <div class="form-group col-md-6">
                            <label for="count_name_font_size">Count Name Select Font Size</label>
                              <select class="form-control select2" name="count_name_font_size">
                                <option selected="selected" disabled="disabled">Count Name Select Font Size</option>
                                @for($i=24; $i<=50; $i+=2)
                                    <option value="{{$i}}px">{{$i}}px</option>
                                @endfor
                              </select>
                              <div class="error"></div>
                          </div>
                        </div>

                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="count_amount_font_family">Count Amount Select Font Family</label>
                            <select class="form-control select2" name="count_amount_font_family">
                              <option selected="selected" disabled="disabled">Count Amount Select Font Family</option>
                                  <option value="poppins">Poppins</option>
                                  <option value="sans-serif">Sans Serif</option>
                            </select>
                            <div class="error"></div>
                          </div>
                          <div class="form-group col-md-6">
                            <label for="count_name_font_family">Count Name Select Font Family</label>
                            <select class="form-control select2" name="count_name_font_family">
                              <option selected="selected" disabled="disabled">Count Name Select Font Family</option>
                                  <option value="poppins">Poppins</option>
                                  <option value="sans-serif">Sans Serif</option>
                            </select>
                              <div class="error"></div>
                          </div>
                        </div>

                        @endif
                  
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                Submit
                            </button>
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
                    extension: "jpg,jpeg,png",
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
                    extension: "jpg,jpeg,png",
                },
                'our_story_title': {
                    required: true,
                },
                'our_story_description': {
                    required: true,
                },
                'our_mission_title': {
                    required: true,
                },
                'our_mission_description': {
                    required: true,
                },
                'our_vision_title': {
                    required: true,
                },
                'our_vision_description': {
                    required: true,
                },
                'icon': {
                    extension: "jpg,jpeg,png",
                },
            },
            messages: {
                'image': {
                    extension: "Please enter a value with a valid extension.",
                },
                'title': {
                    required: "Title is required",
                },
                'sub_title': {
                    required: "Sub title is required",
                },
                'description': {
                    required: "Description is required",
                },
                'our_story_image': {
                    extension: "Please enter a value with a valid extension.",
                },
                'our_story_title': {
                    required: "Our story title is required",
                },
                'our_story_description': {
                    required: "Our story description is required",
                },
                'our_mission_title': {
                    required: "Our mission title is required",
                },
                'our_mission_description': {
                    required: "Our mission description is required",
                },
                'our_vision_title': {
                    required: "Our vision title is required",
                },
                'our_vision_description': {
                    required: "Our vision description is required",
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
