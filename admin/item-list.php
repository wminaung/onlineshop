<?php
include('./config/config.php');
include './config/auth.php';

$sql = "SELECT items.*, categories.name FROM items LEFT JOIN categories ON items.category_id=categories.id ORDER BY items.reached_date DESC";

$result  = mysqli_query($conn, $sql);;





//list-group list
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Item List</title>
    <!-- CSS only -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="./css/style.css" rel="stylesheet" />
</head>

<body>
    <h1>Item List</h1>
    <div class="myContainer bg-danger">
        <a class="btn btn-danger " href="./item-list.php" role="button"> Manage Items </a>
        <a class="btn btn-danger " href="./cat-list.php" role="button">
            Manage Categories
        </a>
        <a class="btn btn-danger " href="#" role="button">Manage Orders</a>
        <a class="btn btn-danger " href="./logout.php" role="button">Logout</a>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-1"></div>
            <div class="col-10">
                <ul class="list-group list">
                    <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                        <li>
                            <img style="float: right" src="./images/<?php echo $row['photo'] ?>" alt="Img" width="100px" />
                            <b><?php echo $row['title']; ?></b>
                            <i><?php echo $row['brand']; ?></i>
                            <small>(in
                                <?php echo $row['name']; ?>)</small>
                            <span>$<?php echo $row['price']; ?></span>
                            <div>
                                <?php echo $row['review']; ?>
                            </div>
                            [<a href="./item-del.php?id=<?php echo $row['id']; ?>" class="del" onclick="return confirm('Are you sure?')">del</a>] [<a href="./item-edit.php?id=<?php echo $row['id']; ?>" class="edit">edit</a>]
                        </li>
                    <?php
                    };
                    ?>
                </ul>
            </div>

            <div class="col-1"></div>
            <a href="./item-new.php" class="new">New Item</a>
        </div>
    </div>
</body>

</html>