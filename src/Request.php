<?php

namespace Core;

use Core\Log;

class Request
{
    protected $url;
    protected $method;
    protected $data;
    protected $params;
    protected $controller;
    protected $clase;
    protected $args;
    protected $midelware;

    // public function __construct()
    // {
        
    // }
    public function getBody(){
        return $_GET;
    }
    public function getPost($name){
        $data = (empty($_POST)) ? json_decode(file_get_contents('php://input'), true) : $_POST;
        $log = new Log(__CLASS__);
        $log->setValues($data);
        // $log->setValues($data[$name]);
        $valid = (!empty($data[$name])) ? $data[$name] : "Doesn't existe this valu";
        return $valid;
    }
}
