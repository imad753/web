<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    require_once('../app/config/Config.php');
    require_once(APP_ROOT.'/models/User.php');
    require_once(APP_ROOT.'/libraries/Database.php');
    require_once(APP_ROOT.'/controllers/Users.php');
    require_once(APP_ROOT.'/libraries/Controller.php');

    $usr = new Users();
    if (!($usr->login()))
    {
        echo '<p style="color:#FF0000; font-weight:bold;">Erreur de connexion.</p>';
        exit;
    }
    $_SESSION['message'] = "Login successful!";
    header('Location: index.php');
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" type ="text/css" href="static/login.css">
    </head>
    <body>
        <?php if(isset($_SESSION['email'])){ ?>
        <p><?php echo $_SESSION['email']; ?>,correctly authetificated</p>
        <a href="logout.php">Logout</a>
        <?php } else { ?>
        <form action="index.php" method="post">
        <label>E-mail</label>
        <input type="text" name="email" placeholder="E-mail"><br><br>
        <label>Password</label>
        <input type="password" name="password" placeholder="Password"><br><br>
        <p><input type="submit" id="submit" name="submit" value="Submit" /></p>
        </form>
        <?php } ?>
    </body>
</html>