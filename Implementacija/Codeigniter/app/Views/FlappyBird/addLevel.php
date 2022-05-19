<!-- Autor: Dimitrije Vujčić -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add level</title>
    <link rel="stylesheet" href="<?= base_url() ?>/assets/style/bootstrap.min.css">
    <script src="<?= base_url() ?>/assets/scripts/bootstrap.min.js"></script>
    <link rel="stylesheet" href="<?= base_url() ?>/assets/style/flappyBird_addLevel.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</head>
<body onload="init()">
    <div class="container-fluid bg-clouds">
        <div class="row no-padding">
            <div class="col-sm-12 no-padding">
                <nav class="navbar navbar-expand-sm bg-dark n">
                    <div class="levo">
                        <a href="#" class="navbar-brand logo_link">
                            <img src="<?= base_url() ?>/images/superMario.jpg" alt="logo" id="logo" class="rounded-pill">
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
            <div class="col-lg-6 col-md-12 col-sm-12">
                <div class="center">
                    <div class="left">
                        <div class="top">
                            <h1>Instructions: </h1>
                            <p>Rayman is trying to collect as many coins as possible. Create a map by entering number of coins(at least 1, less than 5), their positions like in the example below, number of fire balls and their positions like in the example below. <br>
                            <h3 style="color: red">Coin position format: [pos_x, pos_y]<br> Fire ball position format: [pos_y, direction]</h3><hr>
                                Note: Rayman always spawns in the 0th column centered by height and can move in all directions.
                            </p>
                            <br><br><br>
                        </div>
                        <div class="bottom">
                            <h1>Example: </h1>
                            <div class="example">
                                <br>
                                <table>
                                    <tr>
                                        <td>Number of rows: 5</td>
                                        <td rowspan="4"><img src="<?= base_url() ?>/images/level_map.png"></td>
                                    </tr>
                                    <tr>
                                        <td>Number of columns: 5</td>
                                    </tr>
                                    <tr>
                                        <td>Positions of coins:  [2, 5]</td>
                                    </tr>
                                    <tr>
                                        <td>Positions of floating trees: [1,down], [3,up], [4,down]</td>
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
                                <input type="text" id="numCols" name="numCols" value="10"><br><br>
                                <label for="numR"> Number of coins:</label>
                                <input type="text" id="numC" name="numC" value="1"><br><br>
                                <label for="posC"> Positions of coins:</label>
                                <textarea name="posC" id="posC" cols="30" rows="5">[1,1]</textarea><br><br>
                                <label for="numFT"> Number of fire balls:</label>
                                <input type="text" id="numFT" name="numFT" value="3"><br><br>
                                <label for="fTrees"> Positions of fire balls:</label>
                                <textarea name="posFT" id="fTrees" cols="30" rows="5">[1,down], [3,up], [4,down]</textarea><br><br>
                                <input type="submit" value="Add level" class="submit" id="myButton" name="button1">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row no-padding">
            <div class="col-sm-12 no-padding">
                <nav class="navbar navbar-expand-sm bg-dark n" style="color: white; height: 50px; margin-top: 42px;">
                    <div style="width: 100%; text-align: center; color: white; margin-top:" class="notification">
                        <h3 id="write" style="min-height: 35px;"></h3>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <script>

        $(document).ready(function () {
            
            $("#myButton").click(function () {

                let regexNum = /^[0-9]+$/;
                let regexCoinsPos = /^(\[\d,\d\],)+$/;
                let regexFTPos = /^(\[\d,\d\])+$/;

                let numRows = $("#numRows").val();
                let numCols = $("#numCols").val();
                let numCoins = $("#numC").val();
                let posCoins = $("#posC").val();
                let numFB = $("#numFT").val();
                let posFT = $("#fTrees").val();

                posCoins = posCoins.replace(/\s/g, '');
                posCoins += ',';
                posFT = posFT.replace(/\s/g, '');
                posFT += ',';
                alert(numRows + " " + numCols + " " + numCoins + " " + posCoins + " " + numFB + " " + posFT);

                alert(regexCoinPos.test(posCoins) + " " + regexFTPos.test(posFT));

                if(numRows == "") {
                    $("#write").text("Please enter number of rows!");
                } else if(numCols == "") {
                    $("#write").text("Please enter number of columns!");
                } else if(numCoins == "") {
                    $("#write").text("Please enter number of coins!");
                } else if(posCoins == "") {
                    $("#write").text("Please enter position of coins!");
                } else if(numFB == "") {
                    $("#write").text("Please enter number of fire balls!");
                } else if(posFT == "") {
                    $("#write").text("Please enter position of fire balls!");
                }

            });

        }); 

    </script>
</body>
</html>