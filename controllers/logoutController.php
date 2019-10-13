<?php
$mainPage = '../public/index.php';
session_start();
session_destroy();
header('Location: ' . $mainPage);

