<?php
    session_start();
    function get_topPlayers($game_id) {
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
            
            $sql = "SELECT ID_user, timePlayed, points FROM `playedgame` WHERE ID_game = $game_id ORDER BY points DESC LIMIT 10";
            $resultList = $conn->query($sql);
            $list = [];

            if ($resultList->num_rows > 0) {
                while($row = $resultList->fetch_assoc()) {
                    $jsn = new stdClass();
                    $jsn->username = $row["ID_user"];
                    $sql = "SELECT username FROM `user` WHERE ID = $jsn->username";
                    $jsn->username = $conn->query($sql)->fetch_assoc()['username'];
                    $jsn->timePlayed = $row["timePlayed"];
                    $jsn->points = $row["points"];
                    array_push($list, $jsn);
                }
            }
            $result->list = $list;

            $conn->close();

        } catch (Exception $e){
            echo $e->getMessage() . "<br/>";
            while($e = $e->getPrevious()) {
                echo 'Previous exception: '.$e->getMessage() . "<br/>";
            }
        }

        return $result;
    }

    header('Content-Type: application/json');

    $aResult = array();

    if( !isset($_POST['functionname']) ) { $aResult['error'] = 'No function name!'; }

    //if( !isset($_POST['arguments']) ) { $aResult['error'] = 'No function arguments!'; }

    if( !isset($aResult['error']) ) {

        switch($_POST['functionname']) {
            case 'get_topPlayers':
                $aResult['result'] = get_topPlayers(intval($_POST['arguments'][0]));
                break;
            default:
               $aResult['error'] = 'Not found function '.$_POST['functionname'].'!';
               break;
        }

    }

    echo json_encode($aResult);

?>