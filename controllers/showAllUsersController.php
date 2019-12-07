<?php

include "utils/dbUtils.php";

session_start();

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    $sql = "SELECT users.id, users.first_name, users.last_name, users.email, users.role_id FROM users;";
    if (isset($_GET['sortByFirstName'])) {
        $sql = "SELECT id, first_name, last_name, email, role_id FROM users ORDER BY first_name;";
    } else if (isset($_GET['sortByLastName'])) {
        $sql = "SELECT id, first_name, last_name, email, role_id FROM users ORDER BY last_name;";
    } else if (isset($_GET['sortByEmail'])) {
        $sql = "SELECT id, first_name, last_name, email, role_id FROM users ORDER BY email;";
    } else if (isset($_GET['sortByRole'])) {
        $sql = "SELECT id, first_name, last_name, email, role_id FROM users ORDER BY role_id;";
    } else if (isset($_GET['sortById'])) {
        $sql = "SELECT id, first_name, last_name, email, role_id FROM users ORDER BY id;";
    }

    echo json_encode(mysqli_fetch_all(runQuery($sql), MYSQLI_ASSOC));
}

