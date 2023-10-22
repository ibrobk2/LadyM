<?php
include "server.php";
                
include "header.php";
?>

<div class="container">
<?php
// Connect to database
               
                
                // $conn = mysqli_connect("localhost", "root", "", "my");

                // Check connection
                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }

                if(isset($_GET['id'])){
                    $id = $_GET['id'];

                    // Query for new arrivals
                $sql = "SELECT * FROM product WHERE id=$id";
                $result = mysqli_query($conn, $sql);

                $row = mysqli_fetch_assoc($result);

                ?>
                <h2 class="text-center mt-5">Product Details</h2>
    <form action="" class="form row">
        <div class="col-md-6">
                <?php

                    echo '<div class="product">';
                    echo '<img src="uploads/' . $row['image_url'] . '">';
                    echo '<h3 class="text-primary">' . $row['product_name'] . '</h3>';
                    echo '<p class="price text-danger">&#8358;' . number_format($row['price']) . '</p>';
                    
                    echo '</div>';


?>
        </div>
        <div class="col-md-6">
            <?php
                    echo '<p>Description:'.$row['description'].'</p>';
                    echo '<div class="product">';
                    echo '<label for="qty">Quantity</label>';
                    echo '<input class="form-control" placeholder="Quantity" type="number" style="width:50%; margin-left:135px;" value="1">';
                    // echo '<p class="price">&#8358;' . $row['price'] . '</p>';
                    echo '<a href="view_product.php?cart='.$row["id"].'&id='.$row["id"].'" class="btn btn-secondary mt-3">Add to Cart</a>';
                    echo '<a href="paystack.php?order='.$row["id"].'&id='.$row["id"].'" class="btn btn-warning mt-3 ml-3">Order Now</a>';
                    echo '</div>';
                    
                }

                ?> 
        </div>
    </form>
</div>

<?php include "footer.php"; ?>
</body>

</html>
    