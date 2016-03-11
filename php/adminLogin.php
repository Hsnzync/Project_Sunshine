<?php
session_start(); //sessions are started
require_once 'includes_requires/config.php';  //includes the file

$loggedIn2 = $_SESSION['loggedIn2'];
$submit = $_POST['submit']; //creating variables
$email = $_POST['email'];
$password = $_POST['password'];
$message = "";

if (isset($loggedIn2)){
    $logout = '<a href="?action2=logout2">Uitloggen</a>'; // variables with anchor tags to prevent long html in php echo
    $register = '<a class="account" href="register.php">Registreren</a>';
    $backwards = '<a href="../index.php">Terug naar startpagina</a>';
} else {
    $login = '<a class="account" href="customLogin.php">Inloggen</a>';
    $register = '<a class="account" href="register.php">Registreren</a>';
    $backwards = '<a href="../index.php">Terug naar startpagina</a>';
}
if (isset($_GET ["action2"]) && $_GET ["action2"] === "logout2"){
    session_destroy();
    header("Location:customLogin.php");
    exit;
}
$alert1 = '<div class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
           <span class="sr-only"></span>'; //bootstrap sign for wrong password
$alert2 = '</div>';

if(isset($submit)){ //if the submit button has been submitted
    $query = 'SELECT * FROM Admin WHERE email = "' . $email . '" AND password = "' . $password . '"';
    // select columns in a table from localhost
    $result = mysqli_query($db, $query);

    if ($row = mysqli_fetch_assoc($result)){
        // creating sessions to use in other files and to secure pages
        $_SESSION['loggedIn'] = true;

        $_SESSION['email'] = $row['email'];
        // email for login status on every page
        header('Location:admin.php');
        exit; // go to the location and exit
    } else{
        $message = 'Login mislukt'; //or else, echo this message
    }
}
if($_SESSION['loggedIn'] == true) {
    header('Location:admin.php');
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
<form action="adminLogin.php" class="form-horizontal" method="post">
    <?php if($message) {
        echo $alert1.$message.$alert2;
        } //echo variables if $message gets activated above
    ?>
    <div class="form-group">
        <div class="col-md-1 col-md-offset-4"></div>
        <input type="email" class="form-control" name="email" id="inputEmail3" placeholder="Email admin">
    </div>
    <div class="form-group">
        <div class="col-md-1 col-md-offset-4"></div>
        <input type="password" class="form-control" name="password" id="inputPassword3" placeholder="Wachtwoord admin">
    </div>
    <div class="form-group">
    <div class="col-md-1 col-md-offset-4"></div>
        <button type="submit" name="submit" class="btn btn-primary">Inloggen</button>
    </div> <!--forms-->
    <br><br>
    </form>
</div>
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