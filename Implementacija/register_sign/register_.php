<?php
    function register($fname, $lname, $email, $usern, $passw) {

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "gamingplatform";

        try {
            $conn = new mysqli($servername, $username, $password, $dbname);

            // check connection
            if ($conn->connect_error)
                die("Connection failed: " . $conn->connect_error);
            
            $sql = "SELECT MAX(ID) FROM gamingplatform.user";
            $result = $conn->query($sql);

            $id = $result->fetch_assoc()["MAX(ID)"] + 1;

            $sql = "INSERT INTO gamingplatform.user (ID, username, password, role, blocked, NP) VALUES($id, '$usern', '$passw', 0, false, 0);";

            if ($conn->query($sql) === TRUE) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        
            $conn->close();

        } catch (Exception $e){
            echo $e->getMessage() . "<br/>";
            while($e = $e->getPrevious()) {
                echo 'Previous exception: '.$e->getMessage() . "<br/>";
            }
        }

        return "Registration successful";
    }

    
?>