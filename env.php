<?php

use Dotenv\Dotenv;

require_once('vendor/autoload.php');

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();
?>
