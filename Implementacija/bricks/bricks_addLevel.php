<!-- Autor: Dimitrije Vujčić -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add level</title>
    <link rel="stylesheet" href="bricks_addLevel.css">
</head>
<body>
    <div class="header">
        <div class="notification">
            <h1 id="notification">
                <?php
                    if(array_key_exists('button1', $_POST)) {
                        require __DIR__ . '/bricks_addLevel_.php';
                        $numC = $_REQUEST['numC'];
                        $posC = $_REQUEST['posC'];
                        $numFT = $_REQUEST['numFT'];
                        $posFT = $_REQUEST['posFT'];
                        $numRows = $numC = $_REQUEST['numRows'];
                        $numCols = $numC = $_REQUEST['numCols'];
                        if($numRows == "" || $numCols == "" || $numC == "" || $posC == "" || $numC == "" || $posFT == "") {
                            echo "Zasto :(...";
                        } else {
                            add_level($numRows, $numCols, $numC, $posC, $numFT, $posFT);
                            echo "New level added succesfully!";
                        } 
                    }
                ?>
            </h1>
        </div>
    </div>
    <div class="center">
        <div class="left">
            <div class="top">
                <h1>Instructions: </h1>
                <p>Rayman is trying to collect as many coins as possible. Create a map by entering number of coins(at least 1, less than 5), their positions like in the example below, number of fire balls and their positions like in the example below. <br>
                <h3 style="color: red">Coin position format: [pos_x, pos_y]<br> Fire ball position format: [pos_y, direction]</h3><hr>
                    Note: Rayman always spawns in the 0th column centered by height and can move in all directions.
                </p>
                <br><br><br>
            </div>
            <div class="bottom">
                <h1>Example: </h1>
                <div class="example">
                    <span>
                        <p>
                        Number of rows: 5 <br>
                        Number of columns: 10 <br>
                        Number of coins: 1 <br>
                        Positions of coins:  [2, 5] <br>
                        Number of fire balls: 3 <br>
                        Positions of floating trees: [1,down], [3,up], [4,down] <br><br><br>
                        </p>
                    </span>
                    <span><img src="../images/level_map.png"></span>
                </div>
            </div>
        </div>
        <div class="right">
            <div class="form">
                <form method="post">
                    <label for="numRows"> Number of rows:</label>
                    <input type="text" id="numRows" name="numRows" value="5"><br><br>
                    <label for="numCols"> Number of columns:</label>
                    <input type="text" id="numCols" name="numCols" value="10"><br><br>
                    <label for="numR"> Number of coins:</label>
                    <input type="text" id="numC" name="numC" value="1"><br><br>
                    <label for="posC"> Positions of coins:</label>
                    <textarea name="posC" id="posC" cols="30" rows="5">[1,1]</textarea><br><br>
                    <label for="numFT"> Number of fire balls:</label>
                    <input type="text" id="numFT" name="numFT" value="3"><br><br>
                    <label for="fTrees"> Positions of fire balls:</label>
                    <textarea name="posFT" id="fTrees" cols="30" rows="5">[1,down], [3,up], [4,down]</textarea><br><br>
                    <input type="submit" value="Add level" class="submit" id="myButton" name="button1">
                </form>
            </div>
        </div>
    </div>
    <div class="footer">
        <button id="back" onclick="back()">Back</button>
        <button id="signOut" onclick="signOut_page()">Sign out</button>
    </div>
    <script>
        function back() {
            location.href="rayman.php";
        }
        function signOut_page() {
            location.href="sign.html";
        }
    </script>
</body>
</html>