@include('admin.master')

<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h1>Galaxy Toyota</h1>
          </div>
          <div class="col-sm-6 d-none d-sm-block">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Galaxy Toyota</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('galaxy_toyota_insert') }}" method="POST" class="galaxy_toyota_form" enctype="multipart/form-data">
                        @csrf

                        @if(isset($galaxy_toyotas) && count($galaxy_toyotas) > 0)
                            @foreach($galaxy_toyotas as $galaxy_toyota)
                          
                            <div class="form-group row">
                                <label for="title" class="col-md-4 col-form-label text-md-right">Title</label>
                                <div class="col-md-6">
                                    <input type="text" id="title" class="form-control" name="title" value="{{ $galaxy_toyota->title ?? '' }}">
                                    <div class="error"></div>
                                </div>
                            </div>
                        
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Description</label>
                                <div class="col-md-6"> 
                                    <textarea class="ckeditor form-control" name="description">{{$galaxy_toyota->description}}</textarea>
                                    <div class="error"></div>
                                </div>
                            </div>
                            @endforeach
                        @else

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
        $(".galaxy_toyota_form").validate({
            ignore: [],
            rules: {
                'title': {
                    required: true,
                },
                'description': {
                    required: true,
                },
            },
            messages: {
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
