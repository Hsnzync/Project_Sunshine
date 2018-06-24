<?php
session_start(); //sessions are started
require_once 'includes_requires/config.php'; //includes the file

$loggedIn2 = $_SESSION['loggedIn2']; //customer only page
$email =  $_SESSION['email']; //login status
$password = $_POST['password']; //creating variables
$password_repeat = $_POST['passwordR'];
$alert1 = '<div class="alert alert-success" role="alert"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
              <span class="sr-only"></span>';
$alert2 = '</div>';
$alert3 = '<div class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
              <span class="sr-only"></span>';
$alert4 = '</div>';
//bootstrap signs for wrong password to prevent long html in php echo
$message = "";
$message1 = "";

if (isset($loggedIn2) ){ //if logged in as customer
    $logout = '<a href="?action2=logout2">Uitloggen</a>'; //create variables
    $edit = '<a href="passRecovery.php">Wachtwoord wijzigen</a>';
    $backwards = '<a href="reserveren.php">Terug naar reserveringspagina</a>';
} else {
    header('Location:customer_login.php'); //if not logged in, go to the location
    exit;
}
if (isset($_GET ["action2"]) && $_GET ["action2"] === "logout2") { //logout
    session_destroy(); //destroy the session
    header("Location:customer_login.php"); // then go to the location
    exit;
}
if (isset($_POST['submit'])){ //if submit button has been submitted
    //select column from the table
    $query = "SELECT password FROM Members";
    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_assoc($result);

    if (md5($_POST['password'])){ //if password has been posted

        if ($password == $password_repeat){ //if 2 passwords are the same
            $query2 = "UPDATE Members SET password='" . md5($password) . "'"; //update password
            $result2 = mysqli_query($db, $query2);
            $message = "Uw wachtwoord is gewijzigd!"; //echo message
        }
        else { $message1 = "Er klopt iets niet"; }// if not, echo this
    }
}
?>

<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="../img/favicon.png">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../css/recoveryStyle.css">
    <!--bootstrap and css-->
    <title>Herstellen</title>
</head>
<body>
<div class="container">
    <form action="passRecovery.php" class="form-horizontal" method="post">
        <?php if($message) {
            echo $alert1.$message.$alert2;
            } //echo these variables if $message or $message1 has been activated
            if ($message1) {
            echo $alert3.$message1.$alert4;
            }
         ?>
        <div class="form-group">
            <div class="col-md-1 col-md-offset-4"></div>
            <input type="password" class="form-control" name="password" required="required" placeholder="Nieuw wachtwoord">
        </div>
        <div class="form-group">
            <div class="col-md-1 col-md-offset-4"></div>
            <input type="password" class="form-control" name="passwordR" required="required" placeholder="Herhaal nieuw wachtwoord">
        </div>
        <div class="form-group">
            <div class="col-md-1 col-md-offset-4"></div>
            <button type="submit" name="submit" class="btn btn-primary">Wijzig</button>
        </div>
    </form>
    <!--input fields-->
</div>
<footer class="panel-footer">
    <div class="footer">
        <p>© 2015 Mahorokan Sports Club | <button type="button" onclick="window.location='admin_loginpage.php'" name="admin" class="btn btn-default btn-sm">Admin</button><br>
            <?php if($loggedIn2) { //if logged in echo links below with account status
                echo '<p>'.$logout.' | '.$edit .'<br>'.$backwards.'<br>'.'<b>'.'Welkom, '.'<b>'.$email .'<p>';
            } ?>
        </p>
    </div>
</footer>
<!--footer-->
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<!--bootstrap javascript-->
</body>
</html>