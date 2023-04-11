<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/login.css')}}">
    <title>login</title>
</head>
<body>
    @if (session()->has('fail'))
    <div id="customalert">
        <div id="box">
            <div class="heading">
                Message :
            </div>
            <div class="content">
                <p>{{session()->get('fail')}}</p>
                <button id="confirmbtn" type="button" class="btn btn-primary" onclick="hidealert(customalert)">OK</button>
            </div>
        </div>
    </div>
    @endif
    <div class="container centre">

        <form action="{{route('login.log')}}" method="post" style="width: 30vw">
            @csrf
            <div class="imgcontainer">
              <h1>Login</h1>
            </div>

            <div class="container">
              <label for="uname"><b>Email</b></label>
              <input type="email" placeholder="Enter Email" name="email" required>
              <span class="text-danger">@error('email') {{$message}} @enderror</span>

              <label for="psw"><b>Password</b></label>
              <input type="password" placeholder="Enter Password" name="psw" required>
              <span class="text-danger">@error('psw') {{$message}} @enderror</span>

              <button type="submit">Login</button>
              <p>Pas de compte ? Veuillez vous <a href="{{route('register')}}" class="inscrire">Inscrire</a></p>
            </div>

            <div class="container" style="background-color:#f1f1f1">
              <button type="reset" class="cancelbtn">Cancel</button>
              <span class="psw">Mot de passe <a href="#" class="oublier">Oublier?</a></span>
            </div>
        </form>
    </div>
    <script>
        function hidealert(a) {
        a.style.display = 'none';
    }
    </script>
</body>
</html>
