<!-- Autor: Bogdan Jovanović -->

<?php
    //echo (strcmp("13:00:00", "13:00:15"));
    if($_SESSION['role'] < 0) {
        header('Location: '.base_url()."/Home/home");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tournament</title>
    <link rel="stylesheet" href="<?= base_url() ?>/assets/style/bootstrap.min.css">
    <script src="<?= base_url() ?>/assets/scripts/bootstrap.min.js"></script>
    <link rel="stylesheet" href="<?= base_url() ?>/assets/style/tournament.css">
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
                        <button id="signOut" type="button" class="btn" style="margin-right: 10px;">Sign out</button>
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
            <div class="offset-sm-2 col-sm-8 mt-2" style="text-align: center">
                <!--<table style="width: 100%">
                    
                </table>-->
                <br>
                <!--<div class="tournaments" id="tournaments">-->
                    <!--<div class="tournament">
                        <span class="span1"><h1>&nbsp;&nbsp;Bricks</h1></span>
                        <span class="span2"><button onclick="join()">Join</button></span>
                    </div>-->
                    <table style="width: 100%">

                    </table>
                <!--</div>-->
                <br><br><br>
                <button id="addTournament" onclick="addTournament()" class="btn btn-secondary">Add tournament</button>
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
                /*let date = new Date();
                $.ajax({
                    method: "POST",
                    url: window.location.origin + "/Games/test",
                    data: {arguments: [date.getFullYear(), date.getMonth() + 1, date.getDate(), date.getHours(), date.getMinutes(), date.getSeconds()]},
                    success: function (obj, textstatus) {
                        alert(obj + " " + textstatus);
                    },
                    error: function(xhr, status, error) {
                        alert(xhr.responseText + " " + error + " " + status);
                    }
                });*/

        $(document).ready(function () {

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
                    error: function(xhr, status, error) {
                        alert(xhr.responseText + " " + error + " " + status);
                    }
                });

                location.href = window.location.origin + "/Home/Login";
            });

            $("#addTournament").click(function () {
                location.href = window.location.origin + "/Tournament/addTournament";
            });

            let joined = [];
            $.ajax({
                method: "GET",
                url: window.location.origin + "/Tournament/getJoined",
                success: function (obj, textstatus) {
                    obj = JSON.parse(obj);
                    for(let i = 0; i < obj.list.length; ++i) {
                        joined.push(obj.list[i]['ID_tournament']);
                    }
                },
                error: function(xhr, status, error) {
                    alert(xhr.responseText + " " + error + " " + status);
                }
            });

            $.ajax({
                method: "GET",
                url: window.location.origin + "/Tournament/getTournaments",
                success: function (obj, textstatus) {
                    //alert(obj);
                    if(obj == "") return;
                    let start_data = JSON.parse(obj);
                    for(let i = 0; i < start_data.list.length; ++i) {
                
                        let row = $("<tr id=r"+i+"></tr>").css({"width": "100%", 
                                        "height": "90px", 
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
                        let col = $("<td><h1>" + start_data.list[i].name + "</h1></td>").css("margin-top", "1%");
                        row.append(col);
                        
                        col = $("<td><h1>" + start_data.list[i].date + "</h1></td>").css("margin-top", "1%");
                        row.append(col);
                        
                        col = $("<td><h1>" + start_data.list[i].timeStart + "</h1></td>").css("margin-top", "1%");
                        row.append(col);
                        
                        col = $("<td><h1>" + start_data.list[i].timeEnd + "</h1></td>").css("margin-top", "1%");
                        row.append(col);
                        
                        if(joined.indexOf(start_data.list[i].id) == -1) {
                            col = $("<td><button id='"+ i +"' class='btn btn-primary'>" + 'Join' + "</button></td>").css("margin-top", "2%").css("width", "100px");
                        } else {
                            col = $("<td><button id='"+ i +"' class='btn btn-secondary'>" + 'Joined' + "</button></td>").css("margin-top", "2%").css("width", "100px");
                        }
                        row.append(col);
                        
                        $("table").append(row);
                        /*let txt = $("#1").text();
                        alert(txt);*/

                        $("#" + i).click(function () {
                            //alert("join tournament");
                            joinTournament(start_data.list[i].id, i);
                            event.stopPropagation();
                        });

                        $("#r"+i).click(function () {
                            //alert("player list");
                            window.location.href = '<?php base_url() ?>' + "/Tournament/playerList/" + start_data.list[i].id;
                        });

                    }
                },
                error: function(xhr, status, error) {
                    alert(xhr.responseText + " " + error + " " + status);
                }
            });

            function joinTournament(id, index) {
                let btn = $("#" + index);
                $.ajax({
                    method: "POST",
                    url: window.location.origin + "/Tournament/joinTournament",
                    data: {argument: id},
                    success: function (obj, textstatus) {
                        //alert($("#" + index).text());
                        //alert(obj + " " + textstatus);
                        /*if(btn.text() == "Joined") {
                            btn.removeClass("btn-secondary");
                            btn.addClass("btn-primary");
                        } else*/ if(btn.text() == "Join") {
                            btn.removeClass("btn-primary");
                            btn.addClass("btn-secondary");
                        }
                    },
                    error: function(xhr, status, error) {
                        alert(xhr.responseText + " " + error + " " + status);
                    }
                });
            }
            //alert();
        });
    </script>
</body>
</html>