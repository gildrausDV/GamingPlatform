// <!-- Autor: Dimitrije Vujčić 2019/0341 -->

var canvas;
var context;

var nextX = 10;
var nextY = 515;
var rayman = null;

var numOfBlocks = 0;
var blocks = [];

var numOfCoins = 0;
var coins = [];
var interval;

var level = 1;
var cell_w = 80;
var cell_h = 100;
var r = 5;
var c = 5;
var points = 0;

var interval = null;
var timeInterval = null;

var left = false, right = false;
var up = false, down = true;
var fall = false, jump = false;
var limit = 15, cnt = 0;

var start_data = null;
var next_level = true;

var started = false;

var game_end = false;
var loaded = false;

var timeLeft_start = 15;
var hh = 0, mm = 0, ss = 0, timeLeft = timeLeft_start;

var img = new Image();
img.src = "/images/rayman01.png";
var img_c = new Image();
img_c.src = "/images/coin.png";
var img_f = new Image();
img_f.src = "/images/drvce.png";
var audio = new Audio("/images/coinCollect.mp3");

function print_time(txt) {
    document.getElementById("time_display").innerHTML = txt;
    document.getElementById("timeLeft_display").innerHTML = timeLeft + "";
}

function init() {
    update_list();
    canvas = document.getElementById("my-canvas");

    context = canvas.getContext("2d");
    window.addEventListener('resize', resizeCanvas, false);
    resizeCanvas();

    canvas.addEventListener('click', function() {
        if(started) return;
        $("#my-canvas").css("background-image", 'url("/images/bg.jpg")');
        started = next_level = true;
        game_end = loaded = false;
        hh = mm = ss = points = 0; timeLeft = timeLeft_start;

        document.getElementById("timeLeft_display").innerHTML = timeLeft + "";
        $("#point_display").text('0');
        
        timeInterval = setInterval(function () {
            ss++;
            timeLeft--;
            if(timeLeft == 0) game_end = true;
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

        interval = setInterval(function () {
            if(game_end) {
                clear();
                $("#my-canvas").css("background-image", 'url("/images/bg_start_rayman.png")');
                started = false;

                send_data();
                update_list();

                level = 1;
                $("#level_display").text(level);

                clearInterval(interval);
                clearInterval(timeInterval);
            } else if(started && next_level) {
                next_level = false;
                load_map();
            } else if(started && loaded) {
                checkCoin();
                animate();
                if(allCoinsCollected()) {
                    level++;
                    $("#level_display").text(level);
                    next_level = true;
                    loaded = false;
                    timeLeft = timeLeft_start;
                    document.getElementById("timeLeft_display").innerHTML = timeLeft + "";
                    left = right = down = up = fall = jump = false; cnt = 0;
                }
            }
        }, 15);

     }, false);
}


function send_data() {
    let t = ss + (mm + hh * 60) * 60;
    let date = new Date();
    $.ajax({
        method: "POST",
        url: window.location.origin + "/Games/save_data/Rayman",
        data: {arguments: [t, points, level - 1, date.getFullYear(), date.getMonth() + 1, date.getDate(), date.getHours(), date.getMinutes(), date.getSeconds()]},
    
        success: function (obj, textstatus) {
            if( !(obj == "") ) {
                try {
                    let v = JSON.parse(obj.result);
                } catch(Exception) {
                    return;
                }
                //alert(v + "???");
                //update_data();
            }
            else {
                //console.log(obj.error);
                //alert(obj.error + " ? " + textstatus);
            }
        },
        error: function(xhr, status, error) {
            alert("2 " + xhr.responseText + " " + error + " " + status);
        }
    });
}

function update_list() {
    // get max level and points
    $.ajax({
        method: "GET",
        url: window.location.origin + "/Games/getList/Rayman",
        success: function (obj, textstatus) {
            //alert(obj);
            try {
                maxLvlPts = JSON.parse(obj).result;
            } catch(Exception) {
                return;
            }
            //alert(maxLvlPts + " LIST LENGTH: " + maxLvlPts.list.length);
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
        },
        error: function(xhr, status, error) {
            alert("5 " + xhr.responseText + " " + error + " " + status);
        }
    });
}

function allCoinsCollected() {
    for(let i = 0; i < coins.length; ++i) {
        if(!coins[i].collected) return false;
    }
    return true;
}

function load_map() {
    $.ajax({
        method: "GET",
        url: window.location.origin + "/Games/getLevel/Rayman",
        data: {arguments: level},
    
        success: function (obj, textstatus) {
            if(obj == "") {
                game_end = true;
            }  else {
                //alert(obj);
                start_data = JSON.parse(JSON.parse(obj).result.level_desc);
                update_data();
                loaded = true;
            }
        },
        error: function(xhr, status, error) {
            alert("1" + xhr.responseText + " " + error + " " + status);
        }
    });
}

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

function checkCoin() {
    for(let i = 0; i < numOfCoins; ++i) {
        let coin = coins[i];
        let coin_x_start = coin.x * cell_w + cell_w / 2 - coin.width / 2;
        let coin_x_end = coin.x * cell_w + cell_w / 2 + coin.width / 2;
        let coin_y_start = coin.y * cell_h + cell_h / 2 - coin.height / 2;
        let coin_y_end = coin.y * cell_h + cell_h / 2 + coin.height / 2;
        if(coin.collected) continue;
        if(coin_x_start <= rayman.x + 0.6 * rayman.width && rayman.x + 0.6 * rayman.width <= coin_x_end && coin_y_start <= rayman.y + 0.6 * rayman.height && rayman.y + 0.6 * rayman.height <= coin_y_end) {
            coin.collected = true;
            points += 5;
            document.getElementById("point_display").innerText = points;
            //audio.play();
            new Audio("/images/coinCollect.mp3").play();
            return true;
        }
    }
    return false;
}

document.addEventListener('keyup', (event) => {
    var name = event.key;
    if(name == "ArrowLeft") {
        event.preventDefault();
        left = false;
    } else if(name == "ArrowRight") {
        event.preventDefault();
        right = false;
    } else if(name == "ArrowUp") {
        event.preventDefault();
    } else if(name = "ArrowDown") {
        event.preventDefault();
    }
}, false);

document.addEventListener('keydown', (event) => {
    var name = event.key;
    if(name == "ArrowLeft") {
        event.preventDefault();
        if(left) return;
        img.src = "/images/rayman02.png";
        left = true;
    } else if(name == "ArrowRight") {
        event.preventDefault();
        if(right) return;
        img.src = "/images/rayman01.png";
        right = true;
    } else if(name == "ArrowUp") {
        event.preventDefault();
        if(jump) return;
        if(up) return;
        up = true;
        down = false;
        jump = true;
    } else if(name = "ArrowDown") {
        event.preventDefault();
    }
}, false);

function Coin(c_x, c_y, c_h) {
    this.x = c_x;
    this.y = c_y;
    this.height = c_h;
    this.width = 0.8 * this.height;
    this.radius = 50;

    this.collected = false;

    this.draw = function() {
        if(this.collected) return;
        context.fillStyle = "gold";
        context.beginPath();
        context.drawImage(img_c, this.x * cell_w + cell_w / 2 - this.width / 2, this.y * cell_h + cell_h / 2 - this.height / 2, this.width, this.height);
        context.closePath();
        context.fill();
    }
}

function Block(a, b, c, d) {
    this.x = a;
    this.y = b;
    this.length = c;
    this.height = d;

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
    if(rayman) {
        rayman.move();
    }
}

function draw() {
    for(let i = 0; i < numOfBlocks; ++i) 
        blocks[i].draw();
    for(let i = 0; i < numOfCoins; ++i)
        coins[i].draw();
    if(rayman) rayman.draw();
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
    update();
    draw();
}

function resizeCanvas() {
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;
    if(rayman) {
        rayman.y = canvas.height - 150;
    }
}