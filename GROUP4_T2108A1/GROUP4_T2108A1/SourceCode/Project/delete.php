<?php
include_once ('connect_db.php');
$P_ID = $_GET['id'];

$result = mysqli_query($con,"Delete from product where P_ID = '$P_ID'");
header("Location:admin.php");
?>