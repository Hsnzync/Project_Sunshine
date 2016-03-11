<?php
session_start(); //sessions are started
require_once "php/includes_requires/config.php"; //includes the file

$email =  $_SESSION['email']; //creating variable for login status
$loggedIn2 = $_SESSION['loggedIn2']; //login session for customer

if(isset($_POST["submit"])){ //if submit button has been submitted
    if(($_POST["Fname"]) !== "" && ($_POST["Lname"]) !== "" && ($_POST["email"])!== "" && ($_POST["message"]) !== "") { //if input fields aren't empty

        $Fname=$_POST["Fname"]; //create variables
        $Lname=$_POST["Lname"];
        $email=$_POST["email"];
        $text=$_POST["message"];

        $query="INSERT INTO Contact (Naam,Achternaam,Email,Bericht) VALUES ('$Fname','$Lname','$email','$text')" or die (mysql_error());
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
    header("Location:php/customLogin.php"); //go to the location
    exit;//exit header
}
if (isset($loggedIn2) ){ //if logged in as customer
    $logout = '<a href="?action2=logout2">Uitloggen</a>'; //create variables
    $edit = '<a href="php/passRecovery.php">Wachtwoord wijzigen</a>';
} else { //if not customer
    $login = '<a class="account" href="php/customLogin.php">Inloggen</a>'; //create other variables
    $register = '<a class="account" href="php/register.php">Registreren</a>';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="css/bootstrap_css/site.css">
    <link rel="icon" type="image/png" href="img/favicon.png">
    <link rel="stylesheet" href="css/bootstrap_css/bootstrap.min.css">
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,300' rel='stylesheet' type='text/css'>
    <link href="css/style.css" rel="stylesheet">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js"></script>
    <script type="text/javascript" src="js/smoothscroll.js"></script>
    <!--bootstrap links-->
    <title>Mahorokan Sports Club</title>
</head>
<body>

<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="http://startbootstrap.com">Mahorokan Sports Club</a>
        </div>

        <div class="collapse navbar-collapse navbar-right navbar-ex1-collapse">
            <ul class="nav navbar-nav">
                <li>
                    <a href="#second" class="smoothScroll">Fotoalbum</a>
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
        echo $message; //echo created variables here
        ?>
        <h1>Welkom</h1>
        <h2>Reserveer nu uw zonnebank</h2>
        <a href="#third" class="smoothScroll"><img class="Arrow" src="img/Arrow.png" alt="Arrow"></a>
    </div>
</div> <!--first block-->
<section id="subfirst" >
    <div class="row ">
        <div class="col-sm-3 col-centered">
            <div class="media">
                <div class="media-body">
                    <img class="media-heading" src="img/Sun.png">
                    <p>Mahorokan heeft haar zonnebank uitgerust met speciale blue D-lite lampen. Een mooi tintje is heel mooi
                        in de zomer maar zeker ook in de winter, reserveer dan uw zonnebank bij Mahorokan Sport Club!</p>
                </div>
            </div>
        </div>
        <div class="col-sm-3 col-centered">
            <div class="media">
                <div class="media-body">
                    <img class="media-heading" src="img/D.png">
                    <p>In Nederland hebben we te weinig zonmomenten om het hele jaar door voldoende vitamine D aan te kunnen maken. Deze vitamine wordt
                        door je lichaam aangemaakt onder invloed van voldoende zonlicht en zorgt ervoor dat lichaam optimaal functioneert.</p>
                </div>
            </div>
        </div>
        <div class="col-sm-3 col-centered">
            <div class="media">
                <div class="media-body">
                    <img class="media-heading" src="img/Light.png">
                    <p>Wij hebben zonnebank uitgerust met speciale blue D-lite lampen die zorgen voor een optimale vitamine D aanmaak. Dit
                        zorgt voor een duidelijk positieve invloed op het humeur, gaat vermoeidheid tegen en verbetert het concentratievermogen!</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!--second block-->
<div id="second">
    <div class="row row-centered" id="photos">
        <h2>Foto's</h2>
        <p class="subtext">Gezond en bruin eruit zien in de zomer en winter! <br>Hier vindt u foto's van onze zonnebank die u kunt reserveren.</p>
        <div class="col-sm-3 col-centered">
            <a href="img/DSC_0040.JPG" class="thumbnail">
                <img class="image" src="img/DSC_0040.JPG" alt="Entrance">
            </a>
        </div>
        <div class="col-sm-3 col-centered">
            <a href="img/Zonnebank.jpg" class="thumbnail">
                <img class="image" src="img/Zonnebank.jpg" alt="Solariumone">
            </a>
        </div>
        <div class="col-sm-3 col-centered">
            <a href="img/DSC_0033.JPG" class="thumbnail">
                <img class="image" src="img/DSC_0033.JPG" alt="Solariumtwo">
            </a>
        </div>
        <div class="col-sm-3 col-centered">
            <a href="img/Solarium.jpg" class="thumbnail">
                <img class="image" src="img/Solarium.jpg" alt="Solariumtwo">
            </a>
        </div>
        <div class="col-sm-3 col-centered">
            <a href="img/solarium_1.jpg" class="thumbnail">
                <img class="image" src="img/solarium_1.jpg" alt="Solariumtwo">
            </a>
        </div>
        <div class="col-sm-3 col-centered">
            <a href="img/solarium_2.jpg" class="thumbnail">
                <img class="image" src="img/solarium_2.jpg" alt="Solariumtwo">
            </a>
        </div>
    </div>
</div>
<!--third block-->
<div id="third">
    <div class="container">
        <h2>Reserveren</h2>
        <p class="subtext2"> Om gebruik te maken van onze zonnebank is het handig om vooraf te reserveren.
            <br>U kunt direct reserveren door op de onderstaande knop te drukken!
        </p>
        <a class="reserveren" type="submit" href="php/reserveren.php">Reserveren</a>
    </div>
</div>
<!--fourth block-->
<div id=fourth>
    <h2>Contact</h2>
    <p class="subtext3">Wilt u meer informatie over onze zonnebank?
        Dan kunt u een afspraak maken met een van onze sportadviseurs.
    </p>
    <section id="contact-page" class="container">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="status alert alert-success" style="display: none"></div>
                <form action="index.php" id="main-contact-form" class="contact-form" name="contact-form" method="post">
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="form-group">
                                <input type="text" class="form-control" name="Fname" required="required" placeholder="Voornaam">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="Lname" required="required" placeholder="Achternaam">
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" name="email" required="required" placeholder="Email">
                            </div>
                            <div class="form-group">
                                <input type="submit" name="submit" class="btn btn-primary" value="Verzenden">
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
        <!-- <div id="map"></div> -->
    </div>
    <!--last block-->
    <footer class="panel-footer">
        <div class="footer">
            <p>© 2015 Mahorokan Sports Club | <button type="button" onclick="window.location='php/adminLogin.php'" name="admin" class="btn btn-default btn-sm">Admin</button><br>
                <?php if($loggedIn2) {
                    echo "<p>".$logout." | ".$edit.'<br>'.'<b>'.'Welkom, '.$email .'<b>'."</p>";
                    //echo links in footer with login status
                } if (!$loggedIn2){ //if not logged in, echo that
                    echo "<p>".$login." | ".$register."</p>";
                }
                ?>
            </p>
        </div>
    </footer><!--footer-->
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/maps.js"></script>
</body>
<script>
    var hashTagActive = "";
    $(".scroll").click(function (event) {
        if(hashTagActive != this.hash) { //this will prevent if the user click several times the same link to freeze the scroll.
            event.preventDefault();
            //calculate destination place
            var dest = 0;
            if ($(this.hash).offset().top > $(document).height() - $(window).height()) {
                dest = $(document).height() - $(window).height();
            } else {
                dest = $(this.hash).offset().top;
            }
            //go to destination
            $('html,body').animate({
                scrollTop: dest
            }, 2000, 'swing');
            hashTagActive = this.hash;
        }
    });
    <!--jquery scrolling-->
</script>
</html>