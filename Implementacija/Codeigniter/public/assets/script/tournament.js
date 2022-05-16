var started = false;
var ended = false;

$(document).ready(function () {
    
    $("#addTournament").click(add_tournament);

});

function add_tournament() {
    alert();
    let game = document.getElementById("games").value;
    let numPlayers = document.getElementById("max_players").value;
    let date = document.getElementById("date").value;
    let timeStart = document.getElementById("timeStart").value;
    let timeEnd = document.getElementById("timeEnd").value;
    //alert(game + " " + numPlayers + " " + date + " " + timeStart + " " + timeEnd);

    alert("sending...");
    jQuery.ajax({
        type: "POST",
        url: 'tournament__.php',
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