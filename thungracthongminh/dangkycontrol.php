<?php
    include 'config.php';
    if(isset($_POST['dangky']) && $_POST["name"]!='' && $_POST["user"]!='' && $_POST["pass"]!='' && $_POST["repass"]!=''){
        $name=$_POST["name"];
        
        $user=$_POST["user"];
        $pass=$_POST["pass"];
        $repass=$_POST["repass"];
        if($pass != $repass){
            header("location:login.php");
        }
        $sql="SELECT * FROM tbl_user WHERE user='$user'";
        $old= mysqli_query($conn,$sql);
        // echo mysqli_num_rows($old);
        $pass=md5($pass);
        if(mysqli_num_rows($old)>0){
            header("location:login.php");
        }
        $sql="INSERT INTO tbl_user (name,user,pass) VALUE ('$name','$user','$pass')";
        mysqli_query($conn,$sql);
        header("location:login.php");
        echo "đăng ký thành công";
    }
    else{
        header("location:dangky.php");
    }
?>