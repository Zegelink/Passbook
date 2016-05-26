<?php
    session_start();
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
<titile> Your password</titile>
</head>
<body>

<?php
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

    
    echo '<table boarder="1" style="width:30%">';
    echo '<tr>';
    echo '<td>wid</td>';
    echo '<td>name</td>';
    echo '</tr>';
    for($i =  (count($widArray) - 1); $i >= 0; $i-- ){
        echo "<tr>";
        echo "<td>$widArray[$i]</td>";
        //pass the wid into next link
        echo '<td><a href="enterPassword.php?wid=' .$widArray[$i]. '">' .$nameArray[$i]. '</a> <td>';
        
        echo "</tr>";
    }
    echo "</table>";
    echo "<br>";

        ?>
<br>


<br>
<a style="color: rgb(51, 51, 255);" href="index.php">Index page<br>
<br>

</body>
</html>
