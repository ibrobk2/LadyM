<?php

include "server.php"; 
require "sendEmail/sendEmail.php";

if(isset($_POST['btn_book'])){
  // Variables

  $full_name = $_POST['full_name'];
  $phone = $_POST['phone'];
  $email = $_POST['email'];
  $address = $_POST['address'];
  $no_of_persons = $_POST['no_of_persons'];
  $reserve_type = $_POST['reserve_type'];
  $reserve_date = $_POST['r_date'];
  $food_choices = $_POST['food_choices'];
  $soft_drinks = $_POST['soft_drinks'];
  $payment_type = $_POST['payment_type'];
  $comments = $_POST['comments'];
  $reference = "LadyM-".uniqid();


  $sql = "INSERT INTO bookings (`full_name`, `phone`, `email`, `address`, `num_of_persons`, `date`, `r_type`, `food_choices`, `soft_drinks`, `payment_type`, `comments`, `reference`) VALUES ('$full_name', '$phone', '$email', '$address', '$no_of_persons', '$reserve_date', '$reserve_type', '$food_choices', '$soft_drinks', '$payment_type', '$comments', '$reference')";
  $result = mysqli_query($conn, $sql);

  if($result){
  
    $body = "A customer has reserved a table successfully with reference number: <b>{$reference}</b>";
    sendEmail('lilwizmin@gmail.com', 'ziblswsegtslhque', 'lilwizmin@gmail.com', 'Table Reservation',$body);
    echo "<script>
        alert('Reservation Successful..');
        windo.location = './';    
    </script>";
  }
}