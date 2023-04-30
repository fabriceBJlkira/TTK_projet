<nav class="navbar navbar-expand-sm bg-dark navbar-dark" style="position: fixed; top: 0; width: 100%; z-index: 4;">
  <!-- Brand -->
  <a class="navbar-brand" href="{{route('home')}}">Logo</a>

  <div style="display: flex; align-items: center; justify-content: space-between; width: 90%">
      <!-- Lien dans la page -->
      <ul class="navbar-nav">
            <li class="nav-item">
            <a class="nav-link" href="{{route('home')}}">Home</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="{{route('joueur')}}">Joueur</a>
            </li>
      </ul>

      {{-- Information du profil --}}
      <ul class="navbar-nav">
        <li class="nav-item dropdown">
            <button class="nav-link btn dropdown-toggle" id="navbardrop" data-toggle="dropdown">
                @if (isset($users))
                @foreach ($users as $item)
                    {{$item->name}}
                @endforeach
                @endif
            </button>
            <div class="dropdown-menu" aria-labelledby="navbardrop">
                <a class="dropdown-item" href="{{route('profil')}}">Voir Profile</a>
                <a class="dropdown-item" href="{{route('modificationProfile')}}">Editer Profile</a>
                <a class="dropdown-item" href="{{route('home')}}?logout=true">Déconnexion</a>
            </div>
        </li>
      </ul>
  </div>
</nav>
