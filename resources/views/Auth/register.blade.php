<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/register.css')}}">
    <title>register</title>
</head>
<body>
    @if (session()->has('sucses'))
        <div id="customalert">
            <div id="box">
                <div class="heading">
                    Message :
                </div>
                <div class="content">
                    <p>{{session()->get('sucses')}}</p>
                    <button id="confirmbtn" type="button" class="btn btn-primary" onclick="hidealert(customalert)">OK</button>
                </div>
            </div>
        </div>
    @endif
    <div class="container main">
        <div class="row sec">
            <form action="{{route('register.create')}}" class="form1" method="POST" id="form1">
                @csrf
                <div class="row">
                    <div class="gd" id="">
                        <div class="form-group">
                            <div class="row">
                                <label for="nom"><b>Nom et Prenom:</b></label>
                            </div>
                            <div class="row">
                                <input type="text" name="nom" id="nom" placeholder="Nom et Prenom...">
                                <span class="text-danger">@error('nom'){{$message}} @enderror</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label for="email"><b>Email:</b></label>
                            </div>
                            <div class="row">
                                <input type="email" name="email" id="email" placeholder="email...">
                                <span class="text-danger">@error('email'){{$message}} @enderror</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label for="password"><b>Mot de passe:</b></label>
                            </div>
                            <div class="row">
                                <input type="password" name="password" id="password" placeholder="Mot de passe...">
                                <span class="text-danger">@error('password'){{$message}} @enderror</span>
                            </div>
                        </div>
                        <div class="footer">
                            <p>Vous avez un compte ? <a href="{{route('login')}}">Se Connectez !</a>
                            </p>
                        </div>
                    </div>
                    <button>env</button>
                </div>
            </form>
        </div>
    </div>
    <script src="{{asset('js/register.js')}}"></script>
</body>
</html>
