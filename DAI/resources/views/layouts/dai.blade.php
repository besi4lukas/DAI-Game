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
    {{--<link rel="stylesheet" href="{{asset('temp/assets/css/dead.css')}}" type="text/css" />--}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Pusher Api library -->
    <script src="https://js.pusher.com/4.3/pusher.min.js"></script>


</head>

<body class="dark-edition">
<?php

        $user = \Illuminate\Support\Facades\Auth::user() ;
        $user_profile = \Illuminate\Support\Facades\DB::select('select * from user__profiles where user_id = ?',[$user->id]) ;
        $email = \Illuminate\Support\Facades\DB::select('select email from users where id = ?',[$user->id]);

?>
    <div class="wrapper ">
        <div class="sidebar" data-color="purple" data-background-color="black" data-image="{{asset('temp/assets/img/fire4.gif')}}">

            <div class="logo">
                <a href="{{url('/user_profile')}}" class="simple-text logo-normal">
                    {{$user_profile[0]->username}}
                </a>
            </div>

               @yield('before_content')



        </div>

        <div class="main-panel">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-transparent " id="navigation-example">
                <div class="container-fluid">

                    @yield('navbar')

                    <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation" data-target="#navigation-example">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="navbar-toggler-icon icon-bar"></span>
                        <span class="navbar-toggler-icon icon-bar"></span>
                        <span class="navbar-toggler-icon icon-bar"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end">
                        {{--<form class="navbar-form">--}}
                            {{--<div class="input-group no-border">--}}
                                {{--<input type="text" value="" class="form-control" placeholder="Search...">--}}
                                {{--<button type="submit" class="btn btn-default btn-round btn-just-icon">--}}
                                    {{--<i class="material-icons">search</i>--}}
                                    {{--<div class="ripple-container"></div>--}}
                                {{--</button>--}}
                            {{--</div>--}}
                        {{--</form>--}}
                        <ul class="navbar-nav">
                            {{--<li class="nav-item">--}}
                                {{--<a class="nav-link" href="{{url('/home')}}">--}}
                                    {{--<i class="material-icons">dashboard</i>--}}
                                    {{--<p class="d-lg-none d-md-block">--}}
                                        {{--Stats--}}
                                    {{--</p>--}}
                                {{--</a>--}}
                            {{--</li>--}}
                            <li class="nav-item dropdown">

                                <a class="nav-link" href=""
                                   id="navbarDropdownMenuLink"
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" onclick="mark()">
                                    <i class="material-icons" data-toggle="dropdown" id="notify">notifications</i>
                                    <span class="notification" id="myBadge">{{count(auth()->user()->unreadNotifications)}}</span>
                                    <p class="d-lg-none d-md-block">
                                        Some Actions
                                    </p>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                                    @forelse(auth()->user()->unreadNotifications as $notification)
                                        @include('layouts.notification.'.snake_case(class_basename($notification->type)))
                                        @empty
                                        <p class="dropdown-item">
                                            you have no new game requests
                                        </p>
                                    @endforelse

                                </div>
                            </li>

                            <li class="nav-item dropdown ">
                                <a class="nav-link" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{--<i class="material-icons">person</i>--}}
                                    <img class="rounded-circle" src="https://www.gravatar.com/avatar/{{md5($email[0]->email)}}?d=robohash" height="40" width="40" >
                                    <p class="d-lg-none d-md-block">
                                        Account
                                    </p>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                                    <a href="" class="dropdown-item"> Settings </a>
                                    <a href="{{ route('logout') }}" class="dropdown-item"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log Out</a>
                                    <form id="logout-form" action="{{route('logout')}}" method="post" style="display: none;">
                                        {{csrf_field()}}
                                    </form>

                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <br>
            <!-- End Navbar -->




            <!-- The Modal player one-->
            <div class="modal fade" id="myModalOne">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Game Number</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body dark-edition">
                            <form method="POST" action="{{route('gameLaunch')}}">
                                <input type="hidden" id="game_id" class="form-control" name="game_id" value="">
                                <input type="text" class="form-control" name="number" placeholder="enter game number" required autocomplete="off">
                                <button type="submit" class="btn btn-primary pull-right">Confirm</button>
                                {{ csrf_field() }}
                            </form>
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>

                    </div>
                </div>
            </div>





            <!-- The Modal player two-->
            <div class="modal fade" id="myModalTwo">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Game Number</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body dark-edition">
                            <form method="POST" action="{{route('game')}}">
                                <input type="hidden" id="player_one" name="player_one" value="">
                                <input type="text" class="form-control" name="number" placeholder="enter game number" required autocomplete="off">
                                <button type="submit" class="btn btn-primary pull-right">Confirm</button>
                                {{ csrf_field() }}
                            </form>
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>

                    </div>
                </div>
            </div>



            <div class="container-fluid">

            @yield('content')

            </div>

        </div>


    </div>


    <!--   Core JS Files   -->
    <script src="{{asset('temp/assets/js/core/jquery.min.js')}}"></script>
    <script src="{{asset('temp/assets/js/core/popper.min.js')}}"></script>
    <script src="{{asset('temp/assets/js/core/bootstrap-material-design.min.js')}}"></script>
    <script src="https://unpkg.com/default-passive-events"></script>
    <script src="{{asset('temp/assets/js/plugins/perfect-scrollbar.jquery.min.js')}}"></script>
    <script src="{{asset('js/main.js')}}"> </script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

    <!-- Chartist JS -->
    <script src="{{asset('temp/assets/js/plugins/chartist.min.js')}}"></script>

    <!--  Notifications Plugin    -->
    <script src="{{asset('temp/assets/js/plugins/bootstrap-notify.js')}}"></script>

    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{asset('temp/assets/js/material-dashboard.js?v=2.1.0')}}"></script>

    {{--pusher client scripts --}}

    <script>
        var pusher = new Pusher('afb6c7a8250bde3101f3', {
            cluster: 'eu',
            forceTLS: true
        });


        var gameRequestChannel = pusher.subscribe('new-request-channel') ;
            gameRequestChannel.bind('App\\Events\\newRequest', function (data) {
                if(data.destinationUserId = '{{ $user->id }}'){
                    location.reload() ;
                }
            });


    </script>

    {{--This is the script for marking a notification as read --}}
    <script>

        function mark() {

            $.ajax({
                url: 'markAsRead',
                type: 'get',
                dataType: 'html'

            }) ;

            $("button").click(function(){
                $("p").hide(1000);
            });

        }

    </script>


    <script>

    function add(){
        $('#myModalTwo').on('show.bs.modal', function (event) { // id of the modal with event

            var button = $(event.relatedTarget); // Button that triggered the modal

            var id = button.data('id');

            // Update the modal's content.

            var modal = $(this);
            console.log(id);
            console.log(modal);

            modal.find('.modal-body input#player_one').val(id);



        })
    }

    function add_game_id(){
        $('#myModalOne').on('show.bs.modal', function (event) { // id of the modal with event

            var button = $(event.relatedTarget); // Button that triggered the modal

            var id = button.data('id');

            // Update the modal's content.

            var modal = $(this);
            console.log(id);
            console.log(modal);

            modal.find('.modal-body input#game_id').val(id);



        })
    }

