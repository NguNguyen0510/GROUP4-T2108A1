<?php
include_once("connect_db.php");

//tra ve neu ng dung submit
if (isset($_POST['update']))
{
    $id = $_POST['id'];

    $status = $_POST['status'];
    $total = $_POST['total'];

    $result = mysqli_query($con,"UPDATE orders
SET 
    status='$status',
    total='$total'
WHERE id = '$id'");

    //back home
    header("Location: orderadmin.php");
}
?>
<?php

//get by url
include_once('connect_db.php');

$P_ID = $_GET['id'];

//Fetech data by id
$result = mysqli_query($con,"SELECT * FROM orders WHERE id='$P_ID'");

while ($orderdata = mysqli_fetch_array($result))
{
    $status = $orderdata['status'];
    $total = $orderdata['total'];
}
?>

<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
<head>
    <title>Chỉnh sửa đơn hàng</title>
    <style>
        body{background-color: whitesmoke;}
        .form-table{
            text-align: center;
            margin-top: 25px;
            margin-left: 100px;
            width: 460px;
        }
        .ch{
            margin-left: 400px;
        }
        .btn-sss{
            text-transform: uppercase;
            text-decoration: none;

            border-radius: 5px;
            border: 2px solid #000000;
            background-color: #314ede;
            width: 700px;
            font-size: 18px;
            margin-left: 25px;
            height: 30px;}

        #box
        {
            text-shadow: 2px 0 black;
            width: 1000px;
            border: 1px solid #000000;
            height: 600px;
            background-color: #c50101;    box-shadow:         0px 4px 5px rgba(50, 50, 50, 0.93);

            font-family: Helvetica, sans-serif;
            font-size: 22px;
            border-radius: 30px;
            margin-left: 150px;

        }
        .file-data{
            margin-left: 77px;
        }
        .form-table{
            margin-left: 185px;
        }
    </style>
</head>
<body>

<div id="box">
    <a  style="color: white" class="btn-sss" href="orderadmin.php">Xem Đơn Hàng</a>

    <br/>
    <br/>

    <form name="edit" method="post" action="updatebyadmin.php" name="form" style="color:white;">
        <table border="0" class="form-table" style="font-size: 16px">
            <tr>
                <td>Trạng Thái:</td><td><label>
                        <input type="text" name="status" value=<?php echo $status; ?>></label></td></tr> <tr>
                <td>Tổng Giá:</td><td><label>
                        <input type="text" name="total" value=<?php echo $total; ?>></label></td></tr><tr>
            </tr>
            <tr>
                <td><input type="hidden" name="id" value=<?php echo $_GET['id']; ?>></td>
                <td><input type="submit" name="update" value="Cập Nhật"></td>
            </tr>
        </table>
    </form>

    <a class="ch"><img src="images/logo.png" width="140" height="140"></a>
</div>
</body>
</html>
