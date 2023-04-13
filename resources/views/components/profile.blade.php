@extends('../template.layout')
@section('content')
    <div class="container">
        <h2 style="text-align:center">Votre Profile</h2>
        @foreach ($users as $item)
            <div class="card">
                <div class="img-box">
                    <img src="{{Storage::url('photoProfile/'.$item->avatar)}}" alt="John" class="img-fluid rounded-circle" style="width:40%; margin: 2% 2% 2% 5%;">
                </div>
                <h1>{{$item->name}}</h1>
                <p class="title">{{$item->description}} hgvgfgf</p>

                <h5 class="droite">Email : {{$item->email}}</h5>
                <h5 class="droite">Type : {{$item->type}}</h5>
                @if (!empty($item->facebook))
                <h5 class="droite">Compte Facebook : <a class="link" href="{{$item->facebook}}">Voir le compte</a></h5>
                @endif
                @if (!empty($item->twiter))
                <h5 class="droite">Compte Twiter : <a class="link" href="{{$item->twiter}}">Voir le compte</a></h5>
                @endif
                @if (!empty($item->website))
                <h5 class="droite">Votre site web : <a class="link" href="{{$item->website}}">Voir le site</a></h5>
                @endif
                @if (!empty($item->discord))
                <h5 class="droite">Votre discord : <a class="link" href="{{$item->discord}}">Visiter</a></h5>
                @endif
                @if (!empty($item->twitch))
                <h5 class="droite">Compte twitch : <a class="link" href="{{$item->twitch}}">Voir le compte</a></h5>
                @endif
                <div style="margin: 24px 0;">
                </div>
                <p><a href="{{route('modificationProfile')}}" class="btn btn-danger btn-block">Modifier le profil</a></p>
            </div>
        @endforeach

    </div>
@endsection
