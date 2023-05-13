
@if ($recherche !== null)
    <div class="container-fluid">
        <div class="row">
            @forelse ($recherche as $joueur)
                <div class="col-lg-4 col-md-6 col-sm-12" id="card">
                    <div class="card" style="margin: 2% 0">
                        <div class="img-box">
                            <img src="{{Storage::url('photoProfile/'.$joueur->avatar)}}" alt="John" class="img-fluid" style="max-height: 300px">
                        </div>
                        <div class="card-body">
                            <h3>{{$joueur->name}}</h3>
                            <p></p>
                        </div>
                    </div>
                </div>
            @empty
            @endforelse
        </div>
        {{-- /pagination --}}
        <p>{{$joueurs->links()}}</p>
    </div>
@endif
