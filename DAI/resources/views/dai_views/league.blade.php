@extends('layouts.dai')


@section('content')
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="material-icons">dashboard</i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="#">
                    <i class="material-icons">person</i>
                    <p>User Profile</p>
                </a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="#">
                    <i class="material-icons">content_paste</i>
                    <p>One on One</p>
                </a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="#">
                    <i class="material-icons">library_books</i>
                    <p>League</p>
                </a>
            </li>

            <li class="nav-item ">
                <a class="nav-link" href="#">
                    <i class="material-icons">notifications</i>
                    <p>Notifications</p>
                </a>
            </li>

            <li class="nav-item ">
                <a class="nav-link" href="#">
                    <i class="material-icons">bubble_chart</i>
                    <p>Settings</p>
                </a>
            </li>

            {{--for admin login--}}
            <li class="nav-item ">
                <a class="nav-link" href="#">
                    <i class="material-icons">location_ons</i>
                    <p>Dashboard</p>
                </a>
            </li>

            <li class="nav-item ">
                <a class="nav-link" href="#">
                    <i class="material-icons">notifications</i>
                    <p>Users</p>
                </a>
            </li>

        </ul>
    </div>





@endsection