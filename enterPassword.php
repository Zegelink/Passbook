<?php
    session_start();
    $wid = $_GET['wid'];
    $uid = $_SESSION['uid'];
    $styleSelected = $_POST['styleSelected'];
    
    $deleteKey = $_POST['deleteKey'];
    
    include 'connect.php';
    //make sure the user logined has the permission to this wid
    include 'widVerify.php';

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

<div class="container">

<form action="enterPassword.php?wid=<?php echo $wid ?>" class="form-signin" method="post" role="form">
<h2 class="form-signin-heading" align="center"><b>Enter New Account: </b></h2>
<br>
<label for="name">Account</label>
<input type="text" id="account" name="account"class="form-control" placeholder="" required autofocus>

<label for="sid">Password</label>
<?php
    $passGenerated;
    //if user wants to generated a random password
    if (!empty($styleSelected)){
        $sqlStyle = "SELECT * FROM `cs340_chencho`.`itemLibrary_pb` WHERE sid = $styleSelected";
        $resultStyle = $conn->query($sqlStyle);
        if ($resultStyle->num_rows > 0 ){
            $counter1 = 0;
            $itemArray;
            while ($row = $resultStyle->fetch_assoc()){
                $itemArray[$counter1] = $row["item"];
                $counter1++;
            }
        }
        for ($i = 0; $i <3; $i++){
            $number = mt_rand(0, $counter1-1);
            $passGenerated = $passGenerated. $itemArray[$number];
            $number = mt_rand(0,99);
            $passGenerated = $passGenerated. $number;
        }
        $number = mt_rand(0,4);
        $specialChar = array('$','%','&','*','#');
        $passGenerated = $passGenerated. $specialChar[$number];
    }
    echo '<input type="text" id="password" name="password"class="form-control" placeholder="" value = "'. $passGenerated. '"  required >';
?>
    
<label for="sid">Comment</label>
<input type="text" id="comment" name="comment"class="form-control" placeholder="Optional"  >
<br>



<button class="btn btn-lg btn-success btn-block" type="submit">Confirm</button>
<a href="index.php" class="btn btn-lg btn-danger btn-block" type="submit">Cancel</a> <br>
</form>

</div> <!-- /container -->

<?php
    $sqlStyle = "SELECT * FROM `cs340_chencho`.`style_pb` WHERE uid = $uid OR uid = -1";
    $resultStyle = $conn->query($sqlStyle);
    if ($resultStyle->num_rows > 0 ){
        $counter1 = 0;
        $sidArray;
        while ($row = $resultStyle->fetch_assoc()){
            $styleArray[$counter1] = $row["style"];
            $sidArray[$counter1] = $row["sid"];
            $counter1++;
        }
        echo '<form action ="enterPassword.php?wid='. $wid. '" class="form-signin" method="post" role="form">';
        echo '<select name="styleSelected" onchange="randomString(5)" required>';
    for ($i =  (count($styleArray) - 1); $i >= 0; $i-- ){
        $value = $sidArray[$i];
        echo '<option value="'. $value. '">'. $styleArray[$i]. '</option>';
    }
    echo '</select>';
    echo '<input type = "submit" value="GeneratePassword">';
    echo '</form>';
    }
    ?>

<?php
// If the values are posted, insert them into the database.
    $account = $_POST["account"];
    $password = $_POST["password"];

    if (!empty($account) && !empty($password)) {
        $comment = $_POST["comment"];
        
        $result =0;
        
        if(!empty($account) && !empty($password)){
                $query = "INSERT INTO `cs340_chencho`.`key_pb` (wid, account, passkey, comment) VALUES ('$wid', '$account', '$password', '$comment' )";
                $result = mysqli_query($conn,$query);
            }
            
            if($result == 1){
                $msg = "<p align=center>Account entered.</p>";
                echo $msg;
                //echo '<p align = center>Refresh the page <a href = "enterPassword.php?wid=' .$wid. '">here </a></p>';
            }
            else {
                echo "Failed to insert";
            }
        



        //find the student ID in the database
        //if the number of ID is not equal to 1
        
        //find the student ID in the database
        //if the number of ID is not equal to 1
        

    }
?>
<br>

<?php
    include 'deletePassword.php';

    $sql = "SELECT * FROM `cs340_chencho`.`key_pb` WHERE wid = $wid";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0 ){
        $counter = 0;
        $accountArray;
        $passkeyArray;
        $commentArray;
        $kidArray;
        while($row = $result->fetch_assoc()){
            
            $accountArray[$counter] = $row["account"];
            $passkeyArray[$counter] = $row["passkey"];
            $commentArray[$counter] = $row["comment"];
            $kidArray[$counter] = $row["kid"];
            
            $counter++;
        }
        echo '<table boarder="1" style="width:30%" align=center>';
        echo '<tr>';
        echo '<td>Account</td>';
        echo '<td>Password</td>';
        echo '<td>Comment</td>';
        echo '</tr>';
        for($i =  (count($accountArray) - 1); $i >= 0; $i-- ){
            echo "<tr>";
            echo "<td>". $accountArray[$i]. "</td>";
            echo "<td>". $passkeyArray[$i]. "</td>";
            echo "<td>". $commentArray[$i]. "</td>";

            echo '<td><form action ="enterPassword.php?wid='. $wid. '" class="form-signin" method="post" role="form">';
            echo '<button name = "deleteKey", type = "submit", value = "'.$kidArray[$i]. '">Delete</button>';
            echo '</form></td>';

            echo "</tr>";
        }
        echo "</table>";
        echo "<br>";
    }
    else{
        echo "<p align=center>You don't have any account info yet</p>";
    }
    mysqli_close($conn);
?>
    
</body>
</html>