@extends('admin.layout.header')
@section('css')
    <link class="js-stylesheet" href="{{ asset('plugins/select2/css/select2.css') }}" rel="stylesheet">
    <link class="js-stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h1>{{$site_title}}</h1>
          </div>
        </div>
      </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <form action="@if(isset($record->id)) {{ route('body_shop_update', array('id' => encrypt($record->id))) }} @else{{ route('body_shop_insert') }} @endif" method="POST" class="body_shop_form" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-md-4">
                                <label for="business_id" class="form-label">Our Business<span class="text-danger">*</span></label>
                                <select class="form-control select2" name="business_id" id="business_id">
                                    <option value="">-- Select Our Business --</option>
                                    @if(isset($our_business) && $our_business->count())
                                        @foreach($our_business as $value)
                                            <option value="{{$value->id}}"@if(isset($record->business_id) && $record->business_id == $value->id){{'selected'}}@endif>{{$value->title}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <div class="error"></div>
                                @if($errors->has('business_id')) <div class="text-danger">{{ $errors->first('business_id')}}</div> @endif
                            </div>

                            <div class="mb-3 col-md-4">
                                <label for="image" class="form-label">Image<span class="text-danger">*</span></label>
                                <input type="hidden" name="old_image" id="old_image" value="{{isset($record->image) ? $record->image : old('old_image')}}">
                                @if(isset($record->image) && $record->image)
                                    <img src="{{url('public/body_shop_image/'.$record->image)}}" width="50" style="margin-bottom: 10px; margin-left: 5px;">
                                @endif  
                                <input type="file" id="image" class="form-control" name="image">
                                @if($errors->has('image')) <div class="text-danger">{{ $errors->first('image')}}</div> @endif
                                <div class="error"></div>
                                <small class="image_type">(Height:243px,Width:325px; Image Type : jpg,jpeg,png,svg,webp)</small>
                            </div>

                            <div class="col-md-4">
                                <label for="name" class="form-label">Name<span class="text-danger">*</span></label>
                                <input type="text" id="name" class="form-control" name="name" value="{{isset($record->name) ? $record->name : old('name')}}">
                                @if($errors->has('name')) <div class="text-danger">{{ $errors->first('name')}}</div> @endif
                                <div class="error"></div>
                            </div>

                            <div class="col-md-4">
                                <label for="name_color" class="form-label">Name Text Color</label>
                                <input type="text" class="form-control colorpicker" name="name_color" id="name_color" value="{{isset($record->name_color) ? $record->name_color : old('name_color')}}">
                            </div>

                            <div class="mb-3 col-md-4">
                                @php($fontsize = fontSize())
                                <label for="name_font_size" class="form-label">Name Text Font Size</label>
                                <select class="form-control select2" name="name_font_size">
                                    <option value="">Select</option>
                                    @for($i=$fontsize['start']; $i<=$fontsize['end']; $i+=$fontsize['range'])
                                        <option value="{{$i}}px" @if(isset($record->name_font_size) && $record->name_font_size == $i.'px'){{'selected'}}@endif>{{$i}}px</option>
                                    @endfor
                               </select>
                            </div>

                            <div class="col-md-4">
                                @php($fontfamily = fontFamily())
                                <label for="name_font_family" class="form-label">Name Text Font Family</label>
                                <select class="form-control select2" name="name_font_family">
                                    <option value="">Select</option>
                                    @foreach($fontfamily as $family)
                                        <option value="{{$family['key']}}" @if(isset($record->name_font_family) && $record->name_font_family == $family['key']){{'selected'}}@endif>{{$family['value']}}</option>
                                    @endforeach
                               </select>
                            </div>

                            <div class="col-md-4">
                                <label for="link" class="form-label">Link</label>
                                <input type="text" id="link" class="form-control" name="link" value="{{isset($record->link) ? $record->link : old('link')}}">
                                <div class="error"></div>
                            </div>

                            <div class="mb-3 col-md-4">
                                <label for="rating" class="form-label">Rating<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="rating" id="rating" value="{{isset($record->rating) ? $record->rating : old('rating')}}">
                                @if($errors->has('rating')) <div class="text-danger">{{ $errors->first('rating')}}</div> @endif
                                <div class="error"></div>
                            </div>

                            <div class="col-md-4 mt-2">
                                <label for="number_of_rating" class="form-label">Number of Rating<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" required="" maxlength="5" value="{{isset($record->number_of_rating) ? $record->number_of_rating : old('number_of_rating')}}" name="number_of_rating" id="number_of_rating">
                                <div class="error"></div>
                                @if ($errors->has('number_of_rating')) <div class="text-danger">{{ $errors->first('number_of_rating') }}</div>@endif
                            </div>

                            <div class="col-md-4">
                                <label for="address" class="form-label">Address<span class="text-danger">*</span></label>
                                <textarea class="form-control" name="address" id="address">{{isset($record->address) ? $record->address : old('address')}}</textarea>
                                @if($errors->has('address')) <div class="text-danger">{{ $errors->first('address')}}</div> @endif
                                <div class="error"></div>
                            </div>

                            <div class="col-md-4">
                                <label for="address_font_color" class="form-label">Address Font Color</label>
                                <input type="text" class="form-control colorpicker" name="address_font_color" id="address_font_color" value="{{isset($record->address_font_color) ? $record->address_font_color : old('address_font_color')}}">
                            </div>

                            <div class="mb-3 col-md-4">
                                @php($fontsize = fontSize())
                                <label for="address_font_size" class="form-label">Address Font Size</label>
                                <select class="form-control select2" name="address_font_size">
                                    <option value="">Select</option>
                                    @for($i=$fontsize['start']; $i<=$fontsize['end']; $i+=$fontsize['range'])
                                        <option value="{{$i}}px" @if(isset($record->address_font_size) && $record->address_font_size == $i.'px'){{'selected'}}@endif>{{$i}}px</option>
                                    @endfor
                               </select>
                            </div>

                            <div class="col-md-4">
                                @php($fontfamily = fontFamily())
                                <label for="address_font_family" class="form-label">Address Font Family</label>
                                <select class="form-control select2" name="address_font_family">
                                    <option value="">Select</option>
                                    @foreach($fontfamily as $family)
                                        <option value="{{$family['key']}}" @if(isset($record->address_font_family) && $record->address_font_family == $family['key']){{'selected'}}@endif>{{$family['value']}}</option>
                                    @endforeach
                               </select>
                            </div>

                            <div class="col-md-4">
                                <label for="email" class="form-label">Email<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="email" value="{{isset($record->email) ? $record->email : old('email')}}" id="email">
                                <div class="error"></div>
                                @if($errors->has('email')) <div class="text-danger">{{ $errors->first('email')}}</div> @endif
                            </div>

                            <div class="col-md-4">
                                <label for="email_font_color" class="form-label">Email Font Color</label>
                                <input type="text" class="form-control colorpicker" name="email_font_color" id="email_font_color" value="{{isset($record->email_font_color) ? $record->email_font_color : old('email_font_color')}}">
                            </div>

                            <div class="mb-3 col-md-4">
                                @php($fontsize = fontSize())
                                <label for="email_font_size" class="form-label">Email Font Size</label>
                                <select class="form-control select2" name="email_font_size">
                                    <option value="">Select</option>
                                    @for($i=$fontsize['start']; $i<=$fontsize['end']; $i+=$fontsize['range'])
                                        <option value="{{$i}}px" @if(isset($record->email_font_size) && $record->email_font_size == $i.'px'){{'selected'}}@endif>{{$i}}px</option>
                                    @endfor
                               </select>
                            </div>

                            <div class="col-md-4">
                                @php($fontfamily = fontFamily())
                                <label for="email_font_family" class="form-label">Email Font Family</label>
                                <select class="form-control select2" name="email_font_family">
                                    <option value="">Select</option>
                                    @foreach($fontfamily as $family)
                                        <option value="{{$family['key']}}" @if(isset($record->email_font_family) && $record->email_font_family == $family['key']){{'selected'}}@endif>{{$family['value']}}</option>
                                    @endforeach
                               </select>
                            </div>

                            <div class="col-md-4 mt-2">
                                <label for="contact_number" class="form-label">Contact Number<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" required="" maxlength="10" minlength="10" value="{{isset($record->contact_number) ? $record->contact_number : old('contact_number')}}" name="contact_number" id="contact_number">
                                <div class="error"></div>
                                @if ($errors->has('contact_number')) <div class="text-danger">{{ $errors->first('contact_number') }}</div>@endif
                            </div>

                            <div class="col-md-4 mt-2">
                                <label for="contact_font_size" class="form-label">Contact Number Font Size</label>
                                <select class="form-control select2" name="contact_font_size">
                                    <option value="">-- Select --</option>
                                    @for($i=24; $i<=50; $i+=2)
                                        <option value="{{$i}}px" @if(isset($record->contact_font_size) && $record->contact_font_size == $i.'px'){{'selected'}}@endif>{{$i}}px</option>
                                    @endfor
                                </select>
                            </div>

                            <div class="col-md-4 mt-2 mb-2">
                                <label for="contact_font_family" class="form-label">Contact Number Font Family</label>
                                <select class="form-control select2" name="contact_font_family">
                                    <option value="">-- Select --</option>
                                    @foreach($fontfamily as $family)
                                        <option value="{{$family['key']}}" @if(isset($record->contact_font_family) && $record->contact_font_family == $family['key']){{'selected'}}@endif>{{$family['value']}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4 mt-2">
                                <label for="contact_font_color" class="form-label">Contact Number Font Color</label>
                                <input type="text" class="form-control colorpicker" value="{{isset($record->contact_font_color) ? $record->contact_font_color : old('contact_font_color')}}" name="contact_font_color" id="contact_font_color">
                            </div>

                            <div class="col-md-4 mb-2">
                                <label for="map_link">Map Link</label>
                                <input type="text" id="map_link" class="form-control" name="map_link" value="{{isset($record->map_link) ? $record->map_link : old('map_link')}}">
                            </div>
                        </div> 

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary submit">Submit</button>
                            <a href="{{ route('body_shop') }}" class="btn btn-danger">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
@section('javascript')
<script src="{{ asset('plugins/select2/js/select2.js') }}"></script>
<script src="{{ asset('plugins/select2/js/select2.min.js') }}"></script>
<script>
 $(document).ready(function () {
        $(".body_shop_form").validate({
            rules: {
                'business_id': {
                    required: true,
                },
                'image': {
                    required: checkImage,
                    extension: "jpg,jpeg,png,webp,svg",
                },
                'address': {
                    required: true,
                },
                'name': {
                    required: true,
                },
                'link': {
                    url: "url",
                },
                'rating': {
                    required: true,
                    number: true,
                    max: 5
                },
                'email': {
                    required: true,
                },
                'number_of_rating': {
                    required: true,
                    number: true,
                },
            },
            // messages: {
            //     'business_id': {
            //         required: "The Business field is required.",
            //     },
            //     'image': {
            //         required: "The image field is required.",
            //         extension: "Image must be jpg,jpeg,png,svg or webp.",
            //     },
            //     'name': {
            //         required: "The name field is required.",
            //     },
            //     'link': {
            //         url: "Please enter a valid link.",
            //     },
            //     'rating': {
            //         required: "The rating field is required.",
            //         max: "The rating must not be greater than 5."
            //     },
            //     'number_of_rating': {
            //         required: "The number of rating field is required.",
            //     },
            // },
            errorPlacement: function(error, element) {
                error.appendTo(element.parent().find('.error'));
            },
            submitHandler: function(form) {
                $(form).find('.submit').prop("disabled", true);
                form.submit();
            }
        });

        function checkImage() {
            var old_image = $('#old_image').val();
            var image = $('#image').val();

            if(old_image != '' || image != ''){
                return false;
            }
            return true;
        }

        $('.colorpicker').colorpicker();
    });
</script>
@endsection