<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('temp/assets/img/apple-icon.png')}}">
    <link rel="icon" type="image/png" href="{{asset('temp/assets/img/dead.png')}}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
        Dead And Injured
    </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <!-- CSS Files -->
    <link href="{{asset('temp/assets/css/material-dashboard.css?v=2.1.0')}}" rel="stylesheet" />


</head>

<body class="dark-edition">
    <div class="wrapper">
        <div class="container-fluid">

            <div>
            @yield('navbar')
            </div>

            <div>
                @yield('content')
            </div>


        </div>



    </div>

    <script src="{{asset('temp/assets/js/core/jquery.min.js')}}"></script>
    <script src="{{asset('temp/assets/js/core/popper.min.js')}}"></script>
    <script src="{{asset('temp/assets/js/core/bootstrap-material-design.min.js')}}"></script>
    <script src="https://unpkg.com/default-passive-events"></script>
    <script src="{{asset('temp/assets/js/plugins/perfect-scrollbar.jquery.min.js')}}"></script>
    <script src="{{asset('js/main.js')}}"> </script>

    <!-- Chartist JS -->
    <script src="{{asset('temp/assets/js/plugins/chartist.min.js')}}"></script>

    <!--  Notifications Plugin    -->
    <script src="{{asset('temp/assets/js/plugins/bootstrap-notify.js')}}"></script>

    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{asset('temp/assets/js/material-dashboard.js?v=2.1.0')}}"></script>

</body>

</html>