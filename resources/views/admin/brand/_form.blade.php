@extends('admin.layout.header')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h1>Brand</h1>
          </div>
          <div class="col-sm-6 d-none d-sm-block">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Brand</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    @foreach($brands as $brand)
                        <form method="post" action="{{ route('brand_update', $brand->id) }}" class="edit_form" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" value="{{ $brand->id }}" class="id" name="id">
                           
                                <div class="mb-3">
                                    <label for="image" class="form-label">Image</label>
                                    <input  type="file" class="form-control" name="image">
                                    <div class="error"></div>
                                </div>

                                @if($brand->image == null)
                                    <img src="{{asset('public/no_image/notImg.png')}}" width="100">
                                    @else
                                    <img src="{{asset('public/brand/'.$brand->image)}}" width="100">
                                @endif

                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input  type="text" class="form-control" name="name" value="{{$brand->name}}">
                                    <div class="error"></div>
                                </div>

                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <a href="{{ route('brand.index') }}" class="btn btn-default">Cancel</a>
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
        $(".edit_form").validate({
            rules: {
                'name': {
                    required: true,
                },
                image: {
                    extension: "jpg,jpeg,png",
                },
            },
            messages: {
                'name': {
                    required: "Name is required",
                },
                image: {
                    extension: "Please enter a value with a valid extension.",
                },
            },
            errorPlacement: function(error, element) {
                error.appendTo(element.parent().find('.error'));
            },
        });
    });
</script>
@endsection

  