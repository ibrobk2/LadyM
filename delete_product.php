<?php
include "server.php";


if(isset($_GET['delete'])){
    $id = $_GET['delete'];

    $sql = "DELETE FROM product WHERE id=$id";
    $result = mysqli_query($conn, $sql);

    if($result){
        header("Location: manage_product.php");
    }
}


?>