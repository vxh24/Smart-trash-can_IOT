<?php
include 'config.php';
// $user=[];
$user = (isset($_SESSION['user']) ? $user = $_SESSION['user'] : []);
// $user=$_SESSION['user'];
$sql=mysqli_query($conn,"SELECT * FROM tbl_servo");
$data=mysqli_fetch_array($sql);
$gas=$data['gas'];
$sieuam1=$data['sieuam1'];
$sieuam2=$data['sieuam2'];
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/x-icon" href="images/thungrac.jpg">
    <!-- Bootstrap CSS -->
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <title>Thùng rác thông minh</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script type="text/JavaScript" src="jquery/jquery.min.js"></script>

    <script type="text/JavaScript">
    //     $(document).ready(function(){
    //   setInterval(function(){
    //     $("#doday").load("checkdoday.php");
    //     $("#khigas").load("checkkhigas.php");
    //   },1000);  
    // });
    function changestatus1(value){
        if(value==true) value="Mở";
        else value="Đóng"
        document.getElementById('status1').innerHTML=value;
        //thay đổi trạng thái chuyển
        var xmlhttp1=new XMLHttpRequest();
        xmlhttp1.onreadystatechange = function()
        {
        if(xmlhttp1.readyState ==4 && xmlhttp1 == 200){
            //lấy phản hồi từ web sau khi thay đổi giá trị
            document.getElementById('status1').innerHTML=xmlhttp1.responseText;
        }
        }
        xmlhttp1.open("GET","servo.php?stat1="+value,true);
        xmlhttp1.send();
    }
    function changestatus2(value){
        if(value==true) value="Mở";
        else value="Đóng"
        document.getElementById('status2').innerHTML=value;
        //thay đổi trạng thái chuyển
        var xmlhttp2=new XMLHttpRequest();
        xmlhttp2.onreadystatechange = function()
        {
        if(xmlhttp2.readyState ==4 && xmlhttp2 == 200){
            //lấy phản hồi từ web sau khi thay đổi giá trị
            document.getElementById('status2').innerHTML=xmlhttp2.responseText;
        }
        }
        xmlhttp2.open("GET","servo.php?stat2="+value,true);
        xmlhttp2.send();
    }
    function changestatus3(value){
        if(value==true) value="Mở";
        else value="Đóng"
        document.getElementById('status3').innerHTML=value;
        //thay đổi trạng thái chuyển
        var xmlhttp3=new XMLHttpRequest();
        xmlhttp3.onreadystatechange = function()
        {
        if(xmlhttp3.readyState ==4 && xmlhttp3 == 200){
            //lấy phản hồi từ web sau khi thay đổi giá trị
            document.getElementById('status3').innerHTML=xmlhttp3.responseText;
        }
        }
        xmlhttp3.open("GET","servo.php?stat3="+value,true);
        xmlhttp3.send();
    }
    </script>
    <!-- <script type="text/JavaScript">
        function changestatus(value){
        if(value==true) value="Mở";
        else value="Đóng"
        document.getElementById('status').innerHTML=value;

      }
    </script> -->
</head>

<body>
    <div class="container" style="text-align:center ;margin-top: 50px;">
        <!-- <h1>Hello, world! abc1</h1> -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light"
            style="text-align:center ;margin-bottom: 20px;padding: 10px;">
            <!-- <a class="navbar-brand" href="#">Xin chào,Hoa!</a> -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <i class="fa fa-trash-o" style="font-size:24px"></i>
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">Home </a>
                    </li>
                    
                    <!-- <li class="nav-item">
            <a class="nav-link" href="#">Đăng xuất</a>
          </li> -->
                    <!-- <a class="navbar-brand" href="#">Đăng xuất</a> -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                            style="margin-left:900px ;">
                            Xin chào,<?php echo $user['name']; ?>!
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown" style="margin-left:950px ;">
                            <a class="dropdown-item" href="quanlysensor.php">Quản lý sensor</a>
                            <!-- <a class="dropdown-item" href="#">Another action</a> -->
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="logout.php">Đăng xuất</a>
                        </div>
                    </li>
                    <!-- <li class="nav-item">
            <a class="nav-link disabled" href="#">Disabled</a>
          </li> -->

                </ul>
                <!-- <form class="form-inline my-2 my-lg-0">
          <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form> -->
            </div>
        </nav>
        <div style="display:flex ;margin-bottom: 20px;">
        <!-- <div class="card text-center" style="width: 50%;">
                <div class="card-header" style="font-size:30px ; font-weight:bold ;height: 100px;">
                    Siêu âm độ đầy thùng rác
                </div>
                <div class="card-body">
                    <div class="form-check form-switch" style="font-size:30px ;">
                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault"
                            <?php if($sieuam1==1) echo "checked"; ?> onchange="changestatus1(this.checked)"  style="margin-right: 10px;">
                        <label class="form-check-label" for="flexSwitchCheckDefault"><span
                                id="status1"><?php if($sieuam1==1) echo "Mở";else echo "Đóng" ?></span></label>
                    </div>
                </div>
            </div> -->

            <div class="card text-center" style="width: 50%;">
                <div class="card-header" style="font-size:30px ; font-weight:bold ;height: 100px;background-color: yellow;">
                    Siêu âm đóng mở thùng rác
                </div>
                <div class="card-body">
                    <div class="form-check form-switch" style="font-size:30px ;">
                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault"
                            <?php if($sieuam2==1) echo "checked"; ?> onchange="changestatus2(this.checked)"  style="margin-right: 10px;">
                        <label class="form-check-label" for="flexSwitchCheckDefault"><span
                                id="status2"><?php if($sieuam2==1) echo "Mở";else echo "Đóng" ?></span></label>
                    </div>
                    <img src="images/sieuam.webp" alt="Sieuam" style="width: 225px;">
                </div>
            </div>
            <div class="card text-center" style="width: 50%;">
                <div class="card-header" style="font-size:30px ; font-weight:bold ;height: 100px;background-color: yellowgreen;">
                    Cảm biến khí gas
                </div>
                <div class="card-body">
                    <div class="form-check form-switch" style="font-size:30px ;">
                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault"
                            <?php if($gas==1) echo "checked"; ?> onchange="changestatus3(this.checked)"  style="margin-right: 10px;">
                        <label class="form-check-label" for="flexSwitchCheckDefault"><span
                                id="status3"><?php if($gas==1) echo "Mở";else echo "Đóng" ?></span></label>
                    </div>
                    <img src="images/mq2.jpg" alt="MQ2">
                </div>
            </div>
        </div>

    </div>



    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>