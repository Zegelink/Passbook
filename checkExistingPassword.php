<?php
    session_start();
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

echo '<a href="enterName.php">New Name </a>';
    echo '<br>';
    echo '<a align = "right" href="checkAllPassword.php">All Password </a>';


    include 'connect.php';
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

    
    echo '<table align = center boarder="1" style="width:30%" >';
    echo '<tr>';
    //echo '<td>wid</td>';
    echo '<td>name</td>';
    echo '</tr>';
    for($i =  (count($widArray) - 1); $i >= 0; $i-- ){
        echo "<tr>";
        //echo "<td>$widArray[$i]</td>";
        //pass the wid into next link
        echo '<td><a href="enterPassword.php?wid=' .$widArray[$i]. '">' .$nameArray[$i]. '</a> <td>';
        
        echo "</tr>";
    }
    echo "</table>";
    echo "<br>";

        ?>
<br>


<br>
<br>

</body>
</html>
