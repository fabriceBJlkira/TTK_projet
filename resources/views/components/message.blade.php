<div class="container-fluid">
    <h3>Liste des conversations</h3>
    <div class="row">
        <div class="col-md-4">
            <ul class="list-group">
                @forelse ($privateMessage as $item0)
                    <li class="list-group-item">
                        <span><a style="width: 100%; display: flex; justify-content: space-between" href="{{route('team', ['id' => $hash->encodeHex($groupes->id)])}}?message&to={{$hash->encodeHex($item0->id)}}" class="list-group-link">{{$item0->name}} <i class="fas fa-comment-alt "></i></a></span>
                    </li>
                @empty

                @endforelse
            </ul>
        </div>
        <div class="col-md-8">
            @include('components.privateMessage')
        </div>
    </div>
</div>
