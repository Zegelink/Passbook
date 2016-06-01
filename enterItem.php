<?php
    session_start();
    $sid = $_GET['sid'];
    $uid = $_SESSION['uid'];
    $deleteKey = $_POST['deleteKey'];

    include 'connect.php';
    //make sure the user logined has the permission to this sid
    include 'sidVerify.php';
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>ManagePassword</title>

<!-- Bootstrap  CSS and FontAwesome too -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

<!-- Custom styles for this template -->
<link href="style.css" rel="stylesheet">

</head>

<script src="http://www.w3schools.com/lib/w3data.js"></script>
<body>
<div w3-include-html="navBar.html"></div>
<script>
w3IncludeHTML();
</script>

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

    if (!empty($item) && !empty($sid)) {
        
        $result =0;
        
        if(!empty($item)){
                $query = "INSERT INTO `cs340_chencho`.`itemLibrary_pb` (sid, item) VALUES ('$sid', '$item')";
                $result = mysqli_query($conn,$query);
            }
            
            if($result == 1){
                $msg = "<p align=center>Item entered.</p>";
                echo $msg;
                //echo '<p align = center>Refresh the page <a href = "enterItem.php?sid=' .$sid. '">here </a></p>';
            }
            else {
                echo "<p align = center>Failed to insert</p>";
            }
    }
    else {
        //echo "<p align = center>your item or style is empty</p>";
    }
    
    //for delete item
    include 'deleteStyleItem.php';
    
    $sql = "SELECT * FROM `cs340_chencho`.`itemLibrary_pb` WHERE sid = $sid";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0 ){
        $counter = 0;
        
        
        while($row = $result->fetch_assoc()){
            
            $itemArray[$counter] = $row["item"];
            $iidArray[$counter] = $row["iid"];
            $counter++;
        }
        echo '<table boarder="1" style="width:30%" align=center>';
        echo '<tr>';
        echo '<td>Item</td>';
        echo '</tr>';
        for($i =  (count($itemArray) - 1); $i >= 0; $i-- ){
            echo "<tr>";
            echo "<td>". $itemArray[$i]. "</td>";
            //delete button
            echo '<td><form action ="enterItem.php?sid='. $sid. '" class="form-signin" method="post" role="form">';
            echo '<button name = "deleteKey", type = "submit", value = "'.$iidArray[$i]. '">Delete</button>';
            echo '</form></td>';

            echo "</tr>";
        }
        echo "</table>";
        echo "<br>";
    }
    else{
        echo "<p align=center>You don't have any item for this style yet</p>";
    }

mysqli_close($conn);
?>
<br>
</body>
</html>