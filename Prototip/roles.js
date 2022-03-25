// Autor: Dimitrije Vujčić

function back() {
    location.href = "play.html";
}

function signOut() {
    location.href = "sign.html";
}

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
    document.getElementById("notification").innerText = "Role changed successfully!";
    timerInterval = setInterval(function start_end() {
        ended = true;
        document.getElementById("notification").innerText = "";
        clearInterval(timerInterval);
    }, 1500);
}