<?php

namespace app\Controllers;

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'AbstractController.php';
require_once './app/Database/Database.php';
require_once './app/Models/Users.php';

use app\Controllers\AbstractController as AbstractController;
use app\Database\Database as Database;
use app\Models\Users as Users;

class UserController extends AbstractController
{
    public $apiName = 'users';

    /**
     * Method GET
     * http://domain/users
     * @return string
     */
    public function index()
    {
        $users = Users::getAll();
        if ($users) {
            return $this->response(json_encode(mysqli_fetch_all($users, MYSQLI_ASSOC)), 200);
        }
        return $this->response('Data not found', 404);
    }

    /**
     * Method GET
     * http://domain/users/1
     * @return string
     */
    public function view()
    {
        $id = array_shift($this->requestUri);

        if ($id) {
            $user = Users::getById($id);
            if ($user) {
                return $this->response(json_encode(mysqli_fetch_all($user, MYSQLI_ASSOC)), 200);
            }
        }
        return $this->response('Data not found', 404);
    }

    /**
     * Method POST
     * http://domain/users + user's parameter passed in body
     * @return string
     */
    public function create()
    {
        $firstName = $this->requestParams['firstName'] ?? '';
        $lastName = $this->requestParams['lastName'] ?? '';
        $email = $this->requestParams['email'] ?? '';
        $password = $this->requestParams['password'] ?? '';

        if ($firstName && $lastName && $password && $email) {
            if (!Database::checkEmailOriginality($email)) {
                return $this->response("Given email is already in use", 500);
            }

            if ($id = Users::save($firstName, $lastName, $email, $password)) {
                return $this->response(json_encode(['id' => $id]), 200);
            }
        }
        return $this->response("Saving error", 500);
    }

    /**
     * Method PUT
     * http://domain/users/1
     * @return string
     */
    public function update()
    {
        $id = (int) array_shift($this->requestUri);
        $firstName = $this->requestParams['firstName'] ?? '';
        $lastName = $this->requestParams['lastName'] ?? '';
        $email = $this->requestParams['email'] ?? '';
        $password = $this->requestParams['password'] ?? '';

        if (!$id || !Users::getById($id)) {
            return $this->response("User with id=$id not found", 404);
        }

        if ($firstName && $lastName && $password && $email) {
            if ($user = Users::update($id, $firstName, $lastName, $email, $password)) {
                return $this->response(json_encode(mysqli_fetch_all($user, MYSQLI_ASSOC)), 200);
            }
        } else {
            return $this->response("All user's fields must be present", 500);    
        }

        return $this->response("Update error", 500);
    }

    /**
     * Method DELETE
     * http://doman/users/1
     * @return string
     */
    public function delete()
    {
        $id = (int) array_shift($this->requestUri);
        if (!$id || !Users::getById($id)) {
            return $this->response("User with id=$id not found", 404);
        }
        if (Users::deleteById($id)) {
            return $this->response(json_encode(['id' => $id]), 200);
        }
        return $this->response("Delete error", 500);
    }
}
