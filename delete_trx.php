<?php
include "server.php";

if(isset($_GET['del'])){
    $id = $_GET['del'];


    $sql = "DELETE FROM transactions WHERE id=$id";
    $res = mysqli_query($conn, $sql);

    if($res){
        header("Location: transactions.php");
    }
}

?>