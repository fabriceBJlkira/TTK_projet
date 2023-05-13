@extends('../template.layout')
@section('content')
    <div class="container">
            <div class="card">
                <div class="img-box">
                    <img src="{{Storage::url('photoProfile/'.$others->avatar)}}" alt="John" class="img-fluid rounded-circle" style="width:40%; margin: 2% 2% 2% 5%;">
                </div>
                <h1>{{$others->name}}</h1>
                <p class="title">{{$others->description}}</p>

                <h5 class="droite">Email : {{$others->email}}</h5>
                <h5 class="droite">Type : {{$others->type}}</h5>
                @if (!empty($others->facebook))
                <h5 class="droite">Compte Facebook : <a class="link" href="{{$others->facebook}}">Voir le compte</a></h5>
                @endif
                @if (!empty($others->twiter))
                <h5 class="droite">Compte Twiter : <a class="link" href="{{$others->twiter}}">Voir le compte</a></h5>
                @endif
                @if (!empty($others->website))
                <h5 class="droite">Votre site web : <a class="link" href="{{$others->website}}">Voir le site</a></h5>
                @endif
                @if (!empty($others->discord))
                <h5 class="droite">Votre discord : <a class="link" href="{{$others->discord}}">Visiter</a></h5>
                @endif
                @if (!empty($others->twitch))
                <h5 class="droite">Compte twitch : <a class="link" href="{{$others->twitch}}">Voir le compte</a></h5>
                @endif
                <div style="margin: 24px 0;">
                </div>
            </div>

    </div>
@endsection
