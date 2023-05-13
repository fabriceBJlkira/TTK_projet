@extends('template.layout')
@section('content')
@if (session()->has('eror'))
        <div id="customalert">
            <div id="box">
                <div class="heading">
                    Message :
                </div>
                <div class="content">
                    <p>{{session()->get('eror')}}</p>
                    <button id="confirmbtn" type="button" class="btn btn-primary" onclick="hidealert(customalert)">OK</button>
                </div>
            </div>
        </div>
    @endif
    <div class="container">
        <div class="row">
            <div class="col-4">
                <h3>Liste des jeux disponible</h3>
            </div>
            <div class="col-5">
                <form action="">
                    <div class="row">
                        <div class="col-9">
                            <input type="search" name="searchgame" class="form-control" placeholder="search">
                        </div>
                        <div class="col-3">
                            <button class="btn btn-primary">Envoyer</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-3">
                <a href="{{route('game.post.item')}}" class="btn btn-primary">Post game</a>
            </div>
        </div>
        <hr>
    </div>
    <div class="container-fluid">
        <div class="row">
            @foreach ($games as $item1)
                <div class="col-lg-4 col-md-6 col-sm-12" id="card">
                    <div class="card">
                        <div class="img-box">
                            <img style="max-height: 400px; width: 90%;" src="{{Storage::url('gameimage/banner/'.$item1->banner)}}" alt="John" class="img-fluid">
                            <img src="{{Storage::url('gameimage/icon/'.$item1->icone)}}" style="border: solid 3px black; position: absolute; top: 50%; left: 70%" alt="" class="img-fluid rounded-circle">
                        </div>
                        <div class="card-body">
                            <h3>{{$item1->name}}</h3>
                            <p>({{$item1->specifique}})</p>
                        </div>
                        <div class="card-footer">
                            @if ($admin->type === 'admin')
                                <ul class="navbar-nav">
                                    <li class="nav-item dropdown">
                                        {{-- @if (!in_array($item1->id, $arraygameid)) --}}
                                        <button class="nav-link btn btn-danger dropdown-toggle" id="navbardrop" data-toggle="dropdown">Ajouter</button>
                                        <div class="dropdown-menu" aria-labelledby="navbardrop">
                                            @foreach ($admin->groupes as $item2)
                                                @if (($item2->user_id === $admin->id))
                                                    <form action="{{route('game.post', ['id' => $hash->encodeHex($admin->id), 'id1' => $hash->encodeHex($item1->id), 'id2' => $hash->encodeHex($item2->id)])}}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="nav-link btn">{{$item2->name}}</button>
                                                    </form>
                                                @endif
                                            @endforeach
                                        </div>
                                    </li>
                                </ul>
                            @else
                                <h3>Seul les admin on le droit d'ajouter</h3>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
        <p>{{$games->links()}}</p>
    </div>
    <script>
        function hidealert(a) {
        a.style.display = 'none';
        window.location.pathname = ''
    }
    </script>
@endsection
