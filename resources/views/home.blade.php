@extends('template.layout')
<link rel="stylesheet" href="{{asset('css/home.css')}}">
@section('content')
    @foreach ($users as $item)
    <div class="row">
        <div class="sidenav">
            <a href="#anonce" class="nav-link active" id="Anonce"><i class="fas fa-info-circle "></i> Annonces</a>
            <a href="#equipe" class="nav-link" id="Equipe"><i class="fas fa-user-friends "></i> Equipe</a>
        </div>
    </div>
    <div class="main">
        <div class="container-fluid" id="anonce">
            <h1>En attente du table Annonce</h1>
        </div>
        <div class="container-fluid" style="display: none" id="equipe">
            <div class="container" style="margin-bottom: 2%">
                <div class="row">
                    <div class="col-6">
                        <h1>Votre groupe</h1>
                    </div>
                    <div class="col-3">
                        <a href="{{route('teamCreate')}}" class="btn btn-primary">Crée votre groupe</a>
                    </div>
                    <div class="col-3"><a href="{{route('rechercheTeam')}}" class="btn btn-primary">Chercher ungroupe</a></div>
                </div>
                <hr>
            </div>
            <div class="row">
                @forelse ($item->groupes as $groupe)
                    <div class="col-lg-4 col-md-6 col-sm-12" id="card">
                        <div class="card">
                            <div class="img-box">
                                <img src="{{Storage::url('LogoTeam/'.$groupe->logo)}}" alt="John" class="img-fluid">
                            </div>
                            <div class="card-body">
                                <h3>{{$groupe->name}}</h3>
                                <p></p>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col">
                                        <a class="btn btn-success btn-block" href="{{route('team', ['id' => $groupe->id])}}" style="color: rgba(0, 0, 0, 0.747);"><i class="fas fa-eye"></i> Visiter</a>
                                    </div>
                                    @if (($item->type == 'admin' || $item->type == 'staf') && ($groupe->user_id == $item->id) )
                                        <div class="col">
                                            <a class="btn btn-secondary btn-block" href="{{route('team', ['id' => $groupe->id])}}?option" style="color: rgba(0, 0, 0, 0.747);"><i class="fas fa-ruler"></i> Administrer</a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="container">
                        <h3>Vous n'avez pas encore de groupe!</h3>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
    @endforeach
    <script src="{{asset('js/home.js')}}"></script>
@endsection
