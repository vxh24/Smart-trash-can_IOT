<?php
    include "config.php";
    $sql= mysqli_query($conn,"select * from tbl_sensor order by id desc");
    $data=mysqli_fetch_array($sql);
    $doday=$data['sieuam'];
    // if($doday=="") $doday=0;
    $a=(int)(((21-$doday)/21)*100);
    if($doday <5){
        $doday="Thùng rác đã đầy";
    } else if($a<0){
        $doday="0%";
    }
    else{
        $doday= "$a%";
    }
    echo $doday;
?>