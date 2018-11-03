@extends('layouts.dai')

@section('before_content')
<?php
        $user = \Illuminate\Support\Facades\Auth::user();
?>

    <div class="sidebar-wrapper">
        <ul class="nav">
            @if($user->role == "user")
            <li class="nav-item active  ">
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
            <li class="nav-item ">
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
                <li class="nav-item active  ">
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

                <li class="nav-item ">
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
                    <a class="navbar-brand" href="" >Dashboard</a>
                </div>
@endsection

@section('content')
    <?php
            $count = 0 ;
    ?>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-warning card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">star</i>
                            </div>
                            <p class="card-category">Games Won</p>
                            <h3 class="card-title">{{$data[0]['games'][0]->games}}
                            </h3>
                        </div>
                        {{--<div class="card-footer">--}}
                            {{--<div class="stats">--}}
                                {{--<i class="material-icons text-warning">warning</i>--}}
                                {{--<a href="#pablo" class="warning-link">Get More Space...</a>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-success card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">toll</i>
                            </div>
                            <p class="card-category">Coins</p>
                            <h3 class="card-title">{{$data[0]['profile'][0]->user_coins}}</h3>
                        </div>
                        {{--<div class="card-footer">--}}
                            {{--<div class="stats">--}}
                                {{--<i class="material-icons">date_range</i> Last 24 Hours--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-danger card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">gamepad</i>
                            </div>
                            <p class="card-category">Games Played</p>
                            <h3 class="card-title">{{$data[0]['played'][0]->count}}</h3>
                        </div>
                        {{--<div class="card-footer">--}}
                            {{--<div class="stats">--}}
                                {{--<i class="material-icons">local_offer</i> Tracked from Github--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-info card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">flag</i>
                            </div>
                            <p class="card-category">Leagues</p>
                            <h3 class="card-title">{{$data[0]['leagues'][0]->leagues}}</h3>
                        </div>
                        {{--<div class="card-footer">--}}
                            {{--<div class="stats">--}}
                                {{--<i class="material-icons">update</i> Just Updated--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title">DAI Leaderboard</h4>
                            {{--<p class="card-category">General DAI ranking</p>--}}
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table table-hover">
                                <thead class="text-warning">
                                <th>Name</th>
                                <th>Coins</th>
                                <th>Title</th>
                                </thead>
                                <tbody>
                                @foreach($leaders as $leader)
                                <tr>
                                    <td>{{$leader->username}}</td>
                                    <td>{{$leader->user_coins}}</td>
                                    <td>{{$title[$count]}}</td>
                                </tr>
                                    <p hidden>{{$count += 1}}</p>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer">
        <div class="container-fluid">
            <nav class="float-left">
                <ul>
                    {{--<li>--}}
                        {{--<a href="https://www.creative-tim.com">--}}
                            {{--Creative Tim--}}
                        {{--</a>--}}
                    {{--</li>--}}
                    {{--<li>--}}
                        {{--<a href="https://creative-tim.com/presentation">--}}
                            {{--About Us--}}
                        {{--</a>--}}
                    {{--</li>--}}
                    {{--<li>--}}
                        {{--<a href="http://blog.creative-tim.com">--}}
                            {{--Blog--}}
                        {{--</a>--}}
                    {{--</li>--}}
                    {{--<li>--}}
                        {{--<a href="https://www.creative-tim.com/license">--}}
                            {{--Licenses--}}
                        {{--</a>--}}
                    {{--</li>--}}
                </ul>
            </nav>
            {{--<div class="copyright float-right" id="date">--}}
                {{--, made with <i class="material-icons">favorite</i> by--}}
                {{--<a href="https://www.creative-tim.com" target="_blank">Creative Tim</a> for a better web.--}}
            {{--</div>--}}
        </div>
    </footer>


    <script>
        const x = new Date().getFullYear();
        let date = document.getElementById('date');
        date.innerHTML = '&copy; ' + x + date.innerHTML;
    </script>

@endsection