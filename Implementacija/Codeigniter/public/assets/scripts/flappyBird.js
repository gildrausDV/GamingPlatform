// <!-- Autor: Dimitrije Vujčić 2019/0341 -->

var numOfFireBalls = 0;
var fireBalls = [];

var nextX = 0;
var nextY = 275;
var rayman;

var r = 5;
var c = 5;

var numOfCoins = 0;
var coins = [];

var img_p = new Image();
img_p.src = "/images/drvce.png";
var img = new Image();
img.src = "/images/bird3.png";
var img_c = new Image();
img_c.src = "/images/coin.png";
var img_fb1 = new Image();
img_fb1.src = "/images/fireBall_up.png";
var img_fb2 = new Image();
img_fb2.src = "/images/fireBall_down.png";
var audio = new Audio("/images/coinCollect.mp3");
var cnt = 0;
var interval = null;
var timeInterval = null;

let cnt_jump = 0;
let limit = 25;
let curr_limit = 0;

var context;
var canvas;

var started = false;

var timeLeft_start = 15;
var hh = 0, mm = 0, ss = 0, timeLeft = timeLeft_start;
var level = 1, points = 0;

var left = right = down = up = fall = jump = false;
var cnt = 0;

var game_end = false, loaded = false, next_level = false;

function print_time(txt) {
    document.getElementById("time_display").innerHTML = txt;
    document.getElementById("timeLeft_display").innerHTML = timeLeft + "";
}

document.addEventListener('keydown', (event) => {
    var name = event.key;
    if(name == "ArrowLeft") {
        event.preventDefault();
        if(left) return;
        img.src = "/images/bird3.png";
        left = true;
    } else if(name == "ArrowRight") {
        event.preventDefault();
        if(right) return;
        img.src = "/images/bird3.png";
        right = true;
    } else if(name == "ArrowUp") {
        //curr_limit += limit;
        event.preventDefault();
        cnt_jump = 0;
        up = true;
    } else if(name == "ArrowDown") {
        event.preventDefault();
    }
}, false);

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
    } else if(name == "ArrowDown") {
        event.preventDefault();
    }
}, false);

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
        left = right = down = up = fall = jump = false; cnt = 0;

        document.getElementById("time_display").innerHTML = "00:00:00";
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
                //alert("GAME END: " + level);
                clear();
                $("#my-canvas").css("background-image", 'url("/images/bg_start_flappyBird.png")');
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
                checkFireBalls();
            }
        }, 15);

     }, false);
}

