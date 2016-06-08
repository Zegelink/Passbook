<?php
    session_start();
    ?>

<!DOCTYPE html>
<html>
<head>
<title>Your Customized Styles</title>

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
    echo '<div><a href="enterStyle.php">New Style </a> </div>';

    
    echo '<table boarder="1" style="width:30%" align = center>';
    echo '<tr>';
    echo '<th>Those Style you have in your Library</th>';
    echo '</tr>';
    for($i =  (count($sidArray) - 1); $i >= 0; $i-- ){
        echo "<tr>";
        //pass the sid into next link
        echo '<td><a href="enterItem.php?sid=' .$sidArray[$i]. '">' .$styleArray[$i]. '</a> </td>';
        
        echo "</tr>";
    }
    echo "</table>";
    echo "<br>";
    echo "<br>";


        ?>
<br>


<br>
<br>

</body>
</html>
