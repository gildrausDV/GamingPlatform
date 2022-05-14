<!-- Autor: Bogdan Jovanović -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rayman</title>
    <link rel="stylesheet" href="../bootstrap/bootstrap-5.1.3-dist/css/bootstrap.min.css">
    <script src="../bootstrap/bootstrap-5.1.3-dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="rayman.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="rayman.js"></script>
</head>
<body onload="init()">
    <div class="container-fluid bg-clouds">
        <div class="row no-padding">
            <div class="col-sm-12 no-padding">
                <nav class="navbar navbar-expand-sm bg-dark n">
                    <div class="levo">
                        <a href="#" class="navbar-brand logo_link">
                            <img src="../images/superMario.jpg" alt="logo" id="logo" class="rounded-pill">
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
                                <a href="#" class="nav-link" style="width: 65px;">
                                    Roles
                                </a>
                            </li>
                            <li>
                                <div class="dropdown">
                                    <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown">Top players lists</button>
                                    <ul class="dropdown-menu izbor">
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
                        <button type="button" class="btn btn- bg-danger" style="margin-right: 10px;">Sign out</button>
                    </div>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="offset-md-4 col-md-4 mt-4">
                <nav class="navbar navbar-expand-sm c bg-dark games">
                    <a href="#" class="navbar-brand">
                        <img src="../images/rayman.png" alt="logo" id="logo1" class="rounded-pill">
                    </a>
                    <a href="#" class="navbar-brand">
                        <img src="../images/sonic.jpg" alt="logo" id="logo2" class="rounded-pill">
                    </a>
                    <a href="#" class="navbar-brand">
                        <img src="../images/pikachu.png" alt="logo" id="logo3" class="rounded-pill">
                    </a>
                </nav>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-2 game-info">
                <div class="list">
                    <br>
                    <h1>TOP 10</h1>
                    <table class="lista_poena" id="lista_poena">
                    </table>
                </div>
            </div>
            <div class="col-sm-8">
                <!--<img src="../images/bg_start.png" alt="bg-start" id="bg-start">-->
                <canvas id="my-canvas"></canvas>
            </div>
            <div class="col-sm-2 game-info">
                <div class="points">
                    <br>
                    <h3>GAME STATISTICS</h3>
                    <br><br>
                    <div>
                        <span class="level">Level: </span>
                        <span class="level" id="level_display">1</span>
                    </div>
                    <br>
                    <div>
                        <span class="time">Time: </span>
                        <span class="time" id="time_display">00:00:00</span>
                    </div>
                    <br>
                    <div>
                        <span class="points">Points: </span>
                        <span class="points" id="point_display">0</span>
                    </div>
                    <br><br>
                    <div>
                        <span class="timeLeft" style="color: red">Time left: </span>
                        <span class="timeLeft" id="timeLeft_display" style="color: red">0</span>
                    </div>
                    <br><br>
                    <div>
                        <span class="maxLevel">Max level reached: </span>
                        <span class="maxLevel" id="maxLevel_display">0</span>
                    </div>
                    <br>
                    <div>
                        <span class="maxPoints">Max points achived: </span>
                        <span class="maxPoints" id="maxPoints_display">0</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12" style="min-height: 200px;">
                <br><br><br><br>
            </div>
        </div>
    </div>
</body>
</html>

<!--<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rayman</title>
    <link rel="stylesheet" href="rayman.css">
</head>
<body onload="init()">
    <div class="header">
        <img src="images/superMario.jpg" alt="" id="user">
        <div class="menu">
            <button id="tableButton" onclick="game1()"><img src="images/table.png" alt=""></button>
            <button id="tableButton" onclick="game2()"><img src="images/rayman_game.png" alt=""></button>
        </div>
        <div class="select">
            <select id="selector" name="dropdown" class="dropdown">
                <option value="0" class="black_opt" selected></option>
                <option value="1" class="black_opt">Account settings</option>
                <option value="2" class="black_opt">Roles</option>
                <option value="3" class="black_opt">History</option>
                <option value="4" class="black_opt">Top players (global)</option>
                <option value="5" class="black_opt">Top players</option>
                <option value="6" class="black_opt">Allow/block</option>
            </select>
        </div>
    </div>
    <div class="game">
        <div class="left">
            <div class="list">
                <br>
                <h1>TOP 10</h1>
                <table class="lista_poena" id="lista_poena">
                    <tr>
                        <th>Username</th>
                        <th>Points</th>
                    </tr>
                    <tr>
                        <td>Gildraus</td>
                        <td>50</td>
                    </tr>
                    <tr>
                        <td>JBog00</td>
                        <td>50</td>
                    </tr>
                    <tr>
                        <td>KockaAdmiralac</td>
                        <td>50</td>
                    </tr>
                    <tr>
                        <td>Simple</td>
                        <td>50</td>
                    </tr>
                    <tr>
                        <td>Vukasin</td>
                        <td>50</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="center" id="center">
            <canvas id="my-canvas"></canvas>
        </div>
        <div class="right">
            <div class="points">
                <br>
                <h3>GAME STATISTICS</h3>
                <br><br>
                <div>
                    <span class="level">Level: </span>
                    <span class="level" id="level_display">1</span>
                </div>
                <br>
                <div>
                    <span class="time">Time: </span>
                    <span class="time" id="time_display">00:00:00</span>
                </div>
                <br>
                <div>
                    <span class="points">Points: </span>
                    <span class="points" id="point_display">0</span>
                </div>
                <br><br>
                <div>
                    <span class="timeLeft" style="color: red">Time left: </span>
                    <span class="timeLeft" id="timeLeft_display" style="color: red">0</span>
                </div>
                <br><br>
                <div>
                    <span class="maxLevel">Max level reached: </span>
                    <span class="maxLevel" id="maxLevel_display">0</span>
                </div>
                <br>
                <div>
                    <span class="maxPoints">Max points achived: </span>
                    <span class="maxPoints" id="maxPoints_display">0</span>
                </div>
            </div>
        </div>
    </div>
    <div class="footer">
        <button onclick="addLevel()">Add level</button>
        <button onclick="tournament()">Tournaments</button>
        <button onclick="start()">Start</button>
        <button onclick="pause()">Pause</button>
        <button id="signOut" onclick="signOut_page()">Sign out</button>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="rayman.js"></script>
    <script>
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
            location.href = "rayman_addLevel.php";
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
        function game2() {
            location.href = "rayman.php";
        }
        function chooseGamePage() {
            location.href = "play.html";
        }
    </script>
</body>
</html>-->