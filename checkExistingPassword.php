<?php
    session_start();
    $deleteKey = $_POST['deleteKey'];
    include 'connect.php';
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
<?php
    
    //delete
    if (!empty($deleteKey)){
        $sqlStyle = "DELETE FROM `cs340_chencho`.`web_pb` WHERE wid = $deleteKey";
        if ($resultStyle = $conn->query($sqlStyle)){
            $message = "Delete Successful";
        }
        else{
            $message = "Delete Failed";
        }
        
    }


    echo '<p align=center><a href="enterName.php">New Name </a></p>';
    echo '<p align=center><a href="checkAllPassword.php">All Password </a></p>';

    $uid = $_SESSION['uid'];
    $sql = "SELECT * FROM `cs340_chencho`.`web_pb` WHERE uid = $uid";
    $result = $conn->query($sql);
    
    
    
    if ($result->num_rows > 0 ){
        $counter = 0;
        $CourseNumberArray;
        $DepartmentArray;
        $cidArray;

        
        while($row = $result->fetch_assoc()){
            
            $widArray[$counter] = $row["wid"];
            $nameArray[$counter] = $row["name"];
            
            echo $result1;
            $counter++;
        }
    }

    
    echo '<table align = center style="width:20%" >';
    echo '<tr>';
    //echo '<td>wid</td>';
    echo '<th>Category</th>';
    echo '<th></th>';
    echo '</tr>';
    for($i =  (count($widArray) - 1); $i >= 0; $i-- ){
        echo "<tr>";
        //echo "<td>$widArray[$i]</td>";
        //pass the wid into next link
        echo '<td><a href="enterPassword.php?wid=' .$widArray[$i]. '">' .$nameArray[$i]. '</a> </td>';
        
        //delete button
        echo '<td><form action ="checkExistingPassword.php" class="form-signin" method="post" role="form">';
        echo '<button name = "deleteKey", type = "submit", value = "'.$widArray[$i]. '">Delete</button>';
        echo '</form></td>';
        
        echo "</tr>";
    }
    echo "</table>";
    echo "<br>";
    
    echo '<p align = "center">' .$message. '</p>';
        ?>
<br>


<br>
<br>

</body>
</html>
