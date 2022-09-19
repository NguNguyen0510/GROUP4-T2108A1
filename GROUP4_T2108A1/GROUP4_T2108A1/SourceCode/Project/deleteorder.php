<?php
include_once ('connect_db.php');
$P_ID = $_GET['id'];

$result = mysqli_query($con,"Delete from orders where id = '$P_ID'");
header("Location:orderadmin.php");
?>