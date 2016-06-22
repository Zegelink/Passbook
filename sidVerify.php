<?php 
    $sid = $_GET["sid"];
    $uid = $_SESSION["uid"];
    if (!empty($uid)){
        if (!empty($sid)){
            $sqlVerify = "SELECT * FROM `cs340_chencho`.`style_pb` WHERE uid = $uid AND sid = $sid ";
            $result = $conn->query($sqlVerify);
            if ($result->num_rows < 1){
                exit("You don't have the permission to access this page.");
            }
			else {
				$row = $result->fetch_assoc();
				$style = $row["style"];
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
?>