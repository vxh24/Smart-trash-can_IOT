<?php
    include ("config.php");
    $stat=$_GET['stat'];
    $stat1=$_GET['stat1'];
    $stat2=$_GET['stat2'];
    $stat3=$_GET['stat3'];
    if($stat== "Mở"){
        mysqli_query($conn,"UPDATE tbl_servo SET servo=1");
        echo "Mở";
    }
    else if($stat== "Đóng"){
        mysqli_query($conn,"UPDATE tbl_servo SET servo=0");
        echo "Đóng";
    }
    else if($stat1== "Mở"){
        mysqli_query($conn,"UPDATE tbl_servo SET sieuam1=1");
        echo "Đóng";
    }
    else if($stat1== "Đóng"){
        mysqli_query($conn,"UPDATE tbl_servo SET sieuam1=0");
        echo "Đóng";
    }
    else if($stat2== "Mở"){
        mysqli_query($conn,"UPDATE tbl_servo SET sieuam2=1");
        echo "Đóng";
    }
    else if($stat2== "Đóng"){
        mysqli_query($conn,"UPDATE tbl_servo SET sieuam2=0");
        echo "Đóng";
    }
    else if($stat3== "Mở"){
        mysqli_query($conn,"UPDATE tbl_servo SET gas=1");
        echo "Đóng";
    }
    else if($stat3== "Đóng"){
        mysqli_query($conn,"UPDATE tbl_servo SET gas=0");
        echo "Đóng";
    }
    

?>