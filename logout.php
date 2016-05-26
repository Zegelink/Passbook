<?php
    session_start();
    ?>
<!DOCTYPE html>
<html>
<body>

<?php
    // remove all session variables
    session_unset();
    
    // destroy the session
    session_destroy();
    echo "You have been logout successfully";
    header( "refresh:3;url=index.php" );
    echo 'You\'ll be redirected in about 3 secs. If not, click <a href="index.php">here</a>.';
    ?>

</body>
</html>
