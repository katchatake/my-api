<?php
namespace Core;

// use Monolog\Level;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

Class Log
{
    protected $log;
    public function __construct($channel) {
        $this->log = new Logger((empty($channel)) ? 'API' : $channel);
        $this->log->pushHandler(new StreamHandler('../logs/api.log', Logger::DEBUG));
    }

    public function setValues($data){
        $this->log->warning('Warning :: ',[$data]);
    }
}