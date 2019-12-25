<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once './app/Database/Database.php';

class Users
{
    private static $getAllSql = "SELECT users.id, users.first_name, users.last_name, users.email, users.role_id FROM users;";
    private static $getByIdSql = "SELECT users.id, users.first_name, users.last_name, users.email, users.role_id FROM users WHERE id = %d;";
    private static $createNewSql = "INSERT INTO users (first_name, last_name, email, password) VALUES ('%s', '%s', '%s', '%s');";
    

    public static function getAll()
    {
        $result = Database::runQuery(self::$getAllSql);
        return mysqli_num_rows($result) == 0 ? null : $result;
    }

    public static function getById($id)
    {
        $result = Database::runQuery(sprintf(self::$getByIdSql, $id));
        return mysqli_num_rows($result) == 0 ? null : $result;
    }

    public static function save($firstName, $lastName, $email, $password)
    {
        Database::runQuery(sprintf(self::$createNewSql, $firstName, $lastName, $email, $password));
        $getId = "SELECT id FROM users WHERE email = '$email';";
        $result = Database::runQuery($getId);
        if ($result->num_rows > 0 && $row = $result->fetch_assoc()) {
            return $row['id'];
        }
        return null;
    }
}
