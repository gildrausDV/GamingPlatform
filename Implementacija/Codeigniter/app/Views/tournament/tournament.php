<!-- Autor: Bogdan Jovanović -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Top players</title>
    <link rel="stylesheet" href="<?=base_url()?>/assets/bootstrap/bootstrap-5.1.3-dist/css/bootstrap.min.css">
    <script src="<?=base_url()?>/assets/bootstrap/bootstrap-5.1.3-dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="<?=base_url()?>/assets/style/tournament.css">
</head>
<body>
    <div class="container-fluid bg-clouds">
        <div class="row no-padding">
            <div class="col-sm-12 no-padding">
                <nav class="navbar navbar-expand-sm bg-dark n">
                    <div class="levo">
                        <a href="#" class="navbar-brand logo_link">
                            <img src="<?=base_url()?>/assets/images/superMario.jpg" alt="logo" id="logo" class="rounded-pill">
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
                                <a href="#" class="nav-link" style="width: 75px;">
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
                        <img src="<?=base_url()?>/assets/images/rayman.png" alt="logo" id="logo1" class="rounded-pill">
                    </a>
                    <a href="#" class="navbar-brand">
                        <img src="<?=base_url()?>/assets/images/sonic.jpg" alt="logo" id="logo2" class="rounded-pill">
                    </a>
                    <a href="#" class="navbar-brand">
                        <img src="<?=base_url()?>/assets/images/pikachu.png" alt="logo" id="logo3" class="rounded-pill">
                    </a>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="offset-sm-2 col-sm-8 mt-2" style="text-align: center">
                <br>
                    <table style="width: 100%">

                    </table>
                <br><br><br>
                <button id="addTournament" class="btn btn-secondary">Add tournament</button>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <br><br><br><br>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
        var start_data;

        jQuery.ajax({
            type: "POST",
            url: 'tournament_.php',
            //dataType: 'json',
            data: {functionname: 'get_tournaments'},

            success: function (obj, textstatus) {
                if( !('error' in obj) ) {
                    start_data = obj.result;
                    update_data();
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

        function update_data() {
            for(let i = 0; i < start_data.list.length; ++i) {

                let row = $("<tr></tr>").css({"width": "100%", 
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

                $("table").append(row);
                
            } 
        }

        let started = false;
        let ended = false;

        var timerInterval;
        var timerInterval1;
        var write;

        function join(pos) {
            if(ended = true) {
                ended = false;
                started = false;
            }
            if(started == true) {
                return;
            }
            started = true;
            document.getElementById("notification").innerText = "You have successfully joined the tournament!";
            timerInterval = setInterval(function start_end() {
                //join();
                ended = true;
                //alert();
                document.getElementById("notification").innerText = "";
                clearInterval(timerInterval);
            }, 1500);

            join_add_to_db(start_data.list[pos - 1].id);

        }

        function back() {
            location.href = "play.html";
        }
        function signOut_page() {
            location.href = "sign.html";
        }
        function addTournament() {
            location.href = "addTournament.html";
        }
        function join_add_to_db(tournament_id) {
            jQuery.ajax({
            type: "POST",
            url: 'tournament_.php',
            //dataType: 'json',
            data: {functionname: 'join_tournament', arguments: tournament_id},

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
        }
    </script>
</body>
</html>