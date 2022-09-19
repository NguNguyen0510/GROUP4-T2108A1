<?php
session_start();

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: index.php");
    exit();
}

require_once "connect_db.php";
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = $login_err = "" ;

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" ) {

    // Check if username is empty
    if (empty(trim($_POST["username"]))) {
        $username_err = "Vui lòng nhập Username. ";
    } else {
        $username = trim($_POST["username"]);
    }

    //check if pasword is emp
    if (empty(trim($_POST["password"]))) {
        $password_err = "Vui lòng điền mật khẩu";
    } else {
        $password = trim($_POST["password"]);
    }

// validate credentials
    if (empty($username_err) && empty($password_err)) {
//prepare a select statement
        $sql = "Select id,username,password from admin where username = ?";

        if ($stmt = mysqli_prepare($con, $sql)) {
//bind variable to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            //set parameter
            $param_username = $username;

//attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)){
                //store result
                mysqli_stmt_store_result($stmt);

//check if user exits,if yes then verify pass
                if (mysqli_stmt_num_rows($stmt) == 1){
//bind result variables
                    mysqli_stmt_bind_result($stmt,$id,$username,$hased_password);
                    if (mysqli_stmt_fetch($stmt)){
                        if (password_verify($password,$hased_password)){
//pass id correct, so start a new session
                            session_start();

//store data in session variables
                            $SESSION["loggedin"] = true;
                            $SESSION["id"] = $id;
                            $SESSION["username"] = $username;


                            header("location: admin.php");
                        }else{

                            $login_err = "Sai username hoặc password.";
                        }
                    }
                }else{

                    $login_err="Sai thông tin đăng nhập";

                }
            }else{
                echo "Ối! Đã xảy ra lỗi. Vui lòng thử lại sau.";
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
    <title>Đăng nhập</title>
    <link rel="cheems icon" type="text/css" href="images/logo.png"/>
    <link rel="stylesheet" href="style.css">
    <style>
        body{font: 14px sans-serif; }
        .wrapper{width: 360px; padding: 20px; }

    </style>
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
        <li class="tt"><a href="login.php" style="background-color:white !important;color: #ff8800;text-shadow: 1px 0 black">ĐĂNG NHẬP</a></li>

</div>
<hr>






<div id="fox">


    <div.a>
        <a class="avt1">
            <img src="images/logo.png" width="250" height="250">
        </a>
        <div class="wrapper">

            <?php
            if (!empty($login_err)){
                echo '<div class ="alert alert-danger">'. $login_err.'</div>';
            }
            ?>

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
                  method="post">
                <div class="form-group">
                    <br>
                    <label style="color: white">Tên Đăng Nhập:</label>


                    <input type="text" name="username" class="form-control
            <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="
                                                                 <?php echo $username; ?>">
                    <span class="invalid-feedback"><?php echo $username_err; ?> </span>
                </div>
                <div class="form-group">

                    <label style="color: white">Mật Khẩu:</label><br>
                    <input type="password" name="password" class="form-control
                                 <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                    <span class="invalid-feedback"><?php echo $password_err; ?></span>


                </div>
                <div class="form-group">
                    <br>
                    <input type="submit" class="btn-primary" value="Đăng Nhập">
                </div>
                <p class="df" style="color:white;margin-left: -50px;font-size: 18px">Bạn không phải quản trị viên?<a style="color: yellow" href="login.php">Đăng nhập với tư cách khách</a>.</p>
            </form>
        </div>
    </div.a>
</div>
</body>



















</div>

<br>
<br>

<br>
<br>
<br>
<br>

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
</div>


</body>
</html>