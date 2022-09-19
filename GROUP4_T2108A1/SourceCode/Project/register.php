
<?php
require "connect_db.php";

$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";


if ($_SERVER["REQUEST_METHOD"] == "POST"){


    if (empty(trim($_POST["username"]))){
        $username_err = "Vui lòng điền tên đăng nhập.";
    }elseif (!preg_match('/^[a-zA-Z0-9_]+$/',trim($_POST["username"]))){
        $username_err = "Tên người dùng chỉ sử dụng các chữ cái,số và kí tự";
    }else{

        $sql = "Select id from users where username = ?";

        if($stmt = mysqli_prepare($con,$sql)){

            mysqli_stmt_bind_param($stmt,"s",$param_username);


            $param_username = trim($_POST["username"]);


            if (mysqli_stmt_execute($stmt)){

                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "Tên người dùng đã tồn tại";
                }else{
                    $username = trim($_POST["username"]);
                }
            }else{
                echo "Rất tiếc! Đã xảy ra lỗi. Vui lòng thử lại sau.";
            }


            mysqli_stmt_close($stmt);
        }
    }


    if (empty(trim($_POST["password"]))){
        $password_err = "Vui lòng nhập mật khẩu";
    }elseif (strlen(trim($_POST["password"])) < 6){
        $password_err = "Mật khẩu phải có ít nhất 6 ký tự.";
    }else{
        $password = trim($_POST["password"]);
    }


    if (empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Vui lòng xác nhận mật khẩu.";
    }else{
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($password_err) && ($password !=$confirm_password)){
            $confirm_password_err = "Mật khẩu không khớp.";
        }
    }


    if (empty($username_err) && empty($password_err) && empty($confirm_password_err)){


        $sql = "INSERT INTO users (username,password) values (?, ?)";

        if ($stmt = mysqli_prepare($con,$sql)){

            mysqli_stmt_bind_param($stmt,"ss",$param_username,$param_password);


            $param_username = $username;

            $param_password = password_hash($password, PASSWORD_DEFAULT);


            if (mysqli_stmt_execute($stmt)){

                header("location: login.php");
            }else{
                echo " Đã xảy ra lỗi. Vui lòng thử lại sau.";
            }
            mysqli_stmt_close($stmt);
        }
    }


    mysqli_close($con);
}
?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <title>Đăng ký</title>
    <link rel="cheems icon" type="text/css" href="images/logo.png">
    <link rel="stylesheet" href="style.css">

</head>
<body>
<div id="menu">

    <a href="logout.php" class="logoindex"><img src="images/logo.png" width="111" height="111"></a>
    <ul>
        <li class="tt"><a href="index.php" style="background-color:white;color: #464141;text-shadow: 1px 0 black">TRANG CHỦ</a></li>
        <li class="tt"><a href="service.php" style="background-color:white !important;color: #464141;text-shadow: 1px 0 black">DỊCH VỤ</a></li>
        <li class="tt"><a href="news.php" style="background-color:white !important;color: #464141;text-shadow: 1px 0 black">TIN TỨC</a></li>
        <li class="tt"><a href="product.php" style="background-color:white !important;color: #464141;text-shadow: 1px 0 black">SẢN PHẨM</a></li>
        <li class="tt"><a href="search.php" style="background-color:white !important;color: #464141;text-shadow: 1px 0 black">TÌM KIẾM</a></li>
        <li class="tt"><a href="login.php" style="background-color:white !important;color: #464141;text-shadow: 1px 0 black">ĐĂNG NHẬP</a></li>

</div>
<hr>
<div id="fox">

    <a class="avt1">
        <img src="images/logo.png" width="250" height="250">
    </a>

    <div class="wrapper">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>
                " method="post">
            <div class="form-group">
                <label style="color:white;">Tên Đăng Nhập:</label>
                <input type="text" name="username" class="form-control
                   <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>
                   " value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>
            <div class="form-group">
                <label style="color:white;">Mật khẩu:</label>
                <input type="password" name="password" class="form-control
                  <?php echo (!empty($password_err)) ? 'is-invalid' :''; ?>
                    " value="<?php echo $password; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <label style="color:white;">Nhắc Lại Mật Khẩu:</label>
                <input type="password" name="confirm_password" class="form-control
                 <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>
                " value=" <?php echo $confirm_password; ?>">
                <span class="invalid-feedback"><?php echo $confirm_password_err; ?>
            </span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn-primary" value="Đăng Ký">
            </div>
            <p class="df" style="color: white;font-size: 18px" >Bạn đã có tài khoản? <a style="color: yellow" href="login.php">Đăng nhập ngay</a>.</p>
        </form>
    </div></div>

<div id =open>
    <a class="a1" ><h4>CHUỖI CỬA HÀNG CHEEMS
            <br>
            <h5>Mã số doanh nghiệp:0300808687<br><br>
                Đăng kí lần đầu ngày 10/8/2022<br><br>
                Cấp bởi:Sở kế hoạch và đầu tư
                Tp.Hà Nội</h5></h4> </a>

    <a class="a3" ><h4>VỀ QUÁN ĂN CHEEMS
            <br>
            <h5>Giới thiệu CHEEMS<br><br>
                Hồ sơ doanh nghiệp<br><br>
                Tuyển dụng<br><br>
                Liên hệ</h5></h4> </a>
    <a class="a2" ><h4>CHÍNH SÁCH
            <br>
            <h5>Chính sách hoàn tiền<br><br>
                Quy định khiếu nại<br><br>
                Điều khoản sử dụng<br><br>
                Chính sách bảo mật</h5></h4> </a>



    -----------------------------------------------------------------        <br><br>
    <a href="https://bit.ly/3PtGgBC" style="color: black"><img src="images/vitri.png" width="25" height="32"> Số 8A Tôn Thất Thuyết,Mỹ Đình,Nam Từ Liêm,Hà Nội</a><br><br>
    <a href="https://mail.google.com/" style="color: black"><img src="images/thu.png" width="30" height="30"> CSKHCHEEMS@gmail.com</a><br><br>
    <a style="color: black"><img src="images/phone.png" width="27" height="27"> 1900123123</a>

    <div id="dog">
        <a><img src="images/god.png"></a>
    </div>
    <a style="color: black;margin-left: 20px;font-weight: 700;line-height: 10px"><img src="images/logo.png" width="55" height="54"> <a id="tn">Trải nghiệm tốt hơn với App Cheems Restaurant</a>
        <br> <a class="app" href="https://bit.ly/3QCIU9s"><img src="images/gp.png"></a>
        <a class="app1" href="https://apple.co/3AwXlGz"><img src="images/as.png"></a></a><br><br>


    <a class="bct" style="color: black" href="http://online.gov.vn/">
        <img src="images/bct.png"><a style="color: #ffffff">..................................................................................................................</a>Kết nối với CHEEMS</a><br><br>
    <a>BẢN QUYỀN © 2022 THUỘC VỀ Cheems VIET NAM<a href="https://bit.ly/3wbvCbJ" style="color: white">............................<img src="images/fb.png"></a><a href="https://www.instagram.com/balltze/" style="color: white">....<img src="images/ins.png"></a><a href="https://bit.ly/3psmnQQ" style="color: white">....<img src="images/yt.png"></a></a>
</div>
</div></body>
</html>
</html>

