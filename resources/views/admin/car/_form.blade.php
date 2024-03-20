@include('admin.master')
<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h1>Car</h1>
          </div>
          <div class="col-sm-6 d-none d-sm-block">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Car</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    @foreach($cars as $car)
                        <form method="post" action="{{ route('car_update', $car->id) }}" class="edit_form" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" value="{{ $car->id }}" class="id" name="id">
                           
                            <div class="mb-3">
                                <label for="name" class="form-label">Select Brand</label>
                                <select name="brand_id" id="brand_id" class="form-control select2">
                                    <option selected="selected" disabled="disabled">Select Brand</option>
                                    @foreach($brands as $brand)
                                        <option value="{{$brand->id}}" {{$car->brand_id == $brand->id  ? 'selected' : ''}}>
                                            {{$brand->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                                <div class="mb-3">
                                    <label for="image" class="form-label">Image</label>
                                    <input  type="file" class="form-control" name="image">
                                    <div class="error"></div>
                                </div>

                                @if($car->image == null)
                                    <img src="{{asset('public/no_image/notImg.png')}}" width="100">
                                    @else
                                    <img src="{{asset('public/car/'.$car->image)}}" width="100">
                                @endif

                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input  type="text" class="form-control" name="name" value="{{$car->name}}">
                                    <div class="error"></div>
                                </div>

                                <div class="mb-3">
                                    <label for="price" class="form-label">Price</label>
                                    <input  type="text" class="form-control" name="price" value="{{$car->price}}">
                                    <div class="error"></div>
                                </div>

                                <div class="mb-3">
                                    <label for="link" class="form-label">Link</label>
                                    <input  type="text" class="form-control" name="link" value="{{$car->link}}">
                                    <div class="error"></div>
                                </div>

                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <a href="{{ route('car.index') }}" class="btn btn-default">Cancel</a>
                            </div>
                        </form>
                    @endforeach 
                </div>
            </div>
        </div>
    </section>
  </div>

<script>
    $(document).ready(function () {
        $(".edit_form").validate({
            rules: {
                image: {
                    extension: "jpg,jpeg,png",
                },
                'name': {
                    required: true,
                },
                'price': {
                    required: true,
                },
                'link': {
                    required: true,
                    url: "url",
                },
            },
            messages: {
                image: {
                    extension: "Please enter a value with a valid extension.",
                },
                'name': {
                    required: "Name is required",
                },
                'price': {
                    required: "Price is required",
                },
                'link': {
                    required: "Link is required",
                    url: "Please enter a valid link",
                },
            },
            errorPlacement: function(error, element) {
                error.appendTo(element.parent().find('.error'));
            },
        });
    });
</script>

  