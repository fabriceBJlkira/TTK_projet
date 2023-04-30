<div class="container-fluid">
    <div class="row">
        <div class="col-md-10">
            @if (isset($_GET['game']))
                @include('components.optionequipe.game')
            @elseif (isset($_GET['addmembre']))
                @include('components.optionequipe.addmember')
            @else
                @include('components.optionequipe.groupe')
            @endif
        </div>
        <div class="col-md-2">
            <div class="nav" style="position: fixed; background: black; height: 100%; right: 0;">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a href="{{route('team', ['id' => $groupes->id])}}?option&groupe" class="nav-link">Option du groupe</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('team', ['id' => $groupes->id])}}?option&game" class="nav-link">Option de jeux</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('team', ['id' => $groupes->id])}}?option&addmembre" class="nav-link">Plus de membre</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
