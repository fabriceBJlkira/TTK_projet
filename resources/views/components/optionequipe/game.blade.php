<div class="container-fluid">
    <h3>Liste des jeux que vous avez ajouter dans votre groupe</h3>
    <div class="row">
        @forelse ($games as $game)
        <div class="card col-6">
            <div class="card-header">
                <img src="{{Storage::url('gameimage/banner/'.$game->banner)}}" class="img-fluid" alt="">
                <img src="{{Storage::url('gameimage/icon/'.$game->icone)}}" alt="" class="img-fluid rounded-circle" style="border: solid 3px black; position: absolute; top: 50%; left: 70%">
            </div>
            <div class="card-body">
                <h5>{{$game->gamename}} ({{$game->specifique}})</h5>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col">
                        <form action="{{route('deletegamefromgroupe', ['id' => $hash->encodeHex($groupes->id), 'id2' => $hash->encodeHex($game->gameid)])}}" method="POST">
                            @csrf
                            <button class="btn btn-danger btn-block">suprimer ce jeux</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
            {{-- <p>{{$game->users}}</p> --}}
        @empty
        @endforelse
    </div>
    {{-- pagination --}}
    <p>{{$games->links()}}</p>
</div>
