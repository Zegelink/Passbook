<?php
    session_start();
    $wid = $_GET['wid'];
    $uid = $_SESSION['uid'];

    
    include 'connect.php';
    $sql = "SELECT * FROM `cs340_chencho`.`key_pb` WHERE wid = $wid";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0 ){
        $counter = 0;
        $accountArray;
        $passkeyArray;
        $commentArray;
        
        
        while($row = $result->fetch_assoc()){
            
            $accountArray[$counter] = $row["account"];
            $passkeyArray[$counter] = $row["passkey"];
            $commentArray[$counter] = $row["comment"];
            
            $counter++;
        }
    }
    
    
    echo '<table boarder="1" style="width:30%">';
    echo '<tr>';
    echo '<td>Account</td>';
    echo '<td>Password</td>';
    echo '<td>Comment</td>';
    echo '</tr>';
    for($i =  (count($accountArray) - 1); $i >= 0; $i-- ){
        echo "<tr>";
        echo "<td>". $accountArray[$i]. "</td>";
        echo "<td>". $passkeyArray[$i]. "</td>";
        echo "<td>". $commentArray[$i]. "</td>";
        echo "</tr>";
    }
    echo "</table>";
    echo "<br>";


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

<title>Check existing password</title>

<!-- Bootstrap core CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

<!-- Custom styles for this template -->
<link href="style.css" rel="stylesheet">

</head>

<body>

<div class="container">

<form action="enterPassword.php?wid=<?php echo $wid ?>" class="form-signin" method="post" role="form">
<h2 class="form-signin-heading" align="center"><b>Enter New Account: </b></h2>
<br>
<label for="name">Account</label>
<input type="text" id="account" name="account"class="form-control" placeholder="" required autofocus>

<label for="sid">Password</label>
<input type="text" id="password" name="password"class="form-control" placeholder="" required >

<label for="sid">Comment</label>
<input type="text" id="comment" name="comment"class="form-control" placeholder="Optional"  >
<br>



<button class="btn btn-lg btn-success btn-block" type="submit">Confirm</button>
<a href="index.php" class="btn btn-lg btn-danger btn-block" type="submit">Cancel</a> <br>
</form>

</div> <!-- /container -->


<?php
    
    
// If the values are posted, insert them into the database.
    if (!empty($wid) && !empty($uid)) {
        $account = $_POST["account"];
        $password = $_POST["password"];
        $comment = $_POST["comment"];
        
        if(!empty($account) && !empty($password)){
                $query = "INSERT INTO `cs340_chencho`.`key_pb` (wid, account, passkey, comment) VALUES ('$wid', '$account', '$password', '$comment' )";
                $result = mysqli_query($conn,$query);
            }
            
            if($result == 1){
                $msg = "<p align=center>Account entered.</p>";
                echo $msg;
                header("location: enterPassword.php?wid=$wid");
            }
            else {
                echo "Failed to insert";
            }
        



        //find the student ID in the database
        //if the number of ID is not equal to 1
        
        //find the student ID in the database
        //if the number of ID is not equal to 1
        

    }
    else{
        echo "You are not logined or don't have a wid to enter this page";
    }

    
mysqli_close($conn);
?>
<br>
</body>
</html>