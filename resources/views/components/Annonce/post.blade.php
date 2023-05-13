<div class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-10">
                <h3>Poster une annonce</h3>
            </div>
            <div class="col-2">
                <a href="{{route('team', ['id' => $hash->encodeHex($groupes->id)])}}?annonce" class="btn btn-primary">Retour</a>
            </div>
        </div>
        <hr>
    </div>
    <div class="container-fluid"  style="display: flex; align-items: center; justify-content: center; height: 80vh; width: 100%;">
        <form action="{{route('annonce', ['id' => $hash->encodeHex($groupes->id)])}}" method="POST" style="border: solid 3px black; padding: 3%; width: 80%">
            @csrf
            <div style="text-decoration: underline; text-align: center; margin-bottom: 4%">
                <h4>Poster votre annonce</h4>
            </div>
            <div class="form-group">
                <label for=""><b>Contenue</b></label>
                <textarea name="contenue" id="" class="form-control" cols="30" rows="2"></textarea>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col">
                        <a class="btn btn-danger btn-block" href="{{route('team', ['id' => $hash->encodeHex($groupes->id)])}}?annonce">Annuler</a>
                    </div>
                    <div class="col">
                        <button type="submit" class="btn btn-success">Envoyer</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
