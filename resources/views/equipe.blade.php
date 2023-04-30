<link rel="stylesheet" href="{{asset('css/equipe.css')}}">
@extends('template.layout')
@section('content')
    @forelse ($users as $user)
        @if ($pivots->statut !== 'en attente')
        <div class="row">
            <div class="sidenav">
                <a href="{{route('team', ['id' => $groupes->id])}}" class="nav-link"><i class="fas fa-user-friends "></i> Equipe</a>
                <a href="#message" class="nav-link"><i class="fas fa-comment-dots"></i> Message</a>
                @if ($user->type === 'admin' || $user->type === 'staf') <a href="{{route('team', ['id' => $groupes->id])}}?option" class="nav-link"><i class="fas fa-cog"></i> Option</a> @endif
                <a href="#quite" class="nav-link"><i class="fas fa-sign-out-alt "></i> Quiter</a>
            </div>
        </div>
        <div class="main">
            @if (isset($_GET['option']))
                @include('components.showoption')
            @else
                @include('components.showequipe')
            @endif
        </div>
        @else
            <h1>En attente de validation de l'admin</h1>
        @endif
    @empty

    @endforelse
@endsection
