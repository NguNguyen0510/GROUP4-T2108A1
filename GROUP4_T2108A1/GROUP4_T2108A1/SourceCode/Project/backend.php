<?php
$connect = mysqli_connect("localhost","root","","cheems");


//check conn
if ($connect == false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

if (isset($_REQUEST["term"])){
    //prepare statemetn
    $sql = "select * from product where P_name like ?";


    if ($stmt = mysqli_prepare($connect,$sql)){
        mysqli_stmt_bind_param($stmt,"s",$param_term);

        $sparam_term = $_REQUEST["term"]. '%';

        if (mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
            if (mysqli_num_rows($result) > 0){
                while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
                    echo "<p>" .$row["P_name"]."</p>";
                }
            }else{
                echo "<p>No matches found</p>";
            }
        }else{

            echo "ERROR: Could not able to execute $sql. " .mysqli_error($link);
        }
    }
    mysqli_stmt_close($stmt);
}
mysqli_close($connect);
?>