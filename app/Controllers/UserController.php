<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);


require_once 'AbstractController.php';
require_once './app/Database/Database.php';
require_once './app/Models/Users.php';

class UserController extends AbstractController
{
    public $apiName = 'users';

    /**
     * Метод GET
     * Вывод списка всех записей
     * http://ДОМЕН/users
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
     * Метод GET
     * Просмотр отдельной записи (по id)
     * http://ДОМЕН/users/1
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
     * Метод POST
     * Создание новой записи
     * http://ДОМЕН/users + параметры запроса name, email
     * @return string
     */
    public function create()
    {
        //$name = $this->requestParams['name'] ?? '';
        //$email = $this->requestParams['email'] ?? '';
        //if($name && $email){
        //    $db = (new Db())->getConnect();
        //    $user = new Users($db, [
        //        'name' => $name,
        //        'email' => $email
        //    ]);
        //    if($user = $user->saveNew()){
        //        return $this->response('Data saved.', 200);
        //    }
        //}
        //return $this->response("Saving error", 500);
    }

    /**
     * Метод PUT
     * Обновление отдельной записи (по ее id)
     * http://ДОМЕН/users/1 + параметры запроса name, email
     * @return string
     */
    public function update()
    {
        //$parse_url = parse_url($this->requestUri[0]);
        //$userId = $parse_url['path'] ?? null;
        //
        //$db = (new Db())->getConnect();
        //
        //if(!$userId || !Users::getById($db, $userId)){
        //    return $this->response("User with id=$userId not found", 404);
        //}
        //
        //$name = $this->requestParams['name'] ?? '';
        //$email = $this->requestParams['email'] ?? '';
        //
        //if($name && $email){
        //    if($user = Users::update($db, $userId, $name, $email)){
        //        return $this->response('Data updated.', 200);
        //    }
        //}
        //return $this->response("Update error", 400);
    }

    /**
     * Метод DELETE
     * Удаление отдельной записи (по ее id)
     * http://ДОМЕН/users/1
     * @return string
     */
    public function delete()
    {
        //$parse_url = parse_url($this->requestUri[0]);
        //$userId = $parse_url['path'] ?? null;
        //
        //$db = (new Db())->getConnect();
        //
        //if(!$userId || !Users::getById($db, $userId)){
        //    return $this->response("User with id=$userId not found", 404);
        //}
        //if(Users::deleteById($db, $userId)){
        //    return $this->response('Data deleted.', 200);
        //}
        //return $this->response("Delete error", 500);
    }
}
