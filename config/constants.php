<?php 

// start session
session_start();

// create constants to store repeating values
define('SITEURL', 'http://localhost/restaurant/');
define('LOCALHOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'restaurant');

$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error()); //database connection
$db_select = mysqli_select_db($conn, 'restaurant') or die(mysqli_error()); //selecting  database


?>