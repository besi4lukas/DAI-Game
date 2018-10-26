<p class="dropdown-item">
    {{$notification->data['sender'][0]['username']}} accepted your game request &nbsp
    <button class="btn btn-primary btn-sm"  data-toggle="modal"
            data-target="#myModalOne"
            data-id="{{$notification->data['game']}}"
            onclick="add_game_id()"> Launch game </button>
</p>

