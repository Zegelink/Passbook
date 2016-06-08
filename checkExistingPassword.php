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
	
	//guiding message
	echo '<div align = center>';
	echo '<p align= "center" class="text-primary bg-info" style = "width: 30%">You can save multiple passwords in one category!';
	echo '<br>';
	echo 'Start with a new Category or add info to your category!</p>';
	echo '</div>';
	
	echo '<br>';

    echo '<p align="center"><a class="btn btn-primary" style = "width: 10%"  href="enterName.php">New Category</a></p>';
    echo '<p align=center><a class="btn btn-primary " role="button" style = "width: 10%" href="checkAllPassword.php">List All Password </a></p>';

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
		echo '<br>';

    echo '<table align = center style="width:30%" >';
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
        echo '<button name = "deleteKey", class = "btn btn-danger" type = "submit", value = "'.$widArray[$i]. '">Delete</button>';
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
