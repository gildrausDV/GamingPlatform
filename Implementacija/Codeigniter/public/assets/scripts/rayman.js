let startTime;
let elapsedTime = 0;

let hh = 0;
let mm = 0;
let ss = 0;

let s = false;
let started = false;
let paused = false;
let ended = true;

let loaded = false;

let ball_x = 780; // random horizontal position
let ball_y = 300; // random horizontal position

function print_time(txt) {
    document.getElementById("time_display").innerHTML = txt;
    document.getElementById("timeLeft_display").innerHTML = timeLeft + "";
}

var timeInterval;

function pause() {
    if(paused == false) paused = true;
    
}

function time_restart() {
    ss = 0; mm = 0; hh = 0; print_time("00:00:00");
}

function start() {
    if(paused) return;
    points = 0;
    document.getElementById("point_display").innerText = points + "";
    ss = 0; mm = 0; hh = 0; print_time("00:00:00");
    if(loaded == false) {
        loaded = true;
    }
    timeInterval = setInterval(function () {
        ss++;
        timeLeft--;
        if(ss == 60) { ss = 0; mm++; }
        if(mm == 60) { mm = 0; hh++; }
        if(hh < 10) s_hh = "0" + hh;
        else s_hh = hh + "";
        if(mm < 10) s_mm = "0" + mm;
        else s_mm = mm + "";
        if(ss < 10) s_ss = "0" + ss;
        else s_ss = "" + ss;
        print_time(s_hh + ":" + s_mm + ":" + s_ss);
    }, 1000);
    started = true;
    s = true;
    ended = false;
}



var canvas;// = document.getElementById("my-canvas");
var context;// = canvas.getContext("2d");

var nextX = 10;
var nextY = 515;
var rayman;

var img = new Image();
img.src = "images/rayman01.png";
var img_c = new Image();
img_c.src = "images/coin.png";
var img_f = new Image();
img_f.src = "images/drvce.png";
var audio = new Audio("images/coinCollect.mp3");
var cnt = 0;
var tInterval;
var timeIntervalLeft;
var timeIntervalRight;
var timeIntervalUp;
var left = false, right = false;
var startTimeLeft = 15;
var timeLeft = startTimeLeft;

var jump = false;
var jump2 = false;
var start_limit = 15;
var limit = start_limit;
var up = false, down = true;
var fall = false;

var numOfBlocks = 5;
var num = 0;
var blocks = [];

var arr_x = [];//[400, 700, 500, 200, 20];
var arr_y = [];//[700, 600, 500, 500, 400];
var arr_l = [];//[200, 200, 200, 200, 200];
var arr_h = [100, 100, 100, 100, 100];

var numOfCoins = 2;
var num_c = 0;
var coins = [];
var interval;

var arrC_x = [];//[75, 700];
var arrC_y = [];//[175, 250];

var level = 1;
var cell_w = 80;
var cell_h = 100;
var r = 5;
var c = 5;
var points = 0;

function checkCoin() {
    for(let i = 0; i < numOfCoins; ++i) {
        let coin = coins[i];
        // this.x * cell_w + cell_w / 2 - this.width / 2
        let coin_x_start = coin.x * cell_w + cell_w / 2 - coin.width / 2;
        let coin_x_end = coin.x * cell_w + cell_w / 2 + coin.width / 2;
        let coin_y_start = coin.y * cell_h + cell_h / 2 - coin.height / 2;
        let coin_y_end = coin.y * cell_h + cell_h / 2 + coin.height / 2;
        if(coin.collected) continue;
        //if(coin_x_start <= rayman.x && rayman.x <= coin_x_end)
        //    alert(coin.x + " " + coin.y);
        //if(coin_y_start <= rayman.y + 100 && rayman.y + 100 <= coin_y_end)
        //    alert("321");
        if(coin_x_start <= rayman.x + 0.6 * rayman.width && rayman.x + 0.6 * rayman.width <= coin_x_end && coin_y_start <= rayman.y + 0.6 * rayman.height && rayman.y + 0.6 * rayman.height <= coin_y_end) {
            coin.collected = true;
            points += 5;
            document.getElementById("point_display").innerText = points;
            audio.play();
            return true;
        }
    }
    return false;
}

