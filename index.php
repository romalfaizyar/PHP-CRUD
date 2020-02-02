<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>PHP CRUD</title>
        <link rel="stylesheet" href="assets/css/bootstrap.min.css"/>

    </head>
    <body>
        <?php require_once 'process.php'; ?>
        <div class="container">
            <?php if (isset($_SESSION['message'])) : ?>
            <div class="alert alert-<?=$_SESSION['msg_type']?>">
                <?php 
                    echo $_SESSION['message'];
                    unset($_SESSION['message']);
                ?>
            </div>
            <?php endif ?>
            
            <?php 

                $mysqli = new mysqli('localhost', 'php_crud_user', 'mypass123', 'php_crud') or die(mysqli_error($mysqli));
                $result = $mysqli->query("SELECT * FROM data") or die($mysqli->error);

            ?>
            <div class="row justify-content-center">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Location</th>
                            <th colspan="2">Action</th>
                        </tr>
                    </thead>
                    <?php while ($row = $result->fetch_assoc()) : ?>
                        <tr>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['location']; ?></td>
                            <td>
                                <a href="index.php?edit=<?php echo $row['id']; ?>" class="btn btn-info">Edit</a>
                                <a href="process.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </table>
            </div>
            <?php
                function pre_r($array){
                    echo "<pre>";
                    print_r($array);
                    echo "</pre>";
                }
            ?>
            <div class="row justify-content-center">
                <form action="process.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" value="<?php echo $name; ?>" placeholder="Enter your name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Locationd</label>
                        <input type="text" name="location" value="<?php echo $location; ?>" placeholder="Enter your location" class="form-control">
                    </div>
                    <div class="form-group">
                        <?php if ($update == true) : ?>
                                <button type="submit" name="update" class="btn btn-info">Update</button>
                                <button type="submit" name="cancel" class="btn btn-link">Cancel</button>
                        <?php else : ?>                        
                                <button type="submit" name="save" class="btn btn-primary">Save</button>
                        <?php endif ?>   
                    </div>
                </form>
            </div>
        </div>

        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery-3.4.1.min.js"></script>
    </body>
</html>
