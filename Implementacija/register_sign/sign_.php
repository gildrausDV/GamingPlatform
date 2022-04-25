<?php
    session_start();
    function signIn($usern, $passw) {

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "gamingplatform";

        try {
            $conn = new mysqli($servername, $username, $password, $dbname);

            // check connection
            if ($conn->connect_error)
                die("Connection failed: " . $conn->connect_error);
            
            $sql = "SELECT ID FROM gamingplatform.user WHERE gamingplatform.user.username = '$usern' AND gamingplatform.user.password = '$passw'";
            $result = $conn->query($sql);

            $_SESSION['ID'] = $result->fetch_assoc()['ID'];

            if ($result->num_rows > 1 || $result->num_rows == 0)
                return false;
        
            $conn->close();

        } catch (Exception $e){
            echo $e->getMessage() . "<br/>";
            while($e = $e->getPrevious()) {
                echo 'Previous exception: '.$e->getMessage() . "<br/>";
            }
        }

        return true;
    }
    
?>