<?php
$db_host='localhost'; //Localhost
$db_user='hozaynaci'; //Database user
$db_password='2ahdls71'; // Database password
$db_database='Mahorokan2'; //Database name

$db = mysqli_connect($db_host, $db_user, $db_password, $db_database) or die(mysqli_connect_error()); //Connecting to the database
//mysql_select_db($db_database); //Selecting the database
?>
