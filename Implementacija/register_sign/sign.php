<!-- Autor: Bogdan Jovanović -->
<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in</title>
    <link rel="stylesheet" href="sign.css">
</head>
<body>
    <div class="screen">
        <div class="notification"><h1 id="notification">
        <?php
            if(array_key_exists('button1', $_POST)) {
                require __DIR__ . '/sign_.php';
                $username = $_REQUEST['username'];
                $password = $_REQUEST['password'];
                if(!signIn($username, $password)) {
                    echo "Username or password is incorrect!";
                } else {
                    header("Location:play.php");
                }
            }
        ?>
        </h1></div>
        <div class="inputScreen">
            <div class="input">
                <h1>Sign in</h1>
                <form method="post">
                    <label for="fname" color="red"> Username:</label>
                    <input type="text" id="username" name="username"><br><br>
                    <label for="lname"> Password:</label>
                    <input type="password" id="password" name="password"><br><br>
                    <input type="submit" value="Sign in" class="submit" id="myButton" name="button1">
                </form>
                <br><br><br>
                <div class="play">
                    <a class="input_footer1" href="play.php">
                        Quick play
                    </a>
                </div>
                <div class="register">
                    <a class="input_footer2" href="register.html">
                        Register
                    </a>
                </div>
            </div>
        </div>
    </div>
    <script>
        function signIn() {
            let user = document.getElementById("fname").value;
            let pass = document.getElementById("lname").value;
            if(user == "" || pass == "") {
                document.getElementById("notification").innerText = "Username or password is incorrect!";
            }
            else location.href = "play.php";
        }

    </script>
</body>
</html>