<?php
    if (!empty($deleteKey)){
        $sqlStyle = "DELETE FROM key_pb WHERE kid = $deleteKey";
        if ($resultStyle = $conn->query($sqlStyle)){
            echo "<p align=center> DeleteSuccessful </p>";
        }
        else{
            echo "<p align=center>Delete Failed</p>";
        }
    
    }
?>                  