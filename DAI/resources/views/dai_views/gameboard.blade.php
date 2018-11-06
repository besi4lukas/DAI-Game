@extends('layouts.dai_links')

@section('navbar')

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-transparent" id="navigation-example">
        <div class="container-fluid">
            <div class="navbar-wrapper">
                <a class="btn btn-warning" href="">Exit Game</a>
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

    <div class="row">
        <div class="col-md-12">

            <div class="row">

                <div class="col-md-4 col-sm-4">

                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title"></h4>
                            <p class="card-category">You </p>
                            <i></i>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table table-hover">
                                <thead class="text-warning">
                                <th>Number</th>
                                <th>Dead</th>
                                <th>Injured</th>
                                </thead>
                                <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>

                <div class="col-md-4">

                    <div class="card">
                        <div class="card-header card-header-info">
                            <h4 class="card-title"></h4>
                            <p class="card-category">Guess</p>
                            <i></i>
                        </div>
                        <div class="card-body table-responsive">
                            <div class="offset-4">
                                <h4>Game Number</h4>
                            </div>

                            <div class="offset-4">
                                <h4>UserName</h4>
                            </div>
                            <div class="form-inline" >
                                <input id="idnumber" type="hidden" value="" >
                                <input id="game_id" type="hidden" value="" >
                                <input id="number1" type="text" class="form-control"  onkeypress="return isNumberKey(event)" autofocus maxlength="1"/>
                                <input id="number2" type="text" class="form-control" style="width: 50%;" onkeypress="return isNumberKey(event)"autofocus maxlength="1"/>
                                <input id="number3" type="text" class="form-control"  onkeypress="return isNumberKey(event)"autofocus maxlength="1" />
                            </div>

                            <div class="offset-4">
                            <button ONCLICK="posting()" id="coin" class="btn btn-primary">send</button>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-md-4">

                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title"></h4>
                            <p class="card-category">Username</p>
                            <i></i>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table table-hover">
                                <thead class="text-warning">
                                <th>Number</th>
                                <th>Dead</th>
                                <th>Injured</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>

            </div>

        </div>


    </div>









@endsection