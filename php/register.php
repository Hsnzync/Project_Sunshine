<?php
session_start(); //sessions are started
require_once 'includes_requires/config.php'; //includes the file

$message = ""; //creating variables
$email =  $_SESSION['email']; //account status session
$submit = $_POST['submit'];
$loggedIn2 = $_SESSION['loggedIn2'];
$login = "";
$register = "";
//show these variables in footer
$login = '<a href="customLogin.php">Inloggen</a>';
$register = '<a class="account" href="register.php">Registreren</a>';
$backwards = '<a href="../index.php">Terug naar startpagina</a>';

if(isset($submit)){ // if submit has been submitted

    $email = $_POST['email']; //create variables
    $password1 = md5($_POST['password1']);
    $password2 = md5($_POST['password2']);

    if ($password1 == $password2){ //if passwords are equal

        $name = $_POST['name']; //create variable

        $query = "INSERT INTO Members (`id`,`name`,`email`,`password`) VALUES (NULL,'$name','$email','$password1')" or die (mysql_error());
        // insert submitted information in database table
        $result = mysqli_query($db, $query) or die(mysql_error());
        $message = 'U heeft een account aangemaakt!'; //echo message if information successfully submits
    } else {
        $message = 'Uw wachtwoorden komen niet overeen'; //if not, echo message
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
    <link rel="stylesheet" href="../css/registerStyle.css">
    <!--bootstrap and css-->
    <title>Registreren</title>
</head>
<body>
<div class="container">
<form action="register.php" class="form-horizontal" method="post">
    <?php if($message) {
        echo "<p>" . $message . "</p>";
        //echo variable if $message gets activated above
    } ?>
    <div class="form-group">
        <div class="col-md-1 col-md-offset-4"></div>
        <input type="text" class="form-control" name="name" id="inputName3" required="required" placeholder="Voor uw naam in">
    </div>
    <div class="form-group">
        <div class="col-md-1 col-md-offset-4"></div>
        <input type="email" class="form-control" name="email" id="inputEmail3" required="required" placeholder="Voor uw email in">
    </div>
    <div class="form-group">
        <div class="col-md-1 col-md-offset-4"></div>
        <input type="password" class="form-control" name="password1" id="inputPassword3" required="required" placeholder="Voer uw wachtwoord in">
    </div>
    <div class="form-group">
        <div class="col-md-1 col-md-offset-4"></div>
        <input type="password" class="form-control" name="password2" id="inputPassword3" required="required" placeholder="Voer uw wachtwoord nogmaals in">
    </div>
    <div class="form-group">
        <div class="col-md-1 col-md-offset-4"></div>
            <button type="submit" name="submit" class="btn btn-primary">Registreer</button>
        <a class="register" href="customLogin.php">Klik om in te loggen</a>
    </div><!--input fields with button and links-->
</form>
</div>
<footer class="panel-footer">
    <div class="footer">
        <p>© 2015 Mahorokan Sports Club | <button type="button" onclick="window.location='adminLogin.php'" name="admin" class="btn btn-default btn-sm">Admin</button><br>
            <?php //echo links in footer
                echo '<p>'.$login.' | '.$register.'<br>'.$backwards.'<p>';
            ?>
        </p>
    </div>
</footer>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<!--bootstrap javascript-->
</body>
</html>