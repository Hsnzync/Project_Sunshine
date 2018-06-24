<?php
session_start(); //sessions are started
require_once 'includes_requires/config.php';  //includes the file

$loggedIn2 = $_SESSION['loggedIn2'];
$submit = $_POST['submit']; //creating variables
$username = $_POST['username'];
$password = $_POST['password'];
$message = "";

if (isset($loggedIn2)){
    $logout = '<a href="?action2=logout2">Uitloggen</a>'; // variables with anchor tags to prevent long html in php echo
    $register = '<a class="account" href="register.php">Registreren</a>';
    $backwards = '<a href="../../index.php">Terug naar startpagina</a>';
} else {
    $login = '<a class="account" href="customer_login.php">Inloggen</a>';
    $register = '<a class="account" href="register.php">Registreren</a>';
    $backwards = '<a href="../../index.php">Terug naar startpagina</a>';
}
if (isset($_GET ["action2"]) && $_GET ["action2"] === "logout2"){
    session_destroy();
    header("Location:customer_login.php");
    exit;
}
$alert1 = '<div class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
           <span class="sr-only"></span>';
$alert2 = '</div>';

if(isset($submit)){
    $query = 'SELECT * FROM admin WHERE username = "' . $username . '" AND password = "' . $password . '"';
    // select columns in a table from localhost
    $result = mysqli_query($db, $query);

    if ($row = mysqli_fetch_assoc($result)){
        // creating sessions to use in other files and to secure pages
        $_SESSION['loggedIn'] = true;

        $_SESSION['emausernameil'] = $row['username'];
        header('Location:admin_page.php');
        exit; // go to the location and exit
    } else{
        $message = 'Login mislukt'; //or else, echo this message
    }
}
if($_SESSION['loggedIn'] == true) {
    header('Location:admin_page.php');
    exit; // if logged in as administrator, go directly to the location
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
    <link rel="stylesheet" href="../css/adminLoginStyle.css">
    <!--bootstrap and css-->
    <title>Inloggen</title>
</head>
<body>

<div class="container">
<form class="form-signin" action="admin_loginpage.php" method="post">
    <?php if($message) {
        echo $alert1.$message.$alert2;
        }
    ?>
    <div class="card card-container">
        <!-- <img class="profile-img-card" src="//lh3.googleusercontent.com/-6V8xOA6M7BA/AAAAAAAAAAI/AAAAAAAAAAA/rzlHcD0KYwo/photo.jpg?sz=120" alt="" /> -->
        <img id="profile-img" class="profile-img-card" src="https://cdn0.iconfinder.com/data/icons/user-pictures/100/supportmale-2-512.png" />
        <p id="profile-name" class="profile-name-card"></p>
            <span id="reauth-email" class="reauth-email"></span>
            <input type="text" name="username" id="inputEmail" class="form-control" placeholder="Gebruikersnaam" required autofocus>
            <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Wachtwoord" required>

            <button class="btn btn-lg btn-primary btn-block btn-signin" name="submit" type="submit">Inloggen</button>
    </div><!-- /card-container -->
    </form><!-- /form -->

</div><!-- /container -->

<footer class="panel-footer">
    <div class="footer">
        <p>© 2015 Mahorokan Sports Club | <button type="button" onclick="window.location='adminLogin.php'" name="admin" class="btn btn-default btn-sm">Admin</button><br>
            <?php if($loggedIn2){
                echo '<p>'.$logout.' | '.$register.'<br>'.$backwards.'</p>';
            //echo links in footer
            } if(!$loggedIn2) {
                echo '<p>'.$login.' | '.$register.'<br>'.$backwards.'</p>';
            }?>
        </p>
    </div>
</footer><!--footer-->
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<!--bootstrap javascript links-->
</body>
</html>