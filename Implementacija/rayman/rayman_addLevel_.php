<?php
    session_start();
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
            $js_coins = $js_coins."{\"x\": $coin[1], \"y\": $coin[0]}";
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
            $js_trees = $js_trees."{\"x\": $fTree[1], \"y\": $fTree[0], \"len\": $fTree[2], \"height\": $fTree[3]}";
            if($i != count($fTrees) - 1) $js_trees = $js_trees.", ";
        }
        $js_trees = $js_trees."]";

        $js = "\"wood\": ".$js_trees.", \"coins\": ".$js_coins;

        $js = "{\"rows\": $numRows,\"cols\": $numCols,".$js.",\"rayman\": [{\"x\": 3,\"y\": 3}]}";

        try {
            $conn = new mysqli($servername, $username, $password, $dbname);

            // check connection
            if ($conn->connect_error)
                die("Connection failed: " . $conn->connect_error);

        // $id = $_SESSION['ID']; --- ovde dodati proveru da li je level dodao administrator/moderator

            $sql = "SELECT MAX(lvl) FROM level WHERE level.ID_game = 1";
            $lvl = $conn->query($sql)->fetch_assoc()['MAX(lvl)'] + 1;
            
            $sql = "INSERT INTO `level`(`level_desc`, `ID_game`, `lvl`) VALUES ('$js','1','$lvl')";
            $conn->query($sql);

            $conn->close();

        } catch (Exception $e){
            echo $e->getMessage() . "<br/>";
            while($e = $e->getPrevious()) {
                echo 'Previous exception: '.$e->getMessage() . "<br/>";
            }
        }

        return $js;
    }

?>