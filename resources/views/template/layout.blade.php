<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('webfonts/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('webfonts/fontawesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/createequipe.css')}}">

    <title>Document</title>
</head>
<body>
    <header class="container-fluid" style="padding: 2%;">
        @include('../Auth.navbar')
    </header>
    <main class="container-fluid" style="padding: 2%">
        @yield('content')
    </main>
    <script src="{{asset('bootstrap/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('bootstrap/js/popper.min.js')}}"></script>
    <script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/scriptprofile.js')}}"></script>
</body>
</html>
