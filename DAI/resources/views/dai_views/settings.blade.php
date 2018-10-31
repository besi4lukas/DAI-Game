@extends('layouts.dai')

@section('before_content')

    <div class="sidebar-wrapper">
        <ul class="nav">
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
            <li class="nav-item ">
                <a class="nav-link" href="{{url('/one_on_one')}}">
                    <i class="material-icons">videogame_asset</i>
                    <p>One on One</p>
                </a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="{{url('/league')}}">
                    <i class="material-icons">whatshot</i>
                    <p>League</p>
                </a>
            </li>

            {{--<li class="nav-item ">--}}
                {{--<a class="nav-link" href="{{url('/notifications')}}">--}}
                    {{--<i class="material-icons">notifications</i>--}}
                    {{--<p>Notifications</p>--}}
                {{--</a>--}}
            {{--</li>--}}

            <li class="nav-item active">
                <a class="nav-link" href="{{url('/settings')}}">
                    <i class="material-icons">settings</i>
                    <p>Settings</p>
                </a>
            </li>

            {{--for admin login--}}
            {{--<li class="nav-item ">--}}
                {{--<a class="nav-link" href="#">--}}
                    {{--<i class="material-icons">location_ons</i>--}}
                    {{--<p>Dashboard</p>--}}
                {{--</a>--}}
            {{--</li>--}}

            {{--<li class="nav-item ">--}}
                {{--<a class="nav-link" href="{{url('/users')}}">--}}
                    {{--<i class="material-icons">person</i>--}}
                    {{--<p>Users</p>--}}
                {{--</a>--}}
            {{--</li>--}}

        </ul>
    </div>


@endsection

@section('navbar')



                <div class="navbar-wrapper">
                    <a class="navbar-brand" href="javascript:void(0)">Settings</a>
                </div>


@endsection