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
            <form action="{{route('register.create')}}" method="POST" style="border:3px solid #ccc; width: 50%">
                @csrf
                <div class="container">
                  <h1>Sign Up</h1>
                  <hr>
                    <div class="form-group">
                        <label for="nom"><b>Nom et prenom</b></label>
                        <input type="text" placeholder="Enter Email" name="nom" required>
                        <span class="text-danger eror">@error('nom'){{$message}}@enderror</span>
                    </div>

                    <div class="form-group">
                        <label for="email"><b>Email</b></label>
                        <input type="text" placeholder="Enter Email" name="email" required>
                        <span class="text-danger eror">@error('email'){{$message}}@enderror</span>
                    </div>

                    <div class="form-group">
                        <label for="psw"><b>Password</b></label>
                        <input type="password" placeholder="Enter Password" name="password" required>
                        <span class="text-danger eror">@error('password'){{$message}}@enderror</span>
                    </div>
                    <div class="form-group">
                        <label for="psw-repeat"><b>Repeat Password</b></label>
                        <input type="password" placeholder="Repeat Password" name="password_repeat" required>
                        <span class="text-danger eror">@error('password_repeat'){{$message}}@enderror</span>
                    </div>

                  <p>Vous avez déjà de compte ? <a href="{{route('login')}}" style="color:dodgerblue">Se connecter</a>.</p>

                  <div class="clearfix">
                    <button type="button" class="cancelbtn btn btn-danger">Cancel</button>
                    <button type="submit" class="signupbtn btn btn-success ">Sign Up</button>
                  </div>
                </div>
              </form>
        </div>
    </div>
    <script src="{{asset('js/register.js')}}"></script>
</body>
</html>
