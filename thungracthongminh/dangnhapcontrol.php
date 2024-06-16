<?php
    include 'config.php';
    if(isset($_POST['dangnhap']) &&  $_POST["user"]!='' && $_POST["pass"]!='' ){
        $user=$_POST["user"];
        $pass=$_POST["pass"];
        $pass=md5($pass);
        $sql="SELECT * FROM tbl_user WHERE user='$user' AND pass='$pass'";
        $old= mysqli_query($conn,$sql);
        $row=mysqli_fetch_assoc($old);
        
        if(mysqli_num_rows($old)>0){
            $_SESSION['user']=$row;
            
            header("location:index.php");
            // echo "đăng nhập thành công";
        }
        else{
            echo "sai mk";
        }
    }
    else{
        header("location:dangnhap.php");
    }
?>