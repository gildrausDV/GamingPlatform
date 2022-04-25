<!-- Autor: Dimitrije Vujčić -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>addTournament</title>
    <link rel="stylesheet" href="addTournament.css">
</head>
<body>
    <div class="header">
        <div class="notification"><h1 id="notification"></h1></div>
    </div>
    <div class="center">
        <div class="addTournament_form">
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
                <input type="submit" value="Add tournament" class="submit" id="myButton" onclick="addTournament1();fn2();">
            </div>
        </div>
    </div>
    <div class="footer">
        <button id="back" onclick="back()">Back</button>
        <button id="signOut" onclick="signOut_page()">Sign out</button>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script>
        var started = false;
        var ended = false;

        function addTournament1() {
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
            } else
                document.getElementById("notification").innerText = "You have successfully added a tournament!";
                let timerInterval = setInterval(function start_end() {
                ended = true;
                document.getElementById("notification").innerText = "";
                clearInterval(timerInterval);
            }, 1500);

            //if(end) return;

            add_tournament();

        }

        function add_tournament() {
            //alert();
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
        }
    </script>
    <!--<script type="text/javascript" src="test.js"></script>-->
</body>
</html>