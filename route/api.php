<?php

require_once './app/Controllers/UserController.php';
require_once './app/Controllers/RoleController.php';

class Route
{

    protected $method = ''; //GET|POST|PUT|DELETE

    public $requestUri = [];
    public $requestParams = [];

    public function __construct()
    {
        header("Access-Control-Allow-Orgin: *");
        header("Access-Control-Allow-Methods: *");
        header("Content-Type: application/json");

        //Массив GET параметров разделенных слешем
        $this->requestUri = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
        $this->requestParams = $_REQUEST;

        //Определение метода запроса
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
        //Первые 2 элемента массива URI должны быть "api" и название таблицы
        if (array_shift($this->requestUri) !== 'api') {
            throw new RuntimeException('API Not Found', 403);
        }

        $request = array_shift($this->requestUri);
        switch ($request) {
            case 'users':
                $controller = new UserController($this->method, $this->requestParams);
                break;
            case 'roles':
                //   $controller = new RoleController($this->method,$this->requestParams);
                break;
            default:
                echo 'There is no API mapped on domain/api. The full list of supported URLs you can see bellow:';
        }

        //Если метод(действие) определен в дочернем классе API
        if (method_exists($controller, $controller->getAction($this->requestUri))) {
            return $controller->{$controller->getAction($this->requestUri)}();
        } else {
            throw new RuntimeException('Invalid Method', 405);
        }
    }
}
