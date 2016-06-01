<!DOCTYPE html>
<html>
<head>
<title>Passbook</title>

<!-- Bootstrap  CSS and FontAwesome too -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

<!-- Custom styles for this template -->
<link href="navbar.css" rel="stylesheet">

</head>

<script src="http://www.w3schools.com/lib/w3data.js"></script>
<body>
<div w3-include-html="navBar.html"></div>
<script>
w3IncludeHTML();
</script>
</body>

</html>
<?php
    session_start();
    include 'connect.php';
    ?>
<?php
    if(!empty($_SESSION["username"])) {
        
        $sqlStyle = "call ReturnMostActiveUser()";
        $resultStyle = $conn->query($sqlStyle);
        
        if ($resultStyle->num_rows > 0 ){
            $counter = 0;
            $numArray;
            $uidArray;
            while ($row = $resultStyle->fetch_assoc()){
                $numArray[$counter] = $row["num"];
                $uidArray[$counter] = $row["username"];
                $counter++;
            }
            echo '<table boarder="1" style="width:30%" align=center>';
            echo '<tr>';
            echo '<td>MostActiveUser</td>';
            echo '<td>Points</td>';
            echo '</tr>';
            $num = (count($uidArray));
            if ($num > 3){
                $num = 3;
            }
            for($i = 0 ; $i < $num; $i++ ){
                echo "<tr>";
                echo "<td>". $uidArray[$i]. "</td>";
                echo "<td>". $numArray[$i]. "</td>";
                echo "</tr>";
            }
            echo "</table>";
            echo "<br>";
        }

        
        
        echo " Welcome back! ";
        echo ($_SESSION["username"]);
        echo '<br>';
        echo '<div><a href="checkExistingPassword.php">Password Mangement </a></div>';
        echo '<div><a href="checkAllPassword.php"> Check All Password</a></div>';
        echo '<div><a href="enterStyle.php"> Customise Password Style</a></div>';
        echo '<div><a href="checkExistingStyle.php"> Check Your Style</a></div>';

        echo '<div><a href="logout.php"> Logout</a></div>';
        
        

    } else {
        header("Location: login.html");
        echo 'You are not logined, click <a href="login.html">here</a> to login.';
    }
    ?>

