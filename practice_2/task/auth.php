<?php
session_start();

$login = 'admin';
$password = '1111';
$loginPage = 'login.php';
$cabinetPage = 'cabinet.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['password'] == $password && $_POST['login'] == $login) {
    $_SESSION['auth'] = 'true';
    echo 'hello!';
    header('Location: '.$cabinetPage);
} else {
    header('Location: '.$loginPage);
}
?>