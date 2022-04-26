
var numOfFireBalls = 0;
var numOfCoins = 0;
var num = 0;
var fireBalls = [];

var arr_x = [];
var arr_y = [];
var arr_r = [];

var r = 0;
var c = 0;

var canvas;// = document.getElementById("my-canvas");
var context;// = canvas.getContext("2d");

var nextX = 10;
var nextY = 275;
var rayman;
var coin;

var img = new Image();
img.src = "../images/rayman01.png";
var img_c = new Image();
img_c.src = "../images/coin.png";
var img_fb1 = new Image();
img_fb1.src = "../images/fireBall_up.png";
var img_fb2 = new Image();
img_fb2.src = "../images/fireBall_down.png";
var audio = new Audio("../images/coinCollect.mp3");
var cnt = 0;
var interval;

var left = false;
var right = false;
var up = false;
var down = false;
var num_c = 0;

var cell_w;
var cell_h;

var level = 0;
var start_data;

var started = false;

document.addEventListener('keydown', (event) => {
    var name = event.key;
    if(name == "ArrowLeft") {
        if(left) return;
        img.src = "../images/rayman02.png";
        left = true;
    } else if(name == "ArrowRight") {
        if(right) return;
        img.src = "../images/rayman01.png";
        right = true;
    } else if(name == "ArrowUp") {
        if(up) return;
        up = true;
    } else if(name == "ArrowDown") {
        if(down) return;
        down = true;
    }
}, false);

document.addEventListener('keyup', (event) => {
    var name = event.key;
    if(name == "ArrowLeft") {
        left = false;
    } else if(name == "ArrowRight") {
        right = false;
    } else if(name == "ArrowUp") {
        up = false;
    } else if(name == "ArrowDown") {
        down = false;
    }
}, false);

function Coin() {
    this.x = 810;
    this.y = 315;
    this.width = 80;
    this.height = 100;
    this.radius = 30;

    num_c++;

    this.collected = false;

    this.draw = function() {
        if(this.collected) return;
        context.fillStyle = "gold";
        context.beginPath();
        context.drawImage(img_c, this.x, this.y, this.width, this.height);
        //context.arc(this.x, this.y, this.radius, 0, 2 * Math.PI);
        context.closePath();
        context.fill();
    }
}

function FireBall(x, dir) {
    this.id = num;
    this.x = x;
    //this.y = arr_y[num];
    this.y = parseInt(Math.random() * 500);
    this.radius = arr_r[num];
    //this.inc = 0.5 - Math.random();
    //if(this.inc < 0) this.inc = -5;
    //else this.inc = 5;
    if(num % 2) this.inc = -5;
    else this.inc = 5;
    num++;

    this.draw = function() {
        context.fillStyle = "gold";
        context.beginPath();
        //context.arc(this.x, this.y, this.radius, 0, 2*Math.PI);
        let img_fb;
        if(this.inc < 0) img_fb = img_fb1;
        else img_fb = img_fb2;
        context.drawImage(img_fb, this.x, this.y, 150, 200);
        context.closePath();
        context.fill();
    }

    this.move = function() {
        if(-150 < this.y && this.y < window.innerHeight) this.y += this.inc;
        else {
            if(this.inc < 0) this.y = arr_y[this.id]; else this.y = -100;
        }
    }

}

function Rayman() {
    this.x = 0;
    this.y = 0;

    this.move = function() {
        this.left();
        this.right();
        this.up();
        this.down();
        this.x = nextX;
        this.y = nextY;
    }

    this.left = function() {
        if(!left) return;
        nextX -= 9;
        if(nextX < 0) nextX = 0;
    }

    this.right = function() {
        if(!right) return;
        nextX += 9;
        if(nextX > window.innerWidth - 150) nextX = window.innerWidth - 150;
    }

    this.up = function() {
        if(!up) return;
        nextY -= 12;
        if(nextY < 0) nextY = 0;
    }

    this.down = function() {
        if(!down) return;
        nextY += 12;
        if(nextY > window.innerHeight - 150) {
            nextY = window.innerHeight - 150;
        }
    }

    this.draw = function() {
        context.beginPath();
        context.drawImage(img, this.x, this.y, 115, 150);
        context.closePath();
    }
}

function clear() {
    context.clearRect(0, 0, window.innerWidth, window.innerHeight);
}

function update() {
    rayman.move();
    for(let i = 0; i < numOfFireBalls; ++i)
        fireBalls[i].move();
}

function draw() {
    coin.draw();
    rayman.draw();
    for(let i = 0; i < numOfFireBalls; ++i)
        fireBalls[i].draw();

    let w = canvas.width;
    let h = canvas.height;
    let rows = r;
    let cols = c;
    cell_w = w / cols;
    cell_h = h / rows;

    // drawing matrix... do not delete!!!
    /*for(let i = 0; i < rows; ++i) {
        context.fillStyle = "black"; // ball color
        context.beginPath();
        context.rect(0, i * cell_h, w, 10);
        context.closePath();
        context.fill();
    }

    context.fillStyle = "black"; // ball color
    context.beginPath();
    context.rect(0, 5 * cell_h - 10, w, 10);
    context.closePath();
    context.fill();

    for(let i = 0; i < cols; ++i) {
        context.fillStyle = "black"; // ball color
        context.beginPath();
        context.rect(cell_w * i, 0, 10, h);
        context.closePath();
        context.fill();
    }
    context.fillStyle = "black"; // ball color
    context.beginPath();
    context.rect(cell_w * 10 - 10, 0, 10, h);
    context.closePath();
    context.fill(); */
}

function animate() {
    clear();
    update();
    draw();
}

function resizeCanvas() {
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;
}

function init() {
    canvas = document.getElementById("my-canvas");
    context = canvas.getContext("2d");
    window.addEventListener('resize', resizeCanvas, false);
    resizeCanvas();
    rayman = new Rayman();
    coin = new Coin();
    for(let i = 0; i < numOfFireBalls; ++i)
        fireBalls.push(new FireBall());
    interval = setInterval(function() {
        animate();
        if(game_end()) {
            load_map();
        }
    }, 15);
}

function game_end() {
    if(started == false) {
        started = true;
        return true;
    }
    return false;
}

function load_map() {
    level++;
    jQuery.ajax({
        type: "POST",
        url: 'bricks_.php',
        //dataType: 'json',
        data: {functionname: 'bricks_game_data', arguments: level},
    
        success: function (obj, textstatus) {
            if( !('error' in obj) ) {
                if(obj.result == false) {
                    alert("GAME END");
                    // upisi poene u bazu
                } else {
                    alert(obj.result);
                    start_data = JSON.parse(obj.result);
                    r = start_data.rows;
                    c = start_data.cols;
                    numOfCoins = start_data.coins.length;
                    numOfFireBalls = start_data.wood.length;
                    alert(start_data);
                    create_map();
                }
            }
            else {
                console.log(obj.error);
                alert(obj.error + "  " + textstatus);
            }
        },
        error: function(xhr, status, error) {
            alert("1" + xhr.responseText + " " + error + " " + status);
        }
    });
}

function create_map() {
    // zavrsi ovo
}