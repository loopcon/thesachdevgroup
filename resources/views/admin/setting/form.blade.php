@extends('admin.layout.header')
@section('css')
    <link type="text/css" class="js-stylesheet" href="{{ url('public/plugins/parsley/parsley.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            @include('admin.alerts')
          </div>
          <div class="col-sm-6">
            <h1>Setting</h1>
          </div>
        </div>
      </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('setting_insert') }}" method="POST" class="setting_form" enctype="multipart/form-data" data-parsley-validate="">
                        @csrf
                        @if(isset($settings) && count($settings) > 0)
                            @foreach($settings as $setting)
                            <div class="row">
                              <div class="mb-3 col-md-4">
                                <label for="logo">Logo<span class="text-danger">*</span></label>
                                  <input type="hidden" name="old_logo" id="old_logo" value="{{$setting->logo}}">
                                  @if(isset($setting->logo) && isset($setting->logo))
                                    <img src="{{url('public/logo/'.$setting->logo)}}" width="50" style="margin-bottom: 10px; margin-left: 5px;">
                                  @endif
                                <input type="file" id="logo" class="form-control" name="logo" required>
                                <small class="image_type">(Height:85px,Width:85px; Image Type : jpg,jpeg,png,svg,webp)</small>
                              </div>
    
                              <div class="col-md-4">
                                <label for="email">Email<span class="text-danger">*</span></label>
                                <input type="email" id="email" class="form-control" name="email" value="{{$setting->email}}" required>
                                @if ($errors->has('email')) <div class="text-danger">{{ $errors->first('email') }}</div>@endif 
                              </div>
    
                              <div class="col-md-4">
                                <label for="email_color" class="form-label">Email Text Color</label>
                                <input type="text" class="form-control colorpicker" name="email_color" id="email_color" value="{{$setting->email_color}}">
                              </div>
    
                              <div class="mb-3 col-md-4">
                                @php($fontsize = fontSize())
                                <label for="email_font_size" class="form-label">Email Text Font Size</label>
                                <select class="form-control select2" name="email_font_size">
                                    <option value="">Select</option>
                                    @for($i=$fontsize['start']; $i<=$fontsize['end']; $i+=$fontsize['range'])
                                      <option value="{{$i}}px" {{$setting->email_font_size == $i.'px' ? 'selected' : ''}}>{{$i}}px</option>
                                    @endfor
                                </select>
                              </div>
    
                              <div class="col-md-4">
                                @php($fontfamily = fontFamily())
                                <label for="email_font_family" class="form-label">Email Text Font Family</label>
                                <select class="form-control select2" name="email_font_family">
                                    <option value="">Select</option>
                                    @foreach($fontfamily as $family)
                                      <option value="{{$family['key']}}" {{$setting->email_font_family == $family['key'] ? 'selected' : ''}}>{{$family['value']}}</option>
                                    @endforeach
                                </select>
                              </div>
    
                              <div class="mb-3 col-md-4">
                                <label for="mobile_number">Mobile Number<span class="text-danger">*</span></label>
                                <input type="number" id="mobile_number" class="form-control" name="mobile_number" value="{{$setting->mobile_number}}" required>
                                @if ($errors->has('mobile_number')) <div class="text-danger">{{ $errors->first('mobile_number') }}</div>@endif
                              </div>
    
                              <div class="mb-3 col-md-4">
                                <label for="mobile_number_color" class="form-label">Mobile Number Text Color</label>
                                <input type="text" class="form-control colorpicker" name="mobile_number_color" id="mobile_number_color" value="{{$setting->mobile_number_color}}">
                              </div>
    
                              <div class="col-md-4">
                                <label for="mobile_number_font_size" class="form-label">Mobile Number Text Font Size</label>
                                <select class="form-control select2" name="mobile_number_font_size">
                                    <option value="">Select</option>
                                    @for($i=$fontsize['start']; $i<=$fontsize['end']; $i+=$fontsize['range'])
                                      <option value="{{$i}}px" {{$setting->mobile_number_font_size == $i.'px' ? 'selected' : ''}}>{{$i}}px</option>
                                    @endfor
                                </select>
                              </div>
    
                              <div class="col-md-4">
                                <label for="mobile_number_font_family" class="form-label">Mobile Number Text Font Family</label>
                                <select class="form-control select2" name="mobile_number_font_family">
                                    <option value="">Select</option>
                                    @foreach($fontfamily as $family)
                                      <option value="{{$family['key']}}" {{$setting->mobile_number_font_family == $family['key'] ? 'selected' : ''}}>{{$family['value']}}</option>
                                    @endforeach
                                </select>
                              </div>
    
    
                              <div class="mb-3 col-md-4">
                                <label for="time">Time<span class="text-danger">*</span></label>
                                <input type="text" id="time" class="form-control" name="time" value="{{$setting->time}}" required>
                                @if ($errors->has('time')) <div class="text-danger">{{ $errors->first('time') }}</div>@endif
                              </div>
    
                              <div class="col-md-4">
                                <label for="time_color" class="form-label">Time Text Color</label>
                                <input type="text" class="form-control colorpicker" name="time_color" id="time_color" value="{{$setting->time_color}}">
                              </div>
    
                              <div class="col-md-4">
                                <label for="time_font_size" class="form-label">Time Text Font Size</label>
                                <select class="form-control select2" name="time_font_size">
                                    <option value="">Select</option>
                                    @for($i=$fontsize['start']; $i<=$fontsize['end']; $i+=$fontsize['range'])
                                      <option value="{{$i}}px" {{$setting->time_font_size == $i.'px' ? 'selected' : ''}}>{{$i}}px</option>
                                    @endfor
                                </select>
                              </div>
    
                              <div class="mb-3 col-md-4">
                                <label for="time_font_family" class="form-label">Time Text Font Family</label>
                                <select class="form-control select2" name="time_font_family">
                                    <option value="">Select</option>
                                    @foreach($fontfamily as $family)
                                      <option value="{{$family['key']}}" {{$setting->time_font_family == $family['key'] ? 'selected' : ''}}>{{$family['value']}}</option>
                                    @endforeach
                                </select>
                              </div>
    
                              <div class="mb-3 col-md-4">
                                <label for="address">Address<span class="text-danger">*</span></label>
                                <textarea class="form-control" name="address" required>{{$setting->address}}</textarea>
                                @if ($errors->has('address')) <div class="text-danger">{{ $errors->first('address') }}</div>@endif
                              </div>
    
                              <div class="col-md-4">
                                <label for="address_color" class="form-label">Address Text Color</label>
                                <input type="text" class="form-control colorpicker" name="address_color" id="address_color" value="{{$setting->address_color}}">
                              </div>
    
                              <div class="col-md-4">
                                <label for="address_font_size" class="form-label">Address Text Font Size</label>
                                <select class="form-control select2" name="address_font_size">
                                    <option value="">Select</option>
                                    @for($i=$fontsize['start']; $i<=$fontsize['end']; $i+=$fontsize['range'])
                                      <option value="{{$i}}px" {{$setting->address_font_size == $i.'px' ? 'selected' : ''}}>{{$i}}px</option>
                                    @endfor
                                </select>
                              </div>
    
                              <div class="col-md-4">
                                <label for="address_font_family" class="form-label">Address Text Font Family</label>
                                <select class="form-control select2" name="address_font_family">
                                    <option value="">Select</option>
                                    @foreach($fontfamily as $family)
                                      <option value="{{$family['key']}}" {{$setting->address_font_family == $family['key'] ? 'selected' : ''}}>{{$family['value']}}</option>
                                    @endforeach
                                </select>
                              </div>
    
                              <div class="mb-3 col-md-4">
                                <label for="email_icon">Email Icon<span class="text-danger">*</span></label>
                                <input type="hidden" name="old_email_icon" id="old_email_icon" value="{{$setting->email_icon}}">
                                @if(isset($setting->email_icon) && isset($setting->email_icon))
                                  <img src="{{url('public/email_icon/'.$setting->email_icon)}}" width="50" style="margin-bottom: 10px; margin-left: 5px;">  
                                @endif
                                <input type="file" id="email_icon" class="form-control" name="email_icon" required>
