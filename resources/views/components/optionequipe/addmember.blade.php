<div class="container">
    <div class="row">
        <div>
            <a href="{{route('newmember', ['id' => $hash->encodeHex($groupes->id)])}}" class="btn btn-success">plus de membre</a>
            <div class="row" id="membre">
                <h3>Les membres actif dans {{$groupes->name}} en ce moment sont:</h3>
                @foreach ($allMembreOption as $membres)
                    @if ($membres->statut !== 'en attente')
                        <div class="col-lg-6 col-md-6 col-sm-12" id="card">
                            <div class="card">
                                <div class="img-box">
                                    <img style="max-height: 400px; width: 90%;" src="{{Storage::url('photoProfile/'.$membres->avatar)}}" alt="John" class="img-fluid rounded-circle">
                                </div>
                                <div class="card-body">
                                    <h3>{{$membres->name}}</h3>
                                    <p> ({{$membres->statut}}) </p>
                                </div>
                                <div class="card-footer">
                                    <div class="row">
                                        @if (($membres->statut !== 'co-admin') && ($membres->statut !== 'admin'))
                                            <div class="col">
                                                <form action="{{route('coadmin', ['id' => $hash->encodeHex($membres->id), 'id1' => $hash->encodeHex($groupes->id)])}}" method="POST">
                                                    @csrf
                                                    <button href="" class="btn btn-primary btn-block">Mettre co-admin</button>
                                                </form>
                                            </div>
                                        @endif
                                        @if (($membres->statut !== 'admin'))
                                            <div class="col">
                                                <form action="{{route('deletemembre', ['id' => $hash->encodeHex($membres->id), 'id1' => $hash->encodeHex($groupes->id)])}}" method="POST">
                                                    @csrf
                                                    <button href="" class="btn btn-danger btn-block">Supprimer du groupe</button>
                                                </form>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
    {{-- pagination --}}
    <p>{{$allMembreOption->links()}}</p>
</div>

