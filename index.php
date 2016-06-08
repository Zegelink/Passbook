<?php
    session_start();
    include 'connect.php';
    ?>
<?php
    if(!empty($_SESSION["username"])) {
        
    } else {
        header("Location: login.html");
        echo 'You are not logined, click <a href="login.html">here</a> to login.';
    }
    ?>


<!DOCTYPE html>
<html>
<head>
<title>Passbook</title>

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
    $sqlStyle = "call ReturnMostActiveUser()";
    $resultStyle = $conn->query($sqlStyle);
    
    if ($resultStyle->num_rows > 0 ){
        echo '<br>';
        echo '<h1><p align = center> Welcome back '.$_SESSION["username"].'!</p></h1>';
        //echo '<a align = center>'. $_SESSION["username"]. '</a>';
        echo '<br>';

        $counter = 0;
        $numArray;
        $uidArray;
        while ($row = $resultStyle->fetch_assoc()){
            $numArray[$counter] = $row["num"];
            $uidArray[$counter] = $row["username"];
            $counter++;
        }
        echo '<table style="width:30%" align=center>';
        echo '<tr>';
        echo '<th>MostActiveUser</th>';
        echo '<th>Points</th>';
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
    
    
?>
</body>

</html>

