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
    <script src="<?= base_url() ?>/assets/scripts/jquery-1.11.3.min.js"></script>
    <script src="<?= base_url() ?>/assets/scripts/register.js"></script>
</head>
<body>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 notification">
                <h1 id="notification">
                    <?php 
                    if(esc($reg) == '5') echo "Registration successful!";
                    else if(esc($reg) == '4') echo "Passwords do not match!";
                    else if(esc($reg) == '3') echo "Password too short!";
                    else if(esc($reg) == '2') echo "Username already exists!";
                    else if(esc($reg) == '1') echo "Please provide necessary information!";
                    ?>
                </h1>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="form offset-sm-4 col-sm-4 mt-4">
                <br>
                <h1>Register</h1>
                <hr>
                <br><br>
                <form>
                    <table>
                        <tr>
                            <td>
                                <label for="forename">Forename:</label>
                            </td>
                            <td>
                                <input required type="text" id="forename" name="forename">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="surname">Surname:</label>
                            </td>
                            <td>
                                <input required type="text" id="surname" name="surname">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="email">Email:</label>
                            </td>
                            <td>
                                <input required type="text" id="email" name="email">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="date">Date of birth:</label>
                            </td>
                            <td>
                                <input required type="date" id="date" name="date">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="username">Username:</label>
                            </td>
                            <td>
                                <input required type="text" id="username" name="username">
                                <img class="togglePassword_" src="/images/eye.png">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="password">Password:</label>
                            </td>
                            <td>
                                <div>
                                <input required type="password" id="password" name="password" class="toggle">
                                <img id="togglePassword1" src="/images/eye_.png">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="confirmPassword">Confirm password:</label>
                            </td>
                            <td>
                                <input required type="password" id="confirmPassword" name="confirmPassword" class="toggle">
                                <img id="togglePassword2" src="/images/eye_.png">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <input value="Register" class="btn btn-secondary" id="submit">
                            </td>
                        </tr>
                    </table>
                    <!--<label for="forename">Forename:</label>
                    <input type="text" id="forename" name="forename"><br><br>
                    <label for="surname">&nbsp;&nbsp;Surname:</label>
                    <input type="text" id="surname" name="surname"><br><br>
                    <label for="email">&emsp;&emsp;&nbsp;Email:</label>
                    <input type="text" id="email" name="email"><br><br>
                    <label for="username">&nbsp;Username:</label>
                    <input type="text" id="username" name="username"><br><br>
                    <label for="password">&nbsp;&nbsp;Password:</label>
                    <input type="password" id="password" name="password"><br><br>
                    <label for="confirmPassword">Confirm password:</label>
                    <input type="password" id="confirmPassword" name="confirmPassword"><br><br>
                    <input type="submit" value="Register" class="btn btn-secondary">-->
                </form>
                <br><br><br>
                <div class="links">
                    <div class="play">
                        <a class="input_footer1" href="<?php echo base_url()."/Home/home"  ?>">
                            Quick play
                        </a>
                    </div>
                    <div class="register">
                        <a class="input_footer2" href="<?php echo base_url()."/Home/login"  ?>">
                            Log in
                        </a>
                    </div>
                </div>
            </div>
        </div>

</body>
</html>