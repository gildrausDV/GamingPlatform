<!-- Autor: Bogdan Jovanović -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Top players</title>
    <link rel="stylesheet" href="../bootstrap/bootstrap-5.1.3-dist/css/bootstrap.min.css">
    <script src="../bootstrap/bootstrap-5.1.3-dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="topPlayers.css">
</head>
<body>
    <div class="container-fluid bg-clouds">
        <div class="row no-padding">
            <div class="col-sm-12 no-padding">
                <nav class="navbar navbar-expand-sm bg-dark n">
                    <div class="levo">
                        <a href="#" class="navbar-brand logo_link">
                            <img src="../images/superMario.jpg" alt="logo" id="logo" class="rounded-pill">
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
                        <img src="../images/rayman.png" alt="logo" id="logo1" class="rounded-pill">
                    </a>
                    <a href="#" class="navbar-brand">
                        <img src="../images/sonic.jpg" alt="logo" id="logo2" class="rounded-pill">
                    </a>
                    <a href="#" class="navbar-brand">
                        <img src="../images/pikachu.png" alt="logo" id="logo3" class="rounded-pill">
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>

        var start_data;

        update_list();
        //alert();

        function update_list() {
            jQuery.ajax({
                type: "POST",
                url: 'topPlayers_.php',
                //dataType: 'json',
                data: {functionname: 'get_topPlayers', arguments: 2},
            
                success: function (obj, textstatus) {
                    if( !('error' in obj) ) {
                        //alert(obj.result.list);
                        start_data = obj.result;
                        //alert(obj.result.list[0].points + "???");
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
        }

        function update_data() {
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

                /*document.getElementById("user" + i).innerHTML = "<h1>&nbsp;&nbsp;" + start_data.list[i - 1].username + "<\h1>";

                let time = start_data.list[i - 1].timePlayed;
                let ss = time % 60;
                if(ss < 10) ss = "0" + ss;
                time = Math.floor(time / 60);
                let mm = time % 60;
                if(mm < 10) mm = "0" + mm;
                time = Math.floor(time / 60);
                let hh = time % 60;
                if(hh < 10) hh = "0" + hh;
                time = hh + ":" + mm + ":" + ss;
                document.getElementById("time" + i).innerHTML = "<h1>" + time + "<\h1>";
                
                let points = start_data.list[i - 1].points;
                if(points < 10) 
                    document.getElementById("points" + i).innerHTML = "<h1>Points:&nbsp;&nbsp;&nbsp;" + points + "&nbsp;&nbsp;<\h1>";
                else if(points < 100) 
                    document.getElementById("points" + i).innerHTML = "<h1>Points:&nbsp;" + points + "&nbsp;&nbsp;<\h1>";
                else 
                    document.getElementById("points" + i).innerHTML = "<h1>Points:" + points + "&nbsp;&nbsp;<\h1>";*/
            }
        }

    </script>
</body>
</html>