<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="static/sweetalert/dist/sweetalert.min.js"></script>

    <title>Login Page</title>
    <style>
        .container{
            margin-top: 60px;
            width: 25%;
        }
    </style>
</head>
<body>
    <?php include "navbar3.php"; ?>
    <div class="container">
    <h2 class="text-center text-primary">User Login</h2>
    <form action="login.php" class="form" method="post">
        

        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" name="username">
        </div>  

       

       
        
        <div class="form-group">
            <label for="pass">Password</label>
            <input type="password" class="form-control" name="pass">
        </div>  
        
      
    
        
        <div class="form-group">
            <button type="submit" name="btn_login" class="btn btn-primary form-control mt-3">Login</button>
        </div>

        <p class="text center">Don't Have an Account? Click <a href="reg.php">Here</a> to Register</p>
        
    </form>
        
    </div>
</body>
</html>
<?php
session_start();

if(isset($_SESSION['username'])){
    header("Location: customer_dashboard.php");
}
include "server.php";

if(isset($_POST['btn_login'])){
    $username = $_POST['username'];
    $pass = md5($_POST['pass']);

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$pass' LIMIT 1";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result)==1){
       // session_start();
        $_SESSION['username'] = $username;
        // header("location: dashboard.php?login=success");
        if($username=='admin'){
            $location = 'admin_dashboard.php';
        }else{
            $location = 'customer_dashboard.php';
        }
        echo "
        <script>
            swal('Done','Login Successful...', 'success')
            .then(function(result){
                if (true) {
                    window.location = '{$location}';
                }
            })
          
         
        </script>
    ";
    }else{
        echo "
        <script>
            swal('Error','Invalid Username or Password.', 'info')
            .then(function(result){
                if (true) {
                    window.location = 'login.php';
                }
            })
          
         
        </script>
    ";

}

}

?>