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
    <link rel="stylesheet" href="<?= base_url() ?>/assets/style/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/style/login.css">
    <script src="<?= base_url() ?>/assets/scripts/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>/assets/scripts/login.js""></script>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 notification">
                <h1 id="notification">
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
                </h1>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="form offset-sm-4 col-sm-4 mt-5">
                <br>
                <h1>Sign in</h1>
                <hr>
                <br><br>
                <form method="post" action="<?php echo site_url('Home/process'); ?>">
                    <label for="fname">Username:</label>
                    <input type="text" id="username" name="username"><br><br>
                    <label for="lname">Password:&nbsp;</label>
                    <input type="password" id="password" name="password"><br><br>
                    <button class="btn btn-secondary" type="submit"> Sign in</button>
                </form>
                <br><br><br>
                <div class="links">
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

</body>
</html>