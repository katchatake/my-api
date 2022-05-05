<?php

namespace Core;

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
        return $_POST[$name];
    }
}
