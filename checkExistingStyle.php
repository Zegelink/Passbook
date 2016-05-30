<?php
    session_start();
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
<titile> Your Customized Styles</titile>
</head>
<body>

<?php
    include 'connect.php';
    $uid = $_SESSION['uid'];
    $sql = "SELECT * FROM `cs340_chencho`.`style_pb` WHERE uid = $uid";
    $result = $conn->query($sql);
    
    
    
    if ($result->num_rows > 0 ){
        $counter = 0;

        
        while($row = $result->fetch_assoc()){
            
            $sidArray[$counter] = $row["sid"];
            $styleArray[$counter] = $row["style"];
            
            $counter++;
        }
    }

    
    echo '<table boarder="1" style="width:30%">';
    echo '<tr>';
    echo '<td>Sid</td>';
    echo '<td>Style</td>';
    echo '</tr>';
    for($i =  (count($sidArray) - 1); $i >= 0; $i-- ){
        echo "<tr>";
        echo "<td>$sidArray[$i]</td>";
        //pass the sid into next link
        echo '<td><a href="enterItem.php?sid=' .$sidArray[$i]. '">' .$styleArray[$i]. '</a> <td>';
        
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
