<?php
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sản phẩm</title>
    <meta charset="UTF-8">
    <link rel="icon" type="text/css" href="images/logo.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
<!--    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">-->

    <script src="https://kit.fontawesome.com/d49368c597.js" crossorigin="anonymous"></script>
    <style>




        .buii{

            width: 350px;
            height: 140px;
        }
        body{
            font-family: arial;
            background-color: whitesmoke;
        }
        .container{
            width: 1200px;
            margin: 0 auto;
        }
        h1{
            text-align: center;
            text-shadow: 2px 0 black;
        }
        .product-items{
            border: 4px solid white;
            padding-top: 30px;
        }
        .product-item{
            float: left;
            width: 23%;
            margin: 1%;
            text-align: center;
            padding: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            line-height: 26px;
            background-color: #ffe2bc;
            border-radius: 10px;

            box-shadow: 0 0 16px -5px;
        }
        .product-item label{
            font-weight: bold;
        }
        .product-item p{
            margin: 0;
            line-height: 26px;
            max-height: 52px;
            overflow: hidden;
        }
        .product-price{
            color: #000000;
            font-weight: bold;
        }
        .product-img{
            padding: 5px;
            border: 1px solid #ccc;
            margin-bottom: 5px;
        }
        .product-item img{
            max-width: 100%;
        }
        .product-item ul{
            margin: 0;
            padding: 0;
            border-right: 1px solid #ccc;
        }
        .product-item ul li{
            float: left;
            width: 33.3333%;
            list-style: none;
            text-align: center;
            border: 10px solid #ccc;
            border-right: 0;
            box-sizing: border-box;
            border: 1px solid black;
        }
        .clear-both{
            clear: both;
        }
        a{
            text-decoration: none;
            color: black;
        }
        .buy-button{
            text-align: right;
            margin-top: 10px;
        }
        .buy-button a{
            background: #444;
            padding: 5px;
            color: #fff;
        }
        #pagination{
            text-align: right;
            margin-top: 15px;
        }
        .page-item{
            border: 1px solid #ccc;
            padding: 5px 9px;
            color: #000;
        }
        .current-page{
            background: #000;
            color: #FFF;
        }
        #baos{
            border-radius: 10px;
            width: 1200px;
            height: 500px;
            margin-top: 20px;
            margin-left: 70px;
        }
    </style>
</head>
<body>
<div id="menu">

    <a href="logout.php" class="logoindex"><img src="images/logo.png" width="111" height="111"></a>
    <ul>
        <li class="tt"><a href="index.php" style="background-color:white;color: #464141;text-shadow: 1px 0 black">TRANG CHỦ</a></li>
        <li class="tt"><a href="service.php" style="background-color:white !important;color: #464141;text-shadow: 1px 0 black">DỊCH VỤ</a></li>
        <li class="tt"><a href="news.php" style="background-color:white !important;color: #464141;text-shadow: 1px 0 black">TIN TỨC</a></li>
        <li class="tt"><a href="product.php" style="background-color:white !important;color: #ff8800;text-shadow: 1px 0 black">SẢN PHẨM</a></li>
        <li class="tt"><a href="search.php" style="background-color:white !important;color: #464141;text-shadow: 1px 0 black">TÌM KIẾM</a></li>
        <li class="tt"><a href="login.php" style="background-color:white !important;color: #464141;text-shadow: 1px 0 black">ĐĂNG NHẬP</a></li>

</div>
<hr>

<?php
include './connect_db.php';
$item_per_page = !empty($_GET['per_page'])?$_GET['per_page']:4;
$current_page = !empty($_GET['page'])?$_GET['page']:1; //Trang hiện tại
$offset = ($current_page - 1) * $item_per_page;
$products = mysqli_query($con, "SELECT * FROM `product` ORDER BY `P_ID` DESC  LIMIT " . $item_per_page . " OFFSET " . $offset);
$totalRecords = mysqli_query($con, "SELECT * FROM `product`");
$totalRecords = $totalRecords->num_rows;
$totalPages = ceil($totalRecords / $item_per_page);
?>
<div id="baos">
    <div class="container">
        <h1 style="color: #000000;padding-top: 35px">Danh sách sản phẩm</h1>
        <div
                style="background-color: #b91b00;
        color: #000000;
        width: 180px;
        text-align: center;
        height: 30px;
        font-size:23px;
        border-radius: 10px;
        border: 1px solid #000000;
        margin-top: -80px;
        margin-left: 30px;

"><a style="color: white" href="order.php"> Xem Đơn Hàng</a></div><br><br>
        <div class="product-items" style="height: 288px;
        border-radius: 10px;
        margin-left:60px;
        width: 90%;

       ">
            <?php
            while ($row = mysqli_fetch_array($products)) {
                ?>
                <div class="product-item">
                    <div class="product-img">
                        <a href="detail.php?id=<?= $row['P_ID'] ?>"><img class="buii" src="images/<?= $row['IMG'] ?>" title="<?= $row['P_name'] ?>" /></a><br>
                    </div>
                    <strong><a style="color:#006de5;text-shadow: 1px 0 black;font-size: 20px" href="detail.php?id=<?= $row['P_ID'] ?>"><?= $row['P_name'] ?></a></strong><br/>
                    <label>Giá: </label><span style="text-shadow: 1px 0 black" class="product-price"><?= number_format($row['Price'], 0, ",", ".") ?> đ</span><br/>
                    <p style="color: #002985;width: 100%"><?= $row['P_Desc'] ?></p>
                </div>
            <?php } ?>
            <div class="clear-both" ></div>
            <?php
            include './pagination.php';
            ?>
            <div class="clear-both"></div>
            <div class="clear-both"></div>

        </div>

    </div>
</div>
</body>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</html>