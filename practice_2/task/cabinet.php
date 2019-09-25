<?php
$loginPage = 'login.php';

session_start();
if (!isset($_SESSION['auth']) || $_SESSION['auth'] != true) {
    header('Location: ' . $loginPage);
} else {
    echo '<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
</head>
<body>
<div class="container">
    <h3>Logged in!</h3>
    <form action="logout.php" method="post">
        <button type="submit">Logout</button>
    </form>
</div>
</body>
</html>';
}

?>

