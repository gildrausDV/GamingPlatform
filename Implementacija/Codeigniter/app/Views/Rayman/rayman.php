<!-- Autor: Bogdan Jovanović -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rayman</title>
    <link rel="stylesheet" href="<?= base_url() ?>/assets/style/bootstrap.min.css">
    <script src="<?= base_url() ?>/assets/scripts/bootstrap.min.js"></script>
    <link rel="stylesheet" href="<?= base_url() ?>/assets/style/rayman.css">
    <!--<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>-->
    <script src="<?= base_url() ?>/assets/scripts/jquery-1.11.3.min.js"></script>
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>-->
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>-->
    <script src="<?= base_url() ?>/assets/scripts/rayman.js"></script>
    
</head>
<body onload="init()">
    <div class="container-fluid bg-clouds">
        <div class="row no-padding">
            <div class="col-sm-12 no-padding">
                <nav class="navbar navbar-expand-sm bg-dark n">
                    <div class="levo">
                        <a href="<?= base_url() ?>/Home/settings" class="navbar-brand logo_link">
                            <img src="<?= base_url() ?>/images/superMario.jpg" alt="logo" id="logo" class="rounded-pill">
                        </a>
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a href="<?= base_url() ?>/Home/home" class="nav-link">
                                    Play
                                </a>
                            </li>
                            <li class="nav-item removeForGuests">
                                <a href="<?= base_url() ?>/Tournament/tournament" class="nav-link">
                                    Tournaments
                                </a>
                            </li>
                            <li class="nav-item removeForGuests removeForUsers" style="width: 85px;">
                                <a href="<?= base_url() ?>/Games/addLevel_default" class="nav-link">
                                    Add level
                                </a>
                            </li>
                            <li class="nav-item removeForGuests" style="width: 135px;">
                                <a href="<?= base_url() ?>/Home/settings" class="nav-link">
                                    Account settings
                                </a>
                            </li>
                            <li class="nav-item removeForGuests removeForUsers removeForModerators">
                                <a href="<?= base_url() ?>/Home/allow" class="nav-link">
                                    Allow/block
                                </a>
                            </li>
                            <li class="nav-item removeForGuests">
                                <a href="<?= base_url() ?>/Games/history/None" class="nav-link">
                                    History
                                </a>
                            </li>
                            <li class="nav-item removeForGuests removeForUsers removeForModerators">
                                <a href="<?= base_url() ?>/Home/roles" class="nav-link" style="width: 75px;">
                                    Roles
                                </a>
                            </li>
                            <li>
                                <div class="dropdown" style="margin-left: 10px;">
                                    <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown">Top players lists</button>
                                    <ul class="dropdown-menu izbor">
                                        <li class="dropdown-item">
                                            <a href="<?= base_url() ?>/Games/topPlayers/Global">Top players (global)</a>
                                        </li>
                                        <li class="dropdown-item">
                                            <a href="<?= base_url() ?>/Games/topPlayers/None">Top players for game</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                    
                    <div class="desno">
                        <button id="signOut" type="button" class="btn btn- bg-danger" style="margin-right: 10px;">Sign out</button>
                    </div>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="offset-md-4 col-md-4 mt-4">
                <nav class="navbar navbar-expand-sm c bg-dark games">
                    <a href="<?= base_url() ?>/Games/game/Rayman" class="navbar-brand">
                        <img src="<?= base_url() ?>/images/rayman.png" alt="logo" id="logo1" class="rounded-pill">
                    </a>
                    <a href="<?= base_url() ?>/Games/game/FlappyBird" class="navbar-brand">
                        <img src="<?= base_url() ?>/images/sonic.jpg" alt="logo" id="logo2" class="rounded-pill">
                    </a>
                    <a href="#" class="navbar-brand">
                        <img src="<?= base_url() ?>/images/pikachu.png" alt="logo" id="logo3" class="rounded-pill">
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
                        <span class="maxPoints">Max points achieved: </span>
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
    <script>
        $(document).ready(function () {

            let role = <?php echo $_SESSION['role'];?>;
            //alert(role);
            if(role == 2) {
                return;
            }  if(role == 1) {
                $(".removeForModerators").css("display", "none");
            } if(role == 0) {
                $(".removeForUsers").css("display", "none");
            } if(role == -1) {
                $(".removeForGuests").css("display", "none");
            }
            //alert(role);

            let date = new Date();

            $("#signOut").click(function () {

                $.ajax({
                    method: "POST",
                    url: window.location.origin + "/Home/SignOut",
                    success: function (obj, textstatus) {
                        //alert(obj + " " + textstatus);
                    },
                    error: function (msg) {
                        alert("error");
                    }
                });

                location.href = window.location.origin + "/Home/Login";
            });

            $.ajax({
                method: "POST",
                url: window.location.origin + "/Tournament/isActive/Rayman",
                data: {arguments: [date.getFullYear(), date.getMonth() + 1, date.getDate(), date.getHours(), date.getMinutes(), date.getSeconds()]},
                success: function (obj, textstatus) {
                    if(obj == 'true') {
                        $("#my-canvas").css("border", "5px solid gold");
                    }
                },
                error: function(xhr, status, error) {
                    alert(xhr.responseText + " " + error + " " + status);
                }
            });

        });
    </script>
</body>
</html>