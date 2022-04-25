<?php
    session_start();
    function get_tournaments() {
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
            
            $sql = "SELECT ID, date, timeStart, timeEnd, ID_game FROM `tournament`";
            $resultList = $conn->query($sql);
            $list = [];

            if ($resultList->num_rows > 0) {
                while($row = $resultList->fetch_assoc()) {
                    $jsn = new stdClass();
                    $jsn->date = $row["date"];
                    $jsn->timeStart = $row["timeStart"];
                    $jsn->timeEnd = $row["timeEnd"];
                    $jsn->id = $row["ID"];
                    $jsn->id_game = $row["ID_game"];
                    $sql = "SELECT name FROM `game` WHERE ID = $jsn->id_game";
                    $jsn->name = $conn->query($sql)->fetch_assoc()['name'];
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

    function join_tournament($tournament_id) {
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
            
            // $id = $_SESSION['ID'];
            $user_id = 1;

            $sql = "INSERT INTO `participation`(`ID_tournament`, `ID_user`) VALUES ('$tournament_id','$user_id')";
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

    function add_tournament($game, $num, $date, $timeStart, $timeEnd) {
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
            
            $sql = "SELECT ID FROM game WHERE game.Name = '$game'";
            $game_id = $conn->query($sql)->fetch_assoc()['ID'];

            $sql = "INSERT INTO `tournament`(`date`, `timeStart`, `timeEnd`, `maxNumOfPlayers`, `numOfPlayers`, `ID_game`) VALUES ('$date','$timeStart', '$timeEnd', '$num', 0, '$game_id')";
            $conn->query($sql);
            $result = $game_id;
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
            case 'get_tournaments':
                $aResult['result'] = get_tournaments();
                break;
            case 'join_tournament':
                $aResult['result'] = join_tournament(intval($_POST['arguments'][0]));
                break;
            case 'add_tournament':
                $aResult['result'] = add_tournament($_POST['arguments'][0], intval($_POST['arguments'][1]), $_POST['arguments'][2], $_POST['arguments'][3], $_POST['arguments'][4]);
                break;
            default:
               $aResult['error'] = 'Not found function '.$_POST['functionname'].'!';
               break;
        }

    }

    echo json_encode($aResult);

?>