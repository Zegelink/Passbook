<?php
    session_start();
    ?>
<?php
    // remove all session variables
    session_unset();
    // destroy the session
    session_destroy();
    header( "refresh:3; url=index.php" );
    echo "You have been logout successfully";
	echo '<br>';
    echo 'You\'ll be redirected in about 3 secs. If not, click <a href="index.php">here</a>.';
    ?>
<!DOCTYPE html>
<html>
<body>
</body>
</html>
