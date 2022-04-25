<?php
    session_start();

    function max_level_and_points($game_id) {
        $result = new stdClass();

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "gamingplatform";

        try {
            $conn = new mysqli($servername, $username, $password, $dbname);

            // check connection
            if ($conn->connect_error)
                die("Connection failed: " . $conn->connect_error);

            //$id = $_SESSION['ID'];
            $id = 1;

            //$sql = "SELECT MAX(ID) FROM user";
            //$id_g = $conn->query($sql)->fetch_assoc()['ID'] + 1;
            
            $sql = "SELECT MAX(maxLevel) FROM playedgame WHERE ID_user = $id AND ID_game = $game_id";
            $level = $conn->query($sql);
            $level = $level->fetch_assoc()['MAX(maxLevel)'];
            $result->level = $level;

            $sql = "SELECT MAX(points) FROM playedgame WHERE ID_user = $id AND ID_game = $game_id";
            $points = $conn->query($sql);
            $points = $points->fetch_assoc()['MAX(points)'];
            $result->points = $points;

            //$sql = "SELECT  FROM playedgame WHERE ID_game = $game_id";
            $sql = "SELECT username, points FROM `playedgame` INNER JOIN `user` WHERE ID_game = 1 ORDER BY points DESC LIMIT 10";
            $resultList = $conn->query($sql);
            $list = [];

            if ($resultList->num_rows > 0) {
                while($row = $resultList->fetch_assoc()) {
                    $jsn = new stdClass();
                    $jsn->username = $row["username"];
                    $jsn->points = $row["points"];
                    array_push($list, $jsn);
                }
            }
            $result->list = $list;
            
            $result = json_encode($result);

            $conn->close();

        } catch (Exception $e){
            echo $e->getMessage() . "<br/>";
            while($e = $e->getPrevious()) {
                echo 'Previous exception: '.$e->getMessage() . "<br/>";
            }
        }

        return $result;
    }
    function save_data($time, $points, $level) {
        $result = true;

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "gamingplatform";

        try {
            $conn = new mysqli($servername, $username, $password, $dbname);

            // check connection
            if ($conn->connect_error)
                die("Connection failed: " . $conn->connect_error);

            //$id = $_SESSION['ID'];
            $id = 1;

            //$sql = "SELECT MAX(ID) FROM user";
            //$id_g = $conn->query($sql)->fetch_assoc()['ID'] + 1;
            
            $sql = "INSERT INTO `playedgame`(`timePlayed`, `points`, `ID_user`, `ID_game`, `maxLevel`, `on_tournament`) VALUES ('$time','$points','$id','1', '$level', 'false')";
            $conn->query($sql);

            $conn->close();

        } catch (Exception $e){
            echo $e->getMessage() . "<br/>";
            while($e = $e->getPrevious()) {
                echo 'Previous exception: '.$e->getMessage() . "<br/>";
            }
        }

        return $result;
    }

    function rayman_game_data($level) {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "gamingplatform";

        try {
            $conn = new mysqli($servername, $username, $password, $dbname);

            // check connection
            if ($conn->connect_error)
                die("Connection failed: " . $conn->connect_error);
            
            $sql = "SELECT game.ID FROM game WHERE game.Name = 'Rayman'";
            $game = $conn->query($sql);
            
            if($game->num_rows == 0 || $game->num_rows > 1) $game = false;
            else $game = $game->fetch_assoc()['ID'];

            $sql = "SELECT level.level_desc FROM level WHERE level.ID_game='$game' AND level.lvl=".$level;
            //$sql = "SELECT level.level_desc FROM level WHERE level.ID_game=1 AND level.lvl=1";
            $result = $conn->query($sql);
            
            if($result->num_rows == 0 || $result->num_rows > 1) $result = false;
            else $result = $result->fetch_assoc()['level_desc'];

            $conn->close();

        } catch (Exception $e){
            echo $e->getMessage() . "<br/>";
            while($e = $e->getPrevious()) {
                echo 'Previous exception: '.$e->getMessage() . "<br/>";
            }
        }
        header('Content-Type: application/json');
        return  $result;
        //return "{\"level\": 3}";
    }

    header('Content-Type: application/json');

    $aResult = array();

    if( !isset($_POST['functionname']) ) { $aResult['error'] = 'No function name!'; }

    if( !isset($_POST['arguments']) ) { $aResult['error'] = 'No function arguments!'; }

    if( !isset($aResult['error']) ) {

        switch($_POST['functionname']) {
            case 'rayman_game_data':
                $aResult['result'] = rayman_game_data(intval($_POST['arguments']));
                break;
            case 'save_data':
                $aResult['result'] = save_data(intval($_POST['arguments'][0]), intval($_POST['arguments'][1]), intval($_POST['arguments'][2]));
                break;
            case 'max_level_and_points':
                $aResult['result'] = max_level_and_points(intval($_POST['arguments'][0]));
                break;
            default:
               $aResult['error'] = 'Not found function '.$_POST['functionname'].'!';
               break;
        }

    }

    echo json_encode($aResult);

?>