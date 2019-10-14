<?php
session_start();
include "../../controllers/dbUtils.php";
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

    <title>Document</title>
</head>
<body>
<nav class="navbar navbar-light bg-light" style="background-color: #e3f2fd;">
    <a class="navbar-brand" href="../index.php">
        <img src="../assets/img/logo.png" width="135" height="50" alt="Phoebe">
    </a>
    <div class="text-right">
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
    </div>
</nav>
<div class="container">
    <!--    user's image-->
    <div id="fullUsersInfo">
        <div class="d-inline-block">
            <img src="../assets/img/defaultProfilePhoto.jpg" alt="Profile photo" id="usersImage">
        </div>
        <div id="usersInfo" class="d-inline-block">
            <?php
            $id = $_GET['id'];
            $sql = "SELECT first_name, last_name, email, photo FROM users WHERE id = $id;";
            $result = runQuery($sql);
            if ($result->num_rows > 0 && $row = $result->fetch_assoc()) {
                echo '
                <form>
                  <div class="form-group">
                    <label for="firstName">First name:</label>
                    <div class="col-sm-10">
                      <input type="text" readonly class="form-control" id="firstName" value="' . $row['first_name'] . '">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="lastName">Last name:</label>
                    <div class="col-sm-10">
                      <input type="text" readonly class="form-control" id="lastName" value="' . $row['last_name'] . '">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="staticEmail">Email:</label>
                    <div class="col-sm-10">
                      <input type="text" readonly class="form-control" id="staticEmail" value="' . $row['email'] . '">
                    </div>
                  </div>
                </form>';
            } else {
                echo "<p>Oops, can't get the data(</p>";
            }
            ?>
        </div>
    </div>
</div>
</body>
</html>
