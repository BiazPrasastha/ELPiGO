<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Log in (v2)</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{asset('css/fontawesome-free/css/all.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('css/template/style.min.css')}}">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <h1 style="color: #67CEB9"><b>ELPiGO</b></h1>
            </div>
            <div class="card-body">
                <p class="login-box-msg">You can change your password now.
                </p>
                <form action="/change-password" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="password" name="old" class="form-control" placeholder="Old Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="pass1" class="form-control" placeholder="New Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="pass2" class="form-control" placeholder="Confirm New Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-block btn-primary">Change Password</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                <div style="text-align: center;margin:10px 0">
                    <a href="/">Get Back, Cancel</a>
                </div>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="{{asset('js/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{asset('js/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('js/template/adminlte.min.js')}}"></script>
    @if ($errors->any())
    @foreach ($errors->all() as $error)
    <script>
        $(document).Toasts('create', {
                title: 'Error!!!',
                autohide: true,
                delay: 3000,
                class: 'bg-danger',
                body: '{{ $error }}'
            });
    </script>
    @endforeach
    @endif
    @if (Session::has('notification'))
    <script>
        $(document).Toasts('create', {
            title: 'Error!!!',
            autohide: true,
            delay: 3000,
            class: 'bg-danger',
            body: '{{Session::get("notification")}}'
        });
    </script>
    @endif
</body>

</html>
