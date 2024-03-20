@include('admin.master')

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
                    <form action="{{ route('showroom_insert') }}" method="POST" class="showroom_form" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Select Brand</label>
                            <div class="col-md-6">
                                <select name="brand_id" id="brand_id" class="form-control select2">
                                    <option selected="selected" disabled="disabled">Select Brand</option>
                                    @foreach($brands as $brand)
                                        <option value="{{$brand->id}}">
                                            {{$brand->name}}
                                        </option>
                                    @endforeach
                                </select>
                                <div id="errordiv"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="car_id" class="col-md-4 col-form-label text-md-right">Select Car</label>
                            <div class="col-md-6">
                                <select name="car_id[]" id="car_id" class="form-control select2" multiple>
                                    <option disabled>Select Car</option>
                                    @foreach($cars as $car)
                                        <option value="{{$car->id}}">{{$car->name}}</option>
                                    @endforeach
                                </select>
                                <div id="errorcardiv"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">Address</label>
                            <div class="col-md-6">
                                <textarea class="form-control" name="address"></textarea>
                                <div class="error"></div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="working_hours" class="col-md-4 col-form-label text-md-right">Working Hours</label>
                            <div class="col-md-6">
                                <input type="text" id="working_hours" class="form-control" name="working_hours">
                                <div id="error"></div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="contact_number" class="col-md-4 col-form-label text-md-right">Contact Number</label>
                            <div class="col-md-6">
                                <input type="number" id="contact_number" class="form-control" name="contact_number">
                                <div class="error"></div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>
                            <div class="col-md-6">
                                <input type="email" id="email" class="form-control" name="email">
                                <div class="error"></div>
                            </div>
                        </div>

                        <table class="table table-bordered" cellspacing="0">
                            <tr>
                                <th>Facilitie Image</th>
                                <th>Action</th>
                            </tr>
                            <tr class="sub_table">
                                <td>
                                    <input type="file" class="form-control" name="facilitie_image[]">
                                </td>
                                <td>
                                    <button tabindex="1" type="button" class="btn btn-success add btn-sm" onclick="">+</button>
                                    <button tabindex="1" type="button" class="btn btn-danger minus btn-sm">-</button>
                                </td>
                            </tr>
                        </table>

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
                            <button type="submit" class="btn btn-primary submit">
                                Submit
                            </button>
                            <a href="{{ route('showroom.index') }}" class="btn btn-default">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
  </div>

<script>
    $(document).ready(function () {
        $(".showroom_form").validate({
            rules: {
                'brand_id': {
                    required: true,
                },
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
                'brand_id': {
                    required: "Brand is required",
                },
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
                if(element.attr("name") == "brand_id"){
                    error.appendTo('#errordiv');
                    return;
                }
                if(element.attr("name") == "car_id[]"){
                    error.appendTo('#errorcardiv');
                    return;
                }
                if(element.attr("name") == "name"){
                        error.appendTo('#error');
                        return;
                }else {
                    error.insertAfter(element);
                }
            },
            submitHandler: function(form) {
                $(form).find('.submit').prop("disabled", true);
                form.submit();
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
    });
</script>