<?php
session_start();
include "../../controllers/dbUtils.php";
include "../../controllers/validationUtils.php";

$id = $_GET['id'];
$sql = "SELECT first_name, last_name, email, password, photo FROM users WHERE id = $id;";
$result = runQuery($sql);
$show = false;
$row = null;
$linkToPhoto = null;
if ($result->num_rows > 0 && $row = $result->fetch_assoc()) {
    $show = true;
    $linkToPhoto = !empty($row['photo']) ? '../images/' . $row['photo'] : "../assets/img/defaultProfilePhoto.jpg";
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="../assets/css/main.css">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <title>Document</title>
</head>
<body>
<nav class="navbar navbar-light bg-light" style="background-color: #e3f2fd;">
    <a class="navbar-brand" href="../index.php">
        <img src="../assets/img/logo.png" width="135" height="50" alt="Phoebe">
    </a>
    <?php
    if (empty($_SESSION['email'])) {
        echo '<div class="text-right">
                <span>
                    <button type="button" class="btn btn-success nav-button" data-toggle="modal" data-target="#myModal">
                        Sign in
                    </button>
                </span>
                <span>
                    <button type="button" class="btn btn-info nav-button">
                        <a href="registrationPage.php" class="text-white">Sign up</a>
                    </button>
                </span>
            </div>';
    } else {
        echo '<div class="text-right">
        <span>
            <button type="button" class="btn btn-info nav-button">
                <a href="../index.php" class="text-white">Main page</a>
            </button>
        </span>
        <span>
            <button type="button" class="btn btn-danger logout-button">
                <a href="../../controllers/logoutController.php" class="text-white">Logout</a>
            </button>
        </span>
    </div>';
    }
    ?>
</nav>

<!-- The Modal -->
<div class="modal" id="myModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Sign in</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form action="../../controllers/authController.php" method="post">
                    <div class="form-group">
                        <label for="email">Email address:</label>
                        <input type="email" class="form-control" id="email" name="email">
                    </div>
                    <div class="form-group">
                        <label for="pwd">Password:</label>
                        <input type="password" class="form-control" id="pwd" name="password">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <?php
    if ($_SESSION['id'] == $id || $_SESSION['role'] == 'admin') {
        if ($show) {
            echo '<div class="row mx-md-n5">
        <div class="col px-md-5">
            <div>
                <img src="' . $linkToPhoto . '" alt="Profile photo" id="usersImage">
            </div>
            <form action="../../controllers/uploadController.php?id=' . $id . '" method="post" enctype="multipart/form-data">
                Select image to upload:
                <input type="file" name="fileToUpload" id="fileToUpload">
                <input type="submit" value="Upload Image" name="submit">
            </form>
        </div>
        <div class="col px-md-5">
                <form action="../../controllers/updateProfileController.php" method="post">
                  <input type="text" class="form-control form-control-lg" id="id" value="' . $id . '" name="id" style="display: none">
                  <div class="form-group row">
                    <label for="firstName" class="col col-form-label col-form-label-lg">First name:</label>
                      <input type="text" class="form-control form-control-lg" id="firstName" value="' . $row['first_name'] . '" name="firstName">
                  </div>
                  <div class="form-group row">
                    <label for="lastName" class="col col-form-label col-form-label-lg">Last name:</label>
                      <input type="text" class="form-control form-control-lg" id="lastName" value="' . $row['last_name'] . '" name="lastName">
                  </div>
                  <div class="form-group row">
                    <label for="staticEmail" class="col col-form-label col-form-label-lg">Email:</label>
                      <input type="text" class="form-control form-control-lg" id="staticEmail" value="' . $row['email'] . '" name="email">
                  </div>
                  <div class="form-group row">
                    <label for="staticPassword" class="col col-form-label col-form-label-lg">Password:</label>
                      <input type="password" class="form-control form-control-lg" id="staticPassword" value="' . $row['password'] . '" name="password">
                  </div>
                  <div class="row">
                      <div class="col">
                        <div class="d-flex justify-content-start">
                            <button type="submit" class="btn btn-success btn-block">Update</button>  
                        </div>
                      </div>
                      <div class="col">
                        <div class="d-flex justify-content-end">
                            <button type="" class="btn btn-danger btn-block">
                                <a href="../../controllers/deleteProfileController.php?id=' . $id . '" class="text-white">Delete</a>
                            </button>   
                        <div>
                      </div>
                   </div>
                  
                </form>';
        } else {
            echo "<div><p>Oops, can't get the data:(</p><a href='../index.php'>Main page</a></div>";
        }
        echo '</div>
    </div>';
    } else {
        if ($show) {
            echo '<div class="row mx-md-n5">
        <div class="col px-md-5">
            <div>
                <img src="' . $linkToPhoto . '" alt="Profile photo" id="usersImage">
            </div>
        </div>
                <div class="col px-md-5">
                <form>
                  <div class="form-group row">
                    <label for="firstName" class="col col-form-label col-form-label-lg">First name:</label>
                      <input type="text" readonly class="form-control form-control-lg" id="firstName" value="' . $row['first_name'] . '">
                  </div>
                  <div class="form-group row">
                    <label for="lastName" class="col col-form-label col-form-label-lg">Last name:</label>
                      <input type="text" readonly  class="form-control form-control-lg" id="lastName" value="' . $row['last_name'] . '">
                  </div>
                  <div class="form-group row">
                    <label for="staticEmail" class="col col-form-label col-form-label-lg">Email:</label>
                      <input type="text" readonly class="form-control form-control-lg" id="staticEmail" value="' . $row['email'] . '">
                  </div>
                </form>';
        } else {
            echo "<div><p>Oops, can't get the data:(</p><a href='../index.php'>Main page</a></div>";;
        }
        echo '</div>
    </div>';
    }
    ?>

</div>
</body>
</html>
