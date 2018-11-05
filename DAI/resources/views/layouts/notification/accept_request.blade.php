<p class="dropdown-item">
    {{$notification->data['sender'][0]['username']}} accepted your game request &nbsp
    <a  href="{{url('/game_one',$notification->data['game'])}}" class="btn btn-primary btn-sm"> Launch game </a>
</p>