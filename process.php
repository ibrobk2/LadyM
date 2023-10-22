<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <script src="static/sweetalert2/dist/sweetalert2.all.js"></script>
</head>
<body>
    

<?php
//DB CONNECTION
include "server.php";


//ADD CATEGORY SECTION
if(isset($_GET['add_cat_btn'])){
    $category = $_GET['cat'];

    $sql = "INSERT INTO category VALUES (null, '$category')";
    $result = mysqli_query($conn, $sql);

    if($result){
        echo "<script>
        swal.fire('Done', 'Category Added Successfully', 'success').then((result)=>{if(result){window.location='add_product.php'}})
        </script>";
    }
}

//ADD PRODUCT SECTION
if(isset($_POST['add_product_btn'])){
    $product = $_POST['product'];
    $category = $_POST['cat'];
    $qty = $_POST['qty'];
    $price = $_POST['price'];
    $img = $_FILES['image'];
    $description = $_POST['description'];

    $image_name = $img['name'];
    $image_type = $img['type'];
    $image_size = $img['size'];
    $image_tmp = $img['tmp_name'];

    $sql = "INSERT INTO product (`product_name`, `category`, `quantity`, `price`, `image_url`, `description`) VALUES ('$product', '$category', $qty, $price, '$image_name', '$description')";
    $result = mysqli_query($conn, $sql);

    if($result){
        move_uploaded_file($image_tmp, 'uploads/'.$image_name);
        // header("Location: manage_product.php");
        echo "<script>
        swal.fire('Done', '{$image_name} Added Successfully', 'success').then((result)=>{if(result){window.location='manage_product.php'}})
        </script>";
    
    }else{
        echo "<script>
        swal.fire('Error', 'Something Went Wrong', 'error').then((result)=>{if(result){window.location='add_product.php'}})
        </script>";
    }
    
}



//EDIT SECTION
$product_name =  "";
$category =  "";
$qty =  "";
$price =  "";
$product_image =  "";
$update = false;


// WHEN EDIT BTN CLICKED
if(isset($_GET['edit'])){
    $update = true;
    $id = $_GET['edit'];

    $sql = "SELECT * FROM product WHERE id=$id";
    $result = mysqli_query($conn, $sql);

    $row = mysqli_fetch_assoc($result);
    $product_name =  $row['product_name'];
    $category =  $row['category'];
    $qty =  $row['quantity'];
    $price =  $row['price'];
   $product_image =  $row['image_url'];
}

//UPDATE SECTION WHEN UPDATE BTN CLICKED
//ADD PRODUCT SECTION
if(isset($_POST['update_product_btn'])){
    $id = $_POST['hid'];
    $product = $_POST['product'];
    $category = $_POST['cat'];
    $qty = $_POST['qty'];
    $price = $_POST['price'];
    $img = $_FILES['image'];

    $image_name = $img['name'];
    $image_type = $img['type'];
    $image_size = $img['size'];
    $image_tmp = $img['tmp_name'];

    $sql = "UPDATE product SET product_name='$product', category='$category', quantity='$qty', price='$price', image_url='$image_name' WHERE id=$id";
    $result = mysqli_query($conn, $sql);

    if($result){
        header("Location: manage_product.php");
    }

}

?>

</body>
</html>