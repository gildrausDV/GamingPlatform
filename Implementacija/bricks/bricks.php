<!-- Autor: Bogdan Jovanović -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bricks</title>
    <link rel="stylesheet" href="bricks.css">
</head>
<body onload="init()">
    <div class="header">
        <img src="../images/superMario.jpg" alt="" id="user">
        <div class="menu">
            <button id="tableButton" onclick="game1()"><img src="../images/table.png" alt=""></button>
            <button id="tableButton" onclick="game2()"><img src="../images/rayman_game.png" alt=""></button>
            <!--<button><img src="images/superMario.jpg" alt=""></button>
            <button><img src="images/superMario.jpg" alt=""></button>
            <button><img src="images/superMario.jpg" alt=""></button>
            <button><img src="images/superMario.jpg" alt=""></button>
            <button><img src="images/superMario.jpg" alt=""></button>-->
        </div>
        <!--<button><img src="images/options.png" alt="" id="options"></button>
        <button><img src="images/notification1.png" alt=""></button>-->
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
    <script src="bricks.js"></script>
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
</html>