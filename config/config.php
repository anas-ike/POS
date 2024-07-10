<?php

date_default_timezone_set('Asia/Kolkata');

$host   = 'localhost';
$user   = 'root';
$pass   = 'root';
$dbname   = 'db_pos';


$conn   = mysqli_connect($host, $user, $pass, $dbname);

// if(mysqli_connect_errno()) {
//     echo "DB connection failed";
//     exit();
// }else {
//     echo "DB connection succesfully";
// }

$main_url = 'http://localhost/POS/';


?>
