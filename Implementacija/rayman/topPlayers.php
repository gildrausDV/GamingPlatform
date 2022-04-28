<!-- Autor: Bogdan Jovanović -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Top players</title>
    <link rel="stylesheet" href="topPlayers.css">
</head>
<body>
    <div class="center">
        <!--<div class="notification"><h1 id="notification"></h1></div>-->
        <!--<div class="notification"><h1 id="notification1"></h1></div>-->
        <br>
        <div id="header_t"><h1>Top 10 players in game: Rayman</h1></div>
        <br>
        <div class="games">
            <div class="game 1">
                <span class="user1" id="user1"><h1>&nbsp;&nbsp;</h1></span>
                <span class="time1" id="time1"><h1>&nbsp;&nbsp;</h1></span>
                <span class="points1" id="points1"><h1>&nbsp;&nbsp;&nbsp;&nbsp;</h1></span>
            </div>
            <div class="game 2">
                <span class="user2" id="user2"><h1>&nbsp;&nbsp;</h1></span>
                <span class="time2" id="time2"><h1>&nbsp;&nbsp;</h1></span>
                <span class="points2" id="points2"><h1>&nbsp;&nbsp;&nbsp;&nbsp;</h1></span>
            </div>
            <div class="game 3">
                <span class="user3" id="user3"><h1>&nbsp;&nbsp;</h1></span>
                <span class="time3" id="time3"><h1>&nbsp;&nbsp;</h1></span>
                <span class="points3" id="points3"><h1>&nbsp;&nbsp;&nbsp;&nbsp;</h1></span>
            </div>
            <div class="game 4">
                <span class="user4" id="user4"><h1>&nbsp;&nbsp;</h1></span>
                <span class="time4" id="time4"><h1>&nbsp;&nbsp;</h1></span>
                <span class="points4" id="points4"><h1>&nbsp;&nbsp;&nbsp;&nbsp;</h1></span>
            </div>
            <div class="game 5">
                <span class="user5" id="user5"><h1>&nbsp;&nbsp;</h1></span>
                <span class="time5" id="time5"><h1>&nbsp;&nbsp;</h1></span>
                <span class="points5" id="points5"><h1>&nbsp;&nbsp;&nbsp;&nbsp;</h1></span>
            </div>
            <div class="game 6">
                <span class="user6" id="user6"><h1>&nbsp;&nbsp;</h1></span>
                <span class="time6" id="time6"><h1>&nbsp;&nbsp;</h1></span>
                <span class="points6" id="points6"><h1>&nbsp;&nbsp;&nbsp;&nbsp;</h1></span>
            </div>
            <div class="game 7">
                <span class="user7" id="user7"><h1>&nbsp;&nbsp;</h1></span>
                <span class="time7" id="time7"><h1>&nbsp;&nbsp;</h1></span>
                <span class="points7" id="points7"><h1>&nbsp;&nbsp;&nbsp;&nbsp;</h1></span>
            </div>
            <div class="game 8">
                <span class="user8" id="user8"><h1>&nbsp;&nbsp;</h1></span>
                <span class="time8" id="time8"><h1>&nbsp;&nbsp;</h1></span>
                <span class="points8" id="points8"><h1>&nbsp;&nbsp;&nbsp;&nbsp;</h1></span>
            </div>
            <div class="game 9">
                <span class="user9" id="user9"><h1>&nbsp;&nbsp;</h1></span>
                <span class="time9" id="time9"><h1>&nbsp;&nbsp;</h1></span>
                <span class="points9" id="points9"><h1>&nbsp;&nbsp;&nbsp;&nbsp;</h1></span>
            </div>
            <div class="game 10">
                <span class="user10" id="user10"><h1>&nbsp;&nbsp;</h1></span>
                <span class="time10" id="time10"><h1>&nbsp;&nbsp;</h1></span>
                <span class="points10" id="points10"><h1>&nbsp;&nbsp;&nbsp;&nbsp;</h1></span>
            </div>
        </div>
        <br><br><br>
    </div>
    <div class="footer">
        <button id="change" onclick="changeGame()">Change game</button>
        <button id="backToGames" onclick="backToGames()">Back to games</button>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script>
    
        var start_data;

        //alert("sending...");
        jQuery.ajax({
            type: "POST",
            url: 'topPlayers_.php',
            //dataType: 'json',
            data: {functionname: 'get_topPlayers', arguments: 1},
        
            success: function (obj, textstatus) {
                if( !('error' in obj) ) {
                    start_data = obj.result;
                    //alert(obj.result.list[1].points + "???");
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
        //alert("sent");
        function changeGame() {
            location.href = "gamingHistory.html";
        }
        function backToGames() {
            location.href = "play.html";
        }

        function update_data() {
            //alert(start_data);
            for(let i = 1; i <= start_data.list.length; ++i) {
                document.getElementById("user" + i).innerHTML = "<h1>&nbsp;&nbsp;" + start_data.list[i - 1].username + "<\h1>";

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
                    document.getElementById("points" + i).innerHTML = "<h1>Points:" + points + "&nbsp;&nbsp;<\h1>";
            }
        }

    </script>
</body>
</html>