<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('page-title') | Safari Gym</title>
    <link rel="stylesheet" href="{{ asset('assets/css/main/app.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/app-dark.css')}}">
    <link rel="shortcut icon" href="{{ asset('assets/images/logo/favicon.svg')}}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('assets/images/logo/favicon.png')}}" type="image/png">
    <link rel="stylesheet" href="{{ asset('assets/css/shared/iconly.css')}}">
    <!-- <link rel="stylesheet" href="{{ asset('assets/extensions/@fortawesome/fontawesome-free/css/all.min.css')}}"> -->
   <!-- idr se copy kr lena action m masla hai -->
    @stack('mycss')
</head>