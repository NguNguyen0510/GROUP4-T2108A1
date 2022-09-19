<?php
include './connect_db.php';
$item_per_page = !empty($_GET['per_page'])?$_GET['per_page']:3;
$current_page = !empty($_GET['page'])?$_GET['page']:1; //Trang hiện tại
$offset = ($current_page - 1) * $item_per_page;
$products = mysqli_query($con, "SELECT * FROM product ORDER BY P_ID DESC  LIMIT " . $item_per_page . " OFFSET " . $offset);
$totalRecords = mysqli_query($con, "SELECT * FROM product");
$totalRecords = $totalRecords->num_rows;
$totalPages = ceil($totalRecords / $item_per_page);

?>


<html>
<head>
    <meta charset="UTF-8">
    <title>Trang của Admin</title>
    <link rel="cheems icon" type="text/css" href="images/logo.png"/>
    <link rel="stylesheet" href="style.css">

    <style>

        .ch{
            text-decoration: none;
            margin-left: 400px;
        }
        .btn-sss{
            text-transform: uppercase;
            text-align: center;
            border-radius: 5px;
            border: 2px solid #000000;
            margin-left: 25px;
            background-color: #212bc4;
            width: 200px;
            height: 20px;}

        #box
        {
            text-decoration: none;
            width: 1000px;

            font-family: Helvetica, sans-serif;
            font-size: 17px;
            margin-left: 173px;
        }
        strong{
            margin-left: 3px;
            border: 1px solid black;
        }

        .indexx{
            background-color: #212bc4;
            color: white;
            margin-left: 25px;
            border: 2px solid black;
            font-size: 17px;
            text-decoration: none;
            text-align: center;
            width: 150px;
            height: 20px;
            margin-top: -24px;
            margin-left: 230px;
            border-radius: 5px;
        }.indexx1{
             background-color: #212bc4;
             color: white;
             border: 2px solid black;
             font-size: 17px;
             text-decoration: none;
             text-align: center;
             width: 200px;
             height: 20px;
            border-radius: 5px;
             margin-top: -24px;
             margin-left: 385px;
         }
        td img{
            width: 280px;
            height: 170px;
        }
        .thanhngang{
            background-color: #c50101;
            color: white;
        }
        tbody{
            background-color: #ffe2bc;
        }
        body{
            background-color: whitesmoke;
        }

    </style>
</head>
<body>
<div id="box">
    <div class="btn-sss">
        <a style="color: #ffffff;
        text-decoration: none;" href='create.php'> Thêm sản phẩm mới</a></div>

    <div class="indexx"> <a style="color: white;text-decoration: none" href="index.php">VỀ TRANG CHỦ</a></div>

    <div class="indexx1"> <a style="color: white;text-decoration: none" href="orderadmin.php">QUẢN LÍ ĐƠN HÀNG</a></div>
    <table style="height: auto;
    width: auto;color: #000000;
    text-align: center;
        box-shadow:         0px 4px 5px rgba(50, 50, 50, 0.93);
;
    text-shadow: 1px 0 #000000" width="100%" border=1>
        <tr class="thanhngang">
            <th>ID Sản Phẩm</th>
            <th>Tên Sản Phẩm</th>
            <th>Mô tả sản phẩm</th>
            <th>Số Lượng</th>
            <th>Phân Loại</th>
            <th>Giá Sản Phẩm</th>
            <th>Ảnh</th>
            <th>Chức Năng</th>
        </tr>
        <?php
        while ($product_data = mysqli_fetch_array($products)){
            echo '<tr>';
            echo '<td>'.$product_data['P_ID'].'</td>';
            echo '<td>'.$product_data['P_name'].'</td>';
            echo '<td>'.$product_data['P_Desc'].'</td>';
            echo '<td>'.$product_data['P_Qty'].'</td>';
            echo '<td>'.$product_data['P_type'].'</td>';
            echo '<td>'.$product_data['Price'].'đ</td>';
            echo '<td class="img-s"><img src="images/'.$product_data['IMG'].'"</td>';
            echo "<td><a href='edit.php?id=$product_data[P_ID]' style='color: #002eff;text-decoration: none'>Chỉnh sửa</a> 
            <a href='delete.php?id=$product_data[P_ID]' style='color: #fa465b;text-decoration: none'>Xóa</a></td></tr>";
        }
        ?>
    </table>
    <div class="clear-both" ></div>
    <?php
    include './pagination.php';
    ?>
    <div class="clear-both"></div>
    <div class="clear-both"></div>

    <a style="margin-left: 400px"><img src="images/logo.png" width="140" height="140"></a>



</div>