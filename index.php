<?php
    session_start();
    ?>
<?php
    if(!empty($_SESSION["username"])) {
        
        
        echo " Welcome back! ";
        echo ($_SESSION["username"]);
        echo '<br>';
        echo '<a href="enterName.php">  Enter Password</a>';
        echo '<br>';
        echo '<div><a href="checkExistingPassword.php">Check Password  </a> </div>';
        echo '<div><a href="enterStyle.php"> Customise Password Style</a></div>';
        echo '<div><a href="checkExistingStyle.php"> Check Your Style</a></div>';

        echo '<div><a href="logout.php"> Logout</a></div>';

    } else {
        header("Location: login.html");
        echo 'You are not logined, click <a href="login.html">here</a> to login.';
    }
    ?>
<!DOCTYPE html>
<html>
<head>
<title>Passbook</title>
</head>
<body>
</body>
</html>
