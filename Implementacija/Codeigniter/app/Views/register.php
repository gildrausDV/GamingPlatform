<!-- Autor: Bogdan Jovanović -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="<?= base_url() ?>/assets/style/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/style/register.css">
    <script src="<?= base_url() ?>/assets/scripts/bootstrap.min.js"></script>
</head>
<body>
    <div class="screen">
        <div class="notification"><h1 id="notification">
        <?php
            if(array_key_exists('button1', $_POST)) {
                require __DIR__ . '/register_.php';
                $fname = $_REQUEST['fname'];
                $lname = $_REQUEST['lname'];
                $email = $_REQUEST['email'];
                $username = $_REQUEST['username'];
                $password = $_REQUEST['password'];
                echo register($fname, $lname, $email, $username, $password);
            }
        ?>
        </h1></div>
        <div class="inputScreen">
            <div class="input">
                <form method="post">
                    <h1>Register</h1>
                    <label for="fname" color="red"> Forename:</label>
                    <input type="text" id="fname" name="fname"><br><br>
                    <label for="fname" color="red"> Surname:</label>
                    <input type="text" id="lname" name="lname"><br><br>
                    <label for="fname" color="red"> Email:</label>
                    <input type="text" id="email" name="email"><br><br>
                    <label for="fname" color="red"> Username:</label>
                    <input type="text" id="username" name="username"><br><br>
                    <label for="lname"> Password:</label>
                    <input type="password" id="password" name="password"><br><br>
                    <input type="submit" value="Register" class="submit" id="myButton1" name="button1">
                </form>
                <br><br>
                <div class="play">
                    <a class="input_footer1" href="play.html">
                        Quick play
                    </a>
                </div>
                <div class="register">
                    <a class="input_footer2" href="sign.html">
                        Sign in
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
<script type="text/javascript">

</script>
</html>