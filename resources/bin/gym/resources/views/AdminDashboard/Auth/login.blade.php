<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Safari Gym</title>
    <link rel="stylesheet" href="assets/css/main/app.css">
    <link rel="stylesheet" href="assets/css/pages/auth.css">
    <link rel="shortcut icon" href="assets/images/logo/favicon.svg" type="image/x-icon">
    <link rel="shortcut icon" href="assets/images/logo/favicon.png" type="image/png">
    <link rel="stylesheet" href="{{asset('assets/extensions/sweetalert2/sweetalert2.min.css')}}">

    <link rel="stylesheet" href="{{asset('assets/extensions/choices.js/public/assets/styles/choices.css')}}">
</head>

<body>
    <div id="auth">

        <div class="row h-100">
            <div class="col-lg-5 col-12" style="background-color: #0a0a09;">
                <div id="auth-left">
                    <div class="auth-logo">

                        @php $logo_img = DB::table('settings')->where('id',5)->value('description'); @endphp
                        @if($logo_img)
                        <a href="javascript:void(0)"><img src="{{asset('d_img')}}/{{$logo_img}}" style="height:150px;" alt="Logo" srcset=""></a>

                        @else

                        <a href="index.html"><img src="assets/images/logo/logo.svg" alt="Logo"></a>

                        @endif

                    </div>


                    <form action="{{ route('login.submit') }}" method="post" autocomplete="off">
                        @csrf

                        @error('admin_username') <span class='text-danger'>{{ $message }}</span> @enderror


                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="text" class="form-control form-control-xl" placeholder="Username" name="admin_username">
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>
                        @error('admin_password') <span class='text-danger'>{{ $message }}</span> @enderror
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" class="form-control form-control-xl" name="admin_password" placeholder="Password">
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li> <span class='text-danger mb-2'> {{ $error }}</span></li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        @if (Session::has('message'))

                        <span class='text-danger mb-2'> {!! Session::get('message') !!}</span>

                        @endif
                        <div class="form-check form-check-lg d-flex align-items-end">
                            <input class="form-check-input me-2" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label text-gray-600" for="flexCheckDefault">
                                Keep me logged in
                            </label>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Log in</button>
                    </form>

                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block" style="background-color: #0a0a09;">
                <div id="auth-right" style="background-image: url({{asset('assets/images/faces/main_login.PNG')}});background-size:cover;">

                </div>
            </div>
        </div>

    </div>
    <script src="{{ asset('assets/extensions/sweetalert2/sweetalert2.min.js')}}"></script>
    <script>
        @if(Session::has('success'))
        Swal.fire({
            icon: "success",
            title: "Success",
            text: "{!! Session::get('success') !!}",
        });
        @endif
    </script>
</body>

</html>