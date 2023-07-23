<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Networker</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" type="image/png" style="width: 500px; height:80px; " href="{{ asset('assets/images/logo/logoq1.png')}}"/>

    <!-- App css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/icons.min.cs') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />




</head>

<body class="account-body accountbg">

    <!-- Log In page -->
    <div class="container">
        <div class="row vh-100 d-flex justify-content-center">
            <div class="col-12 align-self-center">
                <div class="row">
                    <div class="col-lg-5 mx-auto">
                        <div class="card">
                            <div class="card-body p-0 auth-header-box" style="background-color:white">
                                <div class="text-center p-3">
                                    <span>
                                        <div>

                                            <img src="{{asset('assets/images/logo.jpg')}}"
                                                style="width: 350px; ">

                                        </div>
                                        
                                    </span>

                                </div>
                            </div>
                            <div class="card-body p-0">



                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div class="tab-pane active p-3" id="LogIn_Tab" role="tabpanel">
                                        @if (Session::has('message'))
                                            <div class="alert alert-{{ Session::get('message_class') }} border-0"
                                                role="alert">
                                                <button type="button" class="close" data-dismiss="alert"
                                                    aria-label="Close">
                                                    <span aria-hidden="true"><i
                                                            class="mdi mdi-close align-middle font-16"></i></span>
                                                </button>
                                                {!! Session::get('message') !!}
                                            </div>
                                        @endif
                                        <form class="form-horizontal auth-form" action="loginSubmit" method="post">
                                            @csrf
                                            <div class="form-group mb-2">
                                                <label for="username">Email</label>
                                                <div class="input-group">
                                                    <input type="email" class="form-control" value="{{ old('email') }}"
                                                        name="email" id="email" placeholder="Enter Email">
                                                    @error('email')
                                                        <span class='text-danger'>{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <!--end form-group-->

                                            <div class="form-group mb-2">
                                                <label for="userpassword">Password</label>
                                                <div class="input-group">
                                                    <input type="password" class="form-control" name="password"
                                                        id="userpassword" placeholder="Enter password">
                                                    @error('password')
                                                        <span class='text-danger'>{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <!--end form-group-->

                                            <!--end form-group-->

                                            <div class="form-group mb-0 row">
                                                <div class="col-12">
                                                    <button class="btn btn-primary btn-block waves-effect waves-light"
                                                        type="submit">Log In <i
                                                            class="fas fa-sign-in-alt ml-1"></i></button>
                                                </div>
                                                <!--end col-->
                                            </div>
                                            <!--end form-group-->
                                        </form>
                                        <!--end form-->



                                    </div>

                                </div>
                            </div>
                            <!--end card-body-->
                            <div class="card-body bg-light-alt text-center">
                                <span class="text-muted d-none d-sm-inline-block">Shehwar ©
                                    {{ date('Y') }}</span>
                            </div>
                        </div>
                        <!--end card-->
                    </div>
                    <!--end col-->
                </div>
                <!--end row-->
            </div>
            <!--end col-->
        </div>
        <!--end row-->
    </div>
    <!--end container-->
    <!-- End Log In page -->




    <!-- jQuery  -->
    <link href="{{ asset('assets/js/jquery.min.js') }}" rel="stylesheet" />
    <link href="{{ asset('assets/js/bootstrap.bundle.min.js') }}" rel="stylesheet" />
    <link href="{{ asset('assets/js/waves.js') }}" rel="stylesheet" />
    <link href="{{ asset('assets/js/feather.min.js') }}" rel="stylesheet" />
    <link href="{{ asset('assets/js/simplebar.min.js') }}" rel="stylesheet" />


</body>

</html>
