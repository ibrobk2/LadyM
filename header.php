<?php
$order = false;
include "server.php";
session_start();
if(isset($_GET['order'])){
    // if(isset($_SESSION['logged'])){
    $id = $_GET['id']; 
    if(isset($_SESSION['logged'])){
        $order = true;
    }else{
        header("Location: login.php");
    }
   

// }else{
//     header("Location: ../");
// }
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>ProxyMart</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link rel="stylesheet" type="text/css" href="style.css"> -->
    <link rel="stylesheet" type="text/css" href="index.css">
    <!-- Optional Bootstrap styling -->
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
   <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
</head>
<body>
    <header>
        <h1 class="text-center">Proxy<span style="color:gold;">Mart</span></h1>
        <nav>
            <div class="row">
                <div class="col-md-6">
                    <ul>
                    <li><a href="./index.php">Home</a></li>
                    <li><a href="#">Computers</a></li>
                    <li><a href="#">Softwares</a></li>
                    <li><a href="#">Hardwares</a></li>
                    <li><a href="#" >Accessories</a></li>
                    </ul>
                </div>
                <div class="col-md-6" style="padding-left:350px;">
                    <ul>
                    <li><a href="#" class="col-md-3"><i class="las la-shopping-cart" style="font-size: 32px;position:relative"><sup style="font-size:16px;position:absolute; top:0; right:0;color:gold;">0</sup></i></a></li>
                    <?php 
                        if($order==true || isset($_SESSION['logged'])){
                            ?>
                            <li><a href="logout.php" class="col-md-3"><i class="las la-lock" style="font-size: 22px;"></i>Logout</a></li>
                    <li><a href="profile.php" style="font-size: 28px;;"><i class="las la-user-circle"></i></a></li>
                    <?php }else{ ?>
                    <li><a href="#" class="col-md-3"><i class="las la-lock" style="font-size: 22px;"></i>Login/Register</a></li>
                    <?php } ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>