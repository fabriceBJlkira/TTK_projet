<nav class="navbar navbar-expand-sm bg-dark navbar-dark" >
  <!-- Brand -->
  <a class="navbar-brand" href="#">Logo</a>

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
                @foreach ($users as $item)
                    {{$item->name}}
                @endforeach
            </button>
            <div class="dropdown-menu" aria-labelledby="navbardrop">
                <a class="dropdown-item" href="#">Voit Profile</a>
                <a class="dropdown-item" href="{{route('home')}}?logout=true">Logout</a>
            </div>
        </li>
      </ul>
  </div>
</nav>
