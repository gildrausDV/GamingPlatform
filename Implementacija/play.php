<!-- Autor: Bogdan Jovanović -->
<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <!--<link rel="stylesheet" href="playStyle.css">-->
    <link rel="stylesheet" href="bootstrap/bootstrap-5.1.3-dist/css/bootstrap.min.css">
    <script src="bootstrap/bootstrap-5.1.3-dist/js/bootstrap.min.js"></script>
    <style>
        #logo, #logo1, #logo2, #logo3 {
            width: 50px;
            height: 50px;
            border: 5px solid black;
        }
        #logo1, #logo2, #logo3 {
            max-width: 60px;
            max-height: 60px;
            border: 5px solid black;
            /*margin-left: 15px;*/
        }
        #logo:hover, #logo1:hover, #logo2:hover, #logo3:hover {
            border: 0px;
        }
        .logo_link {
            margin-left: 15px;
        }
        .nav-link {
            color: white;
        }
        .n {
            display: flex;
            justify-content: space-between;
        }
        .levo {
            display: flex;
            float: left;
            align-items: center;
        }
        .desno {
            display: flex;
            float: right;
            align-items: center;
        }
        .bg-clouds {
            background-image: url('images/cloud.png');
            /*height: 1000px;*/
            /*width: 100%;
            margin: 0px;
            padding: 0 !important;*/
        }
        .game-info {
            text-align: center;
            color: white;
            background-color: black;
            opacity: 0.8;
            border: 5px solid lightgray;
            min-height: 500px;
        }
        .game-info:hover {
            border: 5px solid gray;
        }
        .no-padding {
            padding: 0 !important;
        }
        .games {
            text-align: center;
            justify-content: center;
            /*background-color: lightgray;*/
            /*opacity: 0.8;*/
            border: 5px solid lightgray;
            height: 80px;
            margin-bottom: 10px;
            /*min-width: 150px;*/
        }
        #bg-start {
            margin-left: 5%;
            width: 90%;
            /*height: 500px;*/
            border: 5px solid lightgray;
        }
    </style>
