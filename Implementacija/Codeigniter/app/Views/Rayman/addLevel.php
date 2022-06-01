<!-- Autor: Dimitrije Vujčić 2019/0341 -->

<?php
    if(!isset($_SESSION['isLoggedIn']) || $_SESSION['isLoggedIn'] == false || $_SESSION['role'] < 1) {
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
    <title>Add level</title>
    <link rel="stylesheet" href="<?= base_url() ?>/assets/style/bootstrap.min.css">
    <script src="<?= base_url() ?>/assets/scripts/bootstrap.min.js"></script>
    <link rel="stylesheet" href="<?= base_url() ?>/assets/style/rayman_addLevel.css">
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>-->
    <!--<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>-->
    <script src="<?= base_url() ?>/assets/scripts/jquery-1.11.3.min.js"></script>
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
                    <a href="<?= base_url() ?>/Games/addLevel/Rayman" class="navbar-brand">
                        <img src="<?= base_url() ?>/images/rayman.png" alt="logo" id="logo1" class="rounded-pill">
                    </a>
                    <a href="<?= base_url() ?>/Games/addLevel/FlappyBird" class="navbar-brand">
                        <img src="<?= base_url() ?>/images/sonic.jpg" alt="logo" id="logo2" class="rounded-pill">
                    </a>
                    <a href="#" class="navbar-brand">
                        <img src="<?= base_url() ?>/images/pikachu.png" alt="logo" id="logo3" class="rounded-pill">
                    </a>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-12 col-sm-12">
                <div class="center">
                    <div class="left">
                        <div class="top">
                            <h1>Instructions: </h1>
                            <p>Rayman is trying to collect as many coins as possible. Create a map by entering number of coins(at least 1, less than 5), their positions like in the example below, number of floating trees and their positions like in the example below. <br>
                            <h3 style="color: red">Coin position format: [pos_x, pos_y]<br> Floating tree position format: [pos_x, pos_y, length]</h3><hr>
                                Note: Rayman always spawns in lower left corner, can move left, right and jump 2 cells. 
                            </p>
                            <!--<br><br><br>-->
                        </div>
                        <div class="bottom">
                            <h1>Example: </h1>
                            <div class="example">
                                <br>
                                <table>
                                  <tr>
                                      <td>Number of rows: 5</td>
                                      <td rowspan="4"><img src="<?= base_url() ?>/images/level_map_rayman.png"></td>
                                  </tr>
                                  <tr>
                                      <td>Number of columns: 5</td>
                                  </tr>
                                  <tr>
                                      <td>Positions of coins:  [1, 1], [2, 2]</td>
                                  </tr>
                                  <tr>
                                      <td>Positions of floating trees: [1,1,2], [2,2,2], [3,3,1]</td>
                                  </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12">
                <div> 
                    <div class="right">
                        <div class="form">
                            <div>
                                <label for="numRows"> Number of rows:</label>
                                <input type="text" id="numRows" name="numRows" value="5"><br><br>
                                <label for="numCols"> Number of columns:</label>
                                <input type="text" id="numCols" name="numCols" value="5"><br><br>
                                <label for="numC"> Number of coins:</label>
                                <input type="text" id="numC" name="numC" value="2"><br><br>
                                <label for="posC"> Positions of coins:</label>
                                <textarea name="posC" id="posC" cols="30" rows="5">[1,1], [2,2]</textarea><br><br>
                                <label for="numFT"> Number of floating trees:</label>
                                <input type="text" id="numFT" name="numFT" value="3"><br><br>
                                <label for="fTrees"> Positions of floating trees:</label>
                                <textarea name="posFT" id="fTrees" cols="30" rows="5">[1,1,2], [2,2,2], [3,3,1]</textarea><br><br>
                                <input type="submit" value="Add level" class="submit" id="myButton" name="button1">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--<div class="row no-padding">
            <div class="col-sm-12 no-padding">
                <nav class="navbar navbar-expand-sm bg-dark n" style="color: white; height: 50px; margin-top: 42px;">
                    <div style="width: 100%; text-align: center; color: white; margin-top:" class="notification">
                        <h3 id="write" style="min-height: 35px;"></h3>
                    </div>
                </nav>
            </div>
        </div>-->
    </div>
    <script>

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
                    error: function (msg) {
                        alert("error");
                    }
                });

                location.href = window.location.origin + "/Home/Login";
            });

            $("#myButton").click(function () {
                
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

                let regexNum = /^[0-9]+$/;
                let regexCoinsPos = /^(\[\d+,\d+\],)+$/;
                let regexFTPos = /^((\[\d+,\d+,\d+\]|\[\d+,up\]),)+$/;

                let numRows = $("#numRows").val();
                let numCols = $("#numCols").val();
                let numC = $("#numC").val();
                let posCoins = $("#posC").val();
                let numFT = $("#numFT").val();
                let posFT = $("#fTrees").val();

                posCoins = posCoins.replace(/\s/g, '');
                let _posCoins = posCoins + ',';
                posFT = posFT.replace(/\s/g, '');
                let _posFT = posFT + ',';
                //alert(numRows + " " + numCols + " " + numCoins + " " + posCoins + " " + numFB + " " + posFT);

                let b = true;
                b &= regexCoinsPos.test(_posCoins);
                b &= regexFTPos.test(_posFT);
                b &= regexNum.test(numRows);
                b &= regexNum.test(numCols);
                b &= regexNum.test(numC);
                b &= regexNum.test(numFT);

                if(numRows == "") {
                    $("#write").text("Please enter number of rows!").css("color", "red");
                    return;
                } else if(numCols == "") {
                    $("#write").text("Please enter number of columns!").css("color", "red");
                    return;
                } else if(numC == "") {
                    $("#write").text("Please enter number of coins!").css("color", "red");
                    return;
                } else if(posCoins == "") {
                    $("#write").text("Please enter position of coins!").css("color", "red");
                    return;
                } else if(numFT == "") {
                    $("#write").text("Please enter number of fire balls!").css("color", "red");
                    return;
                } else if(posFT == "") {
                    $("#write").text("Please enter position of fire balls!").css("color", "red");
                    return;
                }

                if(!b) {
                    $("#write").text("Data not entered correctly!").css("color", "red");
                    return;
                }

                $("#write").text("");
                /*
{"rows": 5,"cols": 10,"wood": [{"y": 1, "direction": "down"}, {"y": 3, "direction": "up"}, {"y": 4, "direction": "down"}], "coins": [{"x": 1, "y": 1}]}
                */
                let wood = [];
                let arr = posFT.split("],[");
                for(let i = 0; i < arr.length; ++i) {
                    let str = arr[i].replace('[', '').replace(']', '');
                    let x = str.split(",");
                    //alert(x);
                    if(x.length != 3) continue;
                    let d = {
                        "y" : x[0],
                        "x" : x[1],
                        "len" : x[2]
                    };
                    wood.push(d);
                }
                
                let coins = [];
                arr = posCoins.split("],[");
                for(let i = 0; i < arr.length; ++i) {
                    let str = arr[i].replace('[', '').replace(']', '');
                    let x = str.split(",");
                    //alert(x);
                    if(x.length != 2) continue;
                    let d = {
                        "y" : x[0],
                        "x" : x[1]
                    };
                    coins.push(d);
                }
                //alert(JSON.stringify(coins));

                let data = {
                    "rows" : numRows,
                    "cols" : numCols,
                    "wood" : wood,
                    "coins": coins
                };

                //alert(data);
                $.ajax({
                    method: "POST",
                    url: window.location.origin + "/Games/add_level/Rayman",
                    data: {arguments: JSON.stringify(data)},
                    success: function (obj, textstatus) {
                        if(textstatus == "success") {
                            $("#write").text("New level added successfully!").css("color", "white");
                        } else {
                            $("#write").text("Error!");
                        }
                    },
                    error: function(xhr, status, error) {
                        alert("1" + xhr.responseText + " " + error + " " + status);
                        $("#write").text("Error!");
                    }
                });

            });

        }); 

    </script>
</body>
</html>