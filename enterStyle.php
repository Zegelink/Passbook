<?php
    session_start();
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<meta name="description" content="">
<meta name="author" content="">
<link rel="icon" href="../../favicon.ico">

<title>Customise Password Style</title>

<!-- Bootstrap core CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

<!-- Custom styles for this template -->
<link href="style.css" rel="stylesheet">

</head>

<body>

<div class="container">

<form action="enterStyle.php" class="form-signin" method="post" role="form">
<h2 class="form-signin-heading" align="center"><b>Enter Style: </b></h2>
<br>
<label for="name">Style</label>
<input type="text" id="style" name="style"class="form-control" placeholder="" required autofocus>

<button class="btn btn-lg btn-success btn-block" type="submit">Confirm</button>
<a href="index.php" class="btn btn-lg btn-danger btn-block" type="submit">Cancel</a> <br>
</form>

</div> <!-- /container -->


<?php
include 'connect.php';
    
// If the values are posted, insert them into the database.
    if (!empty($_POST["style"])) {
        $style = $_POST["style"];
        $uid = $_SESSION['uid'];
        $slquery = "SELECT 1 FROM `cs340_chencho`.`style_pb` WHERE style = '$style' AND uid = '$uid' ";
        $selectresult = mysqli_query($conn, $slquery);
        if(mysqli_num_rows($selectresult) == 1)
        {
            $errorMessage = '<p align=center>The style is already exist</p>';
            echo $errorMessage . "<br>";
            echo '<div class="form-actions"><a href="checkExistingStyle.php" role="button" class="btn btn-lg btn-success">Proceed to enter item for your styles.</a></div>';

        }
        else{
            $result = 0;
            if(!empty($style)){
                $query = "INSERT INTO `cs340_chencho`.`style_pb` (uid, style) VALUES ('$uid', '$style' )";
                $result += mysqli_query($conn,$query);
            }
            
            if($result== 1){
                $msg = "<p align=center>Style entered.</p>";
                echo $msg . "<br>";
                echo '<div class="form-actions"><a href="checkExistingStyle.php" role="button" class="btn btn-lg btn-success">Proceed to enter item for your styles.</a></div>';
            }
            else {
                echo "Failed to update";
            }
        }



        //find the student ID in the database
        //if the number of ID is not equal to 1
        
        //find the student ID in the database
        //if the number of ID is not equal to 1
        

    }
    else{
    }

    
mysqli_close($conn);
?>
<br>
</body>
</html>