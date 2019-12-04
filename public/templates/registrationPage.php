<?php
session_start();

$mainPage = "/phoebe/index.php";
if(isset($_SESSION['email'])) {
    header("Location: " . $mainPage);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
            crossorigin="anonymous"></script>
    <title>Registration</title>
</head>
<body>

<nav class="navbar navbar-light bg-light">
    <a class="navbar-brand" href="/phoebe/public/index.php">
        <img src="/phoebe/public/assets/img/logo.png" width="135" height="50" alt="Phoebe">
    </a>
</nav>

<div class="container">
    <div>
        <form action="/phoebe/controllers/registrationController.php" method="post">
            <div class="form-group">
                <label for="firstName">First name:</label>
                <input type="text" class="form-control" id="firstName" name="firstName" required>
            </div>
            <div class="form-group">
                <label for="lastName">Last name:</label>
                <input type="text" class="form-control" id="lastName" name="lastName" required>
            </div>
            <div class="form-group">
                <label for="email">Email address:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="pwd">Password:</label>
                <input type="password" class="form-control" id="pwd" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <div class="text-right">
        <span>
            <a href="/phoebe/public/index.php">Back to main page</a>
        </span>
    </div>
</div>
</body>
</html>