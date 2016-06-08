<?php
    session_start();
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
<title> All password</title>
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

    
    echo '<table align = "center" boarder="1" style="width:40%">';
    echo '<tr>';
    echo '<th>Category</th>';
    echo '<th>Account</th>';
    echo '<th>Password</th>';
    echo '<th>Comment</th>';

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
<br>

</body>
</html>