</head>
<body onload="init()">
<div class="container-fluid bg-clouds">
        <div class="row no-padding">
            <div class="col-sm-12 no-padding">
                <nav class="navbar navbar-expand-sm bg-dark n">
                    <div class="levo">
                        <a href="#" class="navbar-brand logo_link">
                            <img src="images/superMario.jpg" alt="logo" id="logo" class="rounded-pill">
                        </a>
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    Tournaments
                                </a>
                            </li>
                            <li class="nav-item" style="width: 85px;">
                                <a href="#" class="nav-link">
                                    Add level
                                </a>
                            </li>
                            <li class="nav-item" style="width: 135px;">
                                <a href="#" class="nav-link">
                                    Account settings
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    Allow/block
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    History
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link" style="width: 75px;">
                                    Roles
                                </a>
                            </li>
                            <li>
                                <div class="dropdown">
                                    <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">Top players lists</button>
                                    <ul class="dropdown-menu">
                                        <li class="dropdown-item">
                                            <a href="#">Top players (global)</a>
                                        </li>
                                        <li class="dropdown-item">
                                            <a href="#">Top players for game</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                    
                    <div class="desno">
                        <!--<a href="#" class="nav-link" id="signOut">
                            Sign out
                        </a>-->
                        <button type="button" class="btn btn- bg-danger" style="margin-right: 10px;">Sign out</button>
                    </div>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="offset-md-4 col-md-4 mt-4">
                <nav class="navbar navbar-expand-sm c bg-dark games">
                    <a href="#" class="navbar-brand">
                        <img src="images/rayman.png" alt="logo" id="logo1" class="rounded-pill">
                    </a>
                    <a href="#" class="navbar-brand">
                        <img src="images/sonic.jpg" alt="logo" id="logo2" class="rounded-pill">
                    </a>
                    <a href="#" class="navbar-brand">
                        <img src="images/pikachu.png" alt="logo" id="logo3" class="rounded-pill">
                    </a>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-2 game-info">
                
            </div>
            <div class="col-sm-8">
                <img src="images/welcome.png" alt="bg-start" id="bg-start">
            </div>
            <div class="col-sm-2 game-info">
                
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <br><br><br><br>
            </div>
        </div>
    </div>
    <script>
        let startTime;
        let elapsedTime = 0;

        let hh = 0;
        let mm = 0;
        let ss = 0;

        let started = false;
        let paused = false;
        let ended = true;

        let loaded = false;

        let ball_x = 780; // random horizontal position
        let ball_y = 300; // random horizontal position

        var activities = document.getElementById("selector");
        var last;

        activities.addEventListener("change", function() {
            if(activities.value == "1") {
                acc();
            } else if(activities.value == "2") {
                r();
            } else if(activities.value == "3") {
                h();
            } else if(activities.value == "4") {
                top_playersG();
            } else if(activities.value == "5") {
                top_players();
            } else if(activities.value == "6") {
                allow_block();
            }
        });

        function allow_block() {
            location.href = "allow.html"
        }
        function top_playersG() {
            location.href = "topPlayersG.html";
        }
        function top_players() {
            location.href = "gamingHistory.html";
        }
        function acc() {
            location.href = "accountSettings.html";
        }
        function h() {
            location.href = "history.html";
        }
        function r() {
            location.href = "roles.html";
        }
        function back() {
            location.href = "play.html"
        }
        function tournament() {
            location.href = "tournament.html";
        }
        function addLevel() {
            location.href = "addLevel.html";
        }
        function signIn() {
            location.href = "play.html";
        }
        function signOut_page() {
            location.href = "sign.html";
        }
        function game1() {
            location.href = "game1.html";
        }
        function chooseGamePage() {
            location.href = "play.html";
        }
        function addLevel() {
            location.href = "addLevel.html";
        }
        function print_time(txt) {
            document.getElementById("time_display").innerHTML = txt;
        }

        timerInterval = setInterval(function printTime() {
            if(started == false || paused == true) return;
            ss++;
            if(ss == 60) {
                mm++;
                ss = 0;
            }
            if(mm == 60) {
                hh++;
                mm = 0;
            }
            let h = "" + hh;
            let m = "" + mm;
            let s = "" + ss;
            if(h.length == 1) h = "0" + hh;
            if(m.length == 1) m = "0" + mm;
            if(s.length == 1) s = "0" + ss;
            
            print_time(h + ":" + m + ":" + s);
        }, 1000);

        function pause() {
            if(paused == false) paused = true;
            else paused = false;
        }

        function start() {
            ss = 0; mm = 0; hh = 0; print_time("00:00:00");
            if(loaded == false) {
                loaded = true;
                //document.getElementById("center").innerHTML = "<canvas id=\"my-canvas\"></canvas>"
            }
            if(ended == true) {
                for(let i = 0; i < numOfBricks; ++i) bricks[i].destroyed = false;
                table.x = 700;
                table.y = 650;
                ball.x = ball_x;
                ball.y = ball_y;
            }
            started = true;
            ended = false;
        }

        //canvas properties
        var canvas = document.getElementById("my-canvas");
        var context = canvas.getContext("2d");

        //animation things
        var fps = 60;
        var updateTime = 1000 / fps;

        //easy variables for easy coding life
        var _PI = Math.PI;
        var _sin = Math.sin;
        var _cos = Math.cos;
        var _random = Math.random;
        var oneDegreeOnRadian = _PI / 180;

        // ball
        var ball;
        var table;
        let bricks = [];
        let numOfBricks = 0;

        function Brick(length) {
            if(bricks.length == 0) this.x = 2;
            else this.x = bricks[bricks.length - 1].x + length + 2;
            this.y = 0;
            this.length = length;
            this.destroyed = false;

            this.draw = function() {
                if(this.destroyed) return;
                context.fillStyle = "tomato"; // ball color
                context.beginPath();
                context.rect(this.x, this.y, length, 50);
                context.closePath();
                context.fill();
            }
        }


        function Table(length) {

            this.x = 700;
            this.y = 650;
            this.length = length;

            this.diffX = 30;

            this.draw = function() {
                context.fillStyle = "tomato"; // ball color
                context.beginPath();
                context.rect(this.x, this.y, length, 50);
                context.closePath();
                context.fill();
            }
        }

        //Our bouncing ball class
        function Ball(radius, speed) {
            this.radius = (radius) ? (radius) : (20); // ball size
            this.x = ball_x;
            this.y = ball_y;

            this.draw = function() {
                context.fillStyle = "tomato"; // ball color
                context.beginPath();
                context.arc(this.x, this.y, this.radius, 0, _PI * 2, false); // draw circle
                context.closePath();
                context.fill(); // draw ball on canvas
            }
        }

        function clear() {
            context.clearRect(0, 0, canvas.width, canvas.height); // clear canvas
        }

        function update() {
            ball.move(); // move ball
        }

        function draw() {
            ball.draw();
            table.draw();
            for(let i = 0; i < numOfBricks; ++i) bricks[i].draw();
        }

        function animate() {
            clear();
            //update();
            draw();
        }

        // update canvas size when resizing window 
        function resizeCanvas() {
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;
        }

        //initialize canvas
        function init() {
            window.addEventListener('resize', resizeCanvas, false);
            resizeCanvas();
            ball = new Ball(50, 10);
            table = new Table(200);
            numOfBricks = 6;
            for(let i = 0; i < numOfBricks; ++i)
                bricks.push(new Brick(253));
            //run animation
            //setInterval(function() {
                animate();
            //}, updateTime);
        }
    </script>
</body>
</html>