<?php
include "dbUtils.php";

session_start();


$mainPage = '../public/index.php';
$sql = 'DELETE FROM users WHERE id = ' . $_GET['id'] . ';';

if ($_SESSION['id'] == $id) {
    runQuery($sql);
    session_unset();
    session_destroy();
} elseif ($_SESSION['role'] == 'admin') {
    runQuery($sql);
}
header('Location: ' . $mainPage);

