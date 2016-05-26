<?php
    session_start();
    ?>

<!DOCTYPE html>
<html>
<head>
<title>Passbook</title>
</head>
<body>

<?php
    if(!empty($_SESSION["username"])) {
        echo " Welcome back!";
        echo ($_SESSION["username"]);
        echo '<br>';

        echo '<a href="enterName.php">  Enter Password</a>';
        echo '<br>';
        echo '<div><a href="checkExistingPassword.php">Check Password  </a> </div>';
        echo '<div><a href="logout.php"> Logout</a></div>';

    } else {
        echo 'You are not logined, click <a href="login.html">here</a> to login.';
        header("Location: login.html");
    }
    ?>
</body>
</html>
