let started = false;
let ended = false;

var timerInterval;
var timerInterval1;
var write;

function join() {
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
}

function back() {
    location.href = "index.html";
}
function signOut_page() {
    location.href = "index.html";
}
function addTournament() {
    location.href = "addTournament.html";
}