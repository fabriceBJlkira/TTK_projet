@extends('../template.layout')
@section('content')
    <div class="form-box">
        <form action="{{route('teamCreatePost')}}" method="POST" class="formequipe" enctype="multipart/form-data">
            @csrf
            <h3 class="createequipetitre">Creation d'équipe</h3>
            <div class="form-group">
                <label for=""><b>nom Team :</b></label>
                <input type="text" name="nom" class="form-control" placeholder="Nom du team">
                <span class="text-danger">@error('nom') {{$message}}@enderror</span>
            </div>
            <div class="form-group">
                <label for=""><b>Logo du Team :</b></label>
                <div class="img-box imageboxequipe">
                    <img class="img-fluid" id="imglogo" style="width: 200px; height: 100%;" alt="">
                </div>
                <div class="form-control btn btn-danger" onclick="fileimg.click()">
                    <p>upload image <i class="fas fa-arrow-alt-circle-up"></i></p>
                    <input type="file" name="logoteam" id="fileimg" style="display: none">
                </div>
                <span class="text-danger">@error('logoteam'){{$message}} @enderror</span>
            </div>
            <div class="form-group">
                <label for=""><b>Description :</b></label>
                <textarea name="des" id="" cols="30" rows="3" class="form-control"></textarea>
            </div>
            @foreach ($users as $item)
                <input type="hidden" name="id" value="{{$item->id}}" id="">
            @endforeach
            <div class="form-group">
                <div class="row">
                    <div class="col-6">
                        <button type="reset" id="reset" class="btn btn-danger">Effacer</button>
                    </div>
                    <div class="col-6">
                        <button type="submit" class="btn btn-success">Envoyer</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    {{-- script image --}}
    <script>
        // image
    let imglogo = document.getElementById('imglogo');
    let reset = document.getElementById('reset');
    let fileimg = document.getElementById('fileimg');
    fileimg.onchange = ()=> {
        let reader = new FileReader();
        reader.readAsDataURL(fileimg.files[0]);
        reader.onload = ()=>{
            imglogo.setAttribute("src", reader.result);
        }
    }
    reset.addEventListener('click', ()=>{
        imglogo.src = null
    })
    </script>
@endsection
