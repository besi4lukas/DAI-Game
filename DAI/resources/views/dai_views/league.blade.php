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
            <li class="nav-item active">
                <a class="nav-link" href="{{url('/league')}}">
                    <i class="material-icons">whatshot</i>
                    <p>League</p>
                </a>
            </li>

            <li class="nav-item ">
                <a class="nav-link" href="{{url('/notifications')}}">
                    <i class="material-icons">notifications</i>
                    <p>Notifications</p>
                </a>
            </li>

            <li class="nav-item ">
                <a class="nav-link" href="{{url('/settings')}}">
                    <i class="material-icons">build</i>
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

            <li class="nav-item ">
                <a class="nav-link" href="{{url('/users')}}">
                    <i class="material-icons">person</i>
                    <p>Users</p>
                </a>
            </li>

        </ul>
    </div>
@endsection

@section('navbar')


                <div class="navbar-wrapper">
                    <a class="navbar-brand" href="javascript:void(0)">Leagues</a>
                </div>

@endsection

@section('content')


    <div class="container-fluid">
        <div class="card">
            <div class="card-header card-header-info">
                <h4 class="card-title">Your Leagues</h4>
                <p class="card-category"> <a href="#pablo" class="btn btn-info btn-round">Create new League</a></p>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-hover">
                    <thead class="text-warning">
                    <th>League Name</th>
                    <th>Players</th>
                    <th>Status</th>


                    </thead>
                    <tbody>
                    <tr>

                        <td>Dakota Rice</td>
                        <td>738</td>
                        <td>Public</td>
                        <td> <a href="{{url('/user_league')}}" class="btn btn-info btn-round btn-sm">View</a></td>
                    </tr>
                    <tr>

                        <td>Minerva Hooper</td>
                        <td>89</td>
                        <td>Public</td>
                        <td><a href="#pablo" class="btn btn-info btn-round btn-sm">View</a></td>
                    </tr>
                    <tr>

                        <td>Sage Rodriguez</td>
                        <td>142</td>
                        <td>Public</td>
                        <td><a href="#pablo" class="btn btn-info btn-round btn-sm">View</a></td>
                    </tr>
                    <tr>

                        <td>Philip Chaney</td>
                        <td>35</td>
                        <td>Public</td>
                        <td><a href="#pablo" class="btn btn-info btn-round btn-sm">view</a></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <br>

        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title">All Leagues</h4>
                <p class="card-category"></p>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-hover">
                    <thead class="text-warning">
                    <th>League Name</th>
                    <th>Players</th>
                    <th>Status</th>
                    </thead>
                    <tbody>
                    <tr>

                        <td>Dakota Rice</td>
                        <td>$36,738</td>
                        <td>Public</td>
                        <td><a href="#pablo" class="btn btn-primary btn-round btn-sm">Join</a></td>
                    </tr>
                    <tr>

                        <td>Minerva Hooper</td>
                        <td>$23,789</td>
                        <td>Public</td>
                        <td><a href="#pablo" class="btn btn-primary btn-round btn-sm">Join</a></td>
                    </tr>
                    <tr>

                        <td>Sage Rodriguez</td>
                        <td>$56,142</td>
                        <td>Private</td>
                        <td><a href="#pablo" class="btn btn-primary btn-round btn-sm">Join</a></td>
                    </tr>
                    <tr>

                        <td>Philip Chaney</td>
                        <td>$38,735</td>
                        <td>Private</td>
                        <td><a href="#pablo" class="btn btn-primary btn-round btn-sm">Join</a></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>



@endsection