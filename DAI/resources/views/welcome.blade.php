<!doctype html>
<html>

<head>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700" rel="stylesheet">
    <link rel="icon" href="{{asset('temp/assets/img/game.png')}}" type="image/gif" sizes="16x16" />
    <link rel="stylesheet" href="{{asset('temp/assets/css/style.css')}}" type="text/css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>The Dead and the injured</title>
</head>

<body id="body" style="background: linear-gradient( rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{asset('temp/assets/img/image.jpg')}}');">
<!--NAVBAR CONFIGURATION-->
<nav class="navbar navbar-expand-sm navbar-dark fixed-top">
    <div class="container">
        <a href="#" class="navbar-brand">
            <span style="color: white" class="navbar-text">THE DEAD AND THE INJURED</span>
        </a>
        <button class="navbar-toggler" data-toggle="collapse" data-target="#nav-coll">
            <span class="navbar-toggler-icon"></span>
        </button>


        <div class="navbar-collapse collapse" id="nav-coll">
            @if (Route::has('login'))
            <ul class="navbar-nav ml-auto">
                @auth
                <li class="nav-item">
                <a href="{{ url('/home') }}" class="nav-link ">
                                                Go to Dashboard</a>
                </li>
                @else
                {{--<li class="nav-item">--}}
                    {{--<a href="#" class="nav-link">Explore</a>--}}
                {{--</li>--}}
                {{--<li class="nav-item">--}}
                    {{--<a href=".#" class="nav-link">How We Play</a>--}}
                {{--</li>--}}


                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="nav-link">LOGIN</a>
                    </li>
                <li class="nav-item">
                    <a href="{{ route('register') }}" class="nav-link">
                        <i class="material-icons">  </i> REGISTER</a>
                </li>

                {{--<li class="nav-item">--}}
                    {{--<a href="#" class="nav-link">FAQs</a>--}}
                {{--</li>--}}
                @endauth
            </ul>
            @endif
        </div>
    </div>
</nav>




<div class="container align-middle">
    <div class="row">
        <div class="container" id="content">
            <div class="col-lg12">
                <h1 class="display-3">THE DEAD AND THE INJURED</h1>
                <h3 class="display-5">Will you survive?</h3>
                <hr id="#hr">
            </div>
            {{--<div class="">--}}
                {{--<a class="btn btn-outline-success" href="#" role="button">Battle</a>--}}
            {{--</div>--}}
        </div>

    </div>
</div>



<!--JQUERY AND JAVASCRIPT CDNS-->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>

</body>

</html>