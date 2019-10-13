<?php
session_start();

$mainPage = "../index.php";
if (!isset($_SESSION['email'])) {
    header("Location: " . $mainPage);
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
    <title>Document</title>
</head>
<body>
<nav class="navbar navbar-light bg-light" style="background-color: #e3f2fd;">
    <a class="navbar-brand" href="index.php">
        <img src="assets/img/logo.png" width="135" height="50" alt="Phoebe">
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

</div>
</body>
</html>
