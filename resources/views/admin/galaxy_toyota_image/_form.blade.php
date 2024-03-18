@include('admin.master')
<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h1>Galaxy Toyota Image</h1>
          </div>
          <div class="col-sm-6 d-none d-sm-block">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Galaxy Toyota Image</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    @foreach($galaxy_toyota_images as $galaxy_toyota_image)
                        <form method="post" action="{{ route('galaxy_toyota_image_update', $galaxy_toyota_image->id) }}" class="edit_form" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" value="{{ $galaxy_toyota_image->id }}" class="id" name="id">
                           
                                <div class="mb-3">
                                    <label for="image" class="form-label">Image</label>
                                    <input  type="file" class="form-control" name="image">
                                    <div class="error"></div>
                                </div>

                                @if($galaxy_toyota_image->image == null)
                                    <img src="{{asset('public/no_image/notImg.png')}}" width="100">
                                    @else
                                    <img src="{{asset('public/galaxy_toyota_image/'.$galaxy_toyota_image->image)}}" width="100">
                                @endif

                             

                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input  type="text" class="form-control" name="name" value="{{$galaxy_toyota_image->name}}">
                                    <div class="error"></div>
                                </div>

                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <a href="{{ route('galaxy_toyota_image.index') }}" class="btn btn-default">Cancel</a>
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
            ignore: [],
            rules: {
                image: {
                    extension: "jpg,jpeg,png",
                },
                'name': {
                    required: true,
                },
            },
            messages: {
                image: {
                    extension: "Please enter a value with a valid extension.",
                },
                'name': {
                    required: "Name is required",
                },
            },
            errorPlacement: function(error, element) {
                error.appendTo(element.parent().find('.error'));
            },
        });
    });
</script>

  