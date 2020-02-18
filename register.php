<?php
error_reporting(0);
require_once "connect.php";

$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
?>

<?php


echo $password_err;

if($_POST["signup_submit"])//$_SERVER['REQUEST_METHOD'] == "POST" && $_POST["signup_submit"]);
{   echo "posted";
    //username is empty
    if(empty(trim($_POST['username'])))
    {
        $username_err = "Username cannot be empty....";
    }
    else
    {   echo "pass1";
        $sql = "SELECT id FROM users WHERE username = ?";
        $stmt = mysqli_prepare($conn,$sql);
        if($stmt)
        {   echo "pass2";
            mysqli_stmt_bind_param($stmt,"s",$param_username);

            //set param_username
            $param_username = trim($_POST['username']);

            //try executing stmt
            
            if(mysqli_stmt_execute($stmt))
            {   echo "pass3";
                mysqli_stmt_store_result($stmt);
                if(mysqli_stmt_num_rows($stmt) == 1)
                {   echo "pass4";
                    $username_err = "This username s already taken....";

                }
                else
                {   echo "pass5";
                    $username = trim($_POST['username']);
                }
            }
            else
            {   echo "pass6";
                echo "Something went wrong..";
            }
        }
    }
    mysqli_stmt_close($stmt);


    // check for passwordp

    if(empty(trim($_POST['password'])))
    {   echo "pass7";
    $password_err = "Password cannot be blank....";
    echo $password_err;
    //header("location:register.php");
    }
    elseif(strlen(trim($_POST['password'])) < 5)
    {   echo "pass8";
    $password_err = "Password Cannot be of less then 5 Characters.....";
    }
    else
    {   echo "pass9";
        $password = trim($_POST['password']);

    }

    //check for confirm password
    if(trim($_POST['password']) != trim($_POST['confirm_password']))
    {   echo "pass10";
        $confirm_password_err = "Password should have to match....";
    }

    // if there is no error 

    if(empty($username_err) && empty($password_err) && empty($confirm_password_err))
    {   echo "pass11";
        $sql = "INSERT INTO users (username, password) VALUES(?,?)";
        $stmt = mysqli_prepare($conn,$sql);
        if($stmt)
        {   echo "pass12";
            mysqli_stmt_bind_param($stmt,"ss",$param_username,$param_password);
            // setting parameters
            $param_username = $username;
            $param_password = password_hash($password,PASSWORD_DEFAULT);

            //  try to execute the query 

            if(mysqli_stmt_execute($stmt))
            {   echo "pass13";
                header("location: login.php");
                echo "registered successfully";
            }
            else
            {   echo "pass14";
                echo "Something went wrong ...cannot redirect ....";
            }
        }
        mysqli_stmt_close($stmt);

    }
    else
    {
        echo " Error";
    }
    mysqli_close($conn);
}

?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>PHP Login System</title>
  </head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">REGISTRATION</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">
      <a class="nav-item nav-link active" href="login.php">Login<span class="sr-only">(current)</span></a>
      <a class="nav-item nav-link" href="#">About</a>
      <a class="nav-item nav-link" href="#">Contact</a>
      <a class="nav-item nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
    </div>
  </div>
</nav>

<div class="container mt-4">
<h3>Please Register Here...... </h3>
<hr>

<form action="" method="post">
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Username</label>
      <input type="text" name="username" class="form-control" id="inputEmail4">
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Password</label>
      <input type="password" name="password" class="form-control" id="inputPassword4">
      <div class="pswd-err"><?php echo $password_err; ?></div>
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Confirm Password</label>
      <input type="password" name="confirm_password" class="form-control" id="inputPassword">
      <div class="pswd-err"><?php echo $password_err; ?></div>
    </div>
  </div>
  <div class="form-group">
    <label for="inputAddress">Address</label>
    <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
  </div>
  <div class="form-group">
    <label for="inputAddress2">Address 2</label>
    <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputCity">City</label>
      <input type="text" class="form-control" id="inputCity">
    </div>
    <div class="form-group col-md-4">
      <label for="inputState">State</label>
      <select id="inputState" class="form-control">
        <option selected>Choose...</option>
        <option>...</option>
      </select>
    </div>
    <div class="form-group col-md-2">
      <label for="inputZip">Pincode</label>
      <input type="text" class="form-control" id="inputZip">
    </div>
  </div>
  <div class="form-group">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" id="gridCheck">
      <label class="form-check-label" for="gridCheck">
        Check me out
      </label>
    </div>
  </div>
  <input type="submit" name="signup_submit" class="btn btn-dark">
</form>


</div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>



