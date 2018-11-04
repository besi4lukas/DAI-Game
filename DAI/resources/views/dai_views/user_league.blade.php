@extends('layouts.dai_links')


@section('navbar')

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-transparent" id="navigation-example">
        <div class="container-fluid">
            <div class="navbar-wrapper">
                <a class="navbar-brand" href="{{url('/league')}}">League</a>
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation" data-target="#navigation-example">
                <span class="sr-only">Toggle navigation</span>
                <span class="navbar-toggler-icon icon-bar"></span>
                <span class="navbar-toggler-icon icon-bar"></span>
                <span class="navbar-toggler-icon icon-bar"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end">
                <ul class="navbar-nav">

                </ul>
            </div>
        </div>
    </nav>

@endsection

@section('content')
    <?php
            $count = 0 ;
            $user = \App\User_Profile::where('user_id',$league->league_founder)->first() ;

    ?>
        <div class="row">
            <div class="col-md-12">

                <div class="row">

                    <div class="col-md-3">

                        <div class="card card-stats">
                            <div class="card-header card-header-warning card-header-icon">
                                <div class="card-icon">
                                    <i class="material-icons">content_copy</i>
                                </div>
                                <p class="card-category">Winning Ratio</p>
                                <h3 class="card-title">{{$winningRatio}}
                                </h3>
                            </div>
                        </div>

                    </div>

                    <div class="col-md-3">

                        <div class="card card-stats">
                            <div class="card-header card-header-warning card-header-icon">
                                <div class="card-icon">
                                    <i class="material-icons">content_copy</i>
                                </div>
                                <p class="card-category">Points</p>
                                <h3 class="card-title">{{$points}}
                                </h3>
                            </div>
                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="card">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title">{{$league->league_name}}</h4>
                                <p class="card-category">Rankings Table </p>
                                <i> created by {{$user->username}}</i>
                            </div>
                            <div class="card-body table-responsive">
                                <table class="table table-hover">
                                    <thead class="text-warning">
                                    <th>Name</th>
                                    <th>Coins</th>
                                    <th>Score</th>
                                    </thead>
                                    <tbody>
                                    @foreach($player_names as $player_name)
                                    <tr>

                                        <td>{{$player_name}}</td>
                                        <td>{{$coins[$count]}}</td>
                                        <td>{{$score[$count]}}</td>
                                        <td><a href="" class="btn btn-primary btn-round btn-sm">Battle</a></td>
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

            {{--<div class="col-md-4">--}}
                    {{----}}
                {{--<div class="row">--}}
                    {{----}}
                    {{--<div class="">--}}
                        {{----}}
                        {{----}}
                    {{--</div>--}}
               {{----}}

            {{--</div>--}}
                {{----}}
            {{--</div>--}}

        </div>

@endsection