<!-- Autor: Dimitrije Vujčić 2019/0341 -->

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
            </div><br><br><br><br><br><br>
            <!--<div class="col-sm-12 no-padding" style="margin-top: 125px">
                <nav class="navbar navbar-expand-sm bg-dark n" style="color: white; height: 50px;">
                    <div style="width: 100%; text-align: center; color: white; margin-top:" class="notification">
                        <h3 id="write1" style="min-height: 35px;"></h3>
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
                $("#addTournament").css("display", "none");
            } if(role == 0) {
                $(".removeForUsers").css("display", "none");
                $("#addTournament").css("display", "none");
            } if(role == -1) {
                $(".removeForGuests").css("display", "none");
                $("#addTournament").css("display", "none");
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
            //alert(("00:45:00" < "00:39:46"));
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
                                        "align-items": "center",
                                        "justify-content": "space-around",
                                        "text-align": "center",
                                        "border": "3px solid white",
                                        "background-color": "black",
                                        "opacity": "0.8",
                                        "color": "white",
                                        "position": "relative"
                                    });
                        row.hover(function () { $(this).css("border", "3px solid gray") }, function () { $(this).css("border", "3px solid white") });
                        let col = $("<td><h1>" + start_data.list[i].name + "</h1></td>");//.css("margin-top", "1%");
                        row.append(col);
                        
                        col = $("<td><h1>" + start_data.list[i].date + "</h1></td>");//css("margin-top", "1%");
                        row.append(col);
                        
                        col = $("<td><h1>" + start_data.list[i].timeStart + "</h1></td>");//css("margin-top", "1%");
                        row.append(col);
                        
                        col = $("<td><h1>" + start_data.list[i].timeEnd + "</h1></td>");//css("margin-top", "1%");
                        row.append(col);
                        
                        let date = new Date();
                        let hh = date.getHours(); if(hh < 10) hh = "0" + hh;
                        let mm = date.getMinutes(); if(mm < 10) mm = "0" + mm;
                        let ss = date.getSeconds(); if(ss < 10) ss = "0" + ss;
                        let txt = hh + ":" + mm + ":" + ss;
                        let m = date.getMonth() + 1;
                        if(m < 10) m = "0" + m;
                        let ddd = date.getDate();
                        if(ddd < 10) ddd = "0" + ddd;
                        let d = date.getFullYear() + "-" + m + "-" + ddd;
                        //alert(start_data.list[i].timeEnd + " < " + txt + " = " + (start_data.list[i].timeEnd < txt));

                        let jnd = (joined.indexOf(start_data.list[i].id) != -1);
                        let ended = (start_data.list[i].date < d || start_data.list[i].date == d && start_data.list[i].timeEnd < txt);
                        let admin = (role == 2);
                        let closed = (start_data.list[i].ended == 1);
                                
                        //alert("joined: " + jnd + " ended: " + ended + " admin:" + admin);
                        //alert(start_data.list[i].timeEnd + " < " + txt + " = " + (start_data.list[i].date < txt));
                        //if(i == 4) {
                            //alert("joined: " + jnd + " ended: " + ended + " admin:" + admin);
                            //alert(start_data.list[i].timeEnd + " < " + txt + " = " + (start_data.list[i].date < txt));
                            //alert(start_data.list[i].date + " " + d + " " + start_data.list[i].date.length + " " + d.length);
                        //}
                        if(!admin) {
                            if(!ended) {
                                col = $("<td><button id='"+ i +"' class='btn btn-danger'>" + 'Ended' + "</button></td>");
                            } else if(jnd) {
                                col = $("<td><button id='"+ i +"' class='btn btn-secondary'>" + 'Joined' + "</button></td>");
                            } else {
                                col = $("<td><button id='"+ i +"' class='btn btn-primary'>" + 'Join' + "</button></td>");
                            }
                        } else {
                            if(!ended) {
                                if(jnd) {
                                col = $("<td><button id='"+ i +"' class='btn btn-secondary'>" + 'Joined' + "</button></td>");
                                } else {
                                    col = $("<td><button id='"+ i +"' class='btn btn-primary'>" + 'Join' + "</button></td>");
                                }
                            } else {
                                if(closed) {
                                    col = $("<td><button id='"+ i +"' class='btn btn-danger'>" + 'Ended' + "</button></td>");
                                } else {
                                    col = $("<td><button id='"+ i +"' class='btn btn-success'>" + 'End' + "</button></td>");
                                }
                            }
                        }

                        /*if(start_data.list[i].date > d) {
                            if(joined.indexOf(start_data.list[i].id) == -1) {
                                col = $("<td><button id='"+ i +"' class='btn btn-primary'>" + 'Join' + "</button></td>");
                            } else {
                                col = $("<td><button id='"+ i +"' class='btn btn-secondary'>" + 'Joined' + "</button></td>");
                            }
                        } else if(start_data.list[i].date == d) {
                            if(txt > start_data.list[i].timeEnd && role != 2) {
                                if(joined.indexOf(start_data.list[i].id) == -1) {
                                    col = $("<td><button id='"+ i +"' class='btn btn-primary'>" + 'Join' + "</button></td>");
                                } else {
                                    //alert(txt + " > " + start_data.list[i].timeEnd);
                                    col = $("<td><button id='"+ i +"' class='btn btn-secondary'>" + 'Joined' + "</button></td>");
                                }
                            } else if(txt > start_data.list[i].timeEnd && role == 2) {
                                if(start_data.list[i].ended == 0) {
                                    col = $("<td><button id='"+ i +"' class='btn btn-success'>" + 'End' + "</button></td>");
                                } else {
                                    col = $("<td><button id='"+ i +"' class='btn btn-danger'>" + 'Ended' + "</button></td>");
                                }
                            } else {
                                col = $("<td><button id='"+ i +"' class='btn btn-danger'>" + 'Ended' + "</button></td>");
                            }
                        } else {
                            col = $("<td><button id='"+ i +"' class='btn btn-danger'>" + 'Ended' + "</button></td>");
                        }*/

                        /*if(start_data.list[i].date == d && start_data.list[i].timeEnd < txt) {
                            if(role == 2 && start_data.list[i].ended == 0) {
                                col = $("<td><button id='"+ i +"' class='btn btn-success'>" + 'End' + "</button></td>");//css("margin-top", "2%").css("width", "100px");
                            } else {
                                col = $("<td><button id='"+ i +"' class='btn btn-danger'>" + 'Ended' + "</button></td>");//css("margin-top", "2%").css("width", "100px");
                            }
                        } else if(joined.indexOf(start_data.list[i].id) == -1) {
                            col = $("<td><button id='"+ i +"' class='btn btn-primary'>" + 'Join' + "</button></td>");//css("margin-top", "2%").css("width", "100px");
                        } else {
                            col = $("<td><button id='"+ i +"' class='btn btn-secondary'>" + 'Joined' + "</button></td>");//css("margin-top", "2%").css("width", "100px");
                        }*/
                        row.append(col);
                        
                        $("table").append(row);
                        /*let txt = $("#1").text();
                        alert(txt);*/

                        let isFull = false;
                        if(start_data.list[i].maxNumOfPlayers == start_data.list[i].numOfPlayers) {
                            let b = $("#" + i);
                            if(b.text() == "Join") {
                                b.removeClass("btn-primary");
                                b.text("Full");
                                b.addClass("btn-danger");
                            }
                        }

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
                //alert();
                let btn = $("#" + index);
                if(btn.text() == "Joined") {
                    //alert("1");
                    $("#write").text("");
                } else if(btn.text() == "Full") {
                    //alert("2");
                    $("#write").text("Tournament full!").css("color", "red");
                } else if(btn.text() == "Join") {
                    //alert("3");
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
                            } else*/ 
                            if(btn.text() == "Join") {
                                btn.removeClass("btn-primary");
                                btn.addClass("btn-secondary");
                                btn.text("Joined");
                            }
                        },
                        error: function(xhr, status, error) {
                            alert(xhr.responseText + " " + error + " " + status);
                        }
                    });
                } else if(btn.text() == "End") {
                    $.ajax({
                        method: "POST",
                        url: window.location.origin + "/Tournament/endTournament",
                        data: {argument: id},
                        success: function (obj, textstatus) {
                            //alert(obj + " " + textstatus);
                            //btn.css("display": "none");
                            btn.text("Ended");
                            btn.removeClass("btn-success");
                            btn.addClass("btn-danger");
                        },
                        error: function(xhr, status, error) {
                            alert(xhr.responseText + " " + error + " " + status);
                        }
                    });
                }
            }
            //alert();
        });
    </script>
</body>
</html>