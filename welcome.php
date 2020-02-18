<?php
    include("connect.php");
    include("bootstrap.php");
    session_start();

    if(!isset($_SESSION['loggedin'])){
        //echo "pass1";
        header("location:login.php");
    }
    //echo "pass2";
    //echo "Hello ".$_SESSION['username'];
    //$_SESSION['id'];
    
?>

<h2><div class="well text-center m-4"> WORKERS ATTENDANCE SYSTEM </div> </h2>
    <hr>
<a class="btn btn-success" href="add.php"> Add Workers   </a>
<a class="btn btn-secondary pull-right"  href="view_worker.php">View Workers</a>

<a href="logout.php"><button class="btn btn-dark">Logout</button></a>