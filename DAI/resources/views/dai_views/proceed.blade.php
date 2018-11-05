@extends('layouts.dai_links')


@section('navbar')

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-transparent" id="navigation-example">
        <div class="container-fluid">
            <div class="navbar-wrapper">
                <a class="navbar-brand" href="" data-toggle="modal" data-target="#Modal"
                >Exit to Dashboard</a>
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


    <!-- Modal -->
    <div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">If you exit your opponent wins the game  </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h6>Are you sure you want to exit ?</h6>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"> No </button>
                    <a type="button" class="btn btn-warning" href="{{url('/exit', $game_id)}}">Quit Game</a>
                </div>
                {{--<div class="modal-footer">--}}
                    {{--<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>--}}
                    {{--<button type="button" class="btn btn-primary">Save changes</button>--}}
                {{--</div>--}}
            </div>
        </div>
    </div>





@endsection