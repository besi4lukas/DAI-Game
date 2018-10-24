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
                    <i class="material-icons">content_paste</i>
                    <p>One on One</p>
                </a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="{{url('/league')}}">
                    <i class="material-icons">library_books</i>
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
                <a class="nav-link" href="{{url('/users')}}">
                    <i class="material-icons">person</i>
                    <p>Users</p>
                </a>
            </li>

        </ul>
    </div>
@endsection

@section('navbar')

        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-transparent " id="navigation-example">
            <div class="container-fluid">
                <div class="navbar-wrapper">
                    <a class="navbar-brand" href="javascript:void(0)">Leagues</a>
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation" data-target="#navigation-example">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end">
                    <form class="navbar-form">
                        <div class="input-group no-border">
                            <input type="text" value="" class="form-control" placeholder="Search...">
                            <button type="submit" class="btn btn-default btn-round btn-just-icon">
                                <i class="material-icons">search</i>
                                <div class="ripple-container"></div>
                            </button>
                        </div>
                    </form>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="javascript:void(0)">
                                <i class="material-icons">dashboard</i>
                                <p class="d-lg-none d-md-block">
                                    Stats
                                </p>
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="javscript:void(0)" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons">notifications</i>
                                <span class="notification">5</span>
                                <p class="d-lg-none d-md-block">
                                    Some Actions
                                </p>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="javascript:void(0)">Mike John responded to your email</a>
                                <a class="dropdown-item" href="javascript:void(0)">You have 5 new tasks</a>
                                <a class="dropdown-item" href="javascript:void(0)">You're now friend with Andrew</a>
                                <a class="dropdown-item" href="javascript:void(0)">Another Notification</a>
                                <a class="dropdown-item" href="javascript:void(0)">Another One</a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="javascript:void(0)">
                                <i class="material-icons">person</i>
                                <p class="d-lg-none d-md-block">
                                    Account
                                </p>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- End Navbar -->


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