@extends('layouts.dai')

@section('before_content')
    <?php
    $user = \Illuminate\Support\Facades\Auth::user()
    ?>
    <div class="sidebar-wrapper">
        <ul class="nav">
            @if($user->role == "user")
            <li class="nav-item">
                <a class="nav-link" href="{{url('/home')}}">
                    <i class="material-icons">dashboard</i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="{{url('/user_profile')}}">
                    <i class="material-icons">person</i>
                    <p>User Profile</p>
                </a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="{{url('/one_on_one')}}">
                    <i class="material-icons">videogame_asset</i>
                    <p>One on One</p>
                </a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="{{url('/league')}}">
                    <i class="material-icons">flag</i>
                    <p>League</p>
                </a>
            </li>

            {{--<li class="nav-item ">--}}
                {{--<a class="nav-link" href="{{url('/notifications')}}">--}}
                    {{--<i class="material-icons">notifications</i>--}}
                    {{--<p>Notifications</p>--}}
                {{--</a>--}}
            {{--</li>--}}

            <li class="nav-item ">
                <a class="nav-link" href="{{url('/help')}}">
                    <i class="material-icons">help</i>
                    <p>Help</p>
                </a>
            </li>
            @else
            {{--for admin login--}}
                <li class="nav-item ">
                    <a class="nav-link" href="{{url('/home')}}">
                        <i class="material-icons">dashboard</i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-item ">
                    <a class="nav-link" href="{{url('/user_profile')}}">
                        <i class="material-icons">person</i>
                        <p>User Profile</p>
                    </a>
                </li>

                <li class="nav-item active">
                    <a class="nav-link" href="{{url('/one_on_one')}}">
                        <i class="material-icons">videogame_asset</i>
                        <p>One on One</p>
                    </a>
                </li>

                <li class="nav-item ">
                    <a class="nav-link" href="{{url('/league')}}">
                        <i class="material-icons">flag</i>
                        <p>League</p>
                    </a>
                </li>


                <li class="nav-item ">
                    <a class="nav-link" href="{{url('/help')}}">
                        <i class="material-icons">help</i>
                        <p>Help</p>
                    </a>
                </li>

                {{--<li class="nav-item ">--}}
                {{--<a class="nav-link" href="#">--}}
                {{--<i class="material-icons">location_ons</i>--}}
                {{--<p> Admin Dashboard</p>--}}
                {{--</a>--}}
                {{--</li>--}}

                <li class="nav-item ">
                    <a class="nav-link" href="{{url('/users')}}">
                        <i class="material-icons">person</i>
                        <p>Users</p>
                    </a>
                </li>
            @endif
        </ul>
    </div>

@endsection

@section('navbar')

                <div class="navbar-wrapper">
                    <a class="navbar-brand" href="">One on One</a>
                </div>


@endsection

@section('content')

    <?php
            $user = \Illuminate\Support\Facades\Auth::user();
            $coins = \Illuminate\Support\Facades\DB::select('select user_coins from user__profiles where user_id = ?',[$user->id]);
            $players = \App\User_Profile::where('user_id','!=',$user->id)->where('user_coins','>=',50)->get();
            $count = 0 ;
            ?>
    <div class="row">
        <div class="col-md-4">

            <div class="card card-stats">
                <div class="card-header card-header-success card-header-icon">
                    <div class="card-icon">
                        <i class="material-icons">toll</i>
                    </div>
                    <p class="card-category">Coins</p>
                    <h3 class="card-title">{{$coins[0]->user_coins}}</h3>
                </div>
            </div>
            <br>

            <div class="card card-stats">
                <div class="card-header card-header-success card-header-icon">
                    <div class="card-icon">
                        <i class="material-icons">videogame_asset</i>
                    </div>
                    <p class="card-category">Active Games</p>
                    <h3 class="card-title"></h3>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-hover">
                        <tbody>@foreach($active_games as $active_game)
                                <tr>
                                <td> <a href="{{url('/game',$game_id[$count])}}"> Active Game with {{$active_game->username}}</a></td>
                                </tr>
                                <p hidden>{{$count += 1 }} </p>
                      @endforeach</tbody>
                    </table>
                </div>
            </div>

        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">Active Players</h4>
                    <p class="card-category"></p>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-hover">
                        <thead class="text-warning">
                        <th>User Name</th>
                        <th>Coins</th>
                        </thead>
                        <tbody>
                        @if($coins[0]->user_coins >= 50)
                            @foreach($players as $player)

                        <tr>
                            <td>{{$player->username}}</td>
                            <td>{{$player->user_coins}}</td>
                            {{--<td>Niger</td>--}}
                            <td><a href="{{url('/battle',$player->user_id)}}" class="btn btn-primary btn-round btn-sm">Battle</a></td>
                        </tr>

                        @endforeach
                            @else
                            <tr>
                                <td>Not enough Coins</td>
                            </tr>
                        @endif

                        </tbody>
                    </table>
                </div>
            </div>

        </div>


    </div>





@endsection