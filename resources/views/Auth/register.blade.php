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
                    <div class="gd" id="sec1">
                        <div class="form-group">
                            <div class="row">
                                <img src="{{asset('img/profil.png')}}"class="img-fluid avatar rounded-circle" alt="" id="avatar">
                                <input type="file" name="avatar" id="fileavatar" accept="image/*">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label for="nom"><b>Nom et Prenim:</b></label>
                            </div>
                            <div class="row">
                                <input type="text" name="nom" id="nom" placeholder="Nom et Prenom...">
                                <span class="text-danger">@error('nom'){{$message}} @enderror</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label for="description"><b>Description:</b></label>
                            </div>
                            <div class="row">
                                <textarea name="description" class="form-control" placeholder="Description..." id="description" cols="30" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row" style="text-align: center; margin-top: 2%">
                                <div class="col-6">
                                </div>
                                <div class="col-6">
                                    <button type="button" id="suivant1" class="btn btn-primary">Suivant</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="gd" id="sec2">
                        <h4>Facultatif</h4>
                        <div class="form-group">
                            <div class="row">
                                <label for="facebook"><b>Lien Facebook:</b></label>
                            </div>
                            <div class="row">
                                <input type="text" name="facebook" id="facebook" placeholder="Lien Facebook...">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label for="Twitter"><b>Lien Twitter:</b></label>
                            </div>
                            <div class="row">
                                <input type="text" name="twiter" id="twitter" placeholder="Lien Twitter...">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label for="web"><b>Lien de votre Site web:</b></label>
                            </div>
                            <div class="row">
                                <input type="text" name="web" id="web" placeholder="Lien siteweb...">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label for="discord"><b>Lien de votre Discord:</b></label>
                            </div>
                            <div class="row">
                                <input type="text" name="discord" id="discord" placeholder="Lien discord...">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label for="twitch"><b>Lien de votre Twitch:</b></label>
                            </div>
                            <div class="row">
                                <input type="text" name="twitch" id="twitch" placeholder="Lien twitch...">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row" style="text-align: center; margin-top: 2%">
                                <div class="col-6">
                                    <button type="button" id="precedent1" class="btn btn-primary">Précédent</button>
                                </div>
                                <div class="col-6">
                                    <button type="button" id="suivant2" class="btn btn-primary">Suivant</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="gd" id="sec3">
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
                        <div class="form-group">
                            <div class="row" style="text-align: center; margin-top: 2%">
                                <div class="col-6">
                                    <button type="button" id="precedent2" class="btn btn-primary">Précédent</button>
                                </div>
                                <div class="col-6">
                                    <button type="submit" id="envoyer" class="btn btn-lg btn-success">Envoyer</button>
                                </div>
                            </div>
                        </div>
                        <div class="footer">
                            <p>Vous avez un compte ? <a href="{{route('login')}}">Se Connectez !</a>
                            </p>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="{{asset('js/register.js')}}"></script>
</body>
</html>
