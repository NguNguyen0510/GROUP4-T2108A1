

<?php session_start();
error_reporting(0);


?>
<header id="header">
    <meta charset="UTF-8">


    <style>
        .navbar-brand{
            color: black;
        }
        .text-warning {
            position: absolute;
            color: #ffc107!important;
            margin-left: 5px;
        }

        .bg-light {

            background-color: #7a7a7a !important;
            border-radius: 15%;
            width: 25px;
            align-items: center;
            margin-top: 1.5px;
        }
        .text-warning bg-light{
            margin-left: 10px;
        }


    </style>





    <header id="header">
        <meta charset="UTF-8">


        <style>
            .navbar-brand{
                color: black;
            }
            .text-warning {
                position: absolute;
                color: #ffc107!important;
                margin-left: 5px;
            }

            .bg-light {

                background-color: #7a7a7a !important;
                border-radius: 15%;
                width: 25px;
                align-items: center;
                margin-top: 1.5px;
            }
            .text-warning bg-light{
                margin-left: 10px;
            }


        </style>

        <nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="background-color: whitesmoke !important;" >

            <a href="product.php" class="navbar-brand">
                <h2  class="px-5" style="text-shadow: 1px 0 black;
         font-size: 50px;
         color: black;
         font-size: 16px;
         padding-top: 30px;

font-weight: bold;margin-top: 35px">
                    VỀ TRANG SẢN PHẨM
                </h2>
            </a>

            <button class="navbar-toggler" type="button"
                    data-toggle="collapse"
                    data-target="#navbarNavAltMarkup"
                    aria-controls="navbarNavAltMarkup"
                    aria-expanded="false"
                    aria-label="Toggle navigation"

            >
                <span class="navbar-toggler-icon"></span>

            </button>



        </nav>
    </header>


</header>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
<head>
    <link rel="icon" type="text/css" href="images/logo.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>Giỏ Hàng</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<!--    <link rel="stylesheet" type="text/css" href="css/style.css" >-->

    <link rel="icon" type="text/css" href="images/logo.png">

    <script src="https://kit.fontawesome.com/d49368c597.js" crossorigin="anonymous"></script>
    <style>
        body{
            background-color: whitesmoke;
            color: black;
        }
        #baos{
            border-radius: 10px;
            width: 1200px;
            height: 1000px;
            margin-top: 20px;
            margin-left: 70px;
        }
        #bcs1{
            font-size: 16px;
            width: 200px;
            text-shadow: 1px 0 black;
            color: #000000;
        }
        #bcs1 label input{
            border-radius: 10px;
            color: #000000;
        }
        #bcs1 label textarea{
            border-radius: 10px;
            color: #000000;
        }
        #row-total{
            color: #000000;
height: 50px;
            background-color: #d7d7d7;
            font-weight: bold;
            text-shadow: 1px 0 #ffffff;

        }
        table{
            background-color: #ff4b00;
            height: 120px;
            border-radius: 10px;
            box-shadow:         0px 4px 5px rgba(50, 50, 50, 0.93);

        }
        td{
            border: 1px solid black;
        }

        #notify-msg{
            color: #000000;
            font-size: 35px;
            text-align: center;
            padding-top: 100px;
        }

    </style>
</head>
<body>
<hr>
<?php
include './connect_db.php';
if (!isset($_SESSION["cart"])) {
    $_SESSION["cart"] = array();
}
$error = false;
$success = false;
if (isset($_GET['action'])) {

    function update_cart($add = false) {
        foreach ($_POST['quantity'] as $id => $quantity) {
            if ($quantity == 0) {
                unset($_SESSION["cart"][$id]);
            } else {
                if ($add) {
                    $_SESSION["cart"][$id] += $quantity;
                } else {
                    $_SESSION["cart"][$id] = $quantity;
                }
            }
        }
    }

    switch ($_GET['action']) {
        case "add":
            update_cart(true);
            header('Location: ./cart.php');
            break;
        case "delete":
            if (isset($_GET['id'])) {
                unset($_SESSION["cart"][$_GET['id']]);
            }
            header('Location: ./cart.php');
            break;
        case "submit":
            if (isset($_POST['update_click'])) { //Cập nhật số lượng sản phẩm
                update_cart();
                header('Location: ./cart.php');
            } elseif ($_POST['order_click']) { //Đặt hàng sản phẩm
                if (empty($_POST['C_Name'])) {
                    $error = "Bạn chưa nhập tên của người nhận";
                } elseif (empty($_POST['C_Phone'])) {
                    $error = "Bạn chưa nhập số điện thoại";
                } elseif (empty($_POST['quantity'])) {
                    $error = "Giỏ hàng rỗng";
                }
                if ($error == false && !empty($_POST['quantity'])) { //Xử lý lưu giỏ hàng vào db
                    $products = mysqli_query($con, "SELECT * FROM `product` WHERE `P_ID` IN (" . implode(",", array_keys($_POST['quantity'])) . ")");
                    $total = 0;
                    $orderProducts = array();
                    while ($row = mysqli_fetch_array($products)) {
                        $orderProducts[] = $row;
                        $total += $row['Price'] * $_POST['quantity'][$row['P_ID']];
                    }
                    $insertOrder = mysqli_query($con, "INSERT INTO `Orders` (`id`, `C_Name`, `C_Phone`, `note`, `total`, `created_time`, `last_updated`) VALUES ( NULL, '" . $_POST['C_Name'] . "', '" . $_POST['C_Phone'] . "', '" . $_POST['note'] . "', '" . $total . "', '" . time() . "', '" . time() . "');");
                    $orderID = $con->insert_id;
                    $insertString = "";
                    foreach ($orderProducts as $key => $product) {
                        $insertString .= "(NULL, '" . $orderID . "', '" . $product['P_ID'] . "', '" . $_POST['quantity'][$product['P_ID']] . "', '" . $product['Price'] . "', '" . time() . "', '" . time() . "')";
                        if ($key != count($orderProducts) - 1) {
                            $insertString .= ",";
                        }
                    }
                    $insertOrder = mysqli_query($con, "INSERT INTO `Order_details` (`id`, `order_id`, `P_ID`, `quantity`, `price`, `created_time`, `last_updated`) VALUES " . $insertString . ";");
                    $success = "Đặt hàng thành công!";
                    unset($_SESSION['cart']);
                }
            }
            break;
    }
}
if (!empty($_SESSION["cart"])) {
    $products = mysqli_query($con, "SELECT * FROM `product` WHERE `P_ID` IN (" . implode(",", array_keys($_SESSION["cart"])) . ")");
}
//        $result = mysqli_query($con, "SELECT * FROM `product` WHERE `id` = ".$_GET['id']);
//        $product = mysqli_fetch_assoc($result);
//        $imgLibrary = mysqli_query($con, "SELECT * FROM `image_library` WHERE `product_id` = ".$_GET['id']);
//        $product['images1'] = mysqli_fetch_all($imgLibrary, MYSQLI_ASSOC);
?>
<div id="baos">
    <br>
