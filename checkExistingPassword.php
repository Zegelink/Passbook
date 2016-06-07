<?php
    session_start();
    include 'connect.php';
    $deleteKey = $_POST['deleteKey'];
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
    
    //delte category
    if (!empty($deleteKey)){
        $sqlStyle = "DELETE FROM `cs340_chencho`.`web_pb` WHERE wid = $deleteKey";
        if ($resultStyle = $conn->query($sqlStyle)){
            $message = "Delete Successfully";
        }
        else{
            $message = "Delete Failed";
        }
    }
    
    echo '<a href="enterName.php">New Category </a>';
    echo '<br>';
    echo '<a align = "right" href="checkAllPassword.php">All Password </a>';


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

    
    echo '<table align = "center" style="width:40%" >';
    echo '<tr>';
    echo '<th>Category</th>';
    echo '</tr>';
    for($i =  (count($widArray) - 1); $i >= 0; $i-- ){
        echo '<tr>';
        //echo "<td>$widArray[$i]</td>";
        
        //pass the wid into next link
        echo '<td><a href="enterPassword.php?wid=' .$widArray[$i]. '">' .$nameArray[$i]. '</a></td>';
        
        //the delete button form
        echo '<td><form action ="checkExistingPassword.php" class="form-signin" method="post" role="form">';
        echo '<button name = "deleteKey", type = "submit", value = "'.$widArray[$i]. '">Delete</button>';
        echo '</form></td>';
        
        echo '</tr>';
    }
    echo '</table>';
    echo '<br>';
    
    echo '<p align="center">' .$message. '</p>';
    
    mysqli_close($conn);

        ?>
<br>


<br>
<br>

</body>
</html>
