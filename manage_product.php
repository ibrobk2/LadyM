<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Manage Product</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
<style>
    .las{
        font-size: 22px;
    }
</style>
</head>
<body>
  <h2><a href="./admin_dashboard.php">Back to Admin Dashboard</a></h2>
  <div class="container">
        <h2 class="text-center">Manage Product</h2>
        <table class="table table-striped table-hover">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Product Name</th>
      <th scope="col">Category</th>
      <th scope="col">Quantity</th>
      <th scope="col">Price</th>
      <th scope="col">Total Price</th>
      <th scope="col">Added Date</th>
      <th scope="col" colspan="2">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
    include "server.php";
    $sn = 1;
    $sql = "SELECT * FROM product";
    $result = mysqli_query($conn, $sql);

    while($row=mysqli_fetch_assoc($result)){
    ?>
    <tr>
      <th scope="row"><?= $sn++; ?></th>
      <td><?= $row['product_name']; ?></td>
      <td><?= $row['category']; ?></td>
      <td><?= $row['quantity']; ?></td>
      <td><?= $row['price']; ?></td>
      <td><?= $row['quantity']*$row['price']; ?></td>
      <td><?= substr($row['created_on'],0,10); ?></td>
      <td><a href="add_product.php?edit=<?= $row['id']; ?>" class="btn btn-success"><i class="las la-edit"></i>Edit</a> </td>
      <td><a href="delete_product.php?delete=<?= $row['id']; ?>" class="btn btn-danger"><i class="las la-trash-alt"></i>Delete</a> </td>
    </tr>
    <?php } ?>
  
  </tbody>
</table>
  </div>
</body>
</html>