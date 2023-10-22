<?php 


if(isset($_GET['message'])){
    echo $_GET['message'];
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>verify Token</title>
    <script src="static/sweetalert/dist/sweetalert.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
<style>
    .container{
        width: 25%;
        margin-top: 120px;
    }
</style>
</head>
<body>
    <?php include "verify.php"; ?>
    <div class="container">
        <h2 class="text-center text-success">Verify Email</h2>
        <form action="verify_token.php" method="get">
            <div class="form-group">
                <label for="token">Enter Token</label>
                <input type="text" class="form-control" placeholder="e.g 234556" name="token">
                <button name="btn_verify" class="btn btn-success form-control mt-3">Verify Email</button>
            </div>
        </form>
    </div>
</body>
</html>