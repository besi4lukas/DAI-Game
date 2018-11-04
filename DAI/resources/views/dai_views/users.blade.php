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

                <li class="nav-item active ">
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
                <a class="navbar-brand" href="">Users</a>
            </div>


@endsection

@section('content')
    <?php
            $count = 0 ;
    ?>

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title">Users</h4>
                                {{--<p class="card-category">General DAI ranking</p>--}}
                            </div>
                            <div class="card-body table-responsive">
                                <table class="table table-hover">
                                    <thead class="text-warning">
                                    <th>Email</th>
                                    <th>Name</th>
                                    <th>Coins</th>
                                    <th>Level</th>
                                    </thead>
                                    <tbody>
                                        @foreach($users as $user)
                                            @if($user->role == "user")

                                        <tr>
                                            <td>{{$user->email}}</td>
                                            <td>{{$profiles[$count]->username}}</td>
                                            <td>{{$profiles[$count]->user_coins}}</td>
                                            <td>{{$profiles[$count]->level}}</td>
                                            <td><a
                                                        href=""
                                                        id="adUser"
                                                        data-toggle="modal"
                                                        data-target="#adminUser"
                                                        data-id="{{ $user->id }}"
                                                        onclick="adUser()"
                                                        class="material-icons">perm_identity</a></td>
                                            <td><a
                                                        href=""
                                                        id="delUser"
                                                        data-toggle="modal"
                                                        data-target="#deleteUser"
                                                        data-id="{{$user->id}}"
                                                        onclick="delUser()"
                                                        class="material-icons ">delete</a></td>

                                        </tr>
                                        @else
                                                <tr>
                                                    <td>{{$user->email}}</td>
                                                    <td>{{$profiles[$count]->username}}</td>
                                                    <td>{{$profiles[$count]->user_coins}}</td>
                                                    <td>{{$profiles[$count]->level}}</td>
                                                    <td>admin</td>


                                                </tr>

                                                @endif
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

    <!--Modal for delete prompt-->
    <div class="modal fade" id="deleteUser">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal body -->
                <div class="modal-body dark-edition">
                    <form method="POST" action="{{route('delete_user')}}">
                        <input type="hidden" id="user_id" name="user_id" value="">
                        <h6>Are you sure you want to delete this user ?</h6>
                        <button type="submit" class="btn btn-danger pull-right">Yes</button>
                        <button type="button" class="btn btn-primary pull-right" data-dismiss="modal">No</button>
                        {{ csrf_field() }}
                    </form>
                </div>

            </div>
        </div>
    </div>

    <!-- Modal for Admin prompt -->
    <div class="modal fade" id="adminUser">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal body -->
                <div class="modal-body dark-edition">
                    <form method="POST" action="{{route('make_admin')}}">
                        <input type="hidden" id="user_id" name="user_id" value="">
                        <h6>Are you sure you want to make this user an Admin ?</h6>
                        <button type="submit" class="btn btn-danger pull-right">Yes</button>
                        <button type="button" class="btn btn-primary pull-right" data-dismiss="modal">No</button>
                        {{ csrf_field() }}
                    </form>
                </div>
            </div>
        </div>
    </div>







@endsection

@section('after_content')


    <script>

        function delUser() {

            $('#deleteUser').on('show.bs.modal', function (event) { // id of the modal with event

                var a = $(event.relatedTarget); // Button that triggered the modal

                // var id = $("#delUser").data("id");

                var id = a.data("id");

                // Update the modal's content.

                var modal = $(this);
                console.log(id);
                console.log(modal);

                modal.find('.modal-body input#user_id').val(id);



            })

        }

        function adUser() {

            $('#adminUser').on('show.bs.modal', function (event) { // id of the modal with event

                var a = $(event.relatedTarget); // Button that triggered the modal

                var id = a.data("id");

                // Update the modal's content.

                var modal = $(this);
                console.log(id);
                console.log(modal);

                modal.find('.modal-body input#user_id').val(id);



            })

        }


    </script>











@endsection