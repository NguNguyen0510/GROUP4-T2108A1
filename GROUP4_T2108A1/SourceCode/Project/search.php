<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <title>Tìm Kiếm</title>
    <link rel="cheems icon" type="text/css" href="images/logo.png"/>
    <link rel="stylesheet" href="style.css">
<style>


</style>

</head>
<div id="menu" style="background-color: white;border: 2px solid white">

    <a href="logout.php" class="logoindex" style="background-color: white"><img src="images/logo.png" width="111" height="111"></a>
    <ul>
        <li class=""><a href="index.php" style="background-color:white;color: #464141;text-shadow: 1px 0 black">TRANG CHỦ</a></li>
        <li class="tt"><a href="service.php" style="background-color:white !important;color: #464141;text-shadow: 1px 0 black">DỊCH VỤ</a></li>
        <li class="tt"><a href="news.php" style="background-color:white !important;color: #464141;text-shadow: 1px 0 black">TIN TỨC</a></li>
        <li class="tt"><a href="product.php" style="background-color:white !important;color: #464141;text-shadow: 1px 0 black">SẢN PHẨM</a></li>
        <li class="tt"><a href="search.php" style="background-color:white !important;color: #ff8800;text-shadow: 1px 0 black">TÌM KIẾM</a></li>
        <li class="tt"><a href="login.php" style="background-color:white !important;color: #464141;text-shadow: 1px 0 black">ĐĂNG NHẬP</a></li>

</div>
<hr>
<br>
<br>
<body>
<div id="fox">

    <a herf="#link-to-search" class="button button-open">

        <rect class="fill-none" width="32" height="32"/>
        <path class="fill-currentcolor" d="M29.82861,24.17139,25.56519,19.908A13.0381,13.0381,0,1,0,19.908,25.56525l4.26343,4.26337a4.00026,4.00026,0,0,0,5.65723-5.65723ZM5,14a9,9,0,1,1,9,9A9.00984,9.00984,0,0,1,5,14Z"/>
        </svg>
    </a>

    <!-- Search form overlay -->

    <form action="" method="post">
        <input class="xx" type="text" name="search" placeholder="Nhập từ khóa món ăn cần tìm kiếm">
        <input class="cc" type="submit" name="submit" value="Tìm Kiếm">

    </form>
</div>

</div>


