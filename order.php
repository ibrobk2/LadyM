<?php 
session_start();

if(!isset($_SESSION['username'])){
    header("Location: ./login.php");
    exit(0);
}



?>
<!DOCTYPE html>
<html>
<head>
    <title>Order Form</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <?php include "navbar2.php"; ?>
    <div class="container">
        <h2>Order Form</h2>
        <form method="post" action="process_order.php">
            <div class="form-group">
                <label for="food_name">Food Name:</label>
                <input type="text" class="form-control" name="food_name" value="<?php echo $_GET['product']; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="price">Price:</label>
                <input type="text" class="form-control" name="price" value="<?php echo $_GET['price']; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="card_number">Card Number:</label>
                <input type="text" class="form-control" name="card_number" required maxlength="16" minlength="16">
            </div>
            <div class="form-group">
                <label for="expiry_date">Expiry Date:</label>
                <input type="text" class="form-control" name="expiry_date" required maxlength="6" minlength="6">
            </div>
            <div class="form-group">
                <label for="cvv">CVV:</label>
                <input type="text" class="form-control" name="cvv" required maxlength="3" minlength="3">
            </div>
            <button type="submit" class="btn btn-primary">Pay</button>
        </form>
    </div>
</body>
</html>
