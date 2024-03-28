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
            <h1>Setting</h1>
          </div>
          <div class="col-sm-6 d-none d-sm-block">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Setting</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('setting_insert') }}" method="POST" class="setting_form" enctype="multipart/form-data">
                        @csrf

                        @if(isset($settings) && count($settings) > 0)
                            @foreach($settings as $setting)

                            <div class="row">
                              <div class="mb-3 col-md-4">
                                <label for="logo">Logo<span class="text-danger">*</span></label>
                                  @if($setting->logo == null)
                                    <img src="{{url('public/no_image/notImg.png')}}" width="100">
                                  @else
                                    <img src="{{url('public/logo/'.$setting->logo)}}" width="100">
                                  @endif
                                <input type="file" id="logo" class="form-control" name="logo">
                                <div class="error"></div>
                              </div>
    
                              <div class="col-md-4">
                                <label for="email">Email<span class="text-danger">*</span></label>
                                <input type="email" id="email" class="form-control" name="email" value="{{$setting->email}}">
                                <div class="error"></div>
                              </div>
    
                              <div class="col-md-4">
                                <label for="email_color" class="form-label">Email Text Color</label>
                                <input type="text" class="form-control colorpicker" name="email_color" id="email_color" value="{{$setting->email_color}}">
                              </div>
    
                              <div class="mb-3 col-md-4">
                                @php($fontsize = fontSize())
                                <label for="email_font_size" class="form-label">Email Text Font Size</label>
                                <select class="form-control select2" name="email_font_size">
                                    <option selected="selected" disabled="disabled">Select</option>
                                    @for($i=$fontsize['start']; $i<=$fontsize['end']; $i+=$fontsize['range'])
                                      <option value="{{$i}}px" {{$setting->email_font_size == $i.'px' ? 'selected' : ''}}>{{$i}}px</option>
                                    @endfor
                                </select>
                              </div>
    
                              <div class="col-md-4">
                                @php($fontfamily = fontFamily())
                                <label for="email_font_family" class="form-label">Email Text Font Family</label>
                                <select class="form-control select2" name="email_font_family">
                                    <option selected="selected" disabled="disabled">Select</option>
                                    @foreach($fontfamily as $family)
                                      <option value="{{$family['key']}}" {{$setting->email_font_family == $family['key'] ? 'selected' : ''}}>{{$family['value']}}</option>
                                    @endforeach
                                </select>
                              </div>
    
                              <div class="mb-3 col-md-4">
                                <label for="mobile_number">Mobile Number<span class="text-danger">*</span></label>
                                <input type="number" id="mobile_number" class="form-control" name="mobile_number" value="{{$setting->mobile_number}}">
                                <div class="error"></div>
                              </div>
    
                              <div class="mb-3 col-md-4">
                                <label for="mobile_number_color" class="form-label">Mobile Number Text Color</label>
                                <input type="text" class="form-control colorpicker" name="mobile_number_color" id="mobile_number_color" value="{{$setting->mobile_number_color}}">
                              </div>
    
                              <div class="col-md-4">
                                <label for="mobile_number_font_size" class="form-label">Mobile Number Text Font Size</label>
                                <select class="form-control select2" name="mobile_number_font_size">
                                    <option selected="selected" disabled="disabled">Select</option>
                                    @for($i=$fontsize['start']; $i<=$fontsize['end']; $i+=$fontsize['range'])
                                      <option value="{{$i}}px" {{$setting->mobile_number_font_size == $i.'px' ? 'selected' : ''}}>{{$i}}px</option>
                                    @endfor
                                </select>
                              </div>
    
                              <div class="col-md-4">
                                <label for="mobile_number_font_family" class="form-label">Mobile Number Text Font Family</label>
                                <select class="form-control select2" name="mobile_number_font_family">
                                    <option selected="selected" disabled="disabled">Select</option>
                                    @foreach($fontfamily as $family)
                                      <option value="{{$family['key']}}" {{$setting->mobile_number_font_family == $family['key'] ? 'selected' : ''}}>{{$family['value']}}</option>
                                    @endforeach
                                </select>
                              </div>
    
    
                              <div class="mb-3 col-md-4">
                                <label for="time">Time<span class="text-danger">*</span></label>
                                <input type="text" id="time" class="form-control" name="time" value="{{$setting->time}}">
                                <div class="error"></div>
                              </div>
    
                              <div class="col-md-4">
                                <label for="time_color" class="form-label">Time Text Color</label>
                                <input type="text" class="form-control colorpicker" name="time_color" id="time_color" value="{{$setting->time_color}}">
                              </div>
    
                              <div class="col-md-4">
                                <label for="time_font_size" class="form-label">Time Text Font Size</label>
                                <select class="form-control select2" name="time_font_size">
                                    <option selected="selected" disabled="disabled">Select</option>
                                    @for($i=$fontsize['start']; $i<=$fontsize['end']; $i+=$fontsize['range'])
                                      <option value="{{$i}}px" {{$setting->time_font_size == $i.'px' ? 'selected' : ''}}>{{$i}}px</option>
                                    @endfor
                                </select>
                              </div>
    
                              <div class="mb-3 col-md-4">
                                <label for="time_font_family" class="form-label">Time Text Font Family</label>
                                <select class="form-control select2" name="time_font_family">
                                    <option selected="selected" disabled="disabled">Select</option>
                                    @foreach($fontfamily as $family)
                                      <option value="{{$family['key']}}" {{$setting->time_font_family == $family['key'] ? 'selected' : ''}}>{{$family['value']}}</option>
                                    @endforeach
                                </select>
                              </div>
    
                              <div class="mb-3 col-md-4">
                                <label for="address">Address<span class="text-danger">*</span></label>
                                <textarea class="form-control" name="address">{{$setting->address}}</textarea>
                                <div class="error"></div>
                              </div>
    
                              <div class="col-md-4">
                                <label for="address_color" class="form-label">Address Text Color</label>
                                <input type="text" class="form-control colorpicker" name="address_color" id="address_color" value="{{$setting->address_color}}">
                              </div>
    
                              <div class="col-md-4">
                                <label for="address_font_size" class="form-label">Address Text Font Size</label>
                                <select class="form-control select2" name="address_font_size">
                                    <option selected="selected" disabled="disabled">Select</option>
                                    @for($i=$fontsize['start']; $i<=$fontsize['end']; $i+=$fontsize['range'])
                                      <option value="{{$i}}px" {{$setting->address_font_size == $i.'px' ? 'selected' : ''}}>{{$i}}px</option>
                                    @endfor
                                </select>
                              </div>
    
                              <div class="col-md-4">
                                <label for="address_font_family" class="form-label">Address Text Font Family</label>
                                <select class="form-control select2" name="address_font_family">
                                    <option selected="selected" disabled="disabled">Select</option>
                                    @foreach($fontfamily as $family)
                                      <option value="{{$family['key']}}" {{$setting->address_font_family == $family['key'] ? 'selected' : ''}}>{{$family['value']}}</option>
                                    @endforeach
                                </select>
                              </div>
    
                              <div class="mb-3 col-md-4">
                                <label for="email_icon">Email Icon<span class="text-danger">*</span></label>
                                @if($setting->email_icon == null)
                                  <img src="{{url('public/no_image/notImg.png')}}" width="100">
                                @else
                                    <img src="{{url('public/email_icon/'.$setting->email_icon)}}" width="100">
                                @endif
                                <input type="file" id="email_icon" class="form-control" name="email_icon">
                                <div class="error"></div>
                              </div>
    
                              <div class="mb-3 col-md-4">
                                <label for="call_icon">Call Icon<span class="text-danger">*</span></label>
                                @if($setting->call_icon == null)
                                  <img src="{{url('public/no_image/notImg.png')}}" width="100">
                                @else
                                    <img src="{{url('public/call_icon/'.$setting->call_icon)}}" width="100">
                                @endif
                                <input type="file" id="call_icon" class="form-control" name="call_icon">
                                <div class="error"></div>
                              </div>
    
                              <div class="col-md-4">
                                <label for="address_icon">Address Icon<span class="text-danger">*</span></label>
                                @if($setting->address_icon == null)
                                  <img src="{{url('public/no_image/notImg.png')}}" width="100">
                                @else
                                    <img src="{{url('public/address_icon/'.$setting->address_icon)}}" width="100">
                                @endif
                                <input type="file" id="address_icon" class="form-control" name="address_icon">
                                <div class="error"></div>
                              </div>


                              <div class="col-md-4">
                                <label for="payment_button_text" class="form-label">Payment Button Text</label>
                                <input type="text" class="form-control" name="payment_button_text" id="payment_button_text" value="{{$setting->payment_button_text}}">
                              </div>
    
                              <div class="col-md-4">
                                <label for="payment_button_text_color" class="form-label">Payment Button Text Color</label>
                                <input type="text" class="form-control colorpicker" name="payment_button_text_color" id="payment_button_text_color" value="{{$setting->payment_button_text_color}}">
                              </div>
    
                              <div class="col-md-4">
                                <label for="payment_button_font_size" class="form-label">Payment Button Text Font Size</label>
                                <select class="form-control select2" name="payment_button_font_size">
                                    <option selected="selected" disabled="disabled">Select</option>
                                    @for($i=$fontsize['start']; $i<=$fontsize['end']; $i+=$fontsize['range'])
                                      <option value="{{$i}}px" {{$setting->payment_button_font_size == $i.'px' ? 'selected' : ''}}>{{$i}}px</option>  
                                    @endfor
                                </select>
                              </div>
    
                              <div class="col-md-4">
                                <label for="payment_button_font_family" class="form-label">Payment Button Text Font Family</label>
                                <select class="form-control select2" name="payment_button_font_family">
                                    <option selected="selected" disabled="disabled">Select</option>
                                    @foreach($fontfamily as $family)
                                      <option value="{{$family['key']}}" {{$setting->payment_button_font_family == $family['key'] ? 'selected' : ''}}>{{$family['value']}}</option>
                                    @endforeach
                                </select>
                              </div>
    
                              <div class="col-md-4">
                                <label for="payment_button_color" class="form-label">Payment Button Color</label>
                                <input type="text" class="form-control colorpicker" name="payment_button_color" id="payment_button_color" value="{{$setting->payment_button_color}}">
                              </div>

    
                              <div class="col-md-12 mt-2 mb-3">
                                <label for="footer_description">Footer Description</label>
                                <textarea class="ckeditor form-control" name="footer_description">{{$setting->footer_description}}</textarea>
                                <div class="error"></div>
                              </div>
    
                              <div class="mb-3 col-md-4">
                                <label for="footer_description_color" class="form-label">Footer Description Text Color</label>
                                <input type="text" class="form-control colorpicker" name="footer_description_color" id="footer_description_color" value="{{$setting->footer_description_color}}">
                              </div>
    
                              <div class="col-md-4">
                                <label for="footer_description_font_size" class="form-label">Footer Description Text Font Size</label>
                                <select class="form-control select2" name="footer_description_font_size">
                                    <option selected="selected" disabled="disabled">Select</option>
                                    @for($i=$fontsize['start']; $i<=$fontsize['end']; $i+=$fontsize['range'])
                                      <option value="{{$i}}px" {{$setting->footer_description_font_size == $i.'px' ? 'selected' : ''}}>{{$i}}px</option>
                                    @endfor
                                </select>
                              </div>
    
                              <div class="col-md-4">
                                <label for="footer_description_font_family" class="form-label">Footer Description Text Font Family</label>
                                  <select class="form-control select2" name="footer_description_font_family">
                                    <option selected="selected" disabled="disabled">Select</option>
                                    @foreach($fontfamily as $family)
                                      <option value="{{$family['key']}}" {{$setting->footer_description_font_family == $family['key'] ? 'selected' : ''}}>{{$family['value']}}</option>
                                    @endforeach
                                  </select>
                              </div>
    
                            </div>

                            @endforeach
                        @else
                 
                
                        <div class="row">
                          <div class="mb-3 col-md-4">
                            <label for="logo">Logo<span class="text-danger">*</span></label>
                            <input type="file" id="logo" class="form-control" name="logo">
                            <div class="error"></div>
                          </div>

                          <div class="col-md-4">
                            <label for="email">Email<span class="text-danger">*</span></label>
                            <input type="email" id="email" class="form-control" name="email">
                            <div class="error"></div>
                          </div>

                          <div class="col-md-4">
                            <label for="email_color" class="form-label">Email Text Color</label>
                            <input type="text" class="form-control colorpicker" name="email_color" id="email_color">
                          </div>

                          <div class="mb-3 col-md-4">
                            @php($fontsize = fontSize())
                            <label for="email_font_size" class="form-label">Email Text Font Size</label>
                            <select class="form-control select2" name="email_font_size">
                                <option selected="selected" disabled="disabled">Select</option>
                                @for($i=$fontsize['start']; $i<=$fontsize['end']; $i+=$fontsize['range'])
                                  <option value="{{$i}}px">{{$i}}px</option>
                                @endfor
                            </select>
                          </div>

                          <div class="col-md-4">
                            @php($fontfamily = fontFamily())
                            <label for="email_font_family" class="form-label">Email Text Font Family</label>
                            <select class="form-control select2" name="email_font_family">
                                <option selected="selected" disabled="disabled">Select</option>
                                    @foreach($fontfamily as $family)
                                      <option value="{{$family['key']}}">{{$family['value']}}</option>
                                    @endforeach
                            </select>
                          </div>

                          <div class="mb-3 col-md-4">
                            <label for="mobile_number">Mobile Number<span class="text-danger">*</span></label>
                            <input type="number" id="mobile_number" class="form-control" name="mobile_number">
                            <div class="error"></div>
                          </div>

                          <div class="mb-3 col-md-4">
                            <label for="mobile_number_color" class="form-label">Mobile Number Text Color</label>
                            <input type="text" class="form-control colorpicker" name="mobile_number_color" id="mobile_number_color">
                          </div>

                          <div class="col-md-4">
                            <label for="mobile_number_font_size" class="form-label">Mobile Number Text Font Size</label>
                            <select class="form-control select2" name="mobile_number_font_size">
                                <option selected="selected" disabled="disabled">Select</option>
                                @for($i=$fontsize['start']; $i<=$fontsize['end']; $i+=$fontsize['range'])
                                  <option value="{{$i}}px">{{$i}}px</option>
                                @endfor
                            </select>
                          </div>

                          <div class="col-md-4">
                            <label for="mobile_number_font_family" class="form-label">Mobile Number Text Font Family</label>
                            <select class="form-control select2" name="mobile_number_font_family">
                                <option selected="selected" disabled="disabled">Select</option>
                                @foreach($fontfamily as $family)
                                  <option value="{{$family['key']}}">{{$family['value']}}</option>
                                @endforeach
                            </select>
                          </div>


                          <div class="mb-3 col-md-4">
                            <label for="time">Time<span class="text-danger">*</span></label>
                            <input type="text" id="time" class="form-control" name="time">
                            <div class="error"></div>
                          </div>

                          <div class="col-md-4">
                            <label for="time_color" class="form-label">Time Text Color</label>
                            <input type="text" class="form-control colorpicker" name="time_color" id="time_color">
                          </div>

                          <div class="col-md-4">
                            <label for="time_font_size" class="form-label">Time Text Font Size</label>
                            <select class="form-control select2" name="time_font_size">
                                <option selected="selected" disabled="disabled">Select</option>
                                @for($i=$fontsize['start']; $i<=$fontsize['end']; $i+=$fontsize['range'])
                                  <option value="{{$i}}px">{{$i}}px</option>
                                @endfor
                            </select>
                          </div>

                          <div class="mb-3 col-md-4">
                            <label for="time_font_family" class="form-label">Time Text Font Family</label>
                            <select class="form-control select2" name="time_font_family">
                                <option selected="selected" disabled="disabled">Select</option>
                                @foreach($fontfamily as $family)
                                  <option value="{{$family['key']}}">{{$family['value']}}</option>
                                @endforeach
                            </select>
                          </div>

                          <div class="mb-3 col-md-4">
                            <label for="address">Address<span class="text-danger">*</span></label>
                            <textarea class="form-control" name="address"></textarea>
                            <div class="error"></div>
                          </div>

                          <div class="col-md-4">
                            <label for="address_color" class="form-label">Address Text Color</label>
                            <input type="text" class="form-control colorpicker" name="address_color" id="address_color">
                          </div>

                          <div class="mb-3 col-md-4">
                            <label for="address_font_size" class="form-label">Address Text Font Size</label>
                            <select class="form-control select2" name="address_font_size">
                                <option selected="selected" disabled="disabled">Select</option>
                                @for($i=$fontsize['start']; $i<=$fontsize['end']; $i+=$fontsize['range'])
                                  <option value="{{$i}}px">{{$i}}px</option>
                                @endfor
                            </select>
                          </div>

                          <div class="col-md-4">
                            <label for="address_font_family" class="form-label">Address Text Font Family</label>
                            <select class="form-control select2" name="address_font_family">
                                <option selected="selected" disabled="disabled">Select</option>
                                    @foreach($fontfamily as $family)
                                      <option value="{{$family['key']}}">{{$family['value']}}</option>
                                    @endforeach
                            </select>
                          </div>

                          <div class="col-md-4">
                            <label for="email_icon">Email Icon<span class="text-danger">*</span></label>
                            <input type="file" id="email_icon" class="form-control" name="email_icon">
                            <div class="error"></div>
                          </div>

                          <div class="mb-3 col-md-4">
                            <label for="call_icon">Call Icon<span class="text-danger">*</span></label>
                            <input type="file" id="call_icon" class="form-control" name="call_icon">
                            <div class="error"></div>
                          </div>

                          <div class="col-md-4">
                            <label for="address_icon">Address Icon<span class="text-danger">*</span></label>
                            <input type="file" id="address_icon" class="form-control" name="address_icon">
                            <div class="error"></div>
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
                                <option selected="selected" disabled="disabled">Select</option>
                                @for($i=$fontsize['start']; $i<=$fontsize['end']; $i+=$fontsize['range'])
                                  <option value="{{$i}}px">{{$i}}px</option>
                                @endfor
                            </select>
                          </div>

                          <div class="col-md-4">
                            <label for="payment_button_font_family" class="form-label">Payment Button Text Font Family</label>
                            <select class="form-control select2" name="payment_button_font_family">
                                <option selected="selected" disabled="disabled">Select</option>
                                @foreach($fontfamily as $family)
                                  <option value="{{$family['key']}}">{{$family['value']}}</option>
                                @endforeach
                            </select>
                          </div>

                          <div class="col-md-4">
                            <label for="payment_button_color" class="form-label">Payment Button Color</label>
                            <input type="text" class="form-control colorpicker" name="payment_button_color" id="payment_button_color">
                          </div>

                          <div class="col-md-12 mt-2 mb-3">
                            <label for="footer_description">Footer Description</label>
                            <textarea class="ckeditor form-control" name="footer_description"></textarea>
                            <div class="error"></div>
                          </div>

                          <div class="mb-3 col-md-4">
                            <label for="footer_description_color" class="form-label">Footer Description Text Color</label>
                            <input type="text" class="form-control colorpicker" name="footer_description_color" id="footer_description_color">
                          </div>

                          <div class="col-md-4">
                            <label for="footer_description_font_size" class="form-label">Footer Description Text Font Size</label>
                            <select class="form-control select2" name="footer_description_font_size">
                                <option selected="selected" disabled="disabled">Select</option>
                                @for($i=$fontsize['start']; $i<=$fontsize['end']; $i+=$fontsize['range'])
                                  <option value="{{$i}}px">{{$i}}px</option>
                                @endfor
                            </select>
                          </div>

                          <div class="col-md-4">
                            <label for="footer_description_font_family" class="form-label">Footer Description Text Font Family</label>
                            <select class="form-control select2" name="footer_description_font_family">
                                <option selected="selected" disabled="disabled">Select</option>
                                @foreach($fontfamily as $family)
                                  <option value="{{$family['key']}}">{{$family['value']}}</option>
                                @endforeach
                            </select>
                          </div>

                        </div>
                    
                        @endif
                        <button type="submit" class="btn btn-primary">Submit</button>
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
        $(".setting_form").validate({
            ignore: [],
            rules: {
                'logo': {
                    extension: "jpg,jpeg,png",
                },
                'email': {
                    required: true,
                },
                'mobile_number': {
                    required: true,
                    maxlength:"10",
                    minlength:"10",
                },
                'time': {
                    required: true,
                },
                'address': {
                    required: true,
                },
                'email_icon': {
                  extension: "jpg,jpeg,png",
                },
                'call_icon': {
                  extension: "jpg,jpeg,png",
                },
                'address_icon': {
                  extension: "jpg,jpeg,png",
                },
            },
            messages: {
                'logo': {
                    extension: "Please enter a value with a valid extension.",
                },
                'email': {
                    required: "The email field is required.",
                },
                'mobile_number': {
                    required: "The mobile number field is required.",
                },
                'time': {
                    required: "The time field is required.",
                },
                'address': {
                    required: "The address field is required.",
                },
                'email_icon': {
                    extension: "Please enter a value with a valid extension.",
                },
                'call_icon': {
                    extension: "Please enter a value with a valid extension.",
                },
                'address_icon': {
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