document.addEventListener('keydown', (event) => {
    var name = event.key;
    if(name == "ArrowLeft") {
        if(left) return;
        img.src = "images/rayman02.png";
        left = true;
    } else if(name == "ArrowRight") {
        if(right) return;
        img.src = "images/rayman01.png";
        right = true;
    } else if(name == "ArrowUp") {
        if(jump) return;
        if(up) return;
        up = true;
        down = false;
        jump = true;
    }
}, false);

document.addEventListener('keyup', (event) => {
    var name = event.key;
    if(name == "ArrowLeft") {
        left = false;
        clearInterval(timeIntervalLeft);
    } else if(name == "ArrowRight") {
        right = false;
        clearInterval(timeIntervalRight);
    } else if(name == "ArrowUp") {

    }
}, false);

function Coin(c_x, c_y, c_h) {
    this.x = c_x;//arrC_x[num_c];
    this.y = c_y;//arrC_y[num_c];
    //this.width = 80;
    //this.height = 100;
    //this.radius = 30;
    //alert(cell_w);
    this.height = c_h;//cell_w;
    this.width = 0.8 * this.height;
    this.radius = 50;

    num_c++;

    this.collected = false;

    this.draw = function() {
        if(this.collected) return;
        context.fillStyle = "gold";
        context.beginPath();
        context.drawImage(img_c, this.x * cell_w + cell_w / 2 - this.width / 2, this.y * cell_h + cell_h / 2 - this.height / 2, this.width, this.height);
        //context.arc(this.x, this.y, this.radius, 0, 2 * Math.PI);
        context.closePath();
        context.fill();
    }
}

function Block(a, b, c, d) {
    this.x = a;//arr_x[num];
    this.y = b;//arr_y[num];
    this.length = c;//arr_l[num];
    this.height = d;//arr_h[num];
    num++;

    this.draw = function() {
        context.fillStyle = "green";
        context.beginPath();
        //context.rect(this.x, this.y, this.length, this.height);
        context.drawImage(img_f, this.x * cell_w, this.y * cell_h + cell_h / 1.5, this.length * cell_w, this.height);
        context.closePath();
        context.fill();
    }

}

function Rayman() {
    this.x = 10;
    this.y = canvas.height - 150;

    nextX = 10;
    nextY = canvas.height - 150;

    this.width = 115;
    this.height = 150;

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
        //nextY -= 12;
        nextY -= 1.5 * cell_h / limit;
        if(nextY < 0) nextY = 0;
        cnt++;
        if(cnt >= limit) {
            up = false;
            down = true;
            cnt = 0;
        }
    }

    this.down = function() {
        if(!down) return;
        nextY += 12;
        if(nextY > window.innerHeight - 150) {
            nextY = window.innerHeight - 150;
            jump = false;
            return;
        }
        for(let i = 0 ; i < numOfBlocks; ++i) {
            /*if(blocks[i].x * cell_w <= nextX + 75 && nextX + 75 <= blocks[i].x * cell_w + blocks[i].length * cell_w) 
                alert(1);
            if(blocks[i].y * cell_h + cell_h / 1.5 <= nextY + 110 
            && nextY + 110 <= blocks[i].y * cell_h + cell_h / 1.5 + blocks[i].height) 
                alert(2);*/
            if(blocks[i].x * cell_w <= rayman.x + 75 && rayman.x + 75 <= blocks[i].x * cell_w + blocks[i].length * cell_w && blocks[i].y * cell_h + cell_h / 1.5 <= nextY + 110 
                && nextY + 110 <= blocks[i].y * cell_h + cell_h / 1.5 + blocks[i].height) {
                nextY = blocks[i].y * cell_h + cell_h / 1.5 - 110;
                jump = false;
                return;
            }
        }
    }

    this.draw = function() {
        context.beginPath();
        context.drawImage(img, this.x, this.y, this.width, this.height);
        context.closePath();
    }
}

function clear() {
    context.clearRect(0, 0, window.innerWidth, window.innerHeight);
    //context.clear();
}

function update() {
    if(rayman) rayman.move();
    if(checkCoin()) {
        //coin.collected = true;
        //nextX = 10;
        //nextY = 515;
        //left = right = up = jump =false;
        //down = true;
    }
}

