<!-- Autor: Bogdan Jovanović -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Allow/block user</title>
    <link rel="stylesheet" href="<?= base_url() ?>/assets/style/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/style/allow.css">
    <script src="<?= base_url() ?>/assets/scripts/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>/assets/scripts/jquery-1.11.3.min.js"></script>
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>-->
</head>
<body>
    <div class="container-fluid no-padding">
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
                        <a href="#" class="navbar-brand">
                            <img src="/images/rayman.png" alt="logo" id="logo1" class="rounded-pill">
                        </a>
                        <a href="#" class="navbar-brand">
                            <img src="/images/sonic.jpg" alt="logo" id="logo2" class="rounded-pill">
                        </a>
                        <a href="#" class="navbar-brand">
                            <img src="/images/pikachu.png" alt="logo" id="logo3" class="rounded-pill">
                        </a>
                    </nav>
                </div>
            </div>
            <div class="row">
                <div class="form offset-md-4 col-md-4 mt-4">
                    <div>
                        <br>
                        <h1>Allow/block user</h1>
                        <hr>
                        <br>
                        <form method="post" action="<?php echo site_url('Home/allow_'); ?>">
                            <span id="greskaAllowBlock">
                            <?php 
                                if(esc($allow) == '2') echo "Changes saved!";
                                else if(esc($allow) == '1') echo "Username is not valid!";
                            ?>
                            </span><br>
                            <label for="username">Username:</label>
                            <input type="text" id="username" name="username"><br><br>
                            <label for="allow">Allow</label>
                            <input type="radio" name="allow/block" id="allow" checked value="allow">
                            <label for="block">&emsp;Block</label>
                            <input type="radio" name="allow/block" id="block" value="block"><br><br>
                            <button type="submit" class="ok btn btn-secondary">OK</button>
                        </form>
                        <br><br><br>
                    </div>    
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

        var started = false;
        var ended = false;

        function save() {
            if(ended = true) {
                ended = false;
                started = false;
            }
            if(started == true) {
                return;
            }
            started = true;
            if(document.getElementById("fname").value != "") {
                if(document.getElementById("html1").checked) 
                    document.getElementById("notification").innerText = "Access enabled!";
                else if(document.getElementById("html2").checked) 
                    document.getElementById("notification").innerText = "Access disabled!";
                else
                    document.getElementById("notification").innerText = "Changes saved!";
            }
            else
                document.getElementById("notification").innerText = "Username is not valid!";
            timerInterval = setInterval(function start_end() {
                ended = true;
                document.getElementById("notification").innerText = "";
                clearInterval(timerInterval);
            }, 1500);
        }

    </script>
</body>
</html>
</html>