</script>


    <script>
        $(document).ready(function() {
            $().ready(function() {
                $sidebar = $('.sidebar');

                $sidebar_img_container = $sidebar.find('.sidebar-background');

                $full_page = $('.full-page');

                $sidebar_responsive = $('body > .navbar-collapse');

                window_width = $(window).width();

                $('.fixed-plugin a').click(function(event) {
                    // Alex if we click on switch, stop propagation of the event, so the dropdown will not be hide, otherwise we set the  section active
                    if ($(this).hasClass('switch-trigger')) {
                        if (event.stopPropagation) {
                            event.stopPropagation();
                        } else if (window.event) {
                            window.event.cancelBubble = true;
                        }
                    }
                });

                $('.fixed-plugin .active-color span').click(function() {
                    $full_page_background = $('.full-page-background');

                    $(this).siblings().removeClass('active');
                    $(this).addClass('active');

                    var new_color = $(this).data('color');

                    if ($sidebar.length != 0) {
                        $sidebar.attr('data-color', new_color);
                    }

                    if ($full_page.length != 0) {
                        $full_page.attr('filter-color', new_color);
                    }

                    if ($sidebar_responsive.length != 0) {
                        $sidebar_responsive.attr('data-color', new_color);
                    }
                });

                $('.fixed-plugin .background-color .badge').click(function() {
                    $(this).siblings().removeClass('active');
                    $(this).addClass('active');

                    var new_color = $(this).data('background-color');

                    if ($sidebar.length != 0) {
                        $sidebar.attr('data-background-color', new_color);
                    }
                });

                $('.fixed-plugin .img-holder').click(function() {
                    $full_page_background = $('.full-page-background');

                    $(this).parent('li').siblings().removeClass('active');
                    $(this).parent('li').addClass('active');


                    var new_image = $(this).find("img").attr('src');

                    if ($sidebar_img_container.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
                        $sidebar_img_container.fadeOut('fast', function() {
                            $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
                            $sidebar_img_container.fadeIn('fast');
                        });
                    }

                    if ($full_page_background.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
                        var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

                        $full_page_background.fadeOut('fast', function() {
                            $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
                            $full_page_background.fadeIn('fast');
                        });
                    }

                    if ($('.switch-sidebar-image input:checked').length == 0) {
                        var new_image = $('.fixed-plugin li.active .img-holder').find("img").attr('src');
                        var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

                        $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
                        $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
                    }

                    if ($sidebar_responsive.length != 0) {
                        $sidebar_responsive.css('background-image', 'url("' + new_image + '")');
                    }
                });

                $('.switch-sidebar-image input').change(function() {
                    $full_page_background = $('.full-page-background');

                    $input = $(this);

                    if ($input.is(':checked')) {
                        if ($sidebar_img_container.length != 0) {
                            $sidebar_img_container.fadeIn('fast');
                            $sidebar.attr('data-image', '#');
                        }

                        if ($full_page_background.length != 0) {
                            $full_page_background.fadeIn('fast');
                            $full_page.attr('data-image', '#');
                        }

                        background_image = true;
                    } else {
                        if ($sidebar_img_container.length != 0) {
                            $sidebar.removeAttr('data-image');
                            $sidebar_img_container.fadeOut('fast');
                        }

                        if ($full_page_background.length != 0) {
                            $full_page.removeAttr('data-image', '#');
                            $full_page_background.fadeOut('fast');
                        }

                        background_image = false;
                    }
                });

                $('.switch-sidebar-mini input').change(function() {
                    $body = $('body');

                    $input = $(this);

                    if (md.misc.sidebar_mini_active == true) {
                        $('body').removeClass('sidebar-mini');
                        md.misc.sidebar_mini_active = false;

                        $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar();

                    } else {

                        $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar('destroy');

                        setTimeout(function() {
                            $('body').addClass('sidebar-mini');

                            md.misc.sidebar_mini_active = true;
                        }, 300);
                    }

                    // we simulate the window Resize so the charts will get updated in realtime.
                    var simulateWindowResize = setInterval(function() {
                        window.dispatchEvent(new Event('resize'));
                    }, 180);

                    // we stop the simulation of Window Resize after the animations are completed
                    setTimeout(function() {
                        clearInterval(simulateWindowResize);
                    }, 1000);

                });
            });
        });
    </script>


    {{--<script>--}}
        {{--$(document).ready(function() {--}}
            {{--// Javascript method's body can be found in assets/js/demos.js--}}
            {{--md.initDashboardPageCharts();--}}

        {{--});--}}
    {{--</script>--}}

</body>

</html>