function draw() {
    for(let i = 0; i < numOfBlocks; ++i) 
        blocks[i].draw();
    for(let i = 0; i < numOfCoins; ++i)
        coins[i].draw();
    rayman.draw();
    let w = canvas.width;
    let h = canvas.height;
    let rows = r;
    let cols = c;
    cell_w = w / cols;
    cell_h = h / rows;
    /*for(let i = 0; i < rows; ++i) {
        context.fillStyle = "black"; // ball color
        context.beginPath();
        context.rect(0, i * cell_h, w, 10);
        context.closePath();
        context.fill();
    }
    for(let i = 0; i < rows; ++i) {
        context.fillStyle = "black"; // ball color
        context.beginPath();
        context.rect(cell_w * i, 0, 10, h);
        context.closePath();
        context.fill();
    }*/
}

function animate() {
    clear();
    if(!started || ended) return;
    update();
    draw();
}

var first = true;

function resizeCanvas() {
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;
    if(rayman) {
        rayman.y = canvas.height - 150;
    }
}

function game_end() {
    //(coins);
    if(numOfCoins == 0) {
        //loaded = false;
        return false;
    }
    if(timeLeft == 0) return true;
    let txt = "";
    for(let i = 0; i < coins.length; ++i) {
        txt += coins[i].collected;
        if(!coins[i].collected) {
            //loaded = false;
            return false;
        }
    }
    if(coins == []) alert("ZASTO PRAZNO??");
    //alert("GAME END12334" + " " + txt);
    return true;
}

var start_data;
var maxLvlPts;

function update_data() {
    let w = canvas.width;
    let h = canvas.height;
    let rows = start_data.rows;
    let cols = start_data.cols;
    r = rows;
    c = cols;
    cell_w = w / cols;
    cell_h = h / rows;

    nextX = 10;
    nextY = canvas.height - 150;
    rayman = new Rayman();

    coins = [];
    blocks = [];

    //alert(cell_w + " " + cell_h);
    // coins
    //alert(start_data.coins.length);
    numOfCoins = start_data.coins.length;
    for(let i = 0; i < numOfCoins; ++i) {
        let c_x = start_data.coins[i].x;
        let c_y = start_data.coins[i].y;
        let c_w = 80;
        coins.push(new Coin(c_x, c_y, c_w));
        //alert(start_data.coins[0].x + " " + start_data.coins[0].y);
    }

    // wood
    //alert(start_data.wood.length);
    numOfBlocks = start_data.wood.length;
    for(let i = 0; i < numOfBlocks; ++i) {
        let b_x = start_data.wood[i].x;
        let b_y = start_data.wood[i].y;
        let b_l = start_data.wood[i].len;
        blocks.push(new Block(b_x, b_y, b_l, 100));
    }
}

function send_data() {
    let t = ss + (mm + hh * 60) * 60;
    jQuery.ajax({
        type: "POST",
        url: 'rayman_.php',
        //dataType: 'json',
        data: {functionname: 'save_data', arguments: [t, points, level - 1]},
        //data: {functionname: 'save_data', arguments: points},
    
        success: function (obj, textstatus) {
            if( !('error' in obj) ) {
                v = JSON.parse(obj.result);
                //alert(v + "???");
                //update_data();
            }
            else {
                console.log(obj.error);
                alert(obj.error + " ? " + textstatus);
            }
        },
        error: function(xhr, status, error) {
            alert("2 " + xhr.responseText + " " + error + " " + status);
        }
    });
}

