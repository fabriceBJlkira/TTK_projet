<div class="container">
    <div class="row">
        <div class="col-md-10">
            <div class="row" id="membre">
                <div class="row" style="margin-bottom: 2%">
                    <h3>Les membres actif dans {{$groupes->name}} en ce moment sont:</h3>
                    @foreach ($allmembre as $membres)
                        <div class="col-lg-6 col-md-6 col-sm-12" id="card">
                            <div class="card">
                                <div class="img-box">
                                    <img style="max-height: 400px; width: 90%;" src="{{Storage::url('photoProfile/'.$membres->avatar)}}" alt="John" class="img-fluid rounded-circle">
                                </div>
                                <div class="card-body">
                                    <h3>{{$membres->name}}</h3>
                                    <p></p>
                                </div>
                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col">
                                            <a href="{{route('other', ['id' => $hash->encodeHex($membres->id)])}}" id='Voir' class="btn btn-outline-danger btn-block">Voir le profil</a>
                                        </div>
                                        @if (($user->type === 'admin' && $user->id === $groupes->user_id) || ($pivots->statut === 'co-admin'))
                                            <div class="col">
                                                <a id="Edits" href="{{route('editother', ['id' =>$hash->encodeHex($membres->id)])}}" class="btn btn-secondary btn-block">Editer le profile</a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <p>{{$allmembre->links()}}</p>
            </div>
            <div class="row" id="demande" style="display: none">
                <h3>Les demande d'adhésion en attente dans {{$groupes->name}} en ce moment sont:</h3>
                @foreach ($allMembreEnattente as $membres)
                        <div class="col-lg-6 col-md-6 col-sm-12" id="card">
                            <div class="card">
                                <div class="img-box">
                                    <img src="{{Storage::url('photoProfile/'.$membres->avatar)}}" alt="John" class="img-fluid">
                                </div>
                                <div class="card-body">
                                    <h3>{{$membres->name}}</h3>
                                    <p></p>
                                </div>
                                <div class="card-footer">
                                    <div class="row">
                                        @if (($user->type === 'admin' && $user->id === $groupes->user_id) || ($pivots->statut === 'co-admin'))
                                            <div class="col">
                                                <form action="{{route('addmember', ['id' => $hash->encodeHex($membres->id), 'id1' => $hash->encodeHex($groupes->id)])}}" method="POST">
                                                    @csrf
                                                    <button class="btn btn-success btn-block">Valider</button>
                                                </form>
                                            </div>
                                            <div class="col">
                                                <form action="{{route('deletemembre', ['id' => $hash->encodeHex($membres->id), 'id1' => $hash->encodeHex($groupes->id)])}}" method="POST">
                                                    @csrf
                                                    <button class="btn btn-danger btn-block">Supprimer</button>
                                                </form>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                @endforeach
            </div>
        </div>
        <div class="col-md-2 col-sm-12" style="margin-top: 2%">
            <div class="row" style="position: fixed; background-color: rgba(0, 0, 0, 0.849); height: 100vh; right: 0; width: 14%">
                <ul class="nav flex-column">
                    <li class="nav-item">
                      <a class="nav-link active" href="#membre" id="Showmembre">Les membre actif</a>
                    </li>
                    @if (($user->type === 'admin' && $user->id === $groupes->user_id) || ($pivots->statut === 'co-admin'))
                        <li class="nav-item">
                        <a class="nav-link" href="#demande" id="Showdemande">Demande d'adésion</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>
