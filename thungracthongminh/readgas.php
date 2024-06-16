<?php
    include ("config.php");
    $sql=mysqli_query($conn,"SELECT * FROM tbl_servo");
    $data=mysqli_fetch_array($sql);
    $gas=$data['gas'];
    echo "$gas";
?>