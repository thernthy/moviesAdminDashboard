<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
<!-- Google web font "Open Sans" -->
<link rel="stylesheet" href="{{ asset('vendor/font-awesome-4.5.0/css/font-awesome.min.css') }}">
<!-- Font Awesome -->
<link rel="stylesheet" href="{{ asset('vendor/css/bootstrap.min.css') }}">
<!-- Bootstrap style -->
<link rel="stylesheet" href="{{ asset('vendor/css/magnific-popup.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/css/style.css') }}">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" />  

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" />
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Kreon:400,700">

<!-- custom css -->
<link rel="stylesheet" href="{{ asset('css/custom.css') }}">
<script src="https://kit.fontawesome.com/c49fa14979.js" crossorigin="anonymous"></script>

@stack('styles')
</head>
<body>
@include('front.navbar')
<!-- content -->
<div class="wrap">
    @yield('content')

</div>
@include('front.footer')
@include('front.scripts')
</body>
</html>