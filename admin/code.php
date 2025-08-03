<?php
session_start();
include('../include/connection.php');

// Check if admin session is set
if (!isset($_SESSION['admin'])) {
    header("Location: ../index.php");
    exit();
}

$ad = $_SESSION['admin'];

// Handling deletion
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $query = "DELETE FROM admin WHERE id='$id'";
    if (mysqli_query($connect, $query)) {
        header("Location: code.php"); // Redirect after deletion
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($connect);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
    <?php include('../include/header.php'); ?>
    <div class="container-fluid">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-2" style="margin-left:-30px">
                    <?php include('sidenav.php'); ?>
                </div>
                <div class="col-md-10">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="text-center">All Admin</h5>
                                <?php
                                $query = "SELECT * FROM admin WHERE username !='$ad'";
                                $res = mysqli_query($connect, $query);
                                $output = "
                                <table class='table table-bordered'>
                                <tr>    
                                    <th>ID</th>
                                    <th>Username</th>
                                    <th style='width:10%'>Action</th>
                                </tr>";

                                if (mysqli_num_rows($res) < 1) {
                                    $output .= "<tr><td colspan='3' class='text-center'>No New Admin</td></tr>";
                                } else {
                                    while ($row = mysqli_fetch_array($res)) {
                                        $id = htmlspecialchars($row['id']);
                                        $username = htmlspecialchars($row['username']);
                                        $output .= "<tr>
                                                    <td>$id</td>
                                                    <td>$username</td>
                                                    <td>
                                                        <a href='admin.php?id=$id' class='btn btn-danger remove'>Remove</a>
                                                    </td>
                                                </tr>";
                                    }
                                }

                                $output .= "</table>";
                                echo $output;
                                ?>
                            </div>
                            <div class="col-md-6">
                                <?php
                                if (isset($_POST['add'])) {
                                    $uname = mysqli_real_escape_string($connect, trim($_POST['uname']));
                                    $pass = mysqli_real_escape_string($connect, trim($_POST['pass']));
                                    $image = $_FILES['img']['name'];
                                    $error = array();

                                    if (empty($uname)) {
                                        $error['u'] = "Enter Admin Username";
                                    } else if (empty($pass)) {
                                        $error['u'] = "Enter Admin Password";
                                    } else if (empty($image)) {
                                        $error['u'] = "Add Admin Picture";
                                    }

                                    if (count($error) == 0) {
                                        $q = "INSERT INTO admin(username, password, profile) VALUES('$uname', '$pass', '$image')";
                                        $result = mysqli_query($connect, $q);
                                        if ($result) {
                                            move_uploaded_file($_FILES['img']['tmp_name'], "img/$image");
                                            $show = "<h5 class='text-center alert alert-success'>Admin added successfully</h5>";
                                        } else {
                                            $show = "<h5 class='text-center alert alert-danger'>Failed to add admin</h5>";
                                        }
                                    } else {
                                        $show = "<h5 class='text-center alert alert-danger'>" . $error['u'] . "</h5>";
                                    }
                                } else {
                                    $show = "";
                                }
                                ?>
                                <h5 class="text-center">Add Admin</h5>
                                <form method="post" enctype="multipart/form-data">
                                    <div>
                                        <?php echo $show; ?>
                                    </div>
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input type="text" name="uname" class="form-control" autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" name="pass" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Add Admin Picture</label>
                                        <input type="file" name="img" class="form-control">
                                    </div><br>
                                    <input type="submit" name="add" value="Add New Admin" class="btn btn-success">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
