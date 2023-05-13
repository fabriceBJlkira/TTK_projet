@if (isset($_GET['to']))
    @foreach ($privateMessage as $membre)
        @if ($membre->id == $hash->decodeHex($_GET['to']))
            <div class="card">
                <div class="card-header">
                    <h5>{{$membre->name}}</h5>
                </div>
                <div class="card-body" style="height: 50vh; width: 100%">
                    <div style=" height: 100%; overflow-y: auto;">
                        <div class="row" style="display: flex; flex-direction: column-reverse; width: 100%">
                            @if ($messages->previousPageUrl())
                                <div class="text-center" style="text-align: center; width: 100%; color: black">
                                    <a href="{{$messages->previousPageUrl()}}" class="btn btn-light">
                                        Voir plus de messages
                                    </a>
                                </div>
                            @endif
                            @foreach ($messages as $mess)
                                @if ($mess->from->id === $membre->id)
                                    <div class="col-12" style="display: flex;">
                                        <div style="text-align: left; background-color: rgba(128, 128, 128, 0.767); padding: 2%; margin: 2% 0; width: 50%">
                                            <strong>{{$mess->from->name}}</strong>
                                            <p>{!! nl2br(e($mess->contenue)) !!}</p>
                                        </div>
                                    </div>
                                @endif
                                @if ($mess->from->id === $user->id)
                                    <div class="col-12" style="display: flex; justify-content: right">
                                        <div style="text-align: right; background-color: rgba(0, 60, 255, 0.575); padding: 2%; margin: 2% 0; width: 50%">
                                            <strong>Moi</strong>
                                            <p>{!! nl2br(e($mess->contenue)) !!}</p>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                            @if ($messages->hasMorePages())
                                <div class="text-center" style="text-align: center; width: 100%; color: black">
                                    <a href="{{$messages->nextPageUrl()}}" class="btn btn-light">
                                        Voir les messages enciens
                                    </a>
                                </div>
                            @endif
                        </div>

                    </div>
                </div>
                <div class="card-footer">
                    <form action="{{route('MP', ['id' => $hash->encodeHex($membre->id)])}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <div class="row">
                                <div class="col-10">
                                    <textarea name="content" id="messages" cols="30" rows="1" placeholder="Messages..." class="form-control"></textarea>
                                </div>
                                <div class="col-2">
                                    <button class="btn btn-primary"><i class="fas fa-paper-plane"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @endif
    @endforeach
@endif
<script>

</script>
