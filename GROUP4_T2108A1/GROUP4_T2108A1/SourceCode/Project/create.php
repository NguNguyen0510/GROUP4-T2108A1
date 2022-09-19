<?php
//check add
if (isset($_POST['Submit'])){
    $P_Name = $_POST['P_Name'];
    $P_Desc = $_POST['P_Desc'];
    $P_Qty = $_POST['P_Qty'];
    $P_Type = $_POST['P_Type'];
    $Price = $_POST['Price'];
    $IMG = $_POST['IMG'];

    //load connection
    include_once ("connect_db.php");

    //add ban ghi
    $result = mysqli_query($con,"insert into product(P_Name,P_Desc,P_Qty,P_Type,Price,IMG) values ('$P_Name','$P_Desc','$P_Qty','$P_Type','$Price','$IMG')");

    //hien sau khi add
    header("Location: admin.php");
}
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>Thêm Sản Phẩm</title>
    <link rel="cheems icon" type="text/css" href="images/logo.png"/>
    <link rel="stylesheet" href="style.css">
    <style>


        body {
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
            border: 1px solid #000000;
            background-color: #314ede;
            width: 700px;
            font-size: 18px;
            margin-left: 25px;

            height: 30px;}

        #box
        {    box-shadow:         0px 4px 5px rgba(50, 50, 50, 0.93);

            width: 1000px;
            border: 1px solid #000000;
            height: 600px;
            background-color: #c50101;
            font-family: Helvetica, sans-serif;
            font-size: 22px;
            border-radius: 30px;
            margin-left: 175px;
            text-shadow: 2px 0 black

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
<a class="btn-sss" href="admin.php" style="color: white">Xem danh sách</a>
<br/>
    <br/>


<form action="create.php" method="post" name="form" >
    <table border="0" class="form-table" style="color: white">
        <tr>
            <td>Tên Sản Phẩm:</td>
            <td><input type="text" style="margin-left: -700px" name="P_Name"></td></tr>
        <tr>
            <td>Mô tả sản phẩm:</td>
            <td><input type="text" style="margin-left: -700px" name="P_Desc"></td></tr>
        <tr>
            <td>Số Lượng:</td>
            <td><input type="text" style="margin-left: -700px" name="P_Qty"></td></tr>
        <tr>
            <td>Loại sản phẩm:</td>
            <td><input style="margin-left: -700px" type="text" name="P_Type"></td></tr>
        <tr>
            <td>Giá Sản Phẩm:</td>
            <td><input type="text" style="margin-left: -700px" name="Price"></td></tr>
        <tr>
            <td>Hình Ảnh:</td>
            <td><input class="file-data" style="margin-left: -624px" type="file" name="IMG"></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" name="Submit"style="margin-left: -700px" value="Thêm Sản phẩm"></td>
        </tr>
    </table>
</form>

    <a class="ch"><img src="images/logo.png" width="140" height="140"></a>
</div>
