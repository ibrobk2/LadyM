
<!DOCTYPE html>
<html>
<head>
    <title>Lady M Chips and Restaurant</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link rel="stylesheet" type="text/css" href="style.css"> -->
    <link rel="stylesheet" type="text/css" href="index.css">
    <!-- Optional Bootstrap styling -->
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<?php include "header1.php"; ?>
    <header>
        <h1 class="text-center">Lady M Chips and Restaurant Services</h1>
        <!-- <nav>
            <ul>
                <li><a href="#">Clothes</a></li>
                <li><a href="#">Sunglasses</a></li>
                <li><a href="#">Wrist Watches</a></li>
                <li><a href="#">Shoes</a></li>
            </ul>
        </nav> -->
    </header>

    <div class="carousel">
        <img class="carousel-img" src="https://th.bing.com/th/id/R.d85b02aa6fe16fb653a4644d83a761b9?rik=uTjVuEJJnU%2f43w&pid=ImgRaw&r=0">
        <div class="carousel-text">
            <h2 style="margin-top: 120px; box-shadow: 1px 2px 1px 5px black; padding:5px;border-radius: 4px;" class="text-success">Welcome to Lady M Restaurant</h2>
            <p>Book Your Favourite Dishes or Table at Affordable Prices.</p>
            <a href="#" class="btn">Shop Now</a>
        </div>
    </div>

    <main>
        <h2>Available Foods:</h2>
        <br>

        <div class="product-grid" id="menu">
            <?php
                // Connect to database
                include "server.php";
                // $conn = mysqli_connect("localhost", "root", "", "my");

                // Check connection
                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }

                // Query for new arrivals
                $sql = "SELECT * FROM product";
                $result = mysqli_query($conn, $sql);

                // Loop through results and display each product
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<div class="product">';
                    echo '<img src="uploads/' . $row['image_url'] . '" id="imgs">';
                    echo '<h3>' . $row['product_name'] . '</h3>';
                    echo '<p>'.$row['description'] .'</p>';
                    echo '<p class="price">&#8358;' . $row['price'] . '</p>';
                    echo '<a href="order.php?product='.$row["product_name"].'&price=&#8358;'.number_format($row['price']) .'" class="btn btn-secondary">Order</a>';
                    echo '</div>';
                }

                // Close database connection
                mysqli_close($conn);
            ?>
        </div>
    </main>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> Lady M Chips & Restaurant. All rights reserved.</p>
    </footer>

    <!-- Optional Bootstrap JavaScript -->
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->

    <!-- Carousel slider JavaScript -->
    <script>
        var carouselImg = document.querySelector('.carousel-img');
        var carouselText = document.querySelector('.carousel-text');

        carouselImg.addEventListener('mouseenter', function() {
            carouselText.classList.add('animate__animated', 'animate__bounceInUp');
        });

        carouselImg.addEventListener('mouseleave', function() {
            carouselText.classList.remove('animate__animated', 'animate__bounceInUp');
        });
    </script>
</body>
</html>
