<!DOCTYPE html>
<html lang="en">
<head>
  <!--This website is inspired from the help of bootstrap template: http://getbootstrap.com/examples/signin/; -->

  <title>Passbook</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
include 'connect.php';

// If the values are posted, insert them into the database.


if (!empty($_POST["username"]) && !empty($_POST["password"])){
    $username = $_POST["username"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];
    $date = Date("Y/m/d");
    $slquery = "SELECT 1 FROM user_pb WHERE username = '$username'";
    $selectresult = mysqli_query($conn, $slquery);
    if(mysqli_num_rows($selectresult)>0)
    {
         $errorMessage = '<p align=center>Sorry, but current username already exists.</p>';
         echo $errorMessage . "<br>";
         echo '<div class="form-actions"><a href="register.html" role="button" class="btn btn-lg btn-danger"> Click here to retry</a></div>';
    }
    elseif($password != $cpassword){
         $errorMessage = "<p align=center>Password doesn't match.</p>";
         echo $errorMessage . "<br>";
         echo '<div class="form-actions"><a href="register.html" role="button" class="btn btn-lg btn-danger"> Click here to retry</a></div>';
    } 
    else{
          $sPassword = md5($password);
          $query = "INSERT INTO user_pb (username,password)
          VALUES ('$username','$sPassword')";
          $result = mysqli_query($conn,$query);
          if($result){
             $msg = "<p align=center>User Created Successfully.</p>";
             echo $msg . "<br>";
             echo '<div class="form-actions"><a href="login.html" role="button" class="btn btn-lg btn-success"> Click here to login</a></div>';
          } else {
            echo "Failure!";
          }
    }
} 
mysqli_close($conn);
?>
<br>
</body>
</html>