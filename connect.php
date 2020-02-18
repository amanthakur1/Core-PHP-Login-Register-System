<?php
/*
This file contain Data Base connection And configuaration

*/
error_reporting(0);
define('DB_SERVER','localhost');
define('DB_USERNAME','id12208822_amanchauhan');
define('DB_PASSWORD','root@123');
define('DB_NAME','id12208822_login');

// try connecting database

$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

//check conn

if($conn == false)
{
    echo "Error: Cannot connect to Server.....";
}
else{
    //echo "sucess";
}
?>