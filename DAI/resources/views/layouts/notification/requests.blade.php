<p class="dropdown-item">
    <?php
    $id = \Illuminate\Support\Facades\DB::select('select user_id from user__profiles where username = ?',[$notification->data['sender'][0]['username']]) ;
    ?>
    {{$notification->data['sender'][0]['username']}} sent you a game request &nbsp
    <a class="btn btn-primary btn-sm" href="{{url('/game_two',$id[0]->user_id)}}"> Accept</a>
    <a class="btn btn-primary btn-sm" href="{{url('/notifications/delete',$id[0]->user_id)}}">Decline</a>
</p>

{{--href="{{url('/notifications',$id[0]->user_id)}}"--}}

