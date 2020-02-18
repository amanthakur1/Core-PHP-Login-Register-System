<?php

    include("header.php");
    include("connect.php");
    session_start();

    if(!isset($_SESSION['loggedin'])){
        //echo "pass1";
        header("location:login.php");
    }

    if(isset($_POST['submit_worker']))
    {
        //$sql = "SELECT id FROM users WHERE username = ?";


        $sql = "INSERT INTO workers (admin_id, name,age) VALUES('$_POST[worker_age]','$_POST[name]','$_POST[worker_age]')";
        mysqli_query($conn,$sql);
    }


?>


<div class="panel panel-default">

    <div class="panel-heading m-4 ">
         <h2>   
            
            <a class="btn btn-secondary pull-right"  href="welcome.php"> Back </a>

            <hr>
        </h2>
    </div>

    <div class="panel-body m-4">
        <form action="" method="post">
            <div class="form-group">
                <label for="exampleInputEmail1">Worker Name</label>
                <input type="text" class="form-control" name="name" id="name" aria-describedby="emailHelp">
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1"> Age </label>
                <input type="number" class="form-control" name="worker_age" id="worker_age">
            </div>
            <input type="submit" name="submit_worker" value="submit" class="btn btn-primary" required>
        </form>



    </div>

</div>