// Autor: Dimitrije Vujčić

var started = false;
var ended = false;

function addLevel() {
    if(ended = true) {
        ended = false;
        started = false;
    }
    if(started == true) {
        return;
    }
    started = true;
    document.getElementById("notification").innerText = "New level successfully added!";
    timerInterval = setInterval(function start_end() {
        ended = true;
        document.getElementById("notification").innerText = "";
        clearInterval(timerInterval);
    }, 1500);
}