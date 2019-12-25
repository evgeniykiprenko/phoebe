<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once './app/Database/Database.php';

class Users
{
    private static $getAllSql = "SELECT users.id, users.first_name, users.last_name, users.email, users.role_id FROM users;";
    private static $getById = "SELECT users.id, users.first_name, users.last_name, users.email, users.role_id FROM users WHERE id = %d;";

    public static function getAll()
    {
        return Database::runQuery(self::$getAllSql);
    }

    public static function getById($id)
    {
        return Database::runQuery(sprintf(self::$getById, $id));
    }
}
