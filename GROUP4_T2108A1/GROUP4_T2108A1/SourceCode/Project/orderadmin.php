
<?php
include_once ("connect_db.php");//read files
$result = mysqli_query($con,"SELECT * FROM orders");
//?>

<html>
<head>
    <meta charset="UTF-8">
    <title>Quản Lý Đơn Theo Admin</title>
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
            background-color: #ff1212;
            width: 200px;
            height: 20px;}
        #box
        {
            text-decoration: none;
            width: 1000px;

            height: 1200px;
            background-color: whitesmoke;            font-family: Helvetica, sans-serif;
            font-size: 17px;
            margin-left: 150px;
        }
        .indexx{
            border-radius: 5px;
            background-color: #ff3434;
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
        }
        td img{
            width: 280px;
            height: 170px;
        }
    </style>
</head>
<body>
<div id="box">
    <div class="btn-sss">
        <a style="color: white;
        text-decoration: none;" href='admin.php'>Về Trang Admin</a></div>
    <div class="indexx"> <a style="color: white;text-decoration: none" href="index.php">VỀ TRANG CHỦ</a></div>
    <table style="height: 200px;
    width: auto;    box-shadow:         0px 4px 5px rgba(50, 50, 50, 0.93);
background-color: #ffe2bc;
    color: #000000;text-align: center;text-shadow: 1px 0 black" width="100%" border=4>
        <tr style="background-color: #c50101;color: white;height: 40px">
            <th>Mã Đơn Hàng</th>
            <th>Tên Khách Hàng</th>
            <th>Số Điện Thoại</th>
            <th>Ghi Chú</th>
            <th>Trạng thái</th>
            <th>Tổng Tiền</th>
            <th>Ngày Tạo Đơn</th>
            <th>Ngày Cập Nhật</th>
            <th></th>
        </tr>
        <?php
        while ($order_data = mysqli_fetch_array($result)){
            echo '<tr>';
            echo '<td>'.$order_data['id'].'</td>';
            echo '<td>'.$order_data['C_Name'].'</td>';
            echo '<td>'.$order_data['C_Phone'].'</td>';
            echo '<td>'.$order_data['note'].'</td>';
            echo '<td>'.$order_data['status'].'</td>';
            echo '<td>'.$order_data['total'].'đ</td>';
            echo '<td>'.$order_data['created_time'].'</td>';
            echo '<td>'.$order_data['last_updated'].'</td>';

            echo "<td><a href='updatebyadmin.php?id=$order_data[id]' style='color: #0005b0;text-decoration: none'>Chỉnh sửa</a> 
            <br><a href='deleteorder.php?id=$order_data[id]' style='color: #ff0320;text-decoration: none'>Xóa Đơn</a></td></tr>";
        }
        ?>

    </table>

    <a style="margin-left: 400px"><img src="images/logo.png" width="140" height="140"></a>

</div>







