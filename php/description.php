<?php
session_start(); //sessions are started
require_once 'includes_requires/config.php'; //includes the file

$email =  $_SESSION['email']; //login status
$loggedIn2 = $_SESSION['loggedIn2'];

$id = $_GET['id']; //creating variables and get 'id' information
$query = mysqli_query ($db, "SELECT * FROM Description WHERE id = '$id'");
// select all from the table
$row = mysqli_fetch_assoc($query);

if (isset($loggedIn2)){ //if logged in show these links
    $logout = '<a href="?action2=logout2">Uitloggen</a>'; //create these variables after login
    $edit = '<a href="passRecovery.php">Wachtwoord wijzigen</a>';
    $backwards = '<a href="../index.php">Terug naar startpagina</a>';
}
?>

<!DOCTYPE html>
<html>
<head>
<head lang="en">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="../img/favicon.png">
    <link rel="stylesheet" href="../css/bootstrap_css/jquery.timepicker.css">
    <link rel="stylesheet" href="../css/bootstrap_css/site.css">
    <link rel="stylesheet" href="../css/bootstrap_css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap_css/bootstrap-datepicker.css">
    <link rel="stylesheet" type="text/css" href="../css/descriptionStyle.css">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script type="text/javascript" src="../js/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="../js/jquery.timepicker.js"></script>
    <script type="text/javascript" src="../js/datepair.js"></script>
    <!--bootstrap, jquery calender and css-->
    <title>Beschrijving</title>
</head>
<body>
<div class="row">
    <div class="col-xs-8 col-xs-offset-2">
        <ul class="media-list">
            <li class="media">
                <div class="media-left">
                    <img class="media-object" src="../img/Zonnebank.jpg" alt="zonnebank">
                </div>
                <div class="media-right">
                    <h4 class="media-heading">Beschrijving</h4>
                    <br>
                    <?php
                        echo $row['text']; //echo the text column from database
                    ?>
                </div>
            </li>
        </ul>
        <a class='terug' href="reserveren.php">Terug</a>
    </div>
    <!--info block-->
 </div>

<footer class="panel-footer">
    <div class="footer">
        <p>© 2015 Mahorokan Sports Club | <button type="button" onclick="window.location='adminLogin.php'" name="admin" class="btn btn-default btn-sm">Admin</button><br>
            <?php if($loggedIn2) { //if logged in echo links below with account status
                echo "<p>".$logout." | ".$edit.'<br>'.$backwards.'<br>'.'<b>'.'Welkom, '.'<b>'.$email ."</p>";
            } ?>
        </p>
    </div>
</footer>
<!--footer-->
<script src="../js/calender.js"></script>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<!--bootstrap links-->
</body>
</html>