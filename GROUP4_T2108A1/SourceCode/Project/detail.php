<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
<head>
    <title> Chi tiết sản phẩm</title>
    <meta charset="UTF-8">
    <link rel="icon" type="text/css" href="images/logo.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css" >
    <style>
        .container{
            background-color: whitesmoke;
            border-radius: 10px;
            width: auto;
            height: auto;
        }
        span.product-price{
            color: #601900;
            text-shadow: 2px 0 black;
        }
        label{
            color: #000000;
            font-weight: 700;
        }
        h1{
            font-weight: bold;
            text-shadow: 2px 0 black;
        }
        div.clear-both text{
            margin-top: -200px;
        }
        body{
            text-shadow: 1px 0 black;
            color: white;
            font-size: 20px;
            background-color: whitesmoke;
        }

    </style>
</head>
<body>
<?php
include_once ('header.php')
?>
<?php
include './connect_db.php';
$result = mysqli_query($con, "SELECT * FROM product WHERE P_ID = ".$_GET['id']);$product = mysqli_fetch_assoc($result);
$products = mysqli_query($con, "SELECT * FROM product where P_ID=".$_GET['id'] );

$row = mysqli_fetch_array($products)

?>
<hr>
<div class="container" style="margin-top: 20px">
    <h2 style="color: #000000;text-shadow: 1px 0 black">Chi tiết sản phẩm</h2>
    <div id="product-detail">
        <div id="product-img">
            <img src="images/<?=$row['IMG']?>" />
        </div>
        <div id="product-info">
            <h1 style="color: #261b1b;text-shadow: 3.5px 0 black">
                <?=$product['P_name']?></h1>
            <label>Giá: </label>
            <span class="product-price"><?= number_format($product['Price'], 0, ",", ".") ?> VND</span><br/>
            <form id="add-to-cart-form" action="cart.php?action=add" method="POST">
                <input type="text" value="1" name="quantity[<?=$product['P_ID']?>]" size="2" /><br/>
                <input type="submit" style="background-color: #e00000;text-shadow: 2px 0 black;border-radius: 7px" value="Mua sản phẩm" />
            </form>
            <?php if(!empty($product['IMG'])){ ?>
            <div id="gallery">
                <ul>

                    <li><img src="images/<?=$row['IMG']?>" /></li>
                    <?php } ?>
                </ul>
            </div>
            <?php  ?>
        </div>
        <div class="clear-both"></div>
        <a style="color: #382121">Mô tả: <?=$product['P_Desc']?></a>
    </div>
</div>
</body>
</html>