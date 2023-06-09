@extends('../template.layout')

@section('content')
    <div class="container-fluid">
        <form action="{{route('posteditother')}}" id="formupdateprofil" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                {{-- @foreach ($users as $others) --}}
                    <div class="col-5">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card" style="height: 100%">
                                        <h2>{{$others->name}}</h2>
                                        <div class="img-box" style="">
                                            <div id="imgBox">
                                                <img src="{{Storage::url('photoProfile/'.$others->avatar)}}" class="img-fluid rounded-circle" style="width: 250px;" alt="" id="imgc">
                                            </div>
                                            <br>
                                            <div class="row row-image" style=" width: 100%">
                                                <input type="file" name="imgp" id="imgp" class="form-control fileimg bg-danger" accept=".jpg, .png">
                                            </div>
                                            <hr>
                                        </div>
                                        <div class="card-body">
                                            <div class="bloc">
                                                <p>Uploader un nouvel Avatar. une large image sera redimentioné automatiquemant. <br> Taille Maximum est de 1MB</p>
                                            </div>
                                            <div class="datemembre">
                                                <p>Membre depuis <b>{{$others->created_at->format('d F Y')}}</b></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-7">
                        <div class="card" style="padding: 2%">
                            <h2 style="text-align: left">Edit Profile</h2>

                            <div class="row bloc-choix">
                                <div class="col-3">
                                    <p><a href="#userIfo" class="active" id="userinfo">User Info</a></p>
                                </div>
                            </div>
                            <div class="choix" style="margin-top: 5%">
                                <div id="userInfo">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group" style="text-align: left;">
                                                <label for="nom"><b>Nom et Prenom</b></label>
                                                <input type="text" class="form-control" name="nom" value="{{$others->name}}">
                                                <span class="text-danger eror">@error('nom'){{$message}}@enderror</span>
                                            </div>
                                            <div class="form-check" style="text-align: left;">
                                                <input type="checkbox" name="check" onchange="showemailpassword(Aemail, Nemail, Amdp, Nmdp)" id="check" class="form-check-input">
                                                <label for="check"><b>Changer de Email et Mot de passes ?</b></label>
                                            </div>
                                            <div class="form-group" id="Aemail" style="text-align: left; display: none">
                                                <label for="email"><b>Email</b></label>
                                                <input type="email" class="form-control" name="email" placeholder="Encien email" value="" disabled>
                                                <span class="text-danger eror">@error('email'){{$message}}@enderror</span>
                                            </div>
                                            <div class="form-group" id="Nemail" style="text-align: left; display: none">
                                                <label for="emailC"><b>Nouvel email</b></label>
                                                <input type="email" class="form-control" name="emailC" placeholder="Nouvel email" value="" disabled>
                                                <span class="text-danger eror">@error('emailC'){{$message}}@enderror</span>
                                            </div>
                                            <div class="form-group" id="Amdp" style="text-align: left; display: none">
                                                <label for="mdp"><b>Encien Mot de passe</b></label>
                                                <input type="password" class="form-control" name="mdp" placeholder="Encien Mot de passe" value="" disabled>
                                                <span class="text-danger eror">@error('mdp'){{$message}}@enderror</span>
                                            </div>
                                            <div class="form-group" id="Nmdp" style="text-align: left; display: none">
                                                <label for="mdpC"><b>Nouveau Mot de passe</b></label>
                                                <input type="password" class="form-control" name="mdpC" placeholder="Nouveau Mot de passe" value="" disabled>
                                                <span class="text-danger eror">@error('mdpC'){{$message}}@enderror</span>
                                            </div>

                                        </div>
                                        <div class="col-6">
                                            <div class="form-group" style="text-align: left;">
                                                <label for="facebook"><b>Facebook Profile</b></label>
                                                <input type="text" class="form-control" name="facebook" placeholder="Nom complet sur facebook" value="{{$others->facebook}}">
                                            </div>
                                            <div class="form-group" style="text-align: left;">
                                                <label for="twiter"><b>Twiter Profile</b></label>
                                                <input type="text" class="form-control" name="twiter" placeholder="Nom complet sur Twiter" value="{{$others->twiter}}">
                                            </div>
                                            <div class="form-group" style="text-align: left;">
                                                <label for="web"><b>Lien dans votre site web</b></label>
                                                <input type="text" class="form-control" name="web" placeholder="Lien de site web" value="{{$others->website}}">
                                            </div>
                                            <div class="form-group" style="text-align: left;">
                                                <label for="discord"><b>Lien dans votre discord</b></label>
                                                <input type="text" class="form-control" name="discord" placeholder="Lien dans votre discord" value="{{$others->discord}}">
                                            </div>
                                            <div class="form-group" style="text-align: left;">
                                                <label for="twitch"><b>Lien dans votre Twitch</b></label>
                                                <input type="text" class="form-control" name="twitch" placeholder="Lien dans votre Twitch" value="{{$others->twitch}}">
                                            </div>
                                            <div class="form-group" style="text-align: left;">
                                                <label for="des"><b>Une petite description</b></label>
                                                <textarea name="des" id="des" cols="30" rows="2" class="form-control">{{$others->description}}</textarea>
                                            </div>
                                            <input type="hidden" name="id" value="{{$others->id}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    {{-- @if () --}}
                                        <button type="submit" class="btn btn-danger">Modifier le profil</button>
                                    {{-- @endif --}}
                                </div>
                            </div>
                        </div>
                    </div>
                {{-- @endforeach --}}
            </div>
        </form>
    </div>
@endsection