<?php
$servername='localhost';
$username='root'; // User mặc định là root
$password='';
$dbname = "cheems"; // Cơ sở dữ liệu
$conn=mysqli_connect($servername,$username,$password,$dbname);
if(!$conn){
    die('Không thể kết nối Database:' .mysqli_error());
}
if(ISSET($_POST['submit'])){
    $keyword = $_POST['search'];
    ?>
    <div class="ketqua" style="text-align: center">


        <table style="color: #000000" width="100%" border=4>
            <tr>
                <th>Kết quả</th>
            </tr>
            <tr>

            <?php
            $query = mysqli_query($conn, "SELECT * FROM `product`
         WHERE `P_name` LIKE '%$keyword%' ORDER BY `P_name`") or die(mysqli_error());
            while($fetch = mysqli_fetch_array($query)){
                ?>
                <?php echo '<td>' .$fetch['P_name']. '</td>'; ?>
                <a href="detail.php?id=<?= $fetch['P_ID'] ?>"><img class="imgi" src="images/<?= $fetch['IMG'] ?>" title="<?= $fetch['P_name'] ?>" /></a>
                <?php
            }
            ?> </tr>
        </table>



    </div>

    <?php
}
?>

</body>





</html>
<style>
    .imgi{
        width: 280px;
        height: 170px;
    }

    }
    #menu ul
    {
        display: inline;
    }
    #menu ul li
    {
        list-style-type: none;
        display: inline;
        margin-left: 10px;
        padding-top:9px;
    }
    #menu ul li a:link
    {
        color: #beadad;
        text-decoration: none;
        text-transform: uppercase;
        padding-top: 45px;
        padding-bottom: 50px;
        padding-left: 30px;
        padding-right: 30px;
    }

    #menu ul li a:visited
    {
        color: #FFF;
        text-decoration: none;
        text-transform: uppercase;
    }

    #menu ul li a:hover
    {
        color: #ff0707;
        background-color: #ffffff;
        -webkit-box-shadow: 0px 4px 5px rgba(50, 50, 50, 0.93);
        -moz-box-shadow:    0px 4px 5px rgba(50, 50, 50, 0.93);
        box-shadow:         0px 4px 5px rgba(50, 50, 50, 0.93);
    }

    ul.cmt li{
        display:inline;
        margin: 30px;
        font-weight: 600;
    }

    ul.cmt li a{
        display:inline-block;
    }

    #cmt ul li a:link
    {
        color: #1a0000;
        text-decoration: none;
        text-transform: uppercase;
        padding-top: 20px;
        padding-bottom: 20px;
        padding-left: 20px;
        padding-right: 20px;
    }

    #cmt ul li a:visited
    {
        color: #000000;
        text-decoration: none;
        text-transform: uppercase;
    }

    #cmt ul li a:hover
    {
        color: #000000;
        background-color: #ffffff;
        -webkit-box-shadow: 0px 4px 5px rgba(50, 50, 50, 0.93);
        -moz-box-shadow:    0px 4px 5px rgba(50, 50, 50, 0.93);
        box-shadow:         0px 4px 5px rgba(50, 50, 50, 0.93);
    }

    .search:link
    {
        color: #beadad;
        text-decoration: none;
        text-transform: uppercase;
        padding-top: 72px;
        padding-bottom: 25px;
        padding-left: 40px;
        padding-right: 38px;
    }

    .search :visited
    {
        color: #ff0000;
        text-decoration: none;
        text-transform: uppercase;
    }

    .search:hover
    {
        color: #000000;
        background-color: #ff0000;
        -webkit-box-shadow: 0px 4px 5px rgba(50, 50, 50, 0.93);
        -moz-box-shadow:    0px 4px 5px rgba(50, 50, 50, 0.93);
        box-shadow:         0px 4px 5px rgba(50, 50, 50, 0.93);
    }
    #fox
    {
        width: 1000px;
        border: 1px solid #b7a39e;
        height: 600px;
        background-color: whitesmoke;
        font-family: Helvetica, sans-serif;
        font-size: 17px;
        margin-left: 150px;
        margin-top:10px;

    }


                    .button {
                        display: inline-block;
                        -webkit-appearance: none;
                        -moz-appearance: none;
                        appearance: none;
                        line-height: normal;
                        border: none;
                        outline: none;
                        max-width: 100%;
                        font-family: Arial; }
    .fill-currentcolor {
        fill: currentcolor; }

    .fill-none {
        fill: none; }

    .button {
        cursor: pointer;
        color: #d7d7d7;
        transition: .3s ease-out;}


    .button-open {
    // Display/alignment
    display: flex;
        justify-content: center;
        align-items: center;
        align-content: center;}.button-close {
                                   position: absolute;
                                   top: 7.5vw;
                                   right: 7.5vw;
                                   padding: 0;
                                   background-color: transparent; }

    .button-search {
        position: absolute;
        z-index: 2;
        top: 0;
        right: 0;
        background-color: transparent;
        cursor: pointer;
        padding: 25px;}

    .form-search {
        position: relative;
        width: 100%;}
    .input-search {
    // Sizing
    padding: 26px 25px; // 72px height
    width: 100%;}
    .input-search::placeholder {
        color: #000000; }
    .overlay {
    // Display
    overflow: hidden;
        display: flex;
        justify-content: center;
        align-items: flex-end;
        align-content: flex-end;}
    .ketqua{
        width: 1000px;
        margin-left: 151px;
        border-radius: 2px;
        margin-top: -500px;
    }
    body{
        background-color: whitesmoke;
    }
    .xx{
        margin-left: 150px;
        width: 500px;
        height: 40px;
        border-radius: 10px;
        margin-top: 22px;
    }
    .cc{
        border-radius: 5px;
        width: 200px;
        height: 45px;
        margin-top: 2px;
        font-size: 20px;
        font-weight: bold;
        background-color: #da0909;
        color: #d7d7d7;
        text-shadow: 2px 0 black;
    }
</style>

