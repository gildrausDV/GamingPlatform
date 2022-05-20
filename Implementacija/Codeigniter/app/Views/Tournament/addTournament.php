<!-- Autor: Bogdan Jovanović -->

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
</head>
<body>
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
                            <li class="nav-item">
                                <a href="<?= base_url() ?>/Tournament/tournament" class="nav-link">
                                    Tournaments
                                </a>
                            </li>
                            <li class="nav-item" style="width: 85px;">
                                <a href="<?= base_url() ?>/Games/addLevel_default" class="nav-link">
                                    Add level
                                </a>
                            </li>
                            <li class="nav-item" style="width: 135px;">
                                <a href="<?= base_url() ?>/Home/settings" class="nav-link">
                                    Account settings
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url() ?>/Home/allow" class="nav-link">
                                    Allow/block
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url() ?>/Games/history/None" class="nav-link">
                                    History
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url() ?>/Home/roles" class="nav-link" style="width: 75px;">
                                    Roles
                                </a>
                            </li>
                            <li>
                                <div class="dropdown">
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
                    <a href="#" class="navbar-brand">
                        <img src="<?= base_url() ?>/images/rayman.png" alt="logo" id="logo1" class="rounded-pill">
                    </a>
                    <a href="#" class="navbar-brand">
                        <img src="<?= base_url() ?>/images/sonic.jpg" alt="logo" id="logo2" class="rounded-pill">
                    </a>
                    <a href="#" class="navbar-brand">
                        <img src="<?= base_url() ?>/images/pikachu.png" alt="logo" id="logo3" class="rounded-pill">
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
                    </select>
                    <br><br>
                    <label for="max_players"> Number of players:</label>
                    <input type="text" id="max_players" name="may_players">
                    <br><br>
                    <label for="date"> Date:</label>
                    <input type="date" id="date" name="date">
                    <br><br>
                    <label for="timeStart"> Starting time:</label>
                    <input type="text" id="timeStart" name="timeStart">
                    <br><br>
                    <label for="timeEnd"> Ending time:</label>
                    <input type="text" id="timeEnd" name="timeEnd">
                    <br><br>
                    <input type="submit" value="Add tournament" class="submit btn btn-secondary" id="myButton">
                </div>
            </div>
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
            
            $("#signOut").click(function () {
                $.ajax({
                    method: "POST",
                    url: window.location.origin + "/Home/SignOut",
                    success: function (obj, textstatus) {
                        alert(obj + " " + textstatus);
                    },
                    error: function (msg) {
                        alert("error");
                    }
                });

                location.href = window.location.origin + "/Home/Login";
                });
            });

            $("#myButton").click(function () {
                
                let game = $("#games").val();
                let max_players = $("#max_players").val();
                let date = $("#date").val();
                let timeStart = $("#timeStart").val();
                let timeEnd = $("#timeEnd").val();

                /*if(game == "" || max_players == "" || date == "" || timeStart == "" || timeEnd == "") {
                    return;
                }*/
                alert();
                $.ajax({
                    method: "POST",
                    url: window.location.origin + "/Tournament/add_tournament",
                    data: {arguments: [game, max_players, date, timeStart, timeEnd]},
                    success: function (obj, textstatus) {
                        alert(obj + " " + textstatus);
                    },
                    error: function(xhr, status, error) {
                        alert(xhr.responseText + " " + error + " " + status);
                    }
                });
                alert();
            });

        });

        /*var started = false;
        var ended = false;

        function addTournament1() {
            alert();
            if(ended = true) {
                ended = false;
                started = false;
            }
            if(started == true) {
                return;
            }
            started = true;
            let end = false;
            if(document.getElementById("games").value == "" || document.getElementById("max_players").value == "" || document.getElementById("date").value == "" || document.getElementById("timeStart").value == "" || document.getElementById("timeEnd").value == "") {
                document.getElementById("notification").innerText = "Please provide necessary information.";
                end = true;
            }
            alert();
            //if(end) return;

            add_tournament();

        }

        function add_tournament() {
            alert();
            let game = document.getElementById("games").value;
            let numPlayers = document.getElementById("max_players").value;
            let date = document.getElementById("date").value;
            let timeStart = document.getElementById("timeStart").value;
            let timeEnd = document.getElementById("timeEnd").value;
            //alert(game + " " + numPlayers + " " + date + " " + timeStart + " " + timeEnd);

            alert("sending...");
            jQuery.ajax({
                type: "POST",
                url: 'tournament_.php',
                //dataType: 'json',
                data: {functionname: 'add_tournament', arguments: [game, numPlayers, date, timeStart, timeEnd]},

                success: function (obj, textstatus) {
                    if( !('error' in obj) ) {
                        alert("success");
                    }
                    else {
                        console.log(obj.error);
                        alert(obj.error + " ??? " + textstatus);
                    }
                },
                error: function(xhr, status, error) {
                    alert(xhr.responseText + " " + error + " ??? " + status);
                }
            });
            alert("sent");
        }

        function back() {
            location.href = "tournament.html";
        }
        function signOut_page() {
            location.href = "index.html";
        }*/
    </script>
</body>
</html>