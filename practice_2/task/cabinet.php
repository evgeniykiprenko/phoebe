<?php
$loginPage = 'login.php';

session_start();
if ($_SESSION['auth'] == 1 || $_SESSION['auth'] != 'true') {
    header('Location: ' . $loginPage);
}
?>

<!doctype html>
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
</div>
</body>
</html>'

