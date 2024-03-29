@extends('admin.layout.header')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h1>Home Our Businesses Edit</h1>
          </div>
          <div class="col-sm-6 d-none d-sm-block">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Home Our Businesses Edit</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    @foreach($home_our_businesses as $home_our_businesse)
                        <form method="post" action="{{ route('home_our_businesses_update', $home_our_businesse->id) }}" class="edit_form" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" value="{{ $home_our_businesse->id }}" class="id" name="id">
                            <div class="row">
                                <div class="mb-3 col-md-4">
                                    <label for="image" class="form-label">Image<span class="text-danger">*</span></label>
                                    <img src="{{url('public/home_our_businesses/'.$home_our_businesse->image)}}" width="100">
                                    <input type="file" id="image" class="form-control" name="image">
                                </div>
                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary submit">Submit</button>
                                <a href="{{ route('home_our_businesses.index') }}" class="btn btn-default">Cancel</a>
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
                image: {
                    extension: "jpg,jpeg,png,webp",
                },
            },
            messages: {
                image: {
                    extension: "The image must be an image.",
                },
            },
        });
    });
</script>
@endsection
  