<?php
session_start(); //sessions are started
require_once 'includes_requires/config.php'; //includes the file

$email =  $_SESSION['email']; //getting log in status
$loggedIn= $_SESSION['loggedIn']; //login session for admin
$delete1 = '<a href="?id='; //anchor tag for delete
$delete2 = 'name="id"><div class= "glyphicon glyphicon-remove"></div></a>';
$add = '<a type="submit" href="?id=" name="id" id="plus"><div class="glyphicon glyphicon-plus"></div></a>';
$idDelete = $_GET['id']; //creating variables
$idAdd = $_POST['submit'];
$search = $_POST['search'];


if (isset($_GET ["action"]) && $_GET ["action"] === "logout"){ //admin logout
    session_destroy(); //destroying session
    header("Location:adminLogin.php"); //go to the location after destroying
    exit;
}
if (isset($loggedIn)){ //if admin had logged in
    $query = "SELECT * FROM Reservation ORDER BY id DESC";
    //selecting all information from table and ordering
    $result = mysqli_query($db, $query);

    $logout = '<a href="admin.php?action=logout">Logout</a>'; //variables for footer links
    $register = '<a class="account" href="register.php">Registreren</a>';
} else {
    header('Location:adminLogin.php'); //if not logged in, go to the location
    exit;
}

if (isset($idDelete)) { //if delete button has been used
$query = "DELETE FROM Reservation WHERE id=".$idDelete." LIMIT 1";
    //deleting the id, limited by 1
$result = mysqli_query($db, $query);
header('Location:admin.php'); //go to location after deleting
exit; //exit header
}

if(isset($idAdd)){ //if add has been used
    $name = $_POST['name']; //created variables
    $email1 = $_POST['email'];
    $number = $_POST['pass'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $query = "INSERT INTO Reservation (`name`,`email`,`passnumber`,`date`,`time`) VALUES ('$name','$email1','$number','$date','$time')" or die ("could not retrieve the requested information");
    //insert information from input fields to database columns
    $insertResult = mysqli_query($db, $query);
    header ('Location:admin.php'); //go to location after adding
    exit(); //exit header
}
if(isset($_POST['search'])){ //if searched
    $query2 ="SELECT * FROM Reservation WHERE `id` LIKE '%$search%' OR `name` LIKE '%$search%' OR `email` LIKE '%$search%' OR `passnumber` LIKE '%$search%'";
    //select data from database table and use the $search variable
    $result2 = mysqli_query($db,$query2);
    while($rows = mysqli_fetch_assoc($result2)){ //starting while loop
        $name = $rows['name']; //creating variables for database columns
        $email = $rows['email'];
        $number = $rows['passnumber'];
        $output = '<p>'.$name.' | '.$email.' | '.$number.'</p>'; //creating variable for echo
    }
}

$page = $_SERVER['PHP_SELF'];
$timer = "900";
//15 min auto refreshing the page for updates
?>


<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="refresh" content="<?php echo $timer?>;URL='<?php echo $page //auto refreshing ?>'">
    <link rel="icon" type="image/png" href="../img/favicon.png">
    <link rel="stylesheet" href="../css/bootstrap_css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/adminStyle.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../css/bootstrap_css/site.css">
    <!--bootstrap-->
    <title>Administrator</title>
</head>
<body>
    <div class="col-lg-8 col-lg-offset-2">
    <form action="admin.php" method="post">
        <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
            <form action="admin.php" method="post">
            <div class="input-group">
                <input type="text" class="form-control" name="search" placeholder="Zoeken naar...">
                <span class="input-group-btn">
                    <input class="btn btn-default" name="button" value="Zoeken" type="submit">
                </span>
            </div><!--search bar-->
            </form>
        </div>
</form>
<h2>Overzicht reserveringen</h2>
        <?php
        print $output //printing search result;
        ?>
<div class="panel panel-default">
    <div class="panel-heading">Mahorokan Sports Club</div>
    <table class="table">
        <thead>
        <tr>
            <th >#</th>
            <th>Naam</th>
            <th>Email</th>
            <th>Pasnummer</th>
            <th>Datum</th>
            <th>Tijd</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <?php

            while($row = mysqli_fetch_array($result)){
            //getting data from database for table
            echo '<tr>
                <td>'.$row['id'].'</td>
                <td>'.$row['name'].'</td>
                <td>'.$row['email'].'</td>
                <td>'.$row['passnumber'].'</td>
                <td>'.$row['date'].'</td>
                <td>'.$row['time'].'</td>
                <td>'.$delete1 .$row["id"].$delete2.'</td>
                </tr>';//delete button
            }
            ?>
        </tr>
        <tr>
        </tbody>
    </table>
</div>
        <div class="panel panel-default">
            <div class="panel-heading">Reservering toevoegen</div>
            <form action="admin.php" id="main-contact-form" class="contact-form" name="contact-form" method="post">
            <table class="table">
                <thead>
                <tr>
                    <th >#</th>
                    <th>Naam</th>
                    <th>Email</th>
                    <th>Pasnummer</th>
                    <th>Datum</th>
                    <th>Tijd</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td></td>
                    <td><input type="text" class="form-control" name="name" required="required" placeholder="Naam"></td>
                    <td><input type="text" class="form-control" name="email" required="required" placeholder="Email"></td>
                    <td><input type="text" class="form-control" name="pass" required="required" placeholder="Nummer"></td>
                    <td><label><input type="date" name="date" class="date" min="<?php echo date('Y-m-d'); ?>" required="required"></label></td>
                    <td><label>
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
                    </td>
                    <td><button type="submit" class="btn btn-success" name="submit">Toevoegen</button></td>
                    <!--adding table-->
                </tr>
                </tbody>
            </table>
            </form>
        </div>

<a class="backwards" href="../index.php">Terug naar startpagina</a>
    </div>
        <footer class="panel-footer">
            <div class="footer">
                <p>© 2015 Mahorokan Sports Club | <button type="button" onclick="window.location='adminLogin.php'" name="admin" class="btn btn-default btn-sm">Admin</button><br>
                    <?php if($loggedIn) {
                        echo '<p>'.$logout." | ".$register.'<br>'.'<b>'.'Welkom, '.$email.'<b>'.'</p>';
                        //echo if admin logged in
                    } ?>
                </p>
            </div>
        </footer><!--footer-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
</body>
</html>