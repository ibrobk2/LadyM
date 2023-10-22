<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    <title>Add Category</title>
    <style>
        .container{
            width: 25%;
            margin-top: 50px;

        }
    </style>
</head>
<body>
    <?php include "navbar1.php"; ?>
    <div class="container">
        <h2 class="text-center">Add Category</h2>

        <form action="process.php" method="get">
            <label for="category">Category</label>
            <input type="text" class="form-control" name="cat">
            <button class="btn btn-warning form-control mt-3" name="add_cat_btn">Add</button>
        </form>

    </div>
</body>
</html>