<?php
$mainPage = '/phoebe/public/index.php';
session_start();

session_unset();
session_destroy();
header('Location: ' . $mainPage);

