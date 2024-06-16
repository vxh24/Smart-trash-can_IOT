<?php
    include("config.php");
    $distance = $_GET['distance'];
    $gas = $_GET['gas'];
    mysqli_query($conn,"ALTER TABLE tbl_sensor AUTO_INCREMENT=1");
    $sql=mysqli_query($conn,"insert into tbl_sensor(sieuam,gas)value('$distance','$gas')");
    if($sql){
        echo "gửi thành công";
    }
    else{
        echo "Thất bại";
    }
?>