\                                <small class="image_type">(Height:30px,Width:30px; Image Type : jpg,jpeg,png,svg,webp)</small>
                              </div>
    
                              <div class="mb-3 col-md-4">
                                <label for="call_icon">Call Icon<span class="text-danger">*</span></label>
                                <input type="hidden" name="old_call_icon" id="old_call_icon" value="{{$setting->call_icon}}">
                                @if(isset($setting->call_icon) && isset($setting->call_icon))
                                  <img src="{{url('public/call_icon/'.$setting->call_icon)}}" width="50" style="margin-bottom: 10px; margin-left: 5px;">  
                                @endif
                                <input type="file" id="call_icon" class="form-control" name="call_icon" required>
                                <small class="image_type">(Height:30px,Width:30px; Image Type : jpg,jpeg,png,svg,webp)</small>
                              </div>
    
                              <div class="col-md-4">
                                <label for="address_icon">Address Icon<span class="text-danger">*</span></label>
                                <input type="hidden" name="old_address_icon" id="old_address_icon" value="{{$setting->address_icon}}">
                                @if(isset($setting->address_icon) && isset($setting->address_icon))
                                  <img src="{{url('public/address_icon/'.$setting->address_icon)}}" width="50" style="margin-bottom: 10px; margin-left: 5px;">
                                @endif
                                <input type="file" id="address_icon" class="form-control" name="address_icon" required>
                                <small class="image_type">(Height:30px,Width:30px; Image Type : jpg,jpeg,png,svg,webp)</small>
                              </div>

                              <div class="col-md-4">
                                <label for="payment_button_text" class="form-label">Payment Button Text</label>
                                <input type="text" class="form-control" name="payment_button_text" id="payment_button_text" value="{{$setting->payment_button_text}}">
                              </div>
    
                              <div class="mb-3 col-md-4">
                                <label for="payment_button_text_color" class="form-label">Payment Button Text Color</label>
                                <input type="text" class="form-control colorpicker" name="payment_button_text_color" id="payment_button_text_color" value="{{$setting->payment_button_text_color}}">
                              </div>
    
                              <div class="col-md-4">
                                <label for="payment_button_font_size" class="form-label">Payment Button Text Font Size</label>
                                <select class="form-control select2" name="payment_button_font_size">
                                    <option value="">Select</option>
                                    @for($i=$fontsize['start']; $i<=$fontsize['end']; $i+=$fontsize['range'])
                                      <option value="{{$i}}px" {{$setting->payment_button_font_size == $i.'px' ? 'selected' : ''}}>{{$i}}px</option>  
                                    @endfor
                                </select>
                              </div>
    
                              <div class="col-md-4">
                                <label for="payment_button_font_family" class="form-label">Payment Button Text Font Family</label>
                                <select class="form-control select2" name="payment_button_font_family">
                                    <option value="">Select</option>
                                    @foreach($fontfamily as $family)
                                      <option value="{{$family['key']}}" {{$setting->payment_button_font_family == $family['key'] ? 'selected' : ''}}>{{$family['value']}}</option>
                                    @endforeach
                                </select>
                              </div>
    
                              <div class="mb-3 col-md-4">
                                <label for="payment_button_color" class="form-label">Payment Button Color</label>
                                <input type="text" class="form-control colorpicker" name="payment_button_color" id="payment_button_color" value="{{$setting->payment_button_color}}">
                              </div>
                            </div>
                            @endforeach
                        @else
                        <div class="row">
                          <div class="mb-3 col-md-4">
                            <label for="logo">Logo<span class="text-danger">*</span></label>
                            <input type="file" id="logo" class="form-control" name="logo" required>
                            <small class="image_type">(Height:90px,Width:90px; Image Type : jpg,jpeg,png,svg,webp)</small>
                          </div>

                          <div class="col-md-4">
                            <label for="email">Email<span class="text-danger">*</span></label>
                            <input type="email" id="email" class="form-control" name="email" required>
                            @if ($errors->has('email')) <div class="text-danger">{{ $errors->first('email') }}</div>@endif
                          </div>

                          <div class="col-md-4">
                            <label for="email_color" class="form-label">Email Text Color</label>
                            <input type="text" class="form-control colorpicker" name="email_color" id="email_color">
                          </div>

                          <div class="mb-3 col-md-4">
                            @php($fontsize = fontSize())
                            <label for="email_font_size" class="form-label">Email Text Font Size</label>
                            <select class="form-control select2" name="email_font_size">
                                <option value="">Select</option>
                                @for($i=$fontsize['start']; $i<=$fontsize['end']; $i+=$fontsize['range'])
                                  <option value="{{$i}}px">{{$i}}px</option>
                                @endfor
                            </select>
                          </div>

                          <div class="col-md-4">
                            @php($fontfamily = fontFamily())
                            <label for="email_font_family" class="form-label">Email Text Font Family</label>
                            <select class="form-control select2" name="email_font_family">
                                <option value="">Select</option>
                                    @foreach($fontfamily as $family)
                                      <option value="{{$family['key']}}">{{$family['value']}}</option>
                                    @endforeach
                            </select>
                          </div>

                          <div class="mb-3 col-md-4">
                            <label for="mobile_number">Mobile Number<span class="text-danger">*</span></label>
                            <input type="number" id="mobile_number" class="form-control" name="mobile_number" required>
                            @if ($errors->has('mobile_number')) <div class="text-danger">{{ $errors->first('mobile_number') }}</div>@endif
                          </div>

                          <div class="mb-3 col-md-4">
                            <label for="mobile_number_color" class="form-label">Mobile Number Text Color</label>
                            <input type="text" class="form-control colorpicker" name="mobile_number_color" id="mobile_number_color">
                          </div>

                          <div class="col-md-4">
                            <label for="mobile_number_font_size" class="form-label">Mobile Number Text Font Size</label>
                            <select class="form-control select2" name="mobile_number_font_size">
                                <option value="">Select</option>
                                @for($i=$fontsize['start']; $i<=$fontsize['end']; $i+=$fontsize['range'])
                                  <option value="{{$i}}px">{{$i}}px</option>
                                @endfor
                            </select>
                          </div>

                          <div class="col-md-4">
                            <label for="mobile_number_font_family" class="form-label">Mobile Number Text Font Family</label>
                            <select class="form-control select2" name="mobile_number_font_family">
                                <option value="">Select</option>
                                @foreach($fontfamily as $family)
                                  <option value="{{$family['key']}}">{{$family['value']}}</option>
                                @endforeach
                            </select>
                          </div>

                          <div class="mb-3 col-md-4">
                            <label for="time">Time<span class="text-danger">*</span></label>
                            <input type="text" id="time" class="form-control" name="time" required>
                            @if ($errors->has('time')) <div class="text-danger">{{ $errors->first('time') }}</div>@endif
                          </div>

                          <div class="col-md-4">
                            <label for="time_color" class="form-label">Time Text Color</label>
                            <input type="text" class="form-control colorpicker" name="time_color" id="time_color">
                          </div>

                          <div class="col-md-4">
                            <label for="time_font_size" class="form-label">Time Text Font Size</label>
                            <select class="form-control select2" name="time_font_size">
                                <option value="">Select</option>
                                @for($i=$fontsize['start']; $i<=$fontsize['end']; $i+=$fontsize['range'])
                                  <option value="{{$i}}px">{{$i}}px</option>
                                @endfor
                            </select>
                          </div>

                          <div class="mb-3 col-md-4">
                            <label for="time_font_family" class="form-label">Time Text Font Family</label>
                            <select class="form-control select2" name="time_font_family">
                                <option value="">Select</option>
                                @foreach($fontfamily as $family)
                                  <option value="{{$family['key']}}">{{$family['value']}}</option>
                                @endforeach
                            </select>
                          </div>

                          <div class="mb-3 col-md-4">
                            <label for="address">Address<span class="text-danger">*</span></label>
                            <textarea class="form-control" name="address" required></textarea>
                            @if ($errors->has('address')) <div class="text-danger">{{ $errors->first('address') }}</div>@endif
                          </div>

                          <div class="col-md-4">
                            <label for="address_color" class="form-label">Address Text Color</label>
                            <input type="text" class="form-control colorpicker" name="address_color" id="address_color">
                          </div>

                          <div class="mb-3 col-md-4">
                            <label for="address_font_size" class="form-label">Address Text Font Size</label>
                            <select class="form-control select2" name="address_font_size">
                                <option value="">Select</option>
                                @for($i=$fontsize['start']; $i<=$fontsize['end']; $i+=$fontsize['range'])
                                  <option value="{{$i}}px">{{$i}}px</option>
                                @endfor
                            </select>
                          </div>

                          <div class="col-md-4">
                            <label for="address_font_family" class="form-label">Address Text Font Family</label>
                            <select class="form-control select2" name="address_font_family">
                                <option value="">Select</option>
                                    @foreach($fontfamily as $family)
                                      <option value="{{$family['key']}}">{{$family['value']}}</option>
                                    @endforeach
                            </select>
                          </div>

                          <div class="col-md-4">
                            <label for="email_icon">Email Icon<span class="text-danger">*</span></label>
                            <input type="file" id="email_icon" class="form-control" name="email_icon" required>
                            <small class="image_type">(Height:30px,Width:30px; Image Type : jpg,jpeg,png,svg,webp)</small>
                          </div>

                          <div class="mb-3 col-md-4">
                            <label for="call_icon">Call Icon<span class="text-danger">*</span></label>
                            <input type="file" id="call_icon" class="form-control" name="call_icon" required>
                            <small class="image_type">(Height:30px,Width:30px; Image Type : jpg,jpeg,png,svg,webp)</small>
                          </div>

                          <div class="col-md-4">
                            <label for="address_icon">Address Icon<span class="text-danger">*</span></label>
                            <input type="file" id="address_icon" class="form-control" name="address_icon" required>
                            <small class="image_type">(Height:30px,Width:30px; Image Type : jpg,jpeg,png,svg,webp)</small>
                          </div>

                          
                          <div class="col-md-4">
                            <label for="payment_button_text" class="form-label">Payment Button Text</label>
                            <input type="text" class="form-control" name="payment_button_text" id="payment_button_text">
                          </div>

                          <div class="col-md-4">
                            <label for="payment_button_text_color" class="form-label">Payment Button Text Color</label>
                            <input type="text" class="form-control colorpicker" name="payment_button_text_color" id="payment_button_text_color">
                          </div>

                          <div class="mb-3 col-md-4">
                            <label for="payment_button_font_size" class="form-label">Payment Button Text Font Size</label>
                            <select class="form-control select2" name="payment_button_font_size">
                                <option value="">Select</option>
                                @for($i=$fontsize['start']; $i<=$fontsize['end']; $i+=$fontsize['range'])
                                  <option value="{{$i}}px">{{$i}}px</option>
                                @endfor
                            </select>
                          </div>

                          <div class="col-md-4">
                            <label for="payment_button_font_family" class="form-label">Payment Button Text Font Family</label>
                            <select class="form-control select2" name="payment_button_font_family">
                                <option value="">Select</option>
                                @foreach($fontfamily as $family)
                                  <option value="{{$family['key']}}">{{$family['value']}}</option>
                                @endforeach
                            </select>
                          </div>

                          <div class="mb-3 col-md-4">
                            <label for="payment_button_color" class="form-label">Payment Button Color</label>
                            <input type="text" class="form-control colorpicker" name="payment_button_color" id="payment_button_color">
                          </div>
                        </div>
                        @endif
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
@section('javascript')
<script src="{{ url('public/plugins/parsley/parsley.js') }}"></script>
<script>
    $(document).ready(function () {
        // $(".setting_form").validate({
        //     ignore: [],
        //     rules: {
        //         'logo': {
        //             required: checkLogo,
        //             extension: "jpg,jpeg,png,webp,svg",
        //         },
        //         'email': {
        //             required: true,
        //         },
        //         'mobile_number': {
        //             required: true,
        //             maxlength:"10",
        //             minlength:"10",
        //         },
        //         'time': {
        //             required: true,
        //         },
        //         'address': {
        //             required: true,
        //         },
        //         'email_icon': {
        //           required: checkEmailIcon, 
        //           extension: "jpg,jpeg,png,webp,svg",
        //         },
        //         'call_icon': {
        //           required: checkCallIcon, 
        //           extension: "jpg,jpeg,png,webp,svg",
        //         },
        //         'address_icon': {
        //           required: checkAddressIcon, 
        //           extension: "jpg,jpeg,png,webp,svg",
        //         },
        //     },
        //     messages: {
        //         'logo': {
        //             required: "The logo field is required.",
        //             extension: "Image must be jpg,jpeg,png,svg or webp.",
        //         },
        //         'email': {
        //             required: "The email field is required.",
        //         },
        //         'mobile_number': {
        //             required: "The mobile number field is required.",
        //         },
        //         'time': {
        //             required: "The time field is required.",
        //         },
        //         'address': {
        //             required: "The address field is required.",
        //         },
        //         'email_icon': {
        //             required: "The email icon field is required.",
        //             extension: "Image must be jpg,jpeg,png,svg or webp.",
        //         },
        //         'call_icon': {
        //             required: "The call icon field is required.",
        //             extension: "Image must be jpg,jpeg,png,svg or webp.",
        //         },
        //         'address_icon': {
        //             required: "The address icon field is required.",
        //             extension: "Image must be jpg,jpeg,png,svg or webp.",
        //         },
        //     },
        //     errorPlacement: function(error, element) {
        //         error.appendTo(element.parent().find('.error'));
        //     },
        // });

        // function checkLogo() {
        //   var old_logo = $('#old_logo').val();
        //   if(old_logo){
        //     return false;
        //   }
        // }
        
        // function checkEmailIcon() {
        //   var old_email_icon = $('#old_email_icon').val();
        //   if(old_email_icon){
        //     return false;
        //   }
        // }

        // function checkCallIcon() {
        //   var old_call_icon = $('#old_call_icon').val();
        //   if(old_call_icon){
        //     return false;
        //   }
        // }

        // function checkAddressIcon() {
        //   var old_address_icon = $('#old_address_icon').val();
        //   if(old_address_icon){
        //     return false;
        //   }
        // }

        // logo
        var old_logo = $('#old_logo').val();
        var logo = $('#logo').val();
        if(old_logo != '' || logo != ''){
            document.getElementById("logo").required = false;
        }else{
            document.getElementById("logo").required = true;
        }

        // email icon
        var old_email_icon = $('#old_email_icon').val();
        var email_icon = $('#email_icon').val();
        if(old_email_icon != '' || email_icon != ''){
            document.getElementById("email_icon").required = false;
        }else{
            document.getElementById("email_icon").required = true;
        }

        // call icon
        var old_call_icon = $('#old_call_icon').val();
        var call_icon = $('#call_icon').val();
        if(old_call_icon != '' || call_icon != ''){
            document.getElementById("call_icon").required = false;
        }else{
            document.getElementById("call_icon").required = true;
        }

        // address icon
        var old_address_icon = $('#old_address_icon').val();
        var address_icon = $('#address_icon').val();
        if(old_address_icon != '' || address_icon != ''){
            document.getElementById("address_icon").required = false;
        }else{
            document.getElementById("address_icon").required = true;
        }

        $('.colorpicker').colorpicker();
    });
</script>
@endsection
