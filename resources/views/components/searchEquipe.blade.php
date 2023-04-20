@extends('../template.layout')
@section('content')
<div class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col">
                <h1>Liste des Equipes</h1>
            </div>
            <div class="col">
                <form action="{{route('rechercheTeam')}}" method="GET">
                    <div class="row">
                        <div class="col-6">
                            <input type="search" name="groupe" class="form-control" id="">
                        </div>
                        <div class="col-6">
                            <button class="btn btn-danger" style="width: 40%">Chercher</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <hr>
    </div>
    <div class="row">
        @foreach ($users as $user)
        @forelse ($teams as $item)
        <div class="col-lg-4 col-md-6 col-sm-12" id="card">
            <div class="card">
                <div class="img-box">
                        <img src="{{Storage::url('LogoTeam/'.$item->logo)}}" alt="John" class="img-fluid">
                    </div>
                    <div class="card-body">
                        <h3>{{$item->name}}</h3>
                        <p></p>
                    </div>
                    <div class="card-footer">
                        {{-- parcour de l'id du membre dans un groupes --}}
                        @php
                        $membres = [];
                        foreach ($item->users as $membre) {
                            $membres[] = $membre->id;
                        }
                        @endphp
                        @if (in_array($user->id, $membres))
                            <a class="btn btn-danger btn-block" href="{{route('team', ['id' => $item->id])}}" style="color: rgba(0, 0, 0, 0.747);">Accéder au groupe</a>
                        @else
                            <form action="{{route('adesion')}}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{$item->id}}">
                                <button type="submit" class="btn btn-success">Demande d'adhésion</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
            @empty
        @endforelse
        @endforeach
    </div>
</div>
@endsection
