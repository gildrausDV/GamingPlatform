<!-- Autor: Dimitrije Vujčić 2019/0341 -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Player list</title>
    <link rel="stylesheet" href="<?= base_url() ?>/assets/style/bootstrap.min.css">
    <script src="<?= base_url() ?>/assets/scripts/bootstrap.min.js"></script>
    <link rel="stylesheet" href="<?= base_url() ?>/assets/style/topPlayers.css">
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
                    <div id="newTournament">
                            
                        </div>
                    <div class="desno">
                        <button id="signOut" type="button" class="btn" style="margin-right: 10px;">Sign out</button>
                    </div>
                </nav>
            </div>
        </div>
        <!--<div class="row">
            <div class="offset-md-4 col-md-4 mt-4">
                <div id="chooseGame" class="bg-dark">
                    <h4>Please choose game: </h4>
                </div>
            </div>
        </div>-->
        <div class="row">
            <div class="offset-md-4 col-md-4 mt-4">
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
                <table style="width: 100%">
                    
                </table>
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

            let id_tournament = <?php echo esc($id_tournament); ?>;
            
            $.ajax({
                method: "GET",
                url: window.location.origin + "/Tournament/getPlayersList/" + id_tournament,
                success: function (obj, textstatus) {
                    if(obj == "") return;
                    //alert(obj);
                    start_data = JSON.parse(obj);
                    if(start_data.list[0].username == undefined) return;
                    let l = start_data.list.length;
                    if(l > 10) l = 10;
                    for(let i = 0; i < l; ++i) {
                        let row = $("<tr></tr>").css({"width": "100%", 
                                                "height": "80px", 
                                                "display": "flex",
                                                "justify-content": "space-around",
                                                "text-align": "center",
                                                "border": "3px solid white",
                                                "background-color": "black",
                                                "opacity": "0.8",
                                                "color": "white",
                                                "position": "relative"
                                            });
                        row.hover(function () { $(this).css("border", "3px solid gray") }, function () { $(this).css("border", "3px solid white") });
                        let col = $("<td><h1>" + start_data.list[i].username + "</h1></td>").css("margin-left", "10%").css("margin-top", "1%");
                        row.append(col);
                        
                        
                        let points = start_data.list[i].points;
                        
                        if(points < 10) 
                            points = $("<h1>Points: 0" + points + "<\h1>").css("margin-top", "1%");
                        else if(points < 100) 
                            points = $("<h1>Points: &nbsp;" + points + "<\h1>").css("margin-top", "1%");
                        else 
                            points = $("<h1>Points: " + points + "<\h1>").css("margin-top", "1%");
                        
                        row.append(points);
                        
                        $("table").append(row);
                        
                    }

                },
                error: function(xhr, status, error) {
                    alert(xhr.responseText + " " + error + " " + status);
                }
            });

            /*let start_data;
            let game = 'None';
            $("#chooseGame").css("display", "none");
            if(game == "None") {
                $("#chooseGame").css("display", "inline-block");
                return;
            }

            $.ajax({
                method: "GET",
                url: window.location.origin + "/Games/getTopPlayers/" + game,
                success: function (obj, textstatus) {
                    if(obj == "") return;
                    start_data = JSON.parse(obj);
                    if(game == "Global") {
                        topPlayersG();
                    } else {
                        topPlayers();
                    }
                },
                error: function(xhr, status, error) {
                    alert("2 " + xhr.responseText + " " + error + " " + status);
                }
            });

            function topPlayersG() {
                for(let i = 0; i < start_data.list.length; ++i) {
                    let row = $("<tr></tr>").css({"width": "100%", 
                                            "height": "80px", 
                                            "display": "flex",
                                            "justify-content": "space-around",
                                            "text-align": "center",
                                            "border": "3px solid white",
                                            "background-color": "black",
                                            "opacity": "0.8",
                                            "color": "white",
                                            "position": "relative"
                                        });
                    row.hover(function () { $(this).css("border", "3px solid gray") }, function () { $(this).css("border", "3px solid white") });
                    let col = $("<td><h1>" + start_data.list[i].username + "</h1></td>").css("margin-left", "10%").css("margin-top", "1%");
                    row.append(col);
                    
                    
                    let points = start_data.list[i].NP;
                    
                    if(points < 10) 
                        points = $("<h1>Points: 0" + points + "<\h1>").css("margin-top", "1%");
                    else if(points < 100) 
                        points = $("<h1>Points: &nbsp;" + points + "<\h1>").css("margin-top", "1%");
                    else 
                        points = $("<h1>Points: " + points + "<\h1>").css("margin-top", "1%");
                    
                    row.append(points);
                    
                    $("table").append(row);
                }
            }

            function topPlayers() {
                for(let i = 0; i < start_data.list.length; ++i) {
                    let row = $("<tr></tr>").css({"width": "100%", 
                                            "height": "80px", 
                                            "display": "flex",
                                            "justify-content": "space-around",
                                            "text-align": "center",
                                            "border": "3px solid white",
                                            "background-color": "black",
                                            "opacity": "0.8",
                                            "color": "white",
                                            "position": "relative"
                                        });
                    row.hover(function () { $(this).css("border", "3px solid gray") }, function () { $(this).css("border", "3px solid white") });
                    let col = $("<td><h1>" + start_data.list[i].username + "</h1></td>").css("margin-left", "10%").css("margin-top", "1%");
                    row.append(col);

                    let time = start_data.list[i].timePlayed;
                    let ss = time % 60;
                    if(ss < 10) ss = "0" + ss;
                    time = Math.floor(time / 60);
                    let mm = time % 60;
                    if(mm < 10) mm = "0" + mm;
                    time = Math.floor(time / 60);
                    let hh = time % 60;
                    if(hh < 10) hh = "0" + hh;
                    time = hh + ":" + mm + ":" + ss;
                    
                    col = $("<td><h1>" + time + "</h1></td>").css("margin-top", "1%");
                    row.append(col);
                    
                    
                    let points = start_data.list[i].points;
                    
                    if(points < 10) 
                        points = $("<h1>Points: 0" + points + "<\h1>").css("margin-top", "1%");
                    else if(points < 100) 
                        points = $("<h1>Points: &nbsp;" + points + "<\h1>").css("margin-top", "1%");
                    else 
                        points = $("<h1>Points: " + points + "<\h1>").css("margin-top", "1%");
                    
                    row.append(points);
                    
                    $("table").append(row);
                }
            }*/

        });
    </script>
</body>
</html>