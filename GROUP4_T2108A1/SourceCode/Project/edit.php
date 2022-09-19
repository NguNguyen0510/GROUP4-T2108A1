<?php
include_once("connect_db.php");

//tra ve neu ng dung submit
if (isset($_POST['update']))
{
    $P_ID = $_POST['P_ID'];

    $P_Name = $_POST['P_name'];
    $P_Desc = $_POST['P_Desc'];
    $P_Qty = $_POST['P_Qty'];
    $P_Type = $_POST['P_type'];
    $Price = $_POST['Price'];
    $IMG = $_POST['IMG'];

    $result = mysqli_query($con,"UPDATE PRODUCT
SET P_name ='$P_Name',
    P_Desc='$P_Desc',
    P_Qty='$P_Qty',
    P_type='$P_Type',
    Price='$Price',
    IMG='$IMG'
WHERE P_ID = '$P_ID'");

    //back home
    header("Location: admin.php");
}
?>
<?php

//get by url
include_once('connect_db.php');

$P_ID = $_GET['id'];

//Fetech data by id
$result = mysqli_query($con,"SELECT * FROM PRODUCT WHERE P_ID='$P_ID'");

while ($product_data = mysqli_fetch_array($result))
{
    $P_Name = $product_data['P_name'];
    $P_Desc = $product_data['P_Desc'];
    $P_Qty = $product_data['P_Qty'];
    $P_Type = $product_data['P_type'];
    $Price = $product_data['Price'];
    $IMG = $product_data['IMG'];
}
?>

<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
<head>
    <title>Chỉnh sửa sản phẩm</title>
    <style>
        body{
            background-color: whitesmoke;
        }
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
            background-color: #c50101;
            font-family: Helvetica, sans-serif;
            font-size: 22px;
            border-radius: 30px;
            margin-left: 175px;

        }
        .file-data{
            margin-left: 77px;
        }
        .form-table{
            margin-left: -175px;
            width: 100%;
        }
    </style>
</head>
<body>

<div id="box">
<a  style="color: white" class="btn-sss" href="admin.php">Xem sản phẩm</a>

<br/>
    <br/>

<form name="edit" method="post" action="edit.php" name="form" style="color:white;">
    <table border="0" class="form-table" style="font-size: 16px">
        <tr>
            <td>Tên Sản Phẩm</td>
            <td><label>
                    <input type="text" style="margin-left: -700px" name="P_name" value=<?php echo $P_Name;?>></label></td></tr><tr>
            <td>Mô tả sản phẩm:</td><td><label>
                    <input type="text" style="margin-left: -700px" name="P_Desc" value=<?php echo $P_Desc;?>></label></td></tr><tr>
            <td>Số lượng:</td><td><label>
                    <input type="text" style="margin-left: -700px" name="P_Qty" value=<?php echo $P_Qty; ?>></label></td></tr><tr>
            <td>Loại sản phẩm:</td><td><label>
                    <input type="text" style="margin-left: -700px" name="P_type" value=<?php echo $P_Type; ?>></label></td></tr> <tr>
            <td>Giá Sản Phẩm:</td><td><label>
                    <input type="text" style="margin-left: -700px" name="Price" value=<?php echo $Price; ?>></label></td></tr><tr>
            <td>Hình Ảnh:</td>
            <td><input type="file" style="margin-left: -624px" class="file-data" name="IMG" value=<?php echo $IMG; ?>></td>
        </tr>
        <tr>
            <td><input type="hidden" name="P_ID" value=<?php echo $_GET['id']; ?>></td>
            <td><input type="submit" style="margin-left: -700px" name="update" value="Cập Nhật"></td>
        </tr>
    </table>
</form>

    <a class="ch"><img src="images/logo.png" width="140" height="140"></a>
</div>
</body>
</html>
