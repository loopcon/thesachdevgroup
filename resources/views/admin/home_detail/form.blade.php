@include('admin.master')

<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h1>Home Detail</h1>
          </div>
          <div class="col-sm-6 d-none d-sm-block">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Home Detail</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('home_detail_insert') }}" method="POST" class="home_detail_form" enctype="multipart/form-data">
                        @csrf

                        @if(isset($home_details) && count($home_details) > 0)
                            @foreach($home_details as $home_detail)
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Image</label>
                                <div class="col-md-6">
                                    <input type="file" id="image" class="form-control" name="image">
                                    @if($home_detail->image == null)
                                    <img src="{{asset('public/no_image/notImg.png')}}" width="100">
                                @else
                                    <img src="{{asset('public/home_detail/'.$home_detail->image)}}" width="100">
                                @endif
                                <div class="error"></div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="title" class="col-md-4 col-form-label text-md-right">Title</label>
                                <div class="col-md-6">
                                    <input type="text" id="title" class="form-control" name="title" value="{{ $home_detail->title ?? '' }}">
                                    <div class="error"></div>
                                </div>
                            </div>
                        
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Description</label>
                                <div class="col-md-6"> 
                                    <textarea class="ckeditor form-control" name="description">{{$home_detail->description}}</textarea>
                                    <div class="error"></div>
                                </div>
                            </div>
                            @endforeach
                        @else
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Image</label>
                            <div class="col-md-6">
                                <input type="file" id="image" class="form-control" name="image">
                                <div class="error"></div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label text-md-right">Title</label>
                            <div class="col-md-6">
                                <input type="text" id="title" class="form-control" name="title">
                                <div class="error"></div>
                            </div>
                        </div>

                        
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Description</label>
                            <div class="col-md-6"> 
                                <textarea class="ckeditor form-control" name="description"></textarea>
                                <div class="error"></div>
                            </div>
                        </div>

                        @endif

                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
  </div>
<script>
    $(document).ready(function () {
        $(".home_detail_form").validate({
            ignore: [],
            rules: {
                'image': {
                    extension: "jpg,jpeg,png",
                },
                'title': {
                    required: true,
                },
                'description': {
                    required: true,
                },
            },
            messages: {
                'image': {
                    extension: "Please enter a value with a valid extension.",
                },
                'title': {
                    required: "Title is required",
                },
                'description': {
                    required: "Description is required",
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
