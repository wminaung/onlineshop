<?php
include './config/auth.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category List</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <h1>Category List</h1>
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
            <div class="col-3"></div>
            <div class="col-6">

                <?php
                include('./config/config.php');
                $qry = "SELECT * FROM categories";
                $result = mysqli_query($conn, $qry);

                ?>
                <ul class="list-group list">
                    <?php
                    while ($row = mysqli_fetch_assoc($result)) {

                    ?>


                        <li>
                            [ <a href="./cat-del.php?id=<?php echo $row['id'] ?>" onclick="return confirm('Are you sure?')" class="del">
                                del
                            </a>]
                            [ <a href="./cat-edit.php?id=<?php echo $row['id'] ?>" class="edit">
                                edit
                            </a>]
                            <?php echo $row['name']; ?>
                        </li>


                    <?php
                    }
                    ?>
                </ul>

            </div>
            <div class="col-3"> <a href="./cat-new.php" class="new">New Category</a></div>
        </div>
    </div>
</body>

</html>