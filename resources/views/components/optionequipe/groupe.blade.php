<div class="container-fluid">
    <h1>Modification du groupe</h1>
    <section class="border-dark" style="border:solid 2px black; margin: 2% 0">
        <h3>Changer le nom du proupe</h3>
        <div class="container">
            <form action="{{route('modifteamname')}}" style="margin: 3% 1% 1% 1%" method="POST">
                @csrf
                <p><input type="text" name="name" id="" value="{{$groupes->name}}" style="border: none; outline: none; border-bottom: 2px solid black; font-size: 20px">
                    <input type="hidden" name="id" value="{{$groupes->id}}">
                </p>
                <button>Changer</button>
            </form>
        </div>
    </section>
    <section class="border-dark" style="border:solid 2px black; margin: 2% 0">
        <h3>Changer la decsription du proupe</h3>
        <div class="container">
            <form action="{{route('modifteamdescription')}}" method="POST" style="margin: 3% 1% 1% 1%">
                @csrf
                <p><textarea  class="form-control" name="description" id="" cols="30" rows="5">{{$groupes->description}}</textarea>
                    <input type="hidden" name="id" value="{{$groupes->id}}">
                </p>
                <button>Changer</button>
            </form>
        </div>
    </section>
    <section class="border-dark" style="border:solid 2px black; margin: 2% 0">
        <h3>Changer la couverture du proupe</h3>
        <div class="container">
            <form action="{{route('modifteamimage')}}" method="POST" style="margin: 3% 1% 1% 1%;" enctype="multipart/form-data">
                <div class="row">
                    @csrf
                    <input type="hidden" name="id" value="{{$groupes->id}}">
                    <div class="col-12" style="text-align: center">
                        <img src="{{Storage::url('LogoTeam/'.$groupes->logo)}}" class="img-fluid" alt="" id="img" style="max-height: 400px">
                    </div>
                    <div class="btn btn-danger form-control" onclick="fileimg.click()" style="margin-top: 2%">
                        <p>upload image <i class="fas fa-arrow-alt-circle-up"></i></p>
                        <input type="file" name="logoteam" id="fileimg" style="display: none" accept="image/*">
                    </div>
                    <div style="margin-top: 2%; width: 100%">
                        <button class="btn btn-dark btn-block">Changer</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <script>
        var img = document.getElementById('img');
        var file = document.getElementById('fileimg');

        file.onchange = ()=> {
        let reader = new FileReader();
        reader.readAsDataURL(file.files[0]);
        reader.onload = ()=>{
            img.setAttribute("src", reader.result);
        }
    }
    </script>
</div>
