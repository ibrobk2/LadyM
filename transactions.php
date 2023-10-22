<?php 
session_start();

if(!isset($_SESSION['username'])){
    header("Location: ./login.php");
    exit(0);
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transactions Page</title>
    <link rel="stylesheet" href="./assets/bootstrap/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h3 class="text-left"><a href="admin_dashboard.php">Back to Admin Dashboard</a></h3>
        <h2 class="text-center text-success mt-5">Transactions History</h2>
       <div class="table-responsive">
        <table class="table table-striped
        table-hover	
        table-borderless
        table-primary
        align-middle">
            <thead class="table-light">
                <caption>Transaction History</caption>
                <tr>
                    <th>SNO.</th>
                    <th>Customer Username</th>
                    <th>Food Ordered</th>
                    <th>Price</th>
                    <th>Trx. Date</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody class="table-group-divider">

                <?php
                include "server.php"; //Server connection
                    $sn = 1; //Serial number beginning
                    $sql = "SELECT * FROM transactions";//Fetching Transactions Data from Database
                    $res = mysqli_query($conn, $sql);
                    while($data = mysqli_fetch_assoc($res)){


                
                ?>
                    <tr class="table-primary" >
                        <td scope="row"><?=$sn++; ?></td>
                        <td><?=$data['username'];?></td>
                        <td><?=$data['food_name'];?></td>
                        <td><?=$data['price'];?></td>
                        <td><?=$data['created_on'];?></td>
                        <td><a href="delete_trx.php?del=<?=$data['id'];?>" class="btn btn-danger">Delete</a></td>
                    </tr>

                    <?php } ?>
                    <!-- <tr class="table-primary">
                        <td scope="row">Item</td>
                        <td>Item</td>
                        <td>Item</td>
                    </tr> -->
                </tbody>
                <tfoot>
                    
                </tfoot>
        </table>
       </div>
       
    </div>
</body>
</html>