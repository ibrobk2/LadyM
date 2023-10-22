<?php
// Include your database connection file (server.php)
session_start();
// session_start();

if(!isset($_SESSION['username'])){
    header("Location: ./login.php");
    exit(0);
}


$user = $_SESSION['username'];
include "server.php";
require "sendEmail/sendEmail.php"; 
// Retrieve form data
$query = "SELECT * FROM users WHERE username='$user'";
$result = mysqli_query($conn,$query);

$data = mysqli_fetch_assoc($result);

$phone = $data['phone'];
$email = $data['email'];
$full_name = $data['full_name'];

$food_name = $_POST['food_name'];
$price = $_POST['price'];
$card_number = $_POST['card_number'];
$expiry_date = $_POST['expiry_date'];
$cvv = $_POST['cvv'];

// Save transaction details to the database (you need to implement this)
// Example using mysqli:
$sql = "INSERT INTO transactions (food_name, price, card_number, expiry_date, cvv, username) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssss", $food_name, $price, $card_number, $expiry_date, $cvv, $user);
if($stmt->execute()){
    $subject = "Order Received from {$full_name}";
    $body = "Order Received from {$full_name}, for {$food_name} and price {$price} his phone is 
    {$phone}.";
    sendEmail('lilwizmin@gmail.com', 'ziblswsegtslhque', 'lilwizmin@gmail.com', $subject, $body);
}

// Generate and display an invoice

$customer_name = $full_name;
$customer_email = $email;
?>
<!DOCTYPE html>
<html>
<head>
    <title>Invoice</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .container{
            width: 100%;
            max-width: 500px;
            margin-top: 60px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h3>Lady M Chips & Restaurant Service</h3>
        <p>Opposite New Life Bakery, Barhim Roundabout, Katsina</p>
        <h2 style="text-align: center;" id="inv">Invoice</h2>
        <p><strong>Customer Name:</strong> <?php echo $customer_name; ?></p>
        <p><strong>Food Name:</strong> <?php echo $food_name; ?></p>
        <p><strong>Price:</strong> <?php echo $price; ?></p>
        <p><strong>Phone Number:</strong> <?php echo $phone; ?></p>
        <p><strong>Email Address:</strong> <?php echo $email; ?></p>
        <!-- <p><strong>CVV:</strong> <?php echo $cvv; ?></p> --> 
        <p><strong>Payment Status:</strong> Payment successful</p>
        <br>
        <div id="prtc_btn">
            <button class="btn btn-primary" onclick="printer();" >Print</button>
            <a href="customer_dashboard.php" class="btn btn-warning" >Back to Dashboard</a>
        </div>

    </div>

    <script>
        function printer(){
            var btn = document.getElementById("prtc_btn");
            var inv = document.getElementById("inv");

            btn.style.visibility = "hidden";
            inv.style.textAlign = "left";
            print();
            btn.style.visibility = "visible";
            inv.style.textAlign = "center";
        }
    </script>

</body>
</html>
