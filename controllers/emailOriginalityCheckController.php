<?php

include "utils/dbUtils.php";

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    
    $sql = "SELECT id FROM users WHERE email = '" . $email . "';";

    if (runQuery($sql)->num_rows == 0) {
        echo 'true';    
    } else {
        echo 'false';
    }
}