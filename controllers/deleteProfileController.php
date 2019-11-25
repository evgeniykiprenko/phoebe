<?php
include "utils/dbUtils.php";

session_start();

$id = $_GET['id'];
$mainPage = '/phoebe/public/index.php';
$sql = "DELETE FROM users WHERE id = $id;";

if ($_SESSION['id'] == $id) {
    echo $sql;
    runQuery($sql);
    session_unset();
    session_destroy();
} elseif ($_SESSION['role'] == 'admin') {
    runQuery($sql);
}

header('Location: ' . $mainPage);