<div class="container" style="border: none;color: white">
    <?php if (!empty($error)) { ?>
        <div id="notify-msg">
            <?= $error ?>. <a href="javascript:history.back()">Quay lại</a>
        </div>
    <?php } elseif (!empty($success)) { ?>
        <div id="notify-msg">
            <?= $success ?>. <a style="color: #003cff;text-shadow: 2px 0 black" href="product.php">Tiếp tục mua hàng</a>
| <a style="color: #0033ff;text-shadow: 2px 0 black" href="order.php">Xem đơn hàng</a>
        </div>
    <?php } else { ?>

        <h1 style="padding-bottom: 10px;padding-left: 450px;text-shadow: 1px 0 black;color: #000000">Giỏ hàng</h1>
        <form id="cart-form" action="cart.php?action=submit" method="POST">
            <table style="width: 100%;border: 1px solid black;background-color: #ffe2bc;text-align: center">
                <tr style="background-color: #c50101">
                    <th style="color: white;text-shadow: 2px 0 black" class="product-number">ID</th>
                    <th style="color: white;text-shadow: 2px 0 black" class="product-name">Tên sản phẩm</th>
                    <th style="color: white;text-shadow: 2px 0 black" class="product-price">Đơn giá</th>
                    <th style="color: white;text-shadow: 2px 0 black" class="product-quantity">Số lượng</th>
                    <th style="color: white;text-shadow: 2px 0 black" class="total-money">Thành tiền</th>
                </tr>
                <?php
                if (!empty($products)) {
                    $total = 0;
                    $num = 1;
                    while ($row = mysqli_fetch_array($products)) {
                        ?>
                        <tr style="color: black">
                            <td style="height: 55px" class="product-number"><?= $num++; ?></td>
                            <td style="color: white;color: black;text-shadow: 1px 0 black" class="product-name"><?= $row['P_name'] ?></td>

                            <td  style="color: white;color: black;text-shadow: 1px 0 black" class="product-price"><?= number_format($row['Price'], 0, ",", ".") ?></td>
                            <td class="product-quantity"><input type="text" value="<?= $_SESSION["cart"][$row['P_ID']] ?>" name="quantity[<?= $row['P_ID'] ?>]" /></td>
                            <td style="color: #000000;text-shadow: 1px 0 black" class="total-money"><?= number_format($row['Price'] * $_SESSION["cart"][$row['P_ID']], 0, ",", ".") ?>đ</td>
                        </tr>
                        <?php
                        $total += $row['Price'] * $_SESSION["cart"][$row['P_ID']];
                        $num++;
                    }
                    ?>
                    <tr id="row-total">
                        <td class="product-number">&nbsp;</td>
                        <td class="product-name">Tổng tiền</td>
                        <td class="product-price">&nbsp;</td>
                        <td class="product-quantity">&nbsp;</td>
                        <td class="total-money"><?= number_format($total, 0, ",", ".") ?>đ</td>

                    </tr>
                    <?php
                }
                ?>
            </table>
            <BR>
            <div id="form-button">
                <input style="border-radius: 10px;background-color: #003585;;width: 120px;height: 50px;color: #ffffff;font-size: 25px" type="submit" name="update_click" value="Cập nhật" />
            </div>

            <hr>

            <h1 style="width: 1000px;text-shadow: 1px 0 black;color: #000000">Đặt hàng ngay</h1>
            <div id="bcs1"><label>Người nhận: <input type="text" value="" name="C_Name" /></label></div>
            <div id="bcs1"><label>Số điện thoại: <input type="text" value="" name="C_Phone" /></label></div>
            <div id="bcs1"><label>Ghi chú: <textarea name="note" cols="50" rows="7" ></textarea> </label></div>
            <div style="margin-top: 20px">
                <a style="color: #000000"><img src="images/wr.png" style="margin-top: -20px" width="50" height="50">Lưu ý: sau khi đặt hàng thành công bạn sẽ không thể hủy đơn hàng</a>
            </div>
            <input style="border-radius: 10px;background-color: #0258be;width: 120px;height: 50px;color: #ffffff;font-size: 25px" type="submit" name="order_click" value="Đặt hàng" />

        </form>
    <?php } ?>
</div>

</div>





<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>