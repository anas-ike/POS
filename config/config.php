<?php

date_default_timezone_set('Asia/Makassar');

$host   = 'localhost';
$user   = 'root';
$pass   = '';
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