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
    $sql = "SELECT * FROM `cs340_chencho`.`web_pb` NATURAL JOIN `cs340_chencho`.`key_pb` WHERE uid = $uid";
    $result = $conn->query($sql);
    
    
    
    if ($result->num_rows > 0 ){
        $counter = 0;
        while($row = $result->fetch_assoc()){
            
            $nameArray[$counter] = $row["name"];
            $accountArray[$counter] = $row["account"];
            $passkeyArray[$counter] = $row["passkey"];
            $commentArray[$counter] = $row["comment"];

            
            
            echo $result1;
            $counter++;
        }
    }

    
    echo '<table boarder="1" style="width:30%">';
    echo '<tr>';
    echo '<td>Name</td>';
    echo '<td>Account</td>';
    echo '<td>Password</td>';
    echo '<td>Comment</td>';

    echo '</tr>';
    for($i =  (count($nameArray) - 1); $i >= 0; $i-- ){
        echo "<tr>";
        echo "<td>$nameArray[$i]</td>";
        echo "<td>$accountArray[$i]</td>";
        echo "<td>$passkeyArray[$i]</td>";
        echo "<td>$commentArray[$i]</td>";

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
