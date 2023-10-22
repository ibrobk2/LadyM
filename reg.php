<?php
session_start();

if(isset($_SESSION['username'])){
    header("Location: customer_dashboard.php");
}
$full_name = "";
$username = "";
$email = "";
$gender = "";
$state = "";
$password = "";
$cpassword = "";
$token = "";
$phone = "";

$errors = array();





?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    <title>Registration Page</title>
    <script src="static/sweetalert/dist/sweetalert.min.js"></script>
    <style>
        .container{
            width: 25%;
        }
    </style>
</head>
<body>
   <?php include "navbar3.php"; ?>
    <div class="container">
    <h2 class="text-center text-primary">Registration Form</h2>
    <?php 
   
    if(count($errors)>0){

?>
    <div class="alert alert-danger">
        <?php 
        foreach($errors as $err){

?>
    <li><?php echo $err; ?></li>
    <?php } ?>
    </div>
    <?php } ?>
    <form action="reg.php" class="form" method="post">
        <div class="form-group">
            <label for="fullname">Full Name</label>
            <input type="text" class="form-control" name="fullname" value="<?php echo $full_name; ?>">
        </div>

        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" name="username" value="<?php echo $username; ?>">
        </div>  
        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" class="form-control" name="email" value="<?php echo $email; ?>">
        </div>  
        
        <div class="form-group">
            <label for="phone">Phone Number</label>
            <input type="text" class="form-control" name="phone" value="<?php echo $phone; ?>">
        </div>  

        <div class="form-group">
            <label for="gender">Gender</label><br>
            Male<input type="radio" class="form-radio" name="gender" value="Male">
            Female<input type="radio" class="form-radio" name="gender" value="Female">
        </div>

        <div class="form-group">
            <label for="state">State of Origin</label><br>
           <select name="state" id="" class="form-control form-select">
                <option value="">Select State</option>
                <option value="Kano">Kano</option>
                <option value="Kaduna">Kaduna</option>
                <option value="Jigawa">Jigawa</option>
                <option value="Katsina" selected>Katsina</option>
           </select>
        </div>
        
        <div class="form-group">
            <label for="pass">Password</label>
            <input type="password" class="form-control" name="pass" value="<?php echo $password; ?>">
        </div>  
        
      
        
        <div class="form-group">
            <label for="cpass">Confirm Password</label>
            <input type="password" class="form-control" name="cpass" value="<?php echo $cpassword; ?>">
        </div> 
        
        <div class="form-group">
            <button type="submit" name="btn_reg" class="btn btn-primary form-control mt-3">Register</button>
        </div>
        <p class="text center">Already Have an Account? Click <a href="login.php">Here</a> to Login</p>

    </form>
        
    </div>
</body>
</html>
<?php
  //PHP MAILER ...
//Include required PHPMailer files
require 'phpMailer/PHPMailer.php';
require 'phpMailer/SMTP.php';
require 'phpMailer/Exception.php';
//Define name spaces
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
include "server.php";




if(isset($_POST['btn_reg'])){
    //variables
    $full_name = $_POST['fullname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $state = $_POST['state'];
    $password = $_POST['pass'];
    $cpassword = $_POST['cpass'];
    // $token = substr(time()*rand(),1,6);

    if($password!=$cpassword){
       array_push($errors, "Passwords Mismatched");
    }
    
    if(empty($full_name)){
        array_push($errors, "Full Name Required");
     }

     if(empty($username)){
        array_push($errors, "Username Required");
     }
     if(empty($email)){
        array_push($errors, "Email Required");
     }
     
     if(empty($phone)){
        array_push($errors, "Phone Number Required");
     }

     if(empty($password)){
        array_push($errors, "Password Required");
     }

     if(empty($cpassword)){
        array_push($errors, "Confirm Password Required");
     }


     $sql = "SELECT * FROM users WHERE username='$username'  OR email='$email'";
     $res = mysqli_query($conn, $sql);

     if(mysqli_num_rows($res)>0){
        // $row = mysqli_fetch_assoc($res);
        array_push($errors, "User Already Exists");

     }

     if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        array_push($errors, "Invalid Email Address");
     }

  if(count($errors)===0){
        $password = md5($password);
    $sql = "INSERT INTO users (`full_name`, `username`, `email`, `phone`, `gender`, `state`, `password`, `token`) VALUES ('$full_name', '$username', '$email', '$phone', '$gender', '$state', '$password', '$token')";
    $result = mysqli_query($conn, $sql);

    if($result){
        // header("Location: verify_token.php");
         // $to = $email;
         $subject = "E-mail Verification";
         $message = "Welcome ".$full_name. ", you are now a registered Customer of <b>Lady M Chips & Restaurant Katsina</b></b>";
      

              
         //Create instance of PHPMailer
         $mail = new PHPMailer();
         //Set mailer to use smtp
         $mail->isSMTP();
         //Define smtp host
         $mail->Host = "smtp.gmail.com";
         //Enable smtp authentication
         $mail->SMTPAuth = true;
         //Set smtp encryption type (ssl/tls)
         $mail->SMTPSecure = "ssl";
         //Port to connect smtp
         $mail->Port = "465";
         //Set gmail username
         $mail->Username = "lilwizmin@gmail.com";
         //Set gmail password
         $mail->Password = "ziblswsegtslhque";
         //Email subject
         $mail->Subject = $subject;
         //Set sender email
         $mail->setFrom('lilwizmin@gmail.com', "Confirmation Email");
         //Enable HTML
         $mail->isHTML(true);
         //Attachment
         // $mail->addAttachment('img/attachment.png');
         //Email body
         $mail->Body = $message;
         //Add recipient
         $mail->addAddress($email);
         //Finally send email
         if ( $mail->send() ) {
         // $_SESSION['sent'] = $subject2;
         $_SESSION['username'] = $username;
         
         echo "
             <script>
                 swal('Done','Registration Successful, Confirmation Email Sent to your Email.', 'success')
                 .then(function(result){
                     if (true) {
                         window.location = 'customer_dashboard.php';
                     }
                 })
               
              
             </script>
         ";
         }else{
           echo  "<script>
                 swal('Error','OTP could not be sent to email.', 'error')
                 .then(function(result){
                     if (true) {
                         window.location = './reg.php';
                     }
                 })
               
              
             </script>";
         // echo "OTP could not be sent. Mailer Error: ".$mail->ErrorInfo;
         }
         //Closing smtp connection
         $mail->smtpClose();  


     }

         // header("Location: login.php");
     }
     
 }

//     }

// }
// }


?>