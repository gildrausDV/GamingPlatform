<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>
    <link rel="stylesheet" href="<?= base_url() ?>/assets/style/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/style/settings.css">
    <script src="<?= base_url() ?>/assets/scripts/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
</head>
<body>
    <div class="container-fluid no-padding">
    <div class="row no-padding">
                <div class="col-sm-12 no-padding">
                    <nav class="navbar navbar-expand-sm bg-dark n">
                        <div class="levo">
                            <a href="#" class="navbar-brand logo_link">
                                <img src="/images/superMario.jpg" alt="logo" id="logo" class="rounded-pill">
                            </a>
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        Tournaments
                                    </a>
                                </li>
                                <li class="nav-item" style="width: 85px;">
                                    <a href="#" class="nav-link">
                                        Add level
                                    </a>
                                </li>
                                <li class="nav-item" style="width: 135px;">
                                    <a href="#" class="nav-link">
                                        Account settings
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        Allow/block
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        History
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link" style="width: 65px;">
                                        Roles
                                    </a>
                                </li>
                                <li>
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown">Top players lists</button>
                                        <ul class="dropdown-menu izbor">
                                            <li class="dropdown-item">
                                                <a href="#">Top players (global)</a>
                                            </li>
                                            <li class="dropdown-item">
                                                <a href="#">Top players for game</a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        
                        <div class="desno">
                            <button type="button" class="btn btn- bg-danger" style="margin-right: 10px;">Sign out</button>
                        </div>
                    </nav>
                </div>
            </div>
            <div class="row">
                <div class="offset-md-4 col-md-4 mt-4">
                    <nav class="navbar navbar-expand-sm c bg-dark games">
                        <a href="#" class="navbar-brand">
                            <img src="/images/rayman.png" alt="logo" id="logo1" class="rounded-pill">
                        </a>
                        <a href="#" class="navbar-brand">
                            <img src="/images/sonic.jpg" alt="logo" id="logo2" class="rounded-pill">
                        </a>
                        <a href="#" class="navbar-brand">
                            <img src="/images/pikachu.png" alt="logo" id="logo3" class="rounded-pill">
                        </a>
                    </nav>
                </div>
            </div>
            <div class="row">
                <div class="offset-md-1 col-md-4 mt-4 picture">
                    <h2>Your profile picture</h2>
                    <img id="profilePicture" src="/images/superMario.jpg">
                </div>
                <div class="offset-md-2 col-md-4 mt-4 form">
                    <form>
                        <table>
                            <tr>
                                <td>
                                    <br>
                                    <label for="pass">Password:</label>
                                </td>
                                <td>
                                    <span id="passwordGreska"></span><br>
                                    <input type="password" id="pass" value="123">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="date">Date(mm/dd/yyyy):</label> 
                                </td>
                                <td><input id="date" type="date" value="2022-03-03"></td>
                            </tr>
                            <tr>
                                <td>Picture: </td>
                                <td>
                                    <label id="labelFile" for="file">Click here to import</label>
                                    <input class="hidden box__file" type="file" name="files[]" id="file" data-multiple-caption="{count} files selected" multiple /></td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <button id="save" type="submit" class="btn btn-secondary">Save</button>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
    </div>
</body>