function init() {
    canvas = document.getElementById("my-canvas");
    canvas.addEventListener('click', function() {
        if(started) return;
        start();
        //level = 0;
        $("#my-canvas").css("background-image", 'url("../images/bg.jpg")');
     }, false);
    context = canvas.getContext("2d");
    window.addEventListener('resize', resizeCanvas, false);
    resizeCanvas();

    document.getElementById("timeLeft_display").innerText = timeLeft + "";

    /*jQuery.ajax({
        type: "POST",
        url: 'rayman_.php',
        //dataType: 'json',
        data: {functionname: 'rayman_game_data', arguments: level},
    
        success: function (obj, textstatus) {
            if( !('error' in obj) ) {
                start_data = JSON.parse(obj.result);
                //alert(obj.result + "???");
                update_data();
            }
            else {
                console.log(obj.error);
                alert(obj.error + " ??? " + textstatus);
            }
        },
        error: function(xhr, status, error) {
            alert(error + " ??? " + status);
        }
    });*/

    //update_list();
    //rayman = new Rayman();
    /*for(let i = 0; i <  numOfBlocks; ++i)
        blocks.push(new Block());
    for(let i = 0; i <  numOfCoins; ++i)
        coins.push(new Coin());*/
        let again = false;
        update_list();
    interval = setInterval(function() {
        if(started && (game_end() || again)) {
            update_list();
            if(again) again = false;
            numOfCoins = 0;
            left = right = false;
            timeLeft = startTimeLeft;
            //alert("game end...")
            for(let i = 0; i < numOfCoins; ++i)
                coins[i].collected = false;
            level += 1;
            document.getElementById("level_display").innerText = level + "";
            //alert("daj level: " + (level - 1));
            jQuery.ajax({
                type: "POST",
                url: 'rayman_.php',
                //dataType: 'json',
                data: {functionname: 'rayman_game_data', arguments: level - 1},
            
                success: function (obj, textstatus) {
                    if( !('error' in obj) ) {
                        if(obj.result == false) {
                            // alert("GAME END" + level);
                            // upisi poene u bazu
                            send_data();
                            level = 1;
                            started = false;
                            paused = false;
                            clearInterval(timeInterval);
                            time_restart();
                            again = true;
                            ended = true;
                            $("#my-canvas").css("background-image", 'url("../images/bg_start.png")');
                            update_list();
                            animate();
                        } else {
                            //alert(obj.result);
                            start_data = JSON.parse(obj.result);
                            //alert(obj.result);
                            update_data();
                            loaded = true;
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
        else if(loaded && started && !ended) animate();
        //else if(started) alert(loaded + " " + started + " " + !ended);
    }, 15);
}

function update_list() {
    // get max level and points
    jQuery.ajax({
        type: "POST",
        url: 'rayman_.php',
        //dataType: 'json',
        data: {functionname: 'max_level_and_points', arguments: 1},
        //data: {functionname: 'save_data', arguments: points},
    
        success: function (obj, textstatus) {
            if( !('error' in obj) ) {
                maxLvlPts = JSON.parse(obj.result);
                //alert(1);
                //alert(JSON.stringify(obj.result));
                //alert(2);
                //alert(maxLvlPts.level + " " + maxLvlPts.points);
                //alert(JSON.stringify(maxLvlPts));
                //alert(maxLvlPts);
                let txt = "" + maxLvlPts.level;
                if(maxLvlPts.level == null)
                    txt = "0";
                document.getElementById("maxLevel_display").innerText = txt;
                txt = "" + maxLvlPts.points;
                if(maxLvlPts.points == null)
                    txt = "0";
                document.getElementById("maxPoints_display").innerText = txt;
                //document.getElementById("lista_poena").innerText = "" + maxLvlPts.list;
                var table = document.getElementById("lista_poena");
                table.innerText = "";
                // Create an empty <tr> element and add it to the 1st position of the table:
                var row = table.insertRow(0);

                // Insert new cells (<td> elements) at the 1st and 2nd position of the "new" <tr> element:
                var cell1 = row.insertCell(0);
                var cell2 = row.insertCell(1);

                // Add some text to the new cells:
                cell1.innerHTML = "Username";
                cell2.innerHTML = "Points";

                for(let i = 1; i <= maxLvlPts.list.length; ++i) {
                    var row = table.insertRow(i);

                    // Insert new cells (<td> elements) at the 1st and 2nd position of the "new" <tr> element:
                    var cell1 = row.insertCell(0);
                    var cell2 = row.insertCell(1);

                    // Add some text to the new cells:
                    cell1.innerHTML = maxLvlPts.list[i - 1].username;
                    cell2.innerHTML = maxLvlPts.list[i - 1].points;
                }

            }
            else {
                console.log(obj.error);
                alert(obj.error + " 123 " + textstatus);
            }
        },
        error: function(xhr, status, error) {
            alert("5 " + xhr.responseText + " " + error + " " + status);
        }
    });
}
