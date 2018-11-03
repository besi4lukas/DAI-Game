@extends('layouts.dai')

@section('before_content')
    <?php
         $user = \Illuminate\Support\Facades\Auth::user()
    ?>
    <div class="sidebar-wrapper">
        <ul class="nav">
            @if($user->role == "user")
            <li class="nav-item ">
                <a class="nav-link" href="{{url('/home')}}">
                    <i class="material-icons">dashboard</i>
                    <p>Dashboard</p>
                </a>
            </li>

            <li class="nav-item active  ">
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
                <a class="nav-link" href="{{url('/settings')}}">
                    <i class="material-icons">help</i>
                    <p>Help</p>
                </a>
            </li>
            @else
            {{--for admin login--}}
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/home')}}">
                        <i class="material-icons">dashboard</i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-item active ">
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
                    <a class="nav-link" href="{{url('/settings')}}">
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
                    <a class="navbar-brand" href="">User Profile</a>
                </div>

@endsection

@section('content')

    <?php
            if(\Illuminate\Support\Facades\Auth::check()){
            $user = \Illuminate\Support\Facades\Auth::user();
            $email = \Illuminate\Support\Facades\DB::select('select email from users where id = ?',[$user->id]);
            }
    ?>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                    <div class="card card-profile">
                    <div class="card-avatar">
                    <a href="#pablo">
                    {{--<img class="img" src="{{asset('temp/assets/img/faces/marc.jpg')}}" />--}}
                    <img class="img" src="https://www.gravatar.com/avatar/{{md5($email[0]->email)}}?d=robohash" />
                    </a>
                    </div>
                    <div class="card-body">
                    <h6 class="card-category">{{$profile[0]->level}}</h6>
                    <h4 class="card-title">{{$profile[0]->username}}</h4>
                        <h5> {{$profile[0]->user_coins}} dai</h5>

                        <p class="card-description">

                        </p>
                    {{--<a href="#pablo" class="btn btn-primary btn-round"></a>--}}
                    </div>
                    </div>


                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header card-header-primary">
                             <h4 class="card-title">Edit Profile</h4>
                                {{--<p class="card-category">Complete your profile</p>--}}
                    </div>
                    <div class="card-body">
                        <form method="POST">
                             <div class="row">
                                 <div class="col-md-3">
                                     <div class="form-group">
                    <label class="bmd-label-floating">Username</label>
                    <input type="text" class="form-control" name="username" value="{{$profile[0]->username}}">
                    </div>
                    </div>
                    <div class="col-md-4">
                    <div class="form-group">
                    <label class="bmd-label-floating">Email address</label>
                    <input type="email" class="form-control" name="email" value="{{$email[0]->email}}">
                    </div>
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-md-6">
                    <div class="form-group">
                    <label class="bmd-label-floating">First Name</label>
                    <input type="text" class="form-control" name="firstName" value="{{$profile[0]->firstName}}">
                    </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                    <label class="bmd-label-floating">Last Name</label>
                    <input type="text" class="form-control" name="lastName" value="{{$profile[0]->lastName}}">
                    </div>
                    </div>
                    </div>

                    <button type="submit" class="btn btn-primary pull-right">Update Profile</button>
                    <div class="clearfix"></div>
                    {{ csrf_field() }}
                    </form>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--<footer class="footer">--}}
        {{--<div class="container-fluid">--}}
            {{--<nav class="float-left">--}}
                {{--<ul>--}}
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
                {{--</ul>--}}
            {{--</nav>--}}
            {{--<div class="copyright float-right" id="date">--}}
                {{--, made with <i class="material-icons">favorite</i> by--}}
                {{--<a href="https://www.creative-tim.com" target="_blank">Creative Tim</a> for a better web.--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</footer>--}}
    <script>
        const x = new Date().getFullYear();
        let date = document.getElementById('date');
        date.innerHTML = '&copy; ' + x + date.innerHTML;
    </script>


@endsection