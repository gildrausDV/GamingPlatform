<!-- Autor: Dimitrije Vujčić 2019/0341 -->

<?php
    if($_SESSION['role'] < 1) {
        header('Location: '.base_url()."/Tournament/tournament");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add tournament</title>
    <link rel="stylesheet" href="<?= base_url() ?>/assets/style/bootstrap.min.css">
    <script src="<?= base_url() ?>/assets/scripts/bootstrap.min.js"></script>
    <link rel="stylesheet" href="<?= base_url() ?>/assets/style/addTournament.css">
    <style>
        .noti-count {
            position:absolute;
            background-color:lightblue;
            color:#fff;
            border-radius: 8px;
            width: 8px;
            height: 8px;
            text-align:center;
            margin-left: 90px;
        }
    </style>
</head>
<body>
    <div class="container-fluid bg-clouds">
        <div class="row no-padding">
            <div class="col-sm-12 no-padding">
                <nav class="navbar navbar-expand-sm bg-dark n">
                    <div class="levo">
                        <a href="<?= base_url() ?>/Home/settings" class="navbar-brand logo_link">
                            <img src="<?php 
                                    echo esc($picture);
                                ?>" alt="logo" id="logo" class="rounded-pill">
                        </a>
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a href="<?= base_url() ?>/Home/home" class="nav-link">
                                    Play
                                </a>
                            </li>
                            <li class="nav-item removeForGuests">
                                <a href="<?= base_url() ?>/Tournament/tournament" class="nav-link">
                                <div id="noti" class=""></div>
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
                    <div id="write" style="color: white; font-weight: bolder;">
                        
                    </div>
                    <div style="width: 50px;"></div>
                    <div id="newTournament" style="color: white;">
                        
                    </div>
                    <div class="desno">
                        <button id="signOut" type="button" class="btn" style="margin-right: 10px;">Sign out</button>
                    </div>
                </nav>
            </div>
        </div>
        <br><br><br>
        <div class="row">
            <div class="offset-md-4 col-md-4 mt-2">
                <nav class="navbar navbar-expand-sm c bg-dark games">
                    <a href="<?= base_url() ?>/Games/game/Rayman" class="navbar-brand">
                        <img src="/images/rayman.png" alt="logo" id="logo1" class="rounded-pill">
                    </a>
                    <a href="<?= base_url() ?>/Games/game/FlappyBird" class="navbar-brand">
                        <img src="/images/sonic.jpg" alt="logo" id="logo2" class="rounded-pill">
                    </a>
                    <a href="#" class="navbar-brand">
                        <img src="/images/pikachu.png" alt="logo" id="logo3" class="rounded-pill">
                    </a>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="offset-sm-2 col-sm-8 mt-2">
                <!--<table style="width: 100%">
                    
                </table>-->
                <div id="tournament_form">
                    <br><br>
                    <label for="tournament_game">Choose game:</label>
                    <select name="games" id="games">
                        <option value="Rayman">Rayman</option>
                        <option value="FlappyBird">FlappyBird</option>
                    </select>
                    <br><br>
                    <label for="max_players"> Number of players:</label>
                    <input type="text" id="max_players" name="may_players" value="10">
                    <br><br>
                    <label for="date"> Date:</label>
                    <input type="date" id="date" name="date">
                    <br><br>
                    <label for="timeStart"> Starting time:</label>
                    <input type="text" id="timeStart" name="timeStart" value="13:00:00">
                    <br><br>
                    <label for="timeEnd"> Ending time:</label>
                    <input type="text" id="timeEnd" name="timeEnd" value="14:00:00">
                    <br><br>
                    <input type="submit" value="Add tournament" class="submit btn btn-secondary" id="myButton">
                </div>
            </div><br><br><br>
            <!--<div class="col-sm-12 no-padding" style="margin-top: 125px">
                <nav class="navbar navbar-expand-sm bg-dark n" style="color: white; height: 50px;">
                    <div style="width: 100%; text-align: center; color: white; margin-top:" class="notification">
                        <h3 id="write" style="min-height: 35px;"></h3>
                    </div>
                </nav>
            </div>-->
        </div>
        <div class="row">
            <div class="col-sm-12">
                <br><br><br><br>
            </div>
        </div>
    </div>
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>-->
    <!--<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>-->
    <script src="<?= base_url() ?>/assets/scripts/jquery-1.11.3.min.js"></script>
    <script>

        $(document).ready(function () {

            let newTournament = '<?php
                if(!isset($_SESSION['ID'])) {
                    echo 'false';
                } else {
                    if(!isset($_SESSION['newTournamentUsers'])) {
                        echo 'false';
                    } else {
                        if(in_array($_SESSION['ID'], $_SESSION['newTournamentUsers'])) {
                            $arr = $_SESSION['newTournamentUsers'];
                            if (($key = array_search($_SESSION['ID'], $arr)) !== false) {
                                unset($arr[$key]);
                            }
                            
                            $session = session();
                            $ses_data = [
                                'newTournamentUsers' => $arr
                            ];
                            $session->set($ses_data);

                            echo 'true';
                        } else {
                            echo 'false';
                        }
                    }
                }
            ?>';
            //alert(newTournament);
            if(newTournament == 'true') {
                //alert('Novo takmicenje');
                $("#newTournament").text("Check out new tournament!").css("color", "white").css("margin-right", "100px").css("font-weight", "bold");
                $("#noti").addClass("noti-count");
            }

            let role = <?php echo $_SESSION['role'];?>;
            //alert(role);
            if(role == 2) {
                
            }  if(role == 1) {
                $(".removeForModerators").css("display", "none");
            } if(role == 0) {
                $(".removeForUsers").css("display", "none");
            } if(role == -1) {
                $(".removeForGuests").css("display", "none");
            }
            //alert(role);

            if(role == -1) {
                $("#signOut").text("Log in")
                    .removeClass("btn-danger")
                    .addClass("btn-success");
            } else {
                $("#signOut").text("Log out")
                    .removeClass("btn-success")
                    .addClass("btn-danger");
            }
            
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

            $("#myButton").click(function () {
                
                let game = $("#games").val();
                let max_players = $("#max_players").val();
                let date = $("#date").val();
                let timeStart = $("#timeStart").val();
                let timeEnd = $("#timeEnd").val();

                let valid = false;
                valid = (/^\d+$/.test(max_players) && /^\d\d:\d\d:\d\d$/.test(timeStart) && /^\d\d:\d\d:\d\d$/.test(timeEnd));
                if(!valid || game == "" || max_players == "" || date == "" || timeStart == "" || timeEnd == "") {
                    $("#write").text("Please provide necessary information.").css("color", "red");
                    return;
                }
                //alert();
                $.ajax({
                    method: "POST",
                    url: window.location.origin + "/Tournament/add_tournament",
                    data: {arguments: [game, max_players, date, timeStart, timeEnd]},
                    success: function (obj, textstatus) {
                        //alert(obj + " " + textstatus);
                        if(obj == "error") {
                            $("#write").text("Tournament already exists!").css("color", "red");
                        } else {
                            $("#write").text("You have successfully added a tournament!").css("color", "white");
                        }
                    },
                    error: function(xhr, status, error) {
                        alert(xhr.responseText + " " + error + " " + status);
                    }
                });
                //alert();
            });

        });
    </script>
</body>
</html>