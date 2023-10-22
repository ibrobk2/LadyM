<?php
include "header.php";



?>
    <div class="carousel">
        <img class="carousel-img" src="img/slide1.jpg">
        <div class="carousel-text">
            <h2 style="margin-top: 120px; box-shadow: 1px 2px 1px 5px black; padding:5px;border-radius: 4px;" class="text-success">Welcome to ProxyMart</h2>
            <p>Shop our latest collections of Computers, Spare Parts, Softwares, and Accessories.</p>
            <a href="#" class="btn">Shop Now</a>
            <br><br><br>
        </div>
        <br><br><br><br>
    </div>

    <main>
        <h2>Products</h2>

        <div class="product-grid">
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
                    echo '<img src="uploads/' . $row['image_url'] . '">';
                    echo '<h3 class="text-primary">' . $row['product_name'] . '</h3>';
                    echo '<p class="price text-danger">&#8358;' . number_format($row['price']) . '</p>';
                    echo '<a href="view_product.php?id='.$row['id'].'" class="btn btn-secondary">View</a>';
                    echo '</div>';
                }

                // Close database connection
                mysqli_close($conn);
            ?>
        </div>
    </main>


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

<?php include "footer.php"; ?>
</body>
</html>
