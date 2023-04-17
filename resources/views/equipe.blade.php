<link rel="stylesheet" href="{{asset('css/equipe.css')}}">
@extends('template.layout')
@section('content')
    @if (session()->has('cree'))
        <div id="customalert">
            <div id="box">
                <div class="heading">
                    Message :
                </div>
                <div class="content">
                    <p>{{session()->get('cree')}}</p>
                    <button id="confirmbtn" type="button" class="btn btn-primary" onclick="hidealert(customalert)">OK</button>
                </div>
            </div>
        </div>
    @endif
    @foreach ($users as $user)
        <div class="row">
            <div class="sidenav">
                <a href="#equipe" class="nav-link"><i class="fas fa-user-friends "></i> Equipe</a>
                <a href="#message" class="nav-link"><i class="fas fa-comment-dots"></i> Message</a>
                @if ($user->type === 'admin' || $user->type === 'staf') <a href="#option" class="nav-link"><i class="fas fa-cog"></i> Option</a> @endif
                <a href="#quite" class="nav-link"><i class="fas fa-sign-out-alt "></i> Quiter</a>
            </div>
        </div>
        <div class="main">
            <p>Les membre dans {{$groupes->name}} sont:</p>
            @foreach ($groupes->users as $membre)
                <p>{{$membre->name}}</p>
            @endforeach
        </div>
    @endforeach
@endsection
