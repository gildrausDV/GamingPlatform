let startTime;
let elapsedTime = 0;

let hh = 0;
let mm = 0;
let ss = 0;

let started = false;
let paused = false;
let ended = true;

let loaded = false;

let ball_x = 780; // random horizontal position
let ball_y = 300; // random horizontal position

var activities = document.getElementById("selector");
var last;

activities.addEventListener("change", function() {
    if(activities.value == "1") {
        acc();
    } else if(activities.value == "2") {
        r();
    } else if(activities.value == "3") {
        h();
    }
});

function acc() {
    location.href = "accountSettings.html";
}
function h() {
    location.href = "history.html";
}
function r() {
    location.href = "roles.html";
}
function back() {
    location.href = "play.html"
}
function tournament() {
    location.href = "tournament.html";
}
function addLevel() {
    location.href = "addLevel.html";
}
function signIn() {
    location.href = "play.html";
}
function signOut_page() {
    location.href = "sign.html";
}
function game1() {
    location.href = "game1.html";
}
function chooseGamePage() {
    location.href = "play.html";
}
function addLevel() {
    location.href = "addLevel.html";
}
function print_time(txt) {
    document.getElementById("time_display").innerHTML = txt;
}

timerInterval = setInterval(function printTime() {
    if(started == false || paused == true) return;
    ss++;
    if(ss == 60) {
        mm++;
        ss = 0;
    }
    if(mm == 60) {
        hh++;
        mm = 0;
    }
    let h = "" + hh;
    let m = "" + mm;
    let s = "" + ss;
    if(h.length == 1) h = "0" + hh;
    if(m.length == 1) m = "0" + mm;
    if(s.length == 1) s = "0" + ss;
    
    print_time(h + ":" + m + ":" + s);
}, 1000);

function pause() {
    if(paused == false) paused = true;
    else paused = false;
}

function start() {
    ss = 0; mm = 0; hh = 0; print_time("00:00:00");
    if(loaded == false) {
        loaded = true;
        //document.getElementById("center").innerHTML = "<canvas id=\"my-canvas\"></canvas>"
    }
    if(ended == true) {
        for(let i = 0; i < numOfBricks; ++i) bricks[i].destroyed = false;
        table.x = 700;
        table.y = 650;
        ball.x = ball_x;
        ball.y = ball_y;
    }
    started = true;
    ended = false;
}

document.addEventListener('keydown', (event) => {
    var name = event.key;
    if(event.code == "Space") start();
    else if(name == "ArrowLeft") table.move(true, false);
    else if(name == "ArrowRight") table.move(false, true);
    else if(name == "Space character") alert("???");
  }, false);

//canvas properties
var canvas = document.getElementById("my-canvas");
var context = canvas.getContext("2d");

//animation things
var fps = 60;
var updateTime = 1000 / fps;

//easy variables for easy coding life
var _PI = Math.PI;
var _sin = Math.sin;
var _cos = Math.cos;
var _random = Math.random;
var oneDegreeOnRadian = _PI / 180;

// ball
var ball;
var table;
let bricks = [];
let numOfBricks = 0;

function Brick(length) {
    if(bricks.length == 0) this.x = 2;
    else this.x = bricks[bricks.length - 1].x + length + 2;
    this.y = 0;
    this.length = length;
    this.destroyed = false;

    this.draw = function() {
        if(this.destroyed) return;
        context.fillStyle = "tomato"; // ball color
        context.beginPath();
        context.rect(this.x, this.y, length, 50);
        context.closePath();
        context.fill();
    }
}


function Table(length) {

    this.x = 700;
    this.y = 650;
    this.length = length;

    this.diffX = 30;

    this.move = function(left, right) {
        /*if(started == false || paused == true) return;
        if(left == true) {
            this.x -= this.diffX;
            if(this.x < 0) this.x = 0;
        } else if(right == true) {
            this.x += this.diffX;
            if(this.x > 1350) this.x = 1350;
        }
        this.draw();*/
    }

    this.draw = function() {
        context.fillStyle = "tomato"; // ball color
        context.beginPath();
        context.rect(this.x, this.y, length, 50);
        context.closePath();
        context.fill();
    }
}

//Our bouncing ball class
function Ball(radius, speed) {
    this.radius = (radius) ? (radius) : (20); // ball size
    this.speed = (speed) ? (speed) : (10); // ball speed
    this.x = ball_x;
    this.y = ball_y;

    var angleRadian = _random() * 360 * oneDegreeOnRadian; // random move direction

    this.xSpeed = _cos(angleRadian) * this.speed; // translate speed on x axis
    this.ySpeed = _sin(angleRadian) * this.speed; // translate speed on y axis

    this.xDirection = (_random < 0.5) ? (1) : (-1); // random first x direction
    this.yDirection = (_random < 0.5) ? (1) : (-1); // random first x direction

    this.move = function() {
        /*if(started == false || paused == true) return;
        var nextX = this.x + (this.xDirection * this.xSpeed); // predict next x position
        var nextY = this.y + (this.yDirection * this.ySpeed); // predict next y position

        if(nextY >= table.y - 50) {
            if(table.x <= nextX  && nextX <= table.x + table.length) this.yDirection *= -1;
            else if(nextY >= table.y) {
                started = false;
                ended = true;
                //this.x = (_random() * (canvas.width - (2 * this.radius))) + this.radius;
                //this.y = (_random() * (canvas.height - (2 * this.radius))) + this.radius;
                this.yDirection *= -1;
            }
        }

        //if(nextY >= table.y - 50 && table.x <= nextX  && nextX <= table.x + table.length) this.yDirection *= -1;

        for(let i = 0; i < numOfBricks; ++i) {
            if(bricks[i].destroyed == false && bricks[i].x <= nextX && nextX <= bricks[i].x + bricks[i].length && bricks[i].y <= nextY && nextY <= bricks[i].y + 100) {
                bricks[i].destroyed = true;
                this.yDirection *= -1;
            }
        }

        //if(this.y >= table.y - 150 && table.x < this.x && this.x < table.//x) 
        //    this.yDirection *= -1;

        if(((nextX - this.radius) < 0) || ((nextX + this.radius) > canvas.width - 1)) { // if collide with left/right screen
            this.xDirection *= -1; // change x direction
        }
        if(((nextY - this.radius) < 0) || ((nextY + this.radius) > canvas.height - 1)) { // if collide with top/bottom screen
            this.yDirection *= -1; // change y direction
        }

        this.x += this.xDirection * this.xSpeed; // update x
        this.y += this.yDirection * this.ySpeed; // update y */
    }

    this.draw = function() {
        context.fillStyle = "tomato"; // ball color
        context.beginPath();
        context.arc(this.x, this.y, this.radius, 0, _PI * 2, false); // draw circle
        context.closePath();
        context.fill(); // draw ball on canvas
    }
}

function clear() {
    context.clearRect(0, 0, canvas.width, canvas.height); // clear canvas
}

function update() {
    ball.move(); // move ball
}

function draw() {
    ball.draw();
    table.draw();
    for(let i = 0; i < numOfBricks; ++i) bricks[i].draw();
}

function animate() {
    clear();
    update();
    draw();
}

// update canvas size when resizing window 
function resizeCanvas() {
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;
}

//initialize canvas
function init() {
    window.addEventListener('resize', resizeCanvas, false);
    resizeCanvas();
    ball = new Ball(50, 10);
    table = new Table(200);
    numOfBricks = 6;
    for(let i = 0; i < numOfBricks; ++i)
        bricks.push(new Brick(253));
    //run animation
    setInterval(function() {
        animate();
    }, updateTime);
}