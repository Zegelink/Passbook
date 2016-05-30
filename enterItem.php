<?php
    session_start();
    $sid = $_GET['sid'];
    $uid = $_SESSION['uid'];
    
    include 'connect.php';
    //make sure the user logined has the permission to this sid
    include 'sidVerify.php';
    $sql = "SELECT * FROM `cs340_chencho`.`itemLibrary_pb` WHERE sid = $sid";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0 ){
        $counter = 0;
        
        
        while($row = $result->fetch_assoc()){
            
            $itemArray[$counter] = $row["item"];
            
            $counter++;
        }
        echo '<table boarder="1" style="width:30%" align=center>';
        echo '<tr>';
        echo '<td>Item</td>';
        echo '</tr>';
        for($i =  (count($itemArray) - 1); $i >= 0; $i-- ){
            echo "<tr>";
            echo "<td>". $itemArray[$i]. "</td>";
            echo "</tr>";
        }
        echo "</table>";
        echo "<br>";
    }
    else{
        echo "<p align=center>You don't have any item for this style yet</p>";
    }
    
    


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

<title>Check existing Style</title>

<!-- Bootstrap core CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

<!-- Custom styles for this template -->
<link href="style.css" rel="stylesheet">

</head>

<body>

<div class="container">

<form action="enterItem.php?sid=<?php echo $sid ?>" class="form-signin" method="post" role="form">
<h2 class="form-signin-heading" align="center"><b>Enter New Item: </b></h2>
<br>
<label for="name">Item</label>
<input type="text" id="item" name="item"class="form-control" placeholder="" required autofocus>

<br>



<button class="btn btn-lg btn-success btn-block" type="submit">Confirm</button>
<a href="index.php" class="btn btn-lg btn-danger btn-block" type="submit">Cancel</a> <br>
</form>

</div> <!-- /container -->


<?php
    
    
// If the values are posted, insert them into the database.
    $item = $_POST["item"];

    if (!empty($item) && !empty($style)) {
        
        $result =0;
        
        if(!empty($item)){
                $query = "INSERT INTO `cs340_chencho`.`itemLibrary_pb` (sid, item) VALUES ('$sid', '$item')";
                $result = mysqli_query($conn,$query);
            }
            
            if($result == 1){
                $msg = "<p align=center>Item entered.</p>";
                echo $msg;
                echo '<p align = center>Refresh the page <a href = "enterItem.php?sid=' .$sid. '">here </a></p>';
            }
            else {
                echo "<p align = center>Failed to insert</p>";
            }
    }
    else {
        echo "<p align = center>your item or style is empty</p>";
    }
mysqli_close($conn);
?>
<br>
</body>
</html>