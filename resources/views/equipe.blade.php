<link rel="stylesheet" href="{{asset('css/equipe.css')}}">
@extends('template.layout')
@section('content')
    @forelse ($users as $user)
        @if (($pivots->statut !== 'en attente'))
        <div class="row">
            <div class="sidenav">
                <a href="{{route('team', ['id' => $hash->encodeHex($groupes->id)])}}" class="nav-link"><i class="fas fa-user-friends "></i> Equipe</a>
                <a href="{{route('team', ['id' => $hash->encodeHex($groupes->id)])}}?message" class="nav-link"><i class="fas fa-comment-dots"></i> Message <span class="badge badge-pill badge-danger">@if($unreads !=0){{$unreads}}@endif</span></a>
                @if ($user->type === 'admin') <a href="{{route('team', ['id' => $hash->encodeHex($groupes->id)])}}?option" class="nav-link"><i class="fas fa-cog"></i> Option</a> @endif
                <a href="{{route('team', ['id' => $hash->encodeHex($groupes->id)])}}?annonce" class="nav-link"><i class="fas fa-bullhorn"></i> Annonce</a>
                <form action="{{route('leavegroup')}}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{$user->id}}">
                    <button class="text-danger nav-link" style="border: none; text-align: left; background: none"><i class="fas fa-sign-out-alt "></i> Quiter</button>
                </form>
            </div>
        </div>
        <div class="main">
            @if (isset($_GET['option']))
                @include('components.showoption')
            @elseif (isset($_GET['message']))
                @include('components.message')
            @elseif (isset($_GET['annonce']))
                @include('components.annonce')
            @else
                @include('components.showequipe')
            @endif
        </div>
        @elseif (($pivots->statut === null))
            <h1>En attente de validation de l'admin</h1>
        @else
            <h1>En attente de validation de l'admin</h1>
        @endif
    @empty

    @endforelse
@endsection
