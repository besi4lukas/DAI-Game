<!DOCTYPE html>
<html>
<head>
    <title>Game</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{asset('temp/assets/img/dead.png')}}">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <!-- CSS Files -->
    <link href="{{asset('temp/assets/css/material-dashboard.css?v=2.1.0')}}" rel="stylesheet" />
    {{--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">--}}

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <link rel="stylesheet" type="text/css" href="{{asset('temp/assets/css/game.css')}}">

    <!-- Pusher Api library -->
    <script src="https://js.pusher.com/4.3/pusher.min.js"></script>

    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    <script src="https://requirejs.org/docs/release/2.3.5/minified/require.js"></script>


</head>
<body class="dark-edition">


<?php
        function compare($_guess, $_number){

            $number = $_number ;
            $guess = $_guess ;
            $dead = 0 ;
            $injured = 0 ;
    
            for ( $i = 0 ; $i < strlen($number) ; $i++){
    
                if (strpos($guess,$number[$i]) !== false){
    
                    if (strcmp($number[$i],$guess[$i]) == 0){
    
                        $dead += 1 ;
                    }
                    else{
    
                        $injured += 1 ;
                    }
                }
            }
    
    
    
            return array(
                'dead'=>$dead,
                'injured'=>$injured
            ) ;
    
        }
?>
<?php

        $user_id = \Illuminate\Support\Facades\Auth::user()->id ;
        $user_model = \App\User::where('id',$user_id)->first();
        $user_profile = \Illuminate\Support\Facades\DB::select('select * from user__profiles where user_id = ?',[$user_id]) ;
        $player_one = \Illuminate\Support\Facades\DB::select('select player_one from games where id = ?',[$game_id]) ;
        $player_two = \Illuminate\Support\Facades\DB::select('select player_two from games where id = ?',[$game_id]) ;
        $other_player = null; // the id of the opponent
        $other_number = null; // the game number of the opponent
        $other_profile = null; // the profile of the opponent
        $status = null;

        if ($user_id == $player_one[0]->player_one){
            $game_no = \Illuminate\Support\Facades\DB::select('select game_no_one as number from games where player_one = ? and id = ?',[$user_id,$game_id]) ;
            $other_player = $player_two[0]->player_two;
            $other_n = \Illuminate\Support\Facades\DB::select('select game_no_two from games where id = ?',[$game_id]);
            $other_number = $other_n[0]->game_no_two ;
            $status = 1;
        }else{
            $game_no = \Illuminate\Support\Facades\DB::select('select game_no_two as number from games where player_two = ? and id = ?',[$user_id,$game_id]) ;
            $other_player = $player_one[0]->player_one;
            $other_n = \Illuminate\Support\Facades\DB::select('select game_no_one from games where id = ?',[$game_id]) ;
            $other_number = $other_n[0]->game_no_one ;
            $status = 2;
        }

        //guesses_you is the result from the database containing all the guesses made by you
        $guesses_you = \Illuminate\Support\Facades\DB::select('select * from guesses where game_id = ? and player_id = ? order by created_at',[$game_id, $user_id]) ;
        //guesses_other is the result from the database containing all the guesses made by the opponent
        $guesses_other = \Illuminate\Support\Facades\DB::select('select * from guesses where game_id = ? and player_id = ? order by created_at',[$game_id, $other_player]) ;

        $other_profile = \Illuminate\Support\Facades\DB::select('select * from user__profiles where user_id = ?',[$other_player]) ;

        $guesses_array = array();
        $other_array = array();
        $i = 0;


        foreach($guesses_you as $guess){
            $dead = compare($guess->guess,$other_number)['dead'];
            $injured = compare($guess->guess,$other_number)['injured'];
            $toAdd = array($guess->guess,$dead,$injured);
            array_push($guesses_array, $toAdd);
            $i = $i+1;
        }

        foreach($guesses_other as $guess){
            $dead = compare($guess->guess, $game_no[0]->number)['dead'];
            $injured = compare($guess->guess, $game_no[0]->number)['injured'];
            $toAdd = array($guess->guess,$dead,$injured);
            array_push($other_array, $toAdd);
            $i = $i+1;
        }
//        echo $i;

?>
<?php
        function toTable($array){
            $toReturn = "";
            foreach($array as $line){
                $toReturn = $toReturn."<tr>";
                foreach($line as $element){
                    $toReturn = $toReturn."<td>".$element."</td>";
                }
                $toReturn = $toReturn."</tr>";
            }
            return $toReturn;
        }
?>
<?php
    $tolo = \Illuminate\Support\Facades\DB::select('select player_turn from games where id = ?',[$game_id]) ; /// what is the current turn (1 or 2)
    $turn = $tolo[0]->player_turn;
    $ongn = \Illuminate\Support\Facades\DB::select('select status from games where id = ?',[$game_id]) ;
    $ongm = $ongn[0]->status ;
    $win = false;

    if (strcmp($ongm, 'ended') == 0) {
        $ongoing =  false;
//        $loa = \Illuminate\Support\Facades\DB::select('select winner_id from results where game_id = ?',[$game_id]) ;
        $loa = \App\Result::where('game_id',$game_id)->first();
        $lon = $loa->winner_id;
        if ($lon == $user_id){
            $win = true; /// whether you won or not
        }
    } else {
        $ongoing =  true;
    } /// whether the game is still ongoing or has ended

   // dd($turn);
    if ($ongoing) {
        if ($turn == $status){
            $button_status = "active";
        } else {
            $button_status = "inactive_waiting";
        }
    } else {
        if ($win) {
            $button_status = "inactive_winner";
        } else {
            $button_status = "inactive_loser";
        }
    }
    //dd($button_status);
?>
<?php
    function return_button($b_status){
        $toReturn = '';
        if (strcmp($b_status, 'active') == 0 ){
            $toReturn = "<button ONCLICK='posting()' id='coin' class='btn btn-primary'>Guess</button>";
        } elseif (strcmp($b_status, "inactive_waiting") == 0 ){
            $toReturn = "<div ><center><h2>Waiting for the other player</h2></center></div>";
        } elseif (strcmp($b_status, "inactive_winner") == 0 ) {
            $toReturn = "<div ><center><h2>You Won</h2></center></div>";
        } elseif (strcmp($b_status, "inactive_loser") == 0 ) {
            $toReturn = "<div ><center><h2>You suck fucking Loser</h2></center></div>";
        }

        return $toReturn;
    }

    function exit_button($game_stat,$game_id){
        $exitButton = '' ;
        if (strcmp($game_stat, 'active') == 0 ){
            $exitButton = "<a href='exit/$game_id' class='btn btn-warning offset-2'> Give up Game</a>" ;
        }
        return $exitButton ;

    }
?>

<div class="container-fluid">
<div class="row">

    <div class="col-sm-4"
         style=" background-color: #3a4563;"
          id="col1">

        <h3 style="font-family: courier; color: white;"><center>YOU</center></h3>


        <table style="overflow: auto; padding-top: 2%;" class="table table-striped">
            <tr>
                <th><center>Number</center></th>
                <th><center>Dead</center></th>
                <th><center>Injured</center></th>

            </tr>
            <?php
                echo toTable($guesses_array);
            ?>
        </table>
    </div>




    <div class="col-sm-4"
         {{--style="background-color:white; padding-top: 3%" --}}
         id="col2" >


        <a href="{{ url('/home') }}" class="btn btn-primary offset-1"> Go to Dashboard</a>

        <?php
            echo exit_button($ongm,$game_id) ;
        ?>

        <div>
            <br>
        </div>


        <h1 style="font-family: courier; padding-bottom: 7%"><center>{{$game_no[0]->number}}</center></h1>
        <p><center><img src="https://www.gravatar.com/avatar/{{md5($user_model->email)}}?d=robohash" class="rounded-circle" style=" padding-bottom: 10%"></center></p>
        <p><h2 style="font-family: courier"><center>{{$user_profile[0]->username}}</center></h2></p>


        <p style="margin-top: 13%;" id="ins";>
            <input id="idnumber" type="hidden" value="{{$user_id}}" >
            <input id="game_id" type="hidden" value="{{$game_id}}" >
            <input id="number1" type="text" style="width: 32%;" onkeypress="return isNumberKey(event)" autofocus maxlength="1"/>
            <input id="number2" type="text" style="width: 34%;" onkeypress="return isNumberKey(event)"autofocus maxlength="1"/>
            <input id="number3" type="text" style="width: 32%;" onkeypress="return isNumberKey(event)"autofocus maxlength="1" />
        </p>

        {{--<button ONCLICK="posting()" id="coin" class="btn btn-primary">send</button>--}}
        <?php
            echo return_button($button_status);
        ?>


    </div>



    <div class="col-sm-4"
         style=" background-color: #3a4563; "
         id="col3" >

        <h3 style="font-family: courier; color: white;"><center>{{$other_profile[0]->username}}</center></h3>

        <table style="overflow: auto; padding-top: 2%;" class="table table-striped">
            <tr>
                <th><center>guess</center></th>
                <th><center>dead</center></th>
                <th><center>injured</center></th>
            </tr>
            <?php
                echo toTable($other_array);
            ?>
        </table>

    </div>

</div>
</div>


<script>

    var pusher = new Pusher('afb6c7a8250bde3101f3', {
        cluster: 'eu',
        forceTLS: true
    });

    var playerTurnChannel = pusher.subscribe('new-turn-channel') ;
    playerTurnChannel.bind('App\\Events\\playerTurn', function (data) {
        if (data.destinationUserId = '{{$user_id}}'){
            location.reload() ;
        }
    })

</script>

{{--<script src="{{asset('temp/assets/js/core/jquery.min.js')}}"></script>--}}
{{--<script src="{{asset('temp/assets/js/core/popper.min.js')}}"></script>--}}
{{--<script src="{{asset('temp/assets/js/core/bootstrap-material-design.min.js')}}"></script>--}}
{{--<script src="https://unpkg.com/default-passive-events"></script>--}}
{{--<script src="{{asset('temp/assets/js/plugins/perfect-scrollbar.jquery.min.js')}}"></script>--}}
{{--<script src="{{asset('js/main.js')}}"> </script>--}}

{{--<!-- Chartist JS -->--}}
{{--<script src="{{asset('temp/assets/js/plugins/chartist.min.js')}}"></script>--}}

{{--<!--  Notifications Plugin    -->--}}
{{--<script src="{{asset('temp/assets/js/plugins/bootstrap-notify.js')}}"></script>--}}

{{--<!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->--}}
{{--<script src="{{asset('temp/assets/js/material-dashboard.js?v=2.1.0')}}"></script>--}}

<script type="text/javascript" src="{{asset('temp/assets/js/dead.js')}}"></script>
{{--<script src="{{asset('./node_modules/axios/dist/axios.js')}}"></script>--}}
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript">

    function isNumberKey(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode;
        if (charCode != 46 && charCode > 31
            && (charCode < 48 || charCode > 57))
            return false;

        return true;
    }






    console.clear();

    var MAX_LIFE = 50;
    var canvas = document.querySelector('canvas');
    var input = document.querySelector('input');
    var field = {}
    var hasFocus = false;
    var caret = document.createElement('span');
    caret.style.position = 'absolute';
    caret.style.left = 0;
    caret.style.top = 0;
    caret.style.margin = 0;
    caret.style.width = 'auto';
    caret.style.visibility = 'hidden';
    document.body.appendChild(caret);

    function reposition() {
        field = input.getBoundingClientRect();
    }
    window.onload = reposition;
    window.onresize = reposition;
    reposition();

    input.onfocus = function() {hasFocus = true}
    input.onblur = function() {hasFocus = false}

    var keys = [8,9,13,16,17,18,27,32,33,34,35,36,37,38,39,40,46,91,93,112,113,114,115,116,117,118,119,120,121,122,123];
    function spawnsCharacter(keyCode) {
        return keys.indexOf(keyCode) === -1;
    }

    function burst(intensity) {

        var behavior = [
            this.behavior.force(-.015,-.015),
            this.behavior.cohesion(50),
            this.behavior.move()
        ];

        var size = 1.25;
        var force = .7;
        var lifeMin = 0;
        var progress = Math.min(field.width, caret.offsetWidth) / field.width;
        var offset = field.left + (field.width * progress);
        var rangeMin = Math.max(field.left, offset - 30);
        var rangeMax = Math.min(field.right, offset + 10);

        this.spray(intensity,function(){ return [
            null,null,
            Vector.create(
                Random.between(rangeMin + 10, rangeMax - 20),
                Random.between(field.top + 15, field.bottom - 15)
            ),
            Vector.random(force),
            size + Math.random(),
            Random.between(lifeMin,0),behavior
        ]});

        // top edge
        this.spray(intensity * .5,function(){ return [
            null,null,
            Vector.create(
                Random.between(rangeMin, rangeMax),
                field.top
            ),
            Vector.random(force),
            size + Math.random(),
            Random.between(lifeMin,0),behavior
        ]});

        // bottom edge
        this.spray(intensity * .5,function(){ return [
            null,null,
            Vector.create(
                Random.between(rangeMin, rangeMax),
                field.top + field.height
            ),
            Vector.random(force),
            size + Math.random(),
            Random.between(lifeMin,0)
            ,behavior
        ]});

        // left edge
        if (input.value.length === 1) {

            this.spray(intensity * 2,function(){ return [
                null,null,
                Vector.create(
                    field.left + (Math.random() * 20),
                    Random.between(field.top,field.bottom)
                ),
                Vector.random(force),
                size + Math.random(),
                Random.between(lifeMin,0),behavior
            ]});
        }

        // right edge
        if (rangeMax == field.right) {

            this.spray(intensity * 2,function(){ return [
                null,null,
                Vector.create(
                    field.right,
                    Random.between(field.top,field.bottom)
                ),
                Vector.random(force),
                size + Math.random(),
                Random.between(lifeMin,0),behavior
            ]});

        }

    }



    // start particle simulation
    simulate(
        '2d', {
            init: function() {

            },
            tick: function(particles) {

                if (!particles){ return; }

                particles.forEach(function(p){

                    if (p.life > MAX_LIFE) {
                        this.destroy(p);
                    }

                });

            },
            beforePaint: function() {
                this.clear();
            },
            paint: function(particle) {

                var p = particle.position;
                var s = particle.size;
                var o = 1 - (particle.life / MAX_LIFE);

                this.paint.circle(p.x, p.y, s, 'rgba(255,255,255,' + o +')');
                this.paint.circle(p.x, p.y, s + 1.5, 'rgba(231,244,255,' + (o * .25) + ')');

                // extra
                var w = 2;
                var wh = w * .5;
                var h = 35;
                var hh = h * .5;
                this.context.rect(p.x -wh, p.y - hh, w, h);
                this.context.fillStyle = 'rgba(231,244,255,' + (o * .025) + ')';
                this.context.fill();
                this.context.closePath();

            },
            afterPaint: function() {
                // nothing
            },
            action: function(e) {

                if (!spawnsCharacter(e.keyCode)) {
                    return;
                }

                caret.textContent = input.value;

                burst.call(this,12);

                input.classList.add('keyup');
                setTimeout(function(){input.classList.remove('keyup')},100);

            }
        }
    );




    // "simulate" particle simulation logic
    /**
     * Constants
     */
    PI_2 = Math.PI / 2;
    PI_180 = Math.PI / 180;

    /**
     * Random
     */
    var Random = {
        between: function(min, max) {
            return min + (Math.random() * (max - min));
        }
    }

    /**
     * 2D Vector Class
     */
    function Vector(x, y) {
        this._x = x || 0;
        this._y = y || 0;
    }

    Vector.create = function(x, y) {
        return new Vector(x, y);
    };

    Vector.add = function(a, b) {
        return new Vector(a.x + b.x, a.y + b.y);
    };

    Vector.subtract = function(a, b) {
        return new Vector(a.x - b.x, a.y - b.y);
    };

    Vector.random = function(range) {
        var v = new Vector();
        v.randomize(range);
        return v;
    };

    Vector.distanceSquared = function(a, b) {
        var dx = a.x - b.x;
        var dy = a.y - b.y;
        return dx * dx + dy * dy;
    };

    Vector.distance = function(a, b) {
        var dx = a.x - b.x;
        var dy = a.y - b.y;
        return Math.sqrt(dx * dx + dy * dy);
    };

    Vector.prototype = {
        get x() {
            return this._x;
        },
        get y() {
            return this._y;
        },
        set x(value) {
            this._x = value;
        },
        set y(value) {
            this._y = value;
        },
        get magnitudeSquared() {
            return this._x * this._x + this._y * this._y;
        },
        get magnitude() {
            return Math.sqrt(this.magnitudeSquared);
        },
        get angle() {
            return Math.atan2(this._y, this._x) * 180 / Math.PI;
        },
        clone: function() {
            return new Vector(this._x, this._y);
        },
        add: function(v) {
            this._x += v.x;
            this._y += v.y;
        },
        subtract: function(v) {
            this._x -= v.x;
            this._y -= v.y;
        },
        multiply: function(value) {
            this._x *= value;
            this._y *= value;
        },
        divide: function(value) {
            this._x /= value;
            this._y /= value;
        },
        normalize: function() {
            var magnitude = this.magnitude;
            if (magnitude > 0) {
                this.divide(magnitude);
            }
        },
        limit: function(treshold) {
            if (this.magnitude > treshold) {
                this.normalize();
                this.multiply(treshold);
            }
        },
        randomize: function(amount) {
            amount = amount || 1;
            this._x = amount * 2 * (-.5 + Math.random());
            this._y = amount * 2 * (-.5 + Math.random());
        },
        rotate: function(degrees) {
            var magnitude = this.magnitude;
            var angle = ((Math.atan2(this._x, this._y) * PI_HALF) + degrees) * PI_180;
            this._x = magnitude * Math.cos(angle);
            this._y = magnitude * Math.sin(angle);
        },
        flip: function() {
            var temp = this._y;
            this._y = this._x;
            this._x = temp;
        },
        invert: function() {
            this._x = -this._x;
            this._y = -this._y;
        },
        toString: function() {
            return this._x + ', ' + this._y;
        }
    }

    /**
     * Particle Class
     */
    function Particle(id, group, position, velocity, size, life, behavior) {

        this._id = id || 'default';
        this._group = group || 'default';

        this._position = position || new Vector();
        this._velocity = velocity || new Vector();
        this._size = size || 1;
        this._life = Math.round(life || 0);

        this._behavior = behavior || [];

    }

    Particle.prototype = {
        get id() {
            return this._id;
        },
        get group() {
            return this._group;
        },
        get life() {
            return this._life;
        },
        get size() {
            return this._size;
        },
        set size(size) {
            this._size = size;
        },
        get position() {
            return this._position;
        },
        get velocity() {
            return this._velocity;
        },
        update: function(stage) {

            this._life++;

            var i = 0;
            var l = this._behavior.length;

            for (; i < l; i++) {
                this._behavior[i].call(stage, this);
            }

        },
        toString: function() {
            return 'Particle(' + this._id + ') ' + this._life + ' pos: ' + this._position + ' vec: ' + this._velocity;
        }
    }

    // setup DOM
    function simulate(dimensions, options) {

        // private vars
        var particles = [];
        var destroyed = [];
        var update = update || function() {};
        var stage = stage || function() {};
        var canvas;
        var context;

        if (!options) {
            console.error('"options" object must be defined');
            return;
        }

        if (!options.init) {
            console.error('"init" function must be defined');
            return;
        }

        if (!options.paint) {
            console.error('"paint" function must be defined');
            return;
        }

        if (!options.tick) {
            options.tick = function() {};
        }

        if (!options.beforePaint) {
            options.beforePaint = function() {};
        }

        if (!options.afterPaint) {
            options.afterPaint = function() {};
        }

        if (!options.action) {
            options.action = function() {};
        }

        if (document.readyState === 'interactive') {
            setup();
        } else {
            document.addEventListener('DOMContentLoaded', setup);
        }

        // resizes canvas to fit window dimensions
        function fitCanvas() {
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;
        }

        // create canvas for drawing
        function setup() {

            // create
            canvas = document.createElement('canvas');
            document.body.appendChild(canvas);

            // correct canvas size on window resize
            window.addEventListener('resize', fitCanvas);

            // go
            go();
        }

        // canvas has been attached, let's go!
        function go() {

            // set initial canvas size
            fitCanvas();

            // get context for drawing
            context = canvas.getContext(dimensions);

            // simulation update loop
            function act() {

                // update particle states
                var i = 0;
                var l = particles.length;
                var p;
                for (; i < l; i++) {
                    particles[i].update(this);
                }

                // clean destroyed particles
                while (p = destroyed.pop()) {

                    do {

                        // has not been found in destroyed array?
                        if (p !== particles[i]) {
                            continue;
                        }

                        // remove particle
                        particles.splice(i, 1);

                    } while (i-- >= 0)
                }

                // repaint context
                options.beforePaint.call(this);

                // repaint particles
                i = 0;
                l = particles.length;
                for (; i < l; i++) {
                    options.paint.call(this, particles[i]);
                }

                // after particles have been painted
                options.afterPaint.call(this);
            }

            function tick() {

                // call update method, this allows for inserting particles later on
                options.tick.call(this, particles);

                // update particles here
                act();

                // on to the next frame
                window.requestAnimationFrame(tick);

            }

            /**
             * API
             **/
            function clear() {
                context.clearRect(0, 0, canvas.width, canvas.height);
            }

            function destroy(particle) {
                destroyed.push(particle);
            }

            function add(id, group, position, velocity, size, life, behavior) {
                particles.push(new Particle(id, group, position, velocity, size, life, behavior));
            }

            function spray(amount, config) {
                var i = 0;
                for (; i < amount; i++) {
                    add.apply(this, config());
                }
            }

            function debug(particle) {
                this.paint.circle(
                    particle.position.x,
                    particle.position.y,
                    particle.size,
                    'rgba(255,0,0,.75)'
                );
                context.beginPath();
                context.moveTo(particle.position.x, particle.position.y);
                context.lineTo(particle.position.x + (particle.velocity.x * 10), particle.position.y + (particle.velocity.y * 10));
                context.strokeStyle = 'rgba(255,0,0,.1)';
                context.stroke();
                context.closePath();
            };

            this.clear = clear;
            this.destroy = destroy;
            this.add = add;
            this.spray = spray;
            this.debug = debug;

            this.paint = {
                circle: function(x, y, size, color) {
                    context.beginPath();
                    context.arc(x, y, size, 0, 2 * Math.PI, false);
                    context.fillStyle = color;
                    context.fill();
                },
                square: function(x, y, size, color) {
                    context.beginPath();
                    context.rect(x - (size * .5), y - (size * .5), size, size);
                    context.fillStyle = color;
                    context.fill();
                }
            }

            this.behavior = {
                cohesion: function(range, speed) {
                    range = Math.pow(range || 100, 2);
                    speed = speed || .001;
                    return function(particle) {

                        var center = new Vector();
                        var i = 0;
                        var l = particles.length;
                        var count = 0;

                        if (l <= 1) {
                            return;
                        }

                        for (; i < l; i++) {

                            // don't use self in group
                            if (particles[i] === particle || Vector.distanceSquared(particles[i].position, particle.position) > range) {
                                continue;
                            }

                            center.add(Vector.subtract(particles[i].position, particle.position));
                            count++;
                        }

                        if (count > 0) {

                            center.divide(count);

                            center.normalize();
                            center.multiply(particle.velocity.magnitude);

                            center.multiply(.05);
                        }

                        particle.velocity.add(center);

                    }
                },
                separation: function(distance) {

                    var distance = Math.pow(distance || 25, 2);

                    return function(particle) {

                        var heading = new Vector();
                        var i = 0;
                        var l = particles.length;
                        var count = 0;
                        var diff;

                        if (l <= 1) {
                            return;
                        }

                        for (; i < l; i++) {

                            // don't use self in group
                            if (particles[i] === particle || Vector.distanceSquared(particles[i].position, particle.position) > distance) {
                                continue;
                            }

                            // stay away from neighbours
                            diff = Vector.subtract(particle.position, particles[i].position);
                            diff.normalize();

                            heading.add(diff);
                            count++;
                        }

                        if (count > 0) {

                            // get average
                            heading.divide(count);

                            // make same length as current velocity (so particle won't speed up)
                            heading.normalize();
                            heading.multiply(particle.velocity.magnitude);

                            // limit force to make particle movement smoother
                            heading.limit(.1);
                        }

                        particle.velocity.add(heading);

                    }
                },
                alignment: function(range) {
                    range = Math.pow(range || 100, 2);
                    return function(particle) {

                        var i = 0;
                        var l = particles.length;
                        var count = 0;
                        var heading = new Vector();

                        if (l <= 1) {
                            return;
                        }

                        for (; i < l; i++) {

                            // don't use self in group also don't align when out of range
                            if (particles[i] === particle || Vector.distanceSquared(particles[i].position, particle.position) > range) {
                                continue;
                            }

                            heading.add(particles[i].velocity);
                            count++;
                        }

                        if (count > 0) {

                            heading.divide(count);
                            heading.normalize();
                            heading.multiply(particle.velocity.magnitude);

                            // limit
                            heading.multiply(.1);

                        }

                        particle.velocity.add(heading);

                    }
                },
                move: function() {
                    return function(particle) {
                        particle.position.add(particle.velocity);

                        // handle collisions?

                    }
                },
                eat: function(food) {
                    food = food || [];
                    return function(particle) {

                        var i = 0;
                        var l = particles.length;
                        var prey;

                        for (; i < l; i++) {

                            prey = particles[i];

                            // can't eat itself, also, needs to be tasty
                            if (prey === particle || food.indexOf(prey.group) === -1) {
                                continue;
                            }

                            // calculate force vector
                            if (Vector.distanceSquared(particle.position, neighbour.position) < 2 && particle.size >= neighbour.size) {
                                particle.size += neighbour.size;
                                destroy(neighbour);
                            }

                        }
                    }
                },
                force: function(x, y) {
                    return function(particle) {
                        particle.velocity.x += x;
                        particle.velocity.y += y;
                    }
                },
                limit: function(treshold) {
                    return function(particle) {
                        particle.velocity.limit(treshold);
                    }
                },
                attract: function(forceMultiplier, groups) {
                    forceMultiplier = forceMultiplier || 1;
                    groups = groups || [];
                    return function(particle) {

                        // attract other particles
                        var totalForce = new Vector(0, 0);
                        var force = new Vector(0, 0);
                        var i = 0;
                        var l = particles.length;
                        var distance;
                        var pull;
                        var attractor;
                        var grouping = groups.length;

                        for (; i < l; i++) {

                            attractor = particles[i];

                            // can't be attracted by itself or mismatched groups
                            if (attractor === particle || (grouping && groups.indexOf(attractor.group) === -1)) {
                                continue;
                            }

                            // calculate force vector
                            force.x = attractor.position.x - particle.position.x;
                            force.y = attractor.position.y - particle.position.y;
                            distance = force.magnitude;
                            force.normalize();

                            // the bigger the attractor the more force
                            force.multiply(attractor.size / distance);

                            totalForce.add(force);
                        }

                        totalForce.multiply(forceMultiplier);

                        particle.velocity.add(totalForce);
                    }
                },
                wrap: function(margin) {
                    return function(particle) {

                        // move around when particle reaches edge of screen
                        var position = particle.position;
                        var radius = particle.size * .5;

                        if (position.x + radius > canvas.width + margin) {
                            position.x = radius;
                        }

                        if (position.y + radius > canvas.height + margin) {
                            position.y = radius;
                        }

                        if (position.x - radius < -margin) {
                            position.x = canvas.width - radius;
                        }

                        if (position.y - radius < -margin) {
                            position.y = canvas.height - radius;
                        }

                    }
                },
                reflect: function() {

                    return function(particle) {

                        // bounce from edges
                        var position = particle.position;
                        var velocity = particle.velocity;
                        var radius = particle.size * .5;

                        if (position.x + radius > canvas.width) {
                            velocity.x = -velocity.x;
                        }

                        if (position.y + radius > canvas.height) {
                            velocity.y = -velocity.y;
                        }

                        if (position.x - radius < 0) {
                            velocity.x = -velocity.x;
                        }

                        if (position.y - radius < 0) {
                            velocity.y = -velocity.y;
                        }
                    }

                },
                edge: function(action) {
                    return function(particle) {

                        var position = particle.position;
                        var velocity = particle.velocity;
                        var radius = particle.size * .5;

                        if (position.x + radius > canvas.width) {
                            action(particle);
                        }

                        if (position.y + radius > canvas.height) {
                            action(particle);
                        }

                        if (position.x - radius < 0) {
                            action(particle);
                        }

                        if (position.y - radius < 0) {
                            action(particle);
                        }
                    }
                }
            }

            // public
            Object.defineProperties(this, {
                'particles': {
                    get: function() {
                        return particles;
                    }
                },
                'width': {
                    get: function() {
                        return canvas.width;
                    }
                },
                'height': {
                    get: function() {
                        return canvas.height;
                    }
                },
                'context': {
                    get: function() {
                        return context;
                    }
                }
            });

            // call init method so the scene can be setup
            options.init.call(this)

            // start ticking
            tick();

            // start listening to events
            var self = this;
            document.addEventListener('keyup', function(e) {
                options.action.call(self, e);
            });

        }

    };
</script>

</body>
</html>