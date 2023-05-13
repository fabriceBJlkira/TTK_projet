@extends('template.layout')
@section('content')
    <div class="container">
        <div class="row" style="display: flex; align-items: center; justify-content: center; height: 80vh;">
            <form action="{{route('game.post.post')}}" method="POST" style="border: solid 3px black; width: 50%; padding: 3%; border-radius: 9px" enctype="multipart/form-data">
                @csrf
                <h3 style="text-align: center; text-decoration: underline">Jeux</h3>
                <div class="form-group">
                    <label for=""><b>Nom du jeux: </b></label>
                    <input type="text" name="name" placeholder="nom du jeux" id="" class="form-control">
                    <span class="text-danger">@error('name') {{$message}}@enderror</span>
                </div>
                <div class="form-group">
                    <div style="text-align: center">
                        <img src="" alt="" id="bannerimg" class="img-fluid" style="max-height: 200px;">
                    </div>
                    <div class="btn btn-dark form-control" onclick="baner.click()">
                        <p>Banner <i class="fas fa-arrow-alt-circle-up"></i></p>
                        <input onclick="img(baner, bannerimg)" type="file" hidden name="baner" id="baner" accept="image/*">
                    </div>
                    <span class="text-danger">@error('baner') {{$message}}@enderror</span>
                </div>
                <div class="form-group">
                    <div style="text-align: center">
                        <img src="" alt="" id="iconeimg" class="img-fluid" style="max-height: 200px;">
                    </div>
                    <div class="btn btn-dark form-control" onclick="icone.click()">
                        <p>Icone <i class="fas fa-arrow-alt-circle-up"></i></p>
                        <input onclick="img(icone, iconeimg)" type="file" hidden name="icone" id="icone" accept=".ico">
                    </div>
                </div>
                <div class="form-group">
                    <label for=""><b>Specification</b></label>
                    <input type="text" name="spesifique" placeholder="specification" class="form-control" id="">
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <button type="reset" class="btn btn-danger" id="reset">Annuler</button>
                        </div>
                        <div class="col-6">
                            <button type="submit" class="btn btn-success">Envoyer</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
    function img(a, b) {
        a.onchange = ()=> {
            let reader = new FileReader();
            reader.readAsDataURL(a.files[0]);
            reader.onload = ()=>{
                b.setAttribute("src", reader.result);
            }
        }
    }
    let reset = document.getElementById('reset')
    reset.addEventListener('click', ()=>{
        bannerimg.src = null
        iconeimg.src = null
    })
    </script>
@endsection
