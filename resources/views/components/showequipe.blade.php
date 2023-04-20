<p>Les membre dans {{$groupes->name}} sont:</p>
@foreach ($groupes->users as $membre)
    @if (($membre->id == $pivots->user_id) && $pivots->statut !== 'en attente')
        <p>{{$membre->name}}</p>
    @else
        <p><b>En attente de validation:</b> {{$membre->name}}</p>
    @endif
@endforeach
