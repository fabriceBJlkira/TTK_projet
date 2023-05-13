<div class="container-fluid">
    <div class="row">
        <div class="col-4">
            <h3>Liste des annonces</h3>
        </div>
        <div class="col-5">
            <form action="{{route('annoncesearch', ['id' => $hash->encodeHex($groupes->id)])}}" method="get" style="display: flex">
                <input style="width: 100%; margin: 0 1% 0 0" type="search" placeholder="recherche des nom ous texte" name="annonce" class="form-control" id="">
                <button class="btn btn-danger" style="width: 20%">envoyer</button>
            </form>
        </div>
        <div class="col-3">
            <a href="{{route('team', ['id' => $hash->encodeHex($groupes->id)])}}?annonce&post" class="btn btn-success">Poster une annonce</a>
        </div>
    </div>
    <hr>
    <div class="container">
        @forelse ($annonces as $annonce)
            <div class="row" style="margin: 3%; border: solid 4px black; padding: 2%;">
                    <div class="col-3" style="">
                        <a href="{{route('other', ['id' => $hash->encodeHex($annonce->user_id)])}}">
                        <img src="{{Storage::url('photoProfile/'.$annonce->avatar)}}" class="img-fluid rounded-circle" style="height: 30%; border: solid 1px black" alt="">
                        <h6>{{$annonce->name}}</h6>
                    </a>
                    </div>
                    <div class="col-8" style="">
                        <p>
                            {{$annonce->contenue}}
                        </p>
                    </div>
            </div>
        @empty
        @endforelse
    </div>
    <p>{{$annonces->links()}}</p>
</div>
