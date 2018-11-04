@extends('layouts.dai')

@section('before_content')
    <?php
    $user = \Illuminate\Support\Facades\Auth::user() ;
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

                <li class="nav-item active">
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


                <li class="nav-item active">
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
        <a class="navbar-brand" href="">Help</a>
    </div>


@endsection

@section('content')

<div class="content">
    <div class="container-fluid">
        <div id="accordion">
            <div class="card">
                <div class="card-header">
                    <a class="card-link" data-toggle="collapse" href="#collapseOne">
                        What is Dead and Injured ?
                    </a>
                </div>
                <div id="collapseOne" class="collapse show" data-parent="#accordion">
                    <div class="card-body">
                        Dead and Injured is a probability and algorithmic based game designed to test the limits of human reasoning. Each round features 2 players where each attempts to guess the others three digit number
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <a class="collapsed card-link" data-toggle="collapse" href="#collapseTwo">
                        How to play Dead and Injured ?
                    </a>
                </div>
                <div id="collapseTwo" class="collapse" data-parent="#accordion">
                    <div class="card-body">
                        Enter a three digit number that you think might be you opponent's number and you will receive a report on the number of dead and injured numbers.
                        A dead number is the right number in the right position and an Injured number is the right number in the wrong position.
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <a class="collapsed card-link" data-toggle="collapse" href="#collapseThree">
                        How to join/create a league ?
                    </a>
                </div>
                <div id="collapseThree" class="collapse" data-parent="#accordion">
                    <div class="card-body">
                        Navigate to the league page. Click on the join button of the league you want to compete in. If the league is a private league a join request will be
                        sent to the admin of the league to accept your request. Very Easy!
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <a class="collapsed card-link" data-toggle="collapse" href="#collapseFour">
                        How to start a battle ?
                    </a>
                </div>
                <div id="collapseFour" class="collapse" data-parent="#accordion">
                    <div class="card-body">
                        Navigate to the "one on one" page. Click on the battle button of the player you want to play against.
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <a class="collapsed card-link" data-toggle="collapse" href="#collapseFive">
                        How to change my avatar ?
                    </a>
                </div>
                <div id="collapseFive" class="collapse" data-parent="#accordion">
                    <div class="card-body">
                        Go to <a href="https://www.gravatar.com" target="_blank"> gravatar </a>. Create an account and upload a photo of
                        your choice.
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <a class="collapsed card-link" data-toggle="collapse" href="#collapseSix">
                        What are the game levels ?
                    </a>
                </div>
                <div id="collapseSix" class="collapse" data-parent="#accordion">
                    <div class="card-body">
                        Dead and Injured game levels are controlled by the amount of dai coins you have. A beginner level is
                         between 0 dai coins to 950 dai coins. An Amateur level is between 1000 dai coins to 1950 dai coins. A Professional is between 2000 dai coins to
                        3950 dai coins. An expert level is between 4000 dai coins to 7950 dai coins. A Master level is between 8000 dai coins to
                        15950 dai coins. A Grand Master level is between 16000 dai coins and above.
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <a class="collapsed card-link" data-toggle="collapse" href="#collapseSeven">
                        How to change my email ?
                    </a>
                </div>
                <div id="collapseSeven" class="collapse" data-parent="#accordion">
                    <div class="card-body">
                        Navigate to the "user profile" page. Change the email input to the new valid email and click the
                        update button.
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <a class="collapsed card-link" data-toggle="collapse" href="#collapseEight">
                        How to update my profile ?
                    </a>
                </div>
                <div id="collapseEight" class="collapse" data-parent="#accordion">
                    <div class="card-body">
                        Navigate to the "user profile" page. Make the new updates and click the update profile button.
                    </div>
                </div>
            </div>



        </div>

    </div>

</div>




@endsection
