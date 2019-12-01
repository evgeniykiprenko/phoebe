<?php

 include "utils/dbUtils.php";

session_start();

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    $sql = "SELECT users.id, users.first_name, users.last_name, users.email, users.role_id FROM users;";
    if (isset($_GET['orderByLastName'])) {
        $sql = "SELECT id, first_name, last_name, email, role_id FROM users ORDER BY last_name;";
    }

    echo json_encode(mysqli_fetch_all(runQuery($sql), MYSQLI_ASSOC));
}

