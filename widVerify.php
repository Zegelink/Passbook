<?php 
$wid = $_GET["wid"];
$uid = $_SESSION["uid"];
if (!empty($uid)){
    if (!empty($wid)){
        $sqlVerify = "SELECT * FROM web_pb WHERE uid = $uid AND wid = $wid ";
        $result = $conn->query($sqlVerify);
        if ($result->num_rows < 1){
            exit("You don't have the permission to access this page.");
        }
        else {
            $row = $result->fetch_assoc();
            $name = $row["name"];
        }
    }
    else{
        exit("You don't have the permission to access this page.");
    }
}
else {
    echo "You need to login to access this page";
    echo '<a href = "login.html">Login</a>';
    exit();
}
?>                                                                    