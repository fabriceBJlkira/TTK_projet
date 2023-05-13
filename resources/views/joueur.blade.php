@extends('template.layout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-6">
            <h3>Liste des tous les joueur</h3>
        </div>
        <div class="col-6">
            <form action="">
                <div class="row">
                    <div class="col-8">
                        <input type="search" @if(isset($_GET['parnom']))value="{{$_GET['parnom']}}@endif" placeholder="recherche nom" name="parnom" class="form-control" id="">
                    </div>
                    <div class="col-4">
                        <button class="btn btn-primary">Envoyer</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <form action="" style="width: 100%">
        <h4>Filtre</h4>
        <div class="row">
            <div class="col-5">
                <div class="row">
                    <div class="col-2">
                        <label for=""><b>Equipe</b></label>
                    </div>
                    <div class="col-6">
                        <select name="parequipe" id="equipe" class="form-control">
                            <option value=""></option>
                            @forelse ($equipes as $equipe)
                            <option @if(isset($_GET['parequipe'])){{$hash->decodeHex($_GET['parequipe'])==$equipe->id ? 'selected' : ''}}@endif value="{{$hash->encodeHex($equipe->id)}}">{{$equipe->name}}</option>
                            @empty
                            pas d'equipe trouver
                            @endforelse
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-5">
                <div class="row">
                    <div class="col-2">
                        <label for=""><b>Jeux</b></label>
                    </div>
                    <div class="col-6">
                        <select name="parejeux" id="jeux" class="form-control">
                            <option value=""></option>
                            @forelse ($jeux as $jeu)
                                <option @if(isset($_GET['parejeux'])){{$hash->decodeHex($_GET['parejeux'])==$jeu->id ? 'selected' : ''}}@endif value="{{$hash->encodeHex($jeu->id)}}">{{$jeu->name}}</option>
                            @empty
                                pas de jeux trouver
                            @endforelse
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-2">
                <button class="btn btn-success">Filtrer</button>
            </div>
        </div>
        <input type="hidden" @if(isset($_GET['parnom']))value="{{$_GET['parnom']}}@endif" placeholder="recherche nom" name="parnom" class="form-control" id="">
    </form>
    </div>
    <hr>
</div>
<div class="container-fluid">
    @if (isset($_GET['parejeux']) || isset($_GET['parequipe']))
        @include('components.joueurs.parjeux')
    @else
        @include('components.joueurs.index')
    @endif
</div>
@endsection
@push('scripts')
<script>
    $('#equipe').select2();
    $('#jeux').select2();
</script>
@endpush
