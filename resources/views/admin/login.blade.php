
<html>
    <head>
        @include('admin.layout.headerscript')
        <style>
            .error{
                color: red;
            }
        </style>
    </head>
    <body class="hold-transition login-page">
        <div class="login-box">
          <div class="login-logo">
            <a href="../../index2.html"><b>Admin</b>LTE</a>
          </div>
          <div class="card">
            <div class="card-body login-card-body">
              <p class="login-box-msg">Sign in to start your session</p>
        
              <form method="POST" action="{{ route('login.custom') }}" class="login_form">
                @csrf
                <div class="form-group">
                    <div class="input-group mb-3">
                        <input type="email" class="form-control"  name="email" placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    @if ($errors->has('meassage'))
                        <span class="text-danger">{{ $errors->first('meassage') }}</span>
                    @endif
                </div>
    
    
                <div class="form-group">
                    <div class="input-group mb-3">
                    <input type="password" class="form-control" name="password" placeholder="Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
    
            </div>
          </div>
        </div>
        </body>
        @include('admin.layout.footerscript')
    
        <script>
            $(document).ready(function () {
                $(".login_form").validate({
                    rules: {
                        email: {
                            required: true,
                            email:true,
                        },
                        password: {
                            required: true
                        },
                    },
                    messages: {
                        email: {
                            required: "Email is required",
                        },
                        password: {
                            required: "Password is required",
                        }
                    },
                    errorElement: 'span',
                    errorPlacement: function (error, element) {
                        error.addClass('invalid-feedback');
                        element.closest('.form-group').append(error);
                    },
                });
            });
        </script>
    </html>
    
    
    
    
    