function checkCoin() {
    for(let i = 0; i < numOfCoins; ++i) {
        let coin = coins[i];
        let coin_x_start = coin.x * cell_w;
        let coin_x_end = coin_x_start + cell_w / 1.3;
        let coin_y_start = coin.y * cell_h;
        let coin_y_end = coin_y_start + cell_h / 1.3;
        if(coin.collected) continue;
        //alert(coin_x_start + " " + rayman.x + " " + coin_x_end);
        // context.drawImage(img_c, this.x * cell_w + cell_w / 4, this.y * cell_h + cell_h / 5, cell_w / 1.5, cell_h / 1.5);
        /*if(coin_x_start <= rayman.x && rayman.x <= coin_x_end) 
            alert(coin_x_start + " " + coin_x_end + " " + coin.x + " " + coin.y);
        if(coin_y_start <= rayman.y + 100 && rayman.y + 100 <= coin_y_end)
            alert(coin_x_start + " " + coin_x_end);
        if(coin_x_start <= rayman.x + 0.6 * rayman.width && rayman.x + 0.6 * rayman.width <= coin_x_end && coin_y_start <= rayman.y + 0.6 * rayman.height && rayman.y + 0.6 * rayman.height <= coin_y_end) {
            coin.collected = true;
            points += 5;
            document.getElementById("point_display").innerText = points;
            audio.play();
            return true;
        }*/
        let rayman_x_start = rayman.x + rayman.width / 2;
        let rayman_x_end = rayman.x + rayman.width / 2;
        let rayman_y_start = rayman.y + rayman.height / 2;
        let rayman_y_end = rayman.y + rayman.height / 2;
        //if(coin_x_start <= rayman_x_start && rayman_x_start <= coin_x_end || coin_x_start <= rayman_x_end && rayman_x_end <= coin_x_end) 
        //    alert(coin_x_start + " " + coin_x_end + " " + rayman_x_start + " " + rayman_x_end);
        //if(coin_y_start <= rayman_y_start && rayman_y_start <= coin_y_end || coin_y_start <= rayman_y_end && rayman_y_end <= coin_y_end)
        //    alert(coin_x_start + " " + coin_x_end);
        let bool_x = coin_x_start <= rayman_x_start && rayman_x_start <= coin_x_end || coin_x_start <= rayman_x_end && rayman_x_end <= coin_x_end;
        let bool_y = coin_y_start <= rayman_y_start && rayman_y_start <= coin_y_end || coin_y_start <= rayman_y_end && rayman_y_end <= coin_y_end;
        if(bool_x && bool_y) {
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

function checkFireBalls() {
    for(let i = 0; i < numOfFireBalls; ++i) {
        let coin = fireBalls[i];

        /*let coin_x_start = coin.x + cell_w / 2 - coin.width;
        let coin_x_end = coin.x + cell_w / 2 + coin.width;
        let coin_y_start = coin.y + cell_h / 2 - coin.height / 2;
        let coin_y_end = coin.y + cell_h / 2 + coin.height / 2;*/

        /*let coin_x_start = coin.x * cell_w + cell_w;
        let coin_x_end = coin_x_start + 150;
        let coin_y_start = coin.y;
        let coin_y_end = coin_y_start + 125;*/

        let coin_x_start = coin.x * cell_w;
        let coin_x_end = coin_x_start + cell_w / 1.3;
        let coin_y_start = coin.y + cell_h / 3;
        let coin_y_end = coin_y_start + cell_h / 1.2;

        let rayman_x_start = rayman.x + rayman.width / 2;
        let rayman_x_end = rayman.x + rayman.width / 2;
        let rayman_y_start = rayman.y + rayman.height / 2;
        let rayman_y_end = rayman.y + rayman.height / 2;
        //if(coin_x_start <= rayman_x_start && rayman_x_start <= coin_x_end || coin_x_start <= rayman_x_end && rayman_x_end <= coin_x_end) 
        //    alert(coin_x_start + " " + coin_x_end + " " + rayman_x_start + " " + rayman_x_end);
        //if(coin_y_start <= rayman_y_start && rayman_y_start <= coin_y_end || coin_y_start <= rayman_y_end && rayman_y_end <= coin_y_end)
        //    alert(coin_x_start + " " + coin_x_end);
        let bool_x = coin_x_start <= rayman_x_start && rayman_x_start <= coin_x_end || coin_x_start <= rayman_x_end && rayman_x_end <= coin_x_end;
        //if(bool_x) 
        //    alert(coin_y_start + " " + coin_y_end);
        let bool_y = coin_y_start <= rayman_y_start && rayman_y_start <= coin_y_end || coin_y_start <= rayman_y_end && rayman_y_end <= coin_y_end;

        //if(bool_y)
        //    alert(coin_y_start + " < " + rayman_y_start + ", " + rayman_y_end + " < " + coin_y_end);

        if(bool_x && bool_y) {
            game_end = true;
            //send_data();
            //update_list();
            //animate();
            //clearInterval(timeInterval);
            return true;
        }

        //alert(coin_x_start + " " + rayman.x + " " + coin_x_end);
        //if(coin_x_start <= rayman.x && rayman.x <= coin_x_end)
        //    alert(coin.x + " " + coin.y);
        //if(coin_y_start <= rayman.y + 100 && rayman.y + 100 <= coin_y_end)
        //    alert("321");
        /*if(coin_x_start <= rayman.x + 0.6 * rayman.width && rayman.x + 0.6 * rayman.width <= coin_x_end && coin_y_start <= rayman.y + 0.6 * rayman.height && rayman.y + 0.6 * rayman.height <= coin_y_end) {
            //alert("FireBall")
            end = true;
            send_data();
            update_list();
            animate();
            clearInterval(timeInterval);
            return true;
        }*/
    }
    return false;
}

function allCoinsCollected() {
    for(let i = 0; i < coins.length; ++i) {
        if(!coins[i].collected) return false;
    }
    return true;
}

function Coin(x, y) {
    this.x = x;
    this.y = y;
    this.width = 80;
    this.height = 100;
    this.radius = 30;

    this.collected = false;

    this.draw = function() {
        
        
        if(this.collected) return;
        context.fillStyle = "gold";
        context.beginPath();
        //context.drawImage(img_c, this.x * cell_w + cell_w / 4, this.y * cell_h + cell_h / 5, this.width, this.height);
        context.drawImage(img_c, this.x * cell_w + cell_w / 4, this.y * cell_h + cell_h / 5, cell_w / 1.5, cell_h / 1.5);
        //context.arc(this.x, this.y, this.radius, 0, 2 * Math.PI);
        context.closePath();
        context.fill();
    }
}

function FireBall(x, dir) {
    this.id = num;
    this.x = x;
    //this.y = arr_y[num];
    //this.y = parseInt(Math.random() * 500);
    this.y = 100;
    //this.radius = arr_r[num];
    //this.inc = 0.5 - Math.random();
    //if(this.inc < 0) this.inc = -5;
    //else this.inc = 5; fireBalls.push(new FireBall(cell_w * start_data.wood[i].y + cell_w, start_data.wood[i].direction));

    this.width = cell_w;
    this.height = cell_h * 1.5;

    if(dir == "up") this.inc = -5;
    else this.inc = 5;
    num++;

    this.draw = function() {
        context.fillStyle = "gold";
        context.beginPath();
        //context.arc(this.x, this.y, this.radius, 0, 2*Math.PI);
        let img_fb;
        if(this.inc < 0) img_fb = img_fb1;
        else img_fb = img_fb2;
        context.drawImage(img_fb, cell_w * this.x, this.y, this.width, this.height);
        context.closePath();
        context.fill();
    }

    this.move = function() {
        if(-150 < this.y && this.y < window.innerHeight) this.y += this.inc;
        else {
            if(this.inc < 0) this.y = r * cell_h - 50; else this.y = -100;
        }
    }

}

function Rayman() {
    this.x = 0;
    this.y = 0;

    this.width = cell_w * 1.5;//220;
    this.height = cell_h * 1.5;//260;

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
        if(nextX < -50) nextX = -50;
    }

    this.right = function() {
        if(!right) return;
        nextX += 9;
        if(nextX > window.innerWidth - 150) nextX = window.innerWidth - 150;
    }

    this.up = function() {
        if(!up) return;
        cnt_jump++;
        if(cnt_jump < limit) {
            nextY -= 12;
        }
        else {
            up = false;
            cnt_jump = 0;
            curr_limit = 0;
        }
        if(nextY < -75) {
            nextY = -75;
            up = false;
            cnt_jump = 0;
            curr_limit = 0;
        }
    }

    this.down = function() {
        if(up) return;
        nextY += 12;
        if(nextX < cell_w / 3 && nextY > window.innerHeight - 200) {
            nextY = window.innerHeight - 200;
        }
        if(nextY > window.innerHeight - 100) {
            nextY = window.innerHeight - 100;
            game_end = true;
            //clear();
            //clearInterval(timeInterval);
            //next_level = true;
            loaded = false;
            timeLeft = timeLeft_start;
            document.getElementById("timeLeft_display").innerHTML = timeLeft + "";
            left = right = down = up = fall = jump = false; cnt = 0;
        }
    }

    this.draw = function() {
        context.beginPath();
        // context.drawImage(img, this.x, this.y, 115, 150);
        context.drawImage(img, this.x, this.y, this.width, this.height);
        context.closePath();
    }
}

function clear() {
    context.clearRect(0, 0, window.innerWidth, window.innerHeight);
}

function update() {
    if(rayman) rayman.move();
    for(let i = 0; i < numOfFireBalls; ++i)
        fireBalls[i].move();
}

function animate() {
    clear();
    if(!started) return;
    update();
    draw();
}

function draw() {
    if(rayman) rayman.draw();
    for(let i = 0; i < numOfCoins; ++i) 
        coins[i].draw();
    for(let i = 0; i < numOfFireBalls; ++i)
        fireBalls[i].draw();

    if(rayman) {
        context.fillStyle = "gold";
        context.beginPath();
        //context.drawImage(img_c, this.x * cell_w + cell_w / 4, this.y * cell_h + cell_h / 5, this.width, this.height);
        context.drawImage(img_p, -cell_w, window.innerHeight - 200 + rayman.height / 2.5, cell_w * 2, cell_h);
        //context.arc(this.x, this.y, this.radius, 0, 2 * Math.PI);
        context.closePath();
        context.fill();
    }

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

function send_data() {
    let t = ss + (mm + hh * 60) * 60;
    let date = new Date();
    $.ajax({
        method: "POST",
        url: window.location.origin + "/Games/save_data/flappyBird",
        //dataType: 'json',
        data: {arguments: [t, points, level, date.getFullYear(), date.getMonth() + 1, date.getDate(), date.getHours(), date.getMinutes(), date.getSeconds()]},
        //data: {functionname: 'save_data', arguments: points},
    
        success: function (obj, textstatus) {
            //alert(obj + " " + textstatus);
            if( !(obj == "" || obj.error == "true") ) {
                let v = JSON.parse(obj).result;
                //alert(v + "???");
                //update_data();
            }
            else {
                console.log(obj.error);
                //alert(obj + " ? " + textstatus);
            }
        },
        error: function(xhr, status, error) {
            alert("2 " + xhr.responseText + " " + error + " " + status);
        }
    });
}

function load_map() {
    $.ajax({
        method: "GET",
        url: window.location.origin + "/Games/getLevel/flappyBird",
        //dataType: 'json',
        data: {arguments: level},
        success: function (obj, textstatus) {
            //alert(obj);
            if( 1 ) {
                if(obj == "" || obj.result == false) {
                    //alert("GAME END");
                    game_end = true;
                    //send_data();
                    //update_list();
                    //animate();
                    //clearInterval(timeInterval);
                } else {
                    //alert("Level: " + level + "   " + obj.result);
                    start_data = JSON.parse(JSON.parse(obj).result.level_desc);
                    r = start_data.rows;
                    c = start_data.cols;
                    numOfCoins = start_data.coins.length;
                    numOfFireBalls = start_data.wood.length;
                    create_map();
                    animate();
                    //alert("animate numOfCoins: " + coins.length);
                    loaded = true;
                    //alert(numOfFireBalls);
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

    let w = canvas.width;
    let h = canvas.height;
    let rows = r;
    let cols = c;
    cell_w = w / cols;
    cell_h = h / rows;

    coins = [];
    fireBalls = [];

    num = 0;
    num_c = 0;

    rayman = new Rayman();
    this.x = 10;
    this.y = 275;
    nextX = -50;
    nextY = window.innerHeight - 200;

    // make coins
    //alert("make coins");
    for(let i = 0; i < numOfCoins; ++i)
        coins.push(new Coin(start_data.coins[i].x, start_data.coins[i].y));

    //alert("make fireballs " + numOfFireBalls);
    // make fire balls
    for(let i = 0; i < numOfFireBalls; ++i)
        fireBalls.push(new FireBall(start_data.wood[i].y, start_data.wood[i].direction));
    
    //alert(fireBalls.length);
    //alert("created");
}

function resizeCanvas() {
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;

    let w = canvas.width;
    let h = canvas.height;
    let rows = r;
    let cols = c;
    cell_w = w / cols;
    cell_h = h / rows;

    if(rayman != undefined) {
        rayman.width = cell_w * 1.5;
        rayman.height = cell_h * 1.5;
    }
    for(let i = 0; i < numOfFireBalls; ++i) {
        fireBalls[i].width = cell_w;
        fireBalls[i].height = cell_h * 1.5;
    }   
}

function update_list() {
    var maxLvlPts;
    //alert("update_list");
    // get max level and points
    $.ajax({
        method: "GET",
        url: window.location.origin + "/Games/getList/flappyBird",
        //dataType: 'json',
        // data: {arguments: 2},
        //data: {functionname: 'save_data', arguments: points},

        success: function (obj, textstatus) {
            //alert(obj);
            if( 1 ) {
                //alert("update_list: " + obj.result);
                maxLvlPts = JSON.parse(obj).result;
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
                /*// Create an empty <tr> element and add it to the 1st position of the table:
                var row = table.insertRow(0);

                // Insert new cells (<td> elements) at the 1st and 2nd position of the "new" <tr> element:
                var cell1 = row.insertCell(0);
                var cell2 = row.insertCell(1);

                // Add some text to the new cells:
                cell1.innerHTML = "Username";
                cell2.innerHTML = "Points";*/

                var row = $("<th></th>");
                var cell1 = $("<td>Username</td>").css("float", "left").css("font-weight", "normal");
                var cell2 = $("<td>Points</td>").css("float", "right").css("font-weight", "normal");
                row.append(cell1).append(cell2);
                $("#lista_poena").append(row);

                for(let i = 1; i <= maxLvlPts.list.length; ++i) {
                    var row = $("<tr></tr>").css("text-align", "center");

                    // Insert new cells (<td> elements) at the 1st and 2nd position of the "new" <tr> element:
                    var cell1 = $("<td>" + maxLvlPts.list[i - 1].username + "</td>").css("float", "left");
                    var cell2 = $("<td>" + maxLvlPts.list[i - 1].points + "</td>").css("float", "right");


                    row.append(cell1).append(cell2);
                    $("#lista_poena").append(row);
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