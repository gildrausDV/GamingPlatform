<!-- Autor: Dimitrije Vujčić -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tournament</title>
    <link rel="stylesheet" href="tournament.css">
</head>
<body>
    <div class="center">
        <div class="notification"><h1 id="notification"></h1></div>
        <!--<div class="notification"><h1 id="notification1"></h1></div>-->
        <br>
        <div id="header_t"><h1>Tournaments:</h1></div>
        <br>
        <div class="tournaments" id="tournaments">
            <!--<div class="tournament">
                <span class="span1"><h1>&nbsp;&nbsp;Bricks</h1></span>
                <span class="span2"><button onclick="join()">Join</button></span>
            </div>-->
        </div>
        <br><br><br>
        <button id="addTournament" onclick="addTournament()">Add tournament</button>
    </div>
    <div class="footer">
        <button id="back" onclick="back()">Back</button>
        <button id="signOut" onclick="signOut_page()">Sign out</button>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
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
            for(let i = 1; i <= start_data.list.length; ++i) {

                /*
                <div class="tournament">
                    <span class="span1"><h1>&nbsp;&nbsp;Bricks</h1></span>
                    <span class="span2"><button onclick="join()">Join</button></span>
                </div>
                */

                document.getElementById("tournaments").innerHTML += "<div class='tournament'>\
                        <span class='span1'><h1>&nbsp;&nbsp;" + start_data.list[i - 1].name + "</h1></span>\
                        <span class='span1'><h1>&nbsp;&nbsp;" + start_data.list[i - 1].date + "</h1></span>\
                        <span class='span1'><h1>&nbsp;&nbsp;" + start_data.list[i - 1].timeStart + "</h1></span>\
                        <span class='span1'><h1>&nbsp;&nbsp;" + start_data.list[i - 1].timeEnd + "</h1></span>\
                        <span class='span2'><button onclick='join(" + start_data.list[i - 1].id + ")'>Join</button></span>\
                    </div>"
                
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
    <!--<script type="text/javascript" src="addTournament.js"></script>-->
</body>
</html>