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
            <li class="nav-item ">
                <a class="nav-link" href="{{url('/one_on_one')}}">
                    <i class="material-icons">videogame_asset</i>
                    <p>One on One</p>
                </a>
            </li>
            <li class="nav-item active">
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

                <li class="nav-item ">
                    <a class="nav-link" href="{{url('/one_on_one')}}">
                        <i class="material-icons">videogame_asset</i>
                        <p>One on One</p>
                    </a>
                </li>

                <li class="nav-item active ">
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
                    <a class="navbar-brand" href="">Leagues</a>
                </div>

@endsection

@section('content')
<?php
    $count = 0 ;
    $count_ = 0 ;
?>

    <div class="container-fluid">
        <div class="card">
            <div class="card-header card-header-info">
                <h4 class="card-title">Your Leagues</h4>
                <p class="card-category"> <a href="#pablo" class="btn btn-info btn-round"
                                             data-toggle="modal"
                                             data-target="#createLeague"
                    >Create new League</a></p>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-hover">
                    <thead class="text-warning">
                    <th>League Name</th>
                    <th>Players</th>
                    <th>Status</th>

                    </thead>
                    <tbody>@foreach($leagues_user as $league_user)
                               @if(! in_array($league_user->id,$admin))
                    <tr>
                        <td>{{$league_user->league_name}}</td>
                        <td>{{$league_players[$count]}}</td>
                        <td>{{$league_user->status}}</td>
                        <td> <a href="{{url('/user_league',$league_user->id)}}" class="btn btn-info btn-round btn-sm">View</a></td>
                    </tr>
                    @else
                                   <tr>
                                       <td>{{$league_user->league_name}}</td>
                                       <td>{{$league_players[$count]}}</td>
                                       <td>{{$league_user->status}}</td>
                                       <td> <a href="{{url('/user_league',$league_user->id)}}" class="btn btn-info btn-round btn-sm">View</a></td>
                                       <td><a href=""
                                              id="delLeague"
                                              data-toggle="modal"
                                              data-target="#deleteLeague"
                                              data-id="{{$league_user->id}}"
                                              onclick="del()"
                                              class="material-icons">delete</a></td>

                                   </tr>
                               @endif

                        <p hidden> {{$count += 1 }}</p>
                  @endforeach </tbody>
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
                    <tbody>@foreach($leagues_all as $league_all)

                        @if( ! in_array($league_all->id,$id_array) )
                    <tr>
                        <td>{{$league_all->league_name}}</td>
                        <td>{{$league_all_players[$count_]}}</td>
                        <td>{{$league_all->status}}</td>
                        <td><a href="{{url('/join',$league_all->id)}}" class="btn btn-primary btn-round btn-sm">Join</a></td>
                    </tr>
                        @endif
                        <p hidden>{{$count_ += 1}}</p>
                 @endforeach </tbody>
                </table>
            </div>
        </div>

    </div>



    <div class="modal fade" id="createLeague">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal body -->
                <div class="modal-body dark-edition">
                    <form method="POST" action="#">
                        <input type="text" class="form-control" name="league" placeholder="Enter Name of League" required autocomplete="off">
                        <select class="form-control" id="status" name="status">
                            <option value="public" style="color:#000;">  Public</option>
                            <option value="private" style="color:#000;"> Private</option>
                        </select>
                        <button type="submit" class="btn btn-primary pull-right">Create</button>
                        {{ csrf_field() }}
                    </form>
                </div>


            </div>
        </div>
    </div>

<div class="modal fade" id="deleteLeague">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal body -->
            <div class="modal-body dark-edition">
                <form method="POST" action="{{route('deleteLeague')}}">
                    <input type="hidden" id="league_id" name="league_id" value="">
                    <h6>Are you sure you want to delete ?</h6>
                    <button type="submit" class="btn btn-danger pull-right">Yes</button>
                    <button type="button" class="btn btn-primary pull-right" data-dismiss="modal">No</button>
                    {{ csrf_field() }}
                </form>
            </div>

        </div>
    </div>
</div>

<script>

</script>

@endsection

@section('after_content')
    <script>

    function del() {

    $('#deleteLeague').on('show.bs.modal', function (event) { // id of the modal with event

    var a = $(event.relatedTarget); // Button that triggered the modal

    var id = a.data("id");

    // Update the modal's content.

    var modal = $(this);
    console.log(id);
    console.log(modal);

    modal.find('.modal-body input#league_id').val(id);



    })

    }

    </script>


@endsection