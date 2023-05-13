<div class="container-fluid">
    <div class="row">
        <div class="col-10">
            @if (isset($_GET['admin']))
                @include('components.Annonce.annonceadmin')
            @elseif (isset($_GET['post']))
                @include('components.Annonce.post')
            @else
                @include('components.Annonce.annonce')
            @endif
        </div>
        <div class="col-2">
            <div class="nav" style="position: fixed; background: black; height: 100%; right: 0;">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a href="{{route('team', ['id' => $hash->encodeHex($groupes->id)])}}?annonce" class="nav-link">Annonces</a>
                    </li>
                    @if ($pivots->statut !== 'membre')
                        <li class="nav-item">
                            <a href="{{route('team', ['id' => $hash->encodeHex($groupes->id)])}}?annonce&admin" class="nav-link">Gerer les annonces</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>
