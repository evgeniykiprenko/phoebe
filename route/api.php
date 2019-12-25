<?php

require_once './app/Controllers/UserController.php';

class Route
{

    protected $method = '';

    public $requestUri = [];
    public $requestParams = [];

    public function __construct()
    {
        header("Access-Control-Allow-Orgin: *");
        header("Access-Control-Allow-Methods: *");
        header("Content-Type: application/json");

        $this->requestUri = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
        if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
            $input = file_get_contents('php://input');
            parse_str($input, $this->requestParams);
        } else {
            $this->requestParams = $_REQUEST;
        }

        $this->method = $_SERVER['REQUEST_METHOD'];
        if ($this->method == 'POST' && array_key_exists('HTTP_X_HTTP_METHOD', $_SERVER)) {
            if ($_SERVER['HTTP_X_HTTP_METHOD'] == 'DELETE') {
                $this->method = 'DELETE';
            } else if ($_SERVER['HTTP_X_HTTP_METHOD'] == 'PUT') {
                $this->method = 'PUT';
            } else {
                throw new Exception("Unexpected Header");
            }
        }
    }

    public function run()
    {
        if (array_shift($this->requestUri) !== 'api') {
            throw new RuntimeException('API Not Found', 403);
        }

        $request = array_shift($this->requestUri);
        if ($request == 'users') {
            $controller = new UserController($this->method, $this->requestParams, $this->requestUri);
        } else {
            return 'There is no API mapped on requested link. The full list of supported URLs you can see bellow:
                - GET localhost/api/users to get all users list;
                - GET localhost/api/users/13 to get specific user by id;
                - POST localhost/api/users to create new user (you need to pass firstname, lastName, email and password fields at the request body);
                - PUT localhost/api/users/15 to update specific users information. Its important to pass all the fields: firstname, lastName, email and password. And body type must be **x-www-form-urlencoded**;
                - DELETE localhost/api/users/39 to delete specific user using his ID';
        }

        if (method_exists($controller, $controller->getAction($this->requestUri))) {
            return $controller->{$controller->getAction($this->requestUri)}();
        } else {
            throw new RuntimeException('Invalid Method', 405);
        }
    }
}
