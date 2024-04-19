@extends('admin.layout.header')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h1>Home Our Businesses Edit</h1>
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
                                <div class="mb-3 col-md-6">
                                    <label for="image" class="form-label">Image<span class="text-danger">*</span></label><small>(Height:145px,Width:145px; Image Type : jpg,jpeg,png,svg,webp)</small>
                                    @if(isset($home_our_businesse->image) && isset($home_our_businesse->image))
                                        <img src="{{url('public/home_our_businesses/'.$home_our_businesse->image)}}" width="100" style="margin-bottom: 10px; margin-left: 5px;">
                                    @endif
                                    <input type="file" id="image" class="form-control" name="image">
                                </div>

                                <div class="col-md-6">
                                    <label for="link">Link</label>
                                    <input type="text" id="link" class="form-control" name="link" value="{{$home_our_businesse->link}}">
                                </div>

                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary submit">Submit</button>
                                <a href="{{ route('home_our_businesses.index') }}" class="btn btn-danger">Cancel</a>
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
                    extension: "jpg,jpeg,png,webp,svg",
                },
                'link': {
                    url: "url",
                },
            },
            messages: {
                image: {
                    extension: "Image must be jpg,jpeg,png,svg or webp.",
                },
                'link': {
                    url: "Please enter a valid link.",
                },
            },
        });
        $('.colorpicker').colorpicker();
    });
</script>
@endsection
  