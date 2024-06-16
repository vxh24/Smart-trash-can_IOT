<?php
    include "config.php";
    $sql= mysqli_query($conn,"select * from tbl_sensor order by id desc");
    $data=mysqli_fetch_array($sql);
    $gas=$data['gas'];
    if($gas== 2) $gas= "Vô hiệu hóa";
    if($gas == 1) $gas= "An toàn";
    if($gas == 0) $gas= "Có cháy!!";
    echo $gas;
?>