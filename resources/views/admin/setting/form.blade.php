@extends('admin.layout.header')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
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

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                  <label for="image">Logo</label>
                                  @if($setting->logo == null)
                                    <img src="{{url('public/no_image/notImg.png')}}" width="100">
                                  @else
                                    <img src="{{url('public/logo/'.$setting->logo)}}" width="100">
                                  @endif
                                  <input type="file" id="logo" class="form-control" name="logo">
                                  <div class="error"></div>
                                </div>
                                <div class="form-group col-md-6">
                                  <label for="email">E-mail</label>
                                  <input type="email" id="email" class="form-control" name="email" value="{{ $setting->email ?? '' }}">
                                  <div class="error"></div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                  <label for="mobile_number">Mobile Number</label>
                                  <input type="number" id="mobile_number" class="form-control" name="mobile_number" value="{{ $setting->mobile_number ?? '' }}">
                                  <div class="error"></div>
                                </div>
                                <div class="form-group col-md-6">
                                  <label for="time">Time</label>
                                  <input type="text" id="time" class="form-control" name="time" value="{{ $setting->time ?? '' }}">
                                  <div class="error"></div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                  <label for="twitter_link">Twitter Link</label>
                                  <input type="text" id="twitter_link" class="form-control" name="twitter_link" value="{{ $setting->twitter_link ?? '' }}">
                                  <div class="error"></div>
                                </div>
                                <div class="form-group col-md-6">
                                  <label for="linkedin_link">Linkedin Link</label>
                                  <input type="text" id="linkedin_link" class="form-control" name="linkedin_link" value="{{ $setting->linkedin_link ?? '' }}">
                                  <div class="error"></div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                  <label for="facebook_link">Facebook Link</label>
                                  <input type="text" id="facebook_link" class="form-control" name="facebook_link" value="{{ $setting->facebook_link ?? '' }}">
                                  <div class="error"></div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="address">Address</label>
                                    <textarea class="form-control" name="address">{{$setting->address}}</textarea>
                                    <div class="error"></div>
                                </div>
                            </div>

                            <div class="form-row">
                              <div class="form-group col-md-6">
                                <label for="email_icon">Email Icon</label>
                                @if($setting->email_icon == null)
                                  <img src="{{url('public/no_image/notImg.png')}}" width="100">
                                @else
                                    <img src="{{url('public/email_icon/'.$setting->email_icon)}}" width="100">
                                @endif
                                <input type="file" id="email_icon" class="form-control" name="email_icon">
                                <div class="error"></div>
                              </div>
                              <div class="form-group col-md-6">
                                  <label for="call_icon">Call Icon</label>
                                  @if($setting->call_icon == null)
                                    <img src="{{url('public/no_image/notImg.png')}}" width="100">
                                  @else
                                      <img src="{{url('public/call_icon/'.$setting->call_icon)}}" width="100">
                                  @endif
                                  <input type="file" id="call_icon" class="form-control" name="call_icon">
                                  <div class="error"></div>
                                </div>
                            </div>

                            <div class="mb-3">
                              <label for="footer_description">Footer Description</label>
                              <textarea class="ckeditor form-control" name="footer_description">{{$setting->footer_description}}</textarea>
                              <div class="error"></div>
                            </div>

                            @endforeach
                        @else
                 
                        <div class="form-row">
                            <div class="form-group col-md-6">
                              <label for="image">Logo</label>
                              <input type="file" id="logo" class="form-control" name="logo">
                              <div class="error"></div>
                            </div>
                            <div class="form-group col-md-6">
                              <label for="email">E-mail</label>
                              <input type="email" id="email" class="form-control" name="email">
                              <div class="error"></div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                              <label for="mobile_number">Mobile Number</label>
                              <input type="number" id="mobile_number" class="form-control" name="mobile_number">
                              <div class="error"></div>
                            </div>
                            <div class="form-group col-md-6">
                              <label for="time">Time</label>
                              <input type="text" id="time" class="form-control" name="time">
                              <div class="error"></div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                              <label for="twitter_link">Twitter Link</label>
                              <input type="text" id="twitter_link" class="form-control" name="twitter_link">
                              <div class="error"></div>
                            </div>
                            <div class="form-group col-md-6">
                              <label for="linkedin_link">Linkedin Link</label>
                              <input type="text" id="linkedin_link" class="form-control" name="linkedin_link">
                              <div class="error"></div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                              <label for="facebook_link">Facebook Link</label>
                              <input type="text" id="facebook_link" class="form-control" name="facebook_link">
                              <div class="error"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="address">Address</label>
                                <textarea class="form-control" name="address"></textarea>
                                <div class="error"></div>
                              </div>
                        </div>


                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="email_icon">Email Icon</label>
                            <input type="file" id="email_icon" class="form-control" name="email_icon">
                            <div class="error"></div>
                          </div>
                          <div class="form-group col-md-6">
                              <label for="call_icon">Call Icon</label>
                              <input type="file" id="call_icon" class="form-control" name="call_icon">
                              <div class="error"></div>
                            </div>
                      </div>

                        <div class="mb-3">
                          <label for="footer_description">Footer Description</label>
                          <textarea class="ckeditor form-control" name="footer_description"></textarea>
                          <div class="error"></div>
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
                'twitter_link': {
                    required: true,
                    url: "url",
                },
                'linkedin_link': {
                    required: true,
                    url: "url",
                },
                'facebook_link': {
                    required: true,
                    url: "url",
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
                'twitter_link': {
                    required: "The twitter link field is required.",
                    url: "Please enter a valid link",
                },
                'linkedin_link': {
                    required: "The linkedin link field is required.",
                    url: "Please enter a valid link",
                },
                'facebook_link': {
                    required: "The facebook link field is required.",
                    url: "Please enter a valid link",
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
            },
            errorPlacement: function(error, element) {
                error.appendTo(element.parent().find('.error'));
            },
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
       $('.ckeditor').ckeditor();
    });
</script>
@endsection
