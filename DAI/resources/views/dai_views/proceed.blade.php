@extends('layouts.dai_links')


@section('navbar')

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-transparent" id="navigation-example">
        <div class="container-fluid">
            <div class="navbar-wrapper">
                <a class="navbar-brand" href="{{url('/home')}}">Dashboard</a>
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


    <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-8">
                <div class="card">
                    <div class="card-header" style="color: white;"></div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('game_board') }}">
                            @csrf

                            <div class="form-group row">

                                <div class="col-md-6">
                                    <input  type="hidden"
                                           name="game_id" value="{{ $game_id }}" required autofocus autocomplete="off">
                                </div>
                            </div>

                            <div class="form-group row">
                                {{--<label for="number" class="col-md-4 col-form-label text-md-right">{{ __('') }}</label>--}}

                                <div class="col-md-8 offset-md-2">
                                    <input id="number" type="text"
                                           pattern="[0-9]{3}"
                                           class="form-control" name="number" placeholder="Enter your three digit number" required
                                    autocomplete="off">

                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Proceed to Game Board') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>










@endsection