<?php
$loginPage = 'login.php';
$cabinetPage = 'cabinet.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_destroy();
    header('Location: '.$loginPage);
} else {
    header('Location: '.$cabinetPage);
}