<?php
namespace app\Controllers;

abstract class AbstractController
{
    public $apiName = '';

    protected $method = '';
    public $requestParams = [];
    public $action = '';
    public $requestUri ='';

    public function __construct($method, $requestParams, $requestUri)
    {
        $this->method = $method;
        $this->requestParams = $requestParams;
        $this->requestUri = $requestUri;
    }

    public function getAction($params = '')
    {
        $method = $this->method;
        switch ($method) {
            case 'GET':
                if ($params) {
                    return 'view';
                } else {
                    return 'index';
                }
                break;
            case 'POST':
                return 'create';
                break;
            case 'PUT':
                return 'update';
                break;
            case 'DELETE':
                return 'delete';
                break;
            default:
                return null;
        }
    }

    protected function response($data, $status = 500)
    {
        header("HTTP/1.1 " . $status . " " . $this->requestStatus($status));
        return json_encode($data);
    }

    private function requestStatus($code)
    {
        $status = array(
            200 => 'OK',
            404 => 'Not Found',
            405 => 'Method Not Allowed',
            500 => 'Internal Server Error',
        );
        return ($status[$code]) ? $status[$code] : $status[500];
    }
    abstract protected function index();
    abstract protected function view();
    abstract protected function create();
    abstract protected function update();
    abstract protected function delete();
}
