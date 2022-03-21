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
    document.getElementById("notification").innerText = "You have successfully added a tournament!";
    timerInterval = setInterval(function start_end() {
        ended = true;
        document.getElementById("notification").innerText = "";
        clearInterval(timerInterval);
    }, 1500);
}

function back() {
    location.href = "tournament.html";
}
function signOut_page() {
    location.href = "index.html";
}