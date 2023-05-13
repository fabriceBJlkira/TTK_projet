@if (($admin->type == 'admin'))
<div class="container">
    <div class="row">
        <div class="col-4">
            <h3>Liste des joueurs</h3>
        </div>
        <div class="col-5">
            <form action="">
                <div class="row">
                    <div class="col-9">
                        <input type="search" name="searchequipe" class="form-control" id="">
                    </div>
                    <div class="col-3">
                        <button class="btn btn-success">Envoyer</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-3">
            <button class="btn btn-danger" onclick="window.history.back()">Retour</button>
        </div>
    </div>
    <hr>
</div>
<div class="container-fluid">
    <div class="row">
        @forelse ($allusers as $user)
            <div class="col-lg-4 col-md-6 col-sm-12" id="card">
                <div class="card">
                    <div class="img-box">
                        <img style="max-height: 400px; width: 90%;" src="{{Storage::url('photoProfile/'.$user->avatar)}}" alt="John" class="img-fluid rounded-circle">
                    </div>
                    <div class="card-body">
                        <h3>{{$user->name}}</h3>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                                <div class="col">
                                    <form action="{{route('newmemberadd', ['id' => $hash->encodeHex($user->id), 'id2' => $hash->encodeHex($team_id)])}}" method="POST">
                                        @csrf
                                        <button class="btn btn-primary btn-block">Ajouter</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        @empty

        @endforelse
        <div class="row">
            <p>{{$allusers->links()}}</p>
        </div>
    </div>
</div>

@endif
