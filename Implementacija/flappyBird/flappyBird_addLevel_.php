<?php
    try {
        session_start();
    } catch(Exception $e) {
        
    }
    function add_level($numRows, $numCols, $numCoins, $coins, $numFTrees, $fTrees) {
        $result = true;

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "gamingplatform";

        /*
        {"rows": 6,"cols": 6,"wood": [{"x": 1,"y": 1,"len": 2,"height": 1}],"coins": [{"x": 2,"y": 3}],"rayman": [{"x": 3,"y": 3}]}
        */

        $js = "";

        $js_coins = "[";
        $coins = explode(", ", $coins);
        for ($i = 0; $i < count($coins); ++$i) {
            $coin = $coins[$i];
            $coin = trim($coin, '[');
            $coin = trim($coin, ']');
            $coin = explode(",", $coin);
            $js_coins = $js_coins."{\"x\": $coin[0], \"y\": $coin[1]}";
            if($i != count($coins) - 1) $js_coins = $js_coins.", ";
        }
        $js_coins = $js_coins."]";

        $js_trees = "[";
        $fTrees = explode(", ", $fTrees);
        for ($i = 0; $i < count($fTrees); ++$i) {
            $fTree = $fTrees[$i];
            $fTree = trim($fTree, '[');
            $fTree = trim($fTree, ']');
            $fTree = explode(",", $fTree);
            $js_trees = $js_trees."{\"y\": $fTree[0], \"direction\": \"$fTree[1]\"}";
            if($i != count($fTrees) - 1) $js_trees = $js_trees.", ";
        }
        $js_trees = $js_trees."]";

        $js = "\"wood\": ".$js_trees.", \"coins\": ".$js_coins;

        $js = "{\"rows\": $numRows,\"cols\": $numCols,".$js."}";

        try {
            $conn = new mysqli($servername, $username, $password, $dbname);

            // check connection
            if ($conn->connect_error)
                die("Connection failed: " . $conn->connect_error);

        // $id = $_SESSION['ID']; --- ovde dodati proveru da li je level dodao administrator/moderator

            $sql = "SELECT MAX(lvl) FROM level WHERE level.ID_game = 2";
            $lvl = $conn->query($sql)->fetch_assoc()['MAX(lvl)'] + 1;
            
            $sql = "INSERT INTO `level`(`level_desc`, `ID_game`, `lvl`) VALUES ('$js','2','$lvl')";
            $conn->query($sql);

            $conn->close();

        } catch (Exception $e){
            /*echo $e->getMessage() . "<br/>";
            while($e = $e->getPrevious()) {
                echo 'Previous exception: '.$e->getMessage() . "<br/>";
            }*/
        }

        return $js;
    }

?>