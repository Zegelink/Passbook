<?php
    session_start();
    $deleteKey = $_POST['deleteKey'];
    include 'connect.php';
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
    
    //delete
    if (!empty($deleteKey)){
        $sqlStyle = "DELETE FROM `cs340_chencho`.`style_pb` WHERE sid = $deleteKey";
        if ($resultStyle = $conn->query($sqlStyle)){
            $message = "Delete Successful";
        }
        else{
            $message = "Delete Failed";
        }
        
    }
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
	//guiding message
	echo '<div align = center>';
	echo '<p align= "center" class="text-primary bg-info" style = "width: 30%">Styles are used to generate a password just for you!';
	echo '<br>';
	echo 'You can add your favorite words to different styles!';
	echo '<br>';
	echo 'Start with a new style or add items to your styles!</p>';
	echo '</div>';
	
	echo '<br>';
    echo '<div align = center><a class="btn btn-primary" style = "width: 10%" href="enterStyle.php">New Style </a> </div>';
	echo '<br>'; 
   	echo '<br>';

    echo '<table boarder="1" style="width:30%" align = center>';
    echo '<tr>';
    echo '<th>Style</th>';
	echo '<th></th>';
    echo '</tr>';
    for($i =  (count($sidArray) - 1); $i >= 0; $i-- ){
        echo "<tr>";
        //pass the sid into next link
        echo '<td><a class="btn btn-info" style="width:70%" href="enterItem.php?sid=' .$sidArray[$i]. '">' .$styleArray[$i]. '</a> </td>';
        
        //delete button
        echo '<td><form action ="checkExistingStyle.php" class="form-signin" method="post" role="form">';
        echo '<button class = "btn btn-danger btn-sm" name = "deleteKey", type = "submit", value = "'.$sidArray[$i]. '">Delete</button>';
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
