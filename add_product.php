
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    <title>Lady M ::: Add Product</title>
    <style>
        .container{
            width: 25%;
            margin-top: 50px;
        }
    </style>
</head>
<body>
    <?php include "navbar1.php"; ?>
<?php include "./process.php"; ?>
    <div class="container">
        <?php if($update==true): ?>
        <h2 class="text-center">Update Product</h2>
        <?php else: ?>
        <h2 class="text-center">Add Product</h2>
        <?php endif; ?>

        <form action="process.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="hid" value="<?php echo $row['id']; ?>">
            <div class="form-group">
                <label for="Product">Product Name</label>
                <input type="text" class="form-control" name="product" value="<?php echo $product_name; ?>">
            </div>
             <div class="form-group">

                <label for="category">Category</label>
                <!-- <input type="text" class="form-control" name="cat"> -->
                <select name="cat" id="" class="form-select" >
                    <?php if ($update==true): ?>
                        <option value="<?php echo $category; ?>"><?php echo $category; ?></option>
                        <?php else: ?>
                    <option value="">Select Category</option>
                    <?php endif; ?>
                    <?php
                    include "server.php";
                    $product_name = "";


                    $sql = "SELECT * FROM category ORDER BY id DESC";
                    $res = mysqli_query($conn, $sql);

                    if(mysqli_num_rows($res)>0){
                        while($row = mysqli_fetch_assoc($res)){?>
                            <option value="<?php echo $row['category']; ?>"><?php echo $row['category']; ?></option>
                       <?php }
                    }

                    ?>
                    
                </select>
            </div>
             <div class="form-group">
                <label for="qty">Quantity(optional)</label>
                <input type="text" class="form-control" name="qty" value="<?php echo $qty; ?>">
            </div>
             <div class="form-group">
                <label for="Price">Price</label>
                <input type="text" class="form-control" name="price" value="<?php echo $price; ?>">
            </div> 
             <div class="form-group">
                <label for="image">Upload Image</label>
              
                <input type="file" class="form-control" name="image" >
               
            </div>

            <div class="form-group">
                <label for="description">Product Description</label>
                <textarea name="description" id="" cols="30" rows="5" class="form-control" value="<?php echo $description; ?>">

                </textarea>
            </div>
            <?php if($update==true): ?>
            <button class="btn btn-primary form-control mt-3" name="update_product_btn" >Update</button>
            <p class="text-center"><a href="manage_product.php">Back to Manage Product </a></p>
            <?php else: ?>
            <button class="btn btn-warning form-control mt-3" name="add_product_btn" >Add</button>
            <?php endif; ?>
        </form>

    </div>
</body>
</html>