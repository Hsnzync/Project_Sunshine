<?php 
    session_start(); //sessions are started
    require_once "src/components/includes_requires/config.php"; //includes the file

    $email =  $_SESSION['email']; //creating variable for login status
    $loggedIn2 = $_SESSION['loggedIn2']; //login session for customer
    if(isset($_POST["submit"])){ //if submit button has been submitted
        if(($_POST["Fname"]) !== "" && ($_POST["Lname"]) !== "" && ($_POST["email"])!== "" && ($_POST["message"]) !== "") { //if input fields aren't empty
            $Fname=$_POST["Fname"]; //create variables
            $Lname=$_POST["Lname"];
            $email=$_POST["email"];
            $text=$_POST["message"];
            $query="INSERT INTO contact (firstname, lastname, email, note) VALUES ('$Fname','$Lname','$email','$text')" or die (mysql_error());
            //insert the data into database table
            $result = mysqli_query($db, $query);
        }
        elseif(($_POST["Fname"]) === "" && ($_POST["Lname"]) === "" && ($_POST["email"]) === "" && ($_POST["message"]) === "") { //if empty
            $message = "U bent wat vergeten!"; //give message a variable and echo
        }
        else {
            $message = "controleer formulier";//if not, echo this
        }
    }
    if(isset($_POST['submit'])){ //if submit button has been submitted
        $Fname = $_POST['Fname']; //create variables
        $Lname = $_POST['Lname'];
        $emailTo = $_POST['email']; //customer email
        $text = $_POST['message'];
        $headers = 'From: hsnzync_@hotmail.com' . "\r\n" . //my email as sender
            'Reply-To: hsnzync_@hotmail.com' . "\r\n" . //replying
            'X-Mailer: PHP/' . phpversion();
        mail($Fname, $Lname, $text, $headers); //ordering email structure
        if(mail($emailTo, $Fname, $Lname, $text)) { //if sent
            $message = 'bericht verzonden'; //echo message below
        } else {
            $message = 'bericht verzenden mislukt'; //if not, echo message below
        }
    }
    if (isset($_GET ["action2"]) && $_GET ["action2"] === "logout2") { //logout
        session_destroy(); //destroy the session
        header("Location:src/components/customer_login.php"); //go to the location
        exit;//exit header
    }
    if (isset($loggedIn2) ){ //if logged in as customer
        $logout = '<a href="?action2=logout2">Uitloggen</a>'; //create variables
        $edit = '<a href="src/components/passRecovery.php">Wachtwoord wijzigen</a>';
    } else { //if not customer
        $login = '<a class="account" href="src/components/customer_login.php">Inloggen</a>'; //create other variables
        $register = '<a class="account" href="src/components/register.php">Registreren</a>';
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="src/css/bootstrap_css/site.css">
        <link rel="icon" type="image/png" href="src/img/favicon.png">
        <link rel="stylesheet" href="src/css/bootstrap_css/bootstrap.min.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
        <link href='http://fonts.googleapis.com/css?family=Raleway:400,300' rel='stylesheet' type='text/css'>
        <link href="src/css/main.css" rel="stylesheet">

        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js"></script>
        <title>Project Sunshine</title>
    </head>
<body>

    <nav class="navbar navbar-default" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand">Project Sunshine</a>
            </div>

            <div class="collapse navbar-collapse navbar-right navbar-ex1-collapse">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="#second" class="smoothScroll">Assortiment</a>
                    </li>
                    <li>
                        <a href="#third" class="smoothScroll">Reserveren</a>
                    </li>
                    <li>
                        <a href="#fourth" class="smoothScroll">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div id="first">
        <div id="itemwrap">
            <?php
            echo $message;
            ?>
            <h1>Botenverhuur</h1>
            <h2>Wij bieden u een 100% Mooi Weer Garantie, wat betekent dat u kosteloos uw reservering kunt annuleren bij slecht weer.</h2>
            <i class="fas fa-caret-down"></i>
        </div>
    </div>

    <section id="subfirst" >
        <div class="row ">
            <div class="col-md-4 col-centered">
                <div class="media">
                    <div class="media-body">
                        <i class="fas fa-ship"></i>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris eget nulla eu dolor tristique efficitur sed non turpis. 
                            Vestibulum nisl magna, porttitor quis ullamcorper in, pretium vitae sapien. Morbi volutpat purus elit.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-centered">
                <div class="media">
                    <div class="media-body">
                        <i class="fas fa-clock"></i>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris eget nulla eu dolor tristique efficitur sed non turpis. 
                            Vestibulum nisl magna, porttitor quis ullamcorper in, pretium vitae sapien. Morbi volutpat purus elit.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-centered">
                <div class="media">
                    <div class="media-body">
                        <i class="fas fa-phone"></i>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris eget nulla eu dolor tristique efficitur sed non turpis. 
                            Vestibulum nisl magna, porttitor quis ullamcorper in, pretium vitae sapien. Morbi volutpat purus elit.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div id="second">
        <div class="row row-centered" id="photos">
            <div class="col-sm-4">
                <img class="rounded mx-auto d-block" src="src/img/album_1.jpg" alt="boat_1">
            </div>
            <div class="col-sm-4">
                <img class="rounded mx-auto d-block" src="src/img/album_2.jpg" alt="boat_2">
            </div>
            <div class="col-sm-4">
                <img class="rounded mx-auto d-block" src="src/img/album_3.jpg" alt="boat_3">
            </div>
        </div>
    </div>

    <div id="third">
        <div class="container">
            <h2>Reserveren</h2>
            <p class="subtext2">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris eget nulla eu dolor tristique efficitur sed non turpis. 
                Vestibulum nisl magna, porttitor quis ullamcorper in, pretium vitae sapien. Morbi volutpat purus elit.
            </p>
            <a href="src/components/reserveren.php"><input type="submit" class="btn btn-info" value="Reserveren"></a>
        </div>
    </div>

    <div id=fourth>
        <h2>Contact</h2>
        <p class="subtext3">Wilt u meer informatie over onze zonnebank? Dan kunt u een afspraak maken met een van onze sportadviseurs.</p>
        <section id="contact-page" class="container">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="status alert alert-success" style="display: none"></div>
                <form action="index.php" id="main-contact-form" class="contact-form" name="contact-form" method="post">
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="form-group">
                                <input type="text" class="form-control" name="firstname" required="required" placeholder="Voornaam">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="lastname" required="required" placeholder="Achternaam">
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" name="email" required="required" placeholder="Email">
                            </div>
                            <div class="form-group">
                                <input type="submit" name="submit" class="btn btn-info" value="Verzenden">
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <textarea name="message" id="message" required="required" class="form-control" rows="8" placeholder="Bericht"></textarea>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    
    </div>
    
    <footer class="panel-footer">
        <div class="footer">
            <p>© Project Sunshine 2018 <button type="button" onclick="window.location='src/components/admin_loginpage.php'" name="admin" class="btn btn-default btn-sm">Admin</button><br>
                <?php if($loggedIn2) {
                    echo "<p>".$logout." | ".$edit.'<br>'.'<b>'.'Welkom, '.$email .'<b>'."</p>";
                    
                } if (!$loggedIn2){
                    echo "<p>".$login." | ".$register."</p>";
                }
                ?>
            </p>
        </div>
    </footer>

    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/maps.js"></script>
</body>
</html>