@extends('admin.layout.header')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h1>Showroom</h1>
          </div>
          <div class="col-sm-6 d-none d-sm-block">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Showroom</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    @foreach($showrooms as $showroom)
                        <form method="post" action="{{ route('showroom_update', $showroom->id) }}" class="edit_form" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" value="{{ $showroom->id }}" class="id" name="id">
                            <div class="mb-3">
                                <label for="name" class="form-label">Showroom Name</label>
                                <input  type="text" class="form-control" name="name" value="{{$showroom->name}}">
                                <div class="error"></div>
                            </div>

                            <div class="mb-3">
                                <label for="brand_id" class="form-label">Select Brand</label>
                                <select name="brand_id" id="brand_id" class="form-control select2">
                                    <option selected="selected" disabled="disabled">Select Brand</option>
                                    @foreach($brands as $brand)
                                        <option value="{{$brand->id}}" {{$showroom->brand_id == $brand->id  ? 'selected' : ''}}>
                                            {{$brand->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="car_id" class="form-label">Select Car</label>
                                <select name="car_id[]" id="car_id" class="form-control select2" multiple>
                                    <option disabled>Select Car</option>
                                    @foreach($cars as $car)
                                        <option value="{{$car->id}}" {{ in_array($car->id, json_decode($showroom->car_id)) ? 'selected' : '' }}>
                                            {{$car->name}}
                                        </option>
                                    @endforeach
                                </select>
                                <div id="errorcardiv"></div>
                            </div>
                                <div class="mb-3">
                                    <label for="name" class="form-label">Address</label>
                                    <textarea class="form-control" name="address">{{$showroom->address}}</textarea>
                                    <div class="error"></div>
                                </div>

                                <div class="mb-3">
                                    <label for="working_hours" class="form-label">Working Hours</label>
                                    <input  type="text" class="form-control" name="working_hours" value="{{$showroom->working_hours}}">
                                    <div class="error"></div>
                                </div>

                                <div class="mb-3">
                                    <label for="contact_number" class="form-label">Contact Number</label>
                                    <input type="number" id="contact_number" class="form-control" name="contact_number" value="{{$showroom->contact_number}}">
                                    <div class="error"></div>
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" id="email" class="form-control" name="email" value="{{$showroom->email}}">
                                    <div class="error"></div>
                                </div>

                                <div class="mb-3">
                                    <label for="address_color" class="form-label">Address Color</label>
                                    <input type="text" class="form-control colorpicker" name="address_color" id="address_color" value="{{$showroom->address_color}}">
                                    <div class="error"></div>
                                </div>

                                <div class="mb-3">
                                    <label for="address_font_size">Address Select Font Size</label>
                                    <select class="form-control select2" name="address_font_size">
                                        <option selected="selected" disabled="disabled">Address Select Font Size</option>
                                        @for($i=24; $i<=50; $i+=2)
                                            <option value="{{$i}}px" {{$showroom->address_font_size == $i.'px' ? 'selected' : ''}}>{{$i}}px</option>
                                        @endfor
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="address_font_family">Address Select Font Family</label>
                                    <select class="form-control select2" name="address_font_family">
                                        <option selected="selected" disabled="disabled">Address Select Font Family</option>
                                        <option value="poppins"  {{$showroom->address_font_family == 'poppins' ? 'selected' : ''}}>Poppins</option>
                                        <option value="sans-serif" {{$showroom->address_font_family == 'sans-serif' ? 'selected' : ''}}>Sans Serif</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="working_hours_color">Working Hours Color</label>
                                    <input type="text" class="form-control colorpicker" name="working_hours_color" id="working_hours_color" value="{{$showroom->working_hours_color}}">
                                </div>

                                <div class="mb-3">
                                    <label for="working_hours_font_size">Working Hours Select Font Size</label>
                                    <select class="form-control select2" name="working_hours_font_size">
                                        <option selected="selected" disabled="disabled">Working Hours Select Font Size</option>
                                        @for($i=24; $i<=50; $i+=2)
                                            <option value="{{$i}}px" {{$showroom->working_hours_font_size == $i.'px' ? 'selected' : ''}}>{{$i}}px</option>
                                        @endfor
                                    </select>
                                </div>

                              
                                <div class="mb-3">
                                    <label for="working_hours_font_family">Working Hours Select Font Family</label>
                                    <select class="form-control select2" name="working_hours_font_family">
                                        <option selected="selected" disabled="disabled">Working Hours Select Font Family</option>
                                        <option value="poppins"  {{$showroom->working_hours_font_family == 'poppins' ? 'selected' : ''}}>Poppins</option>
                                        <option value="sans-serif" {{$showroom->working_hours_font_family == 'sans-serif' ? 'selected' : ''}}>Sans Serif</option>
                                    </select>
                                </div>
                             
                                <div class="mb-3">
                                    <label for="contact_number_color">Contact Number Color</label>
                                    <input type="text" class="form-control colorpicker" name="contact_number_color" id="contact_number_color" value="{{$showroom->contact_number_color}}">
                                </div>
                             
                               
                                <div class="mb-3">
                                    <label for="contact_number_font_size">Contact Number Select Font Size</label>
                                    <select class="form-control select2" name="contact_number_font_size">
                                        <option selected="selected" disabled="disabled">Contact Number Select Font Size</option>
                                        @for($i=24; $i<=50; $i+=2)
                                            <option value="{{$i}}px" {{$showroom->contact_number_font_size == $i.'px' ? 'selected' : ''}}>{{$i}}px</option>
                                        @endfor
                                    </select>
                                </div>
                               
                                <div class="mb-3">
                                    <label for="contact_number_font_family">Contact Number Select Font Family</label>
                                    <select class="form-control select2" name="contact_number_font_family">
                                        <option selected="selected" disabled="disabled">Contact Number Select Font Family</option>
                                        <option value="poppins"  {{$showroom->contact_number_font_family == 'poppins' ? 'selected' : ''}}>Poppins</option>
                                        <option value="sans-serif" {{$showroom->contact_number_font_family == 'sans-serif' ? 'selected' : ''}}>Sans Serif</option>
                                    </select>
                                </div>
                             
                                <div class="mb-3">
                                    <label for="email_color">Email Color</label>
                                    <input type="text" class="form-control colorpicker" name="email_color" id="email_color" value="{{$showroom->email_color}}">
                                </div>
                              
                                <div class="mb-3">
                                    <label for="email_font_size">Email Select Font Size</label>
                                    <select class="form-control select2" name="email_font_size">
                                        <option selected="selected" disabled="disabled">Email Select Font Size</option>
                                        @for($i=24; $i<=50; $i+=2)
                                            <option value="{{$i}}px" {{$showroom->email_font_size == $i.'px' ? 'selected' : ''}}>{{$i}}px</option>
                                        @endfor
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="email_font_family">Email Select Font Family</label>
                                    <select class="form-control select2" name="email_font_family">
                                        <option selected="selected" disabled="disabled">Email Select Font Family</option>
                                        <option value="poppins"  {{$showroom->email_font_family == 'poppins' ? 'selected' : ''}}>Poppins</option>
                                        <option value="sans-serif" {{$showroom->email_font_family == 'sans-serif' ? 'selected' : ''}}>Sans Serif</option>
                                    </select>
                                </div>
                                
                                <div class="mb-3">
                                    <label>Facilitie Image</label>
                                    @if($facilitie_image == NULL)
                                        <img src="{{asset('public/no_image/notImg.png')}}" width="100">
                                    @else
                                        @foreach ($facilitie_image as $key => $image ) 
                                            <div class="col-4 offset-1" style="top: 11px;">
                                                <button type="button" data-id="{{$key}}" class="badge btn-danger facilitie_image_btn">X</button>
                                            </div>
                                            <img src="{{asset('public/facilitie_image/'.$image)}}" width="100">
                                        @endforeach
                                    @endif
                                </div>

                                <table class="table table-bordered" cellspacing="0">
                                    <tr>
                                        <th>Facilitie Image</th>
                                        <th>Action</th>
                                    </tr>
                                    <tr class="sub_table">
                                        <td>
                                            <input type="file" class="form-control rate" name="facilitie_image[]">
                                        </td>
                                        <td>
                                            <button tabindex="1" type="button" class="btn btn-success add btn-sm" onclick="">+</button>
                                            <button tabindex="1" type="button" class="btn btn-danger minus btn-sm">-</button>
                                        </td>
                                    </tr>
                                </table>
                       
                        <div class="mb-3">
                            <label>Customer Gallery Image</label>
                            @if($customer_gallery_images == NULL)
                                <img src="{{asset('public/no_image/notImg.png')}}" width="100">
                            @else
                                @foreach ($customer_gallery_images as $key => $customer_gallery_image ) 
                                    <div class="col-4 offset-1" style="top: 11px;">
                                        <button type="button" data-id="{{$key}}" class="badge btn-danger customer_gallery_image_btn">X</button>
                                    </div>
                                    <img src="{{asset('public/customer_gallery_image/'.$customer_gallery_image)}}" width="100">
                                @endforeach
                            @endif
                        </div>

                        <table class="table table-bordered" cellspacing="0">
                            <tr>
                                <th>Customer Gallery Image</th>
                                <th>Action</th>
                            </tr>
                            <tr class="customer_gallery_table">
                                <td>
                                    <input type="file" class="form-control" name="customer_gallery_image[]">
                                </td>
                                <td>
                                    <button tabindex="1" type="button" class="btn btn-success customer_gallery_add btn-sm" onclick="">+</button>
                                    <button tabindex="1" type="button" class="btn btn-danger customer_gallery_minus btn-sm">-</button>
                                </td>
                            </tr>
                        </table>

                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <a href="{{ route('showroom.index') }}" class="btn btn-default">Cancel</a>
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

        $('#brand_id').change(function () {
            var brand_id = $(this).val();
            if (brand_id) {
                $.ajax({
                    type: "GET",
                    url: "{{ route('getcars') }}",
                    data: { brand_id: brand_id },
                    success: function (cars) {
                        $('#car_id').empty();
                        $('#car_id').append('<option disabled>Select Car</option>');
                        $.each(cars, function (key, car) {
                            $('#car_id').append('<option value="' + car.id + '">' + car.name + '</option>'); 
                        });
                    }
                });
            } else {
                $('#car_id').empty();
            }
        });


        $(".edit_form").validate({
            rules: {
                'car_id[]': { 
                    required: true,
                },
                'address': {
                    required: true,
                },
                'working_hours': {
                    required: true,
                },
                'contact_number': {
                    required: true,
                    maxlength:"10",
                    minlength:"10",
                },
                'email': {
                    required: true,
                },
            },
            messages: {
                'car_id[]': { 
                    required: "Car is required",
                },
                'address': {
                    required: "Address is required",
                },
                'working_hours': {
                    required: "Working hours is required",
                },
                'contact_number': {
                    required: "Contact number is required",
                },
                'email': {
                    required: "Email is required",
                },
            },
            errorPlacement: function(error, element) {
            if (element.attr("name") == "car_id[]") {
                error.appendTo('#errorcardiv');
                return;
            }
            if (element.attr("name") == "address") {
                error.appendTo(element.next('.error'));
                return;
            } else {
                error.insertAfter(element);
            }
        }
        });

        $('body').on('click' ,".add",function(){
            var $tr = $(this).closest('.sub_table');
            var $clone = $tr.clone();

            $clone.find('input').val('');
            $clone.find('span:nth-child(3)').remove();

            $tr.after($clone);
            sr_change();
        });

        $('body').on('click' ,".minus",function(event){
            if($(".sub_table").length > 1){

                $(this).closest(".sub_table").remove();
                sr_change();
            }
        });

        $('.facilitie_image_btn').on('click',function(){
            var id = $(this).data('id');
            $.ajax({
                url:"{{ route('facilitie_imagedelete') }}",
                type: "post",
                data: {
                    "id": id,
                    _token:"{{ csrf_token() }}",
                },
                success: function(data) {
                    location.reload();
                },
            })
        });

        $('.customer_gallery_image_btn').on('click',function(){
            var id = $(this).data('id');
            $.ajax({
                url:"{{ route('customer_gallery_imagedelete') }}",
                type: "post",
                data: {
                    "id": id,
                    _token:"{{ csrf_token() }}",
                },
                success: function(data) {
                    location.reload();
                },
            })
        });

        $('body').on('click' ,".customer_gallery_add",function(){
            var $tr = $(this).closest('.customer_gallery_table');
            var $clone = $tr.clone();

            $clone.find('input').val('');
            $clone.find('span:nth-child(3)').remove();

            $tr.after($clone);
            sr_change();
        });

        $('body').on('click' ,".customer_gallery_minus",function(event){
            if($(".customer_gallery_table").length > 1){

                $(this).closest(".customer_gallery_table").remove();
                sr_change();
            }
        });

        $('.colorpicker').colorpicker();

    });
</script>
@endsection

