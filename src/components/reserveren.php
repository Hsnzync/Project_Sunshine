<?php
session_start(); //sessions are started
require_once 'includes_requires/config.php'; //includes the file

$username =  $_SESSION['username']; //creating variables
$loggedIn2 = $_SESSION['loggedIn2'];
$submit = $_POST['submit'];
$message = ""; //empty variables for text
$logout = "";
$register = "";
$message = "";
$alert = '<div class="alert alert-success" role="alert"><span class="sr-only"></span>U heeft gereserveerd!</div>';
//bootstrap sign for wrong password

if (isset($loggedIn2) ){ //if customer logged in
    $logout = '<a href="?action2=logout2">Uitloggen</a>'; //create these variables after login
    $edit = '<a href="passRecovery.php">Wachtwoord wijzigen</a>';
    $backwards = '<a href="../../index.php">Terug naar startpagina</a>';
} else {
    header('Location:customer_login.php'); //if not logged in, go to the location
    exit;
}

if(isset($submit)){ // if submit has been submitted
    $name = $_POST['name']; //create variables
    $email1 = $_POST['email'];
    $number = $_POST['number'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $query = "INSERT INTO Reservation (`name`,`email`,`passnumber`,`date`,`time`) VALUES ('$name','$email1','$number','$date','$time')" or die (mysql_error());
    // insert submitted information in database table
    $result = mysqli_query($db, $query);
} else {
    $message = 'U heeft niet alles ingevuld!'; //if all fields are nog filled, echo
}
if (isset($_GET ["action2"]) && $_GET ["action2"] === "logout2") { //logout
    session_destroy(); //destroy the session
    header("Location:customer_login.php"); //go to the location
    exit;
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
    <link rel="stylesheet" href="../css/bootstrap_css/site.css">
    <link rel="stylesheet" href="../css/bootstrap_css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap_css/bootstrap-datepicker.css">
    <link rel="stylesheet" type="text/css" href="../css/reserverenStyle.css">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script type="text/javascript" src="../js/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="../js/jquery.timepicker.js"></script>
    <!--bootstrap, jquery calender and css-->
    <title>Reserveren</title>
</head>
<body>
    <div class="row">
        <h2>Reserveren</h2>
        <?php if(isset($submit)) {
            echo "<p>" . $alert. "</p>";
            //echo variable if $message gets activated above
        } ?>
        <div class="col-xs-1 col-xs-offset-1"><span class="number">1</span></div>
        <div class="col-xs-2">
            <ul class="media-list">
                <li class="media">
                    <div class="media-left">
                        <img class="media-object" src="../img/album_1.jpg" alt="boat">
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading">Sensual Attraction</h4>
                        <button type="button" class="btn btn-info btn-sm" name="info" onclick="window.location='description.php?id=1'">Meer informatie</button>
                    </div>
                </li>
            </ul>
        </div><!--first block-->
        <div class="col-xs-1 col-xs-offset-1"><span class="number">2</span></div>
        <div class="col-xs-3">
            <form action="reserveren.php" id="main-contact-form" class="contact-form" name="contact-form" method="post">
            <h3>Kies uw gewenste datum en tijd</h3>
                <label><input type="date" name="date" class="date" min="<?php echo date('Y-m-d'); ?>" required="required"></label>
                <label>
                    <select class="form-control" name="time" required="required">
                        <option selected disabled>Tijdstip</option>
                        <option value="09:00:00">09.00 uur</option>
                        <option value="09:15:00">09.15 uur</option>
                        <option value="09:30:00">09.30 uur</option>
                        <option value="09:45:00">09.45 uur</option>
                        <option value="10:00:00">10.00 uur</option>
                        <option value="10:15:00">10.15 uur</option>
                        <option value="10:30:00">10.30 uur</option>
                        <option value="10:45:00">10.45 uur</option>
                        <option value="11:00:00">11.00 uur</option>
                        <option value="11:15:00">11.15 uur</option>
                        <option value="11:30:00">11.30 uur</option>
                        <option value="11:45:00">11.45 uur</option>
                        <option value="12:00:00">12.00 uur</option>
                        <option value="12:15:00">12.15 uur</option>
                        <option value="12:30:00">12.30 uur</option>
                        <option value="12:45:00">12.45 uur</option>
                        <option value="13:00:00">13.00 uur</option>
                        <option value="13:15:00">13.15 uur</option>
                        <option value="13:30:00">13.30 uur</option>
                        <option value="13:45:00">13.45 uur</option>
                        <option value="14:00:00">14.00 uur</option>
                        <option value="14:15:00">14.15 uur</option>
                        <option value="14:30:00">14.30 uur</option>
                        <option value="14:45:00">14.45 uur</option>
                        <option value="15:00:00">15.00 uur</option>
                        <option value="15:15:00">15.15 uur</option>
                        <option value="15:30:00">15.30 uur</option>
                        <option value="15:45:00">15.45 uur</option>
                        <option value="16:00:00">16.00 uur</option>
                        <option value="16:15:00">16.15 uur</option>
                        <option value="16:30:00">16.30 uur</option>
                        <option value="16:45:00">16.45 uur</option>
                        <option value="17:00:00">17.00 uur</option>
                        <option value="17:15:00">17.15 uur</option>
                        <option value="17:30:00">17.30 uur</option>
                        <option value="17:45:00">17.45 uur</option>
                        <option value="18:00:00">18.00 uur</option>
                        <option value="18:15:00">18.15 uur</option>
                        <option value="18:30:00">18.30 uur</option>
                        <option value="18:45:00">18.45 uur</option>
                        <option value="19:00:00">19.00 uur</option>
                        <option value="19:15:00">19.15 uur</option>
                        <option value="19:30:00">19.30 uur</option>
                        <option value="19:45:00">19.45 uur</option>
                        <option value="20:00:00">20.00 uur</option>
                        <option value="20:15:00">20.15 uur</option>
                        <option value="20:30:00">20.30 uur</option>
                        <option value="20:45:00">20.45 uur</option>
                        <option value="21:00:00">21.00 uur</option>
                        <option value="21:15:00">21.15 uur</option>
                        <option value="21:30:00">21.30 uur</option>
                        <option value="21:45:00">21.45 uur</option>
                    </select>
                </label>
                </form>
            </div> <!--second block-->

        <div class="col-xs-1 col-xs-offset-1"><span class="number">3</span></div>
        <div class="col-sm-3">
            <form action="reserveren.php" id="main-contact-form" class="contact-form" name="contact-form" method="post">

                <div class="form-group">
                    <input type="text" class="form-control" name="name" required="required" placeholder="Vul uw voornaam en achternaam in">
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" name="email" required="required" placeholder="Vul uw email in">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="number" onkeypress="return isNumberKey(event)" maxlength="8" required="required" placeholder="Vul uw pasnummer in">
                </div>
                    <button type="submit" class="btn btn-primary" name="submit">Reserveren</button>
                </form>
            </div>
        <!--third block-->
        </div>
    <footer class="panel-footer">
        <div class="footer">
            <p>© 2015 Mahorokan Sports Club | <button type="button" onclick="window.location='admin_loginpage.php'" name="admin" class="btn btn-default btn-sm">Admin</button><br>
                <?php if($loggedIn2) {
                    echo "<p>".$logout." | ".$edit.'<br>'.$backwards.'<br>'.'<b>'.'Welkom, '.'<b>'.$username ."</p>";
                    //echo links in footer with login status
                } ?>
            </p>
        </div> <!--footer-->
    </footer>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<!--bootstrap javascript links-->
</body>
</html>