<?php

namespace Core;

use Medoo\Medoo;
// use voku\db\DB;


class Database 
{
    // private $connection = null;

    // this function is called everytime this class is instantiated		
    // public function __construct(){

    //     parent::__construct(DBHOST, DBUSER, DBPASS, DBNAME);		
	
    // }
    // protected $db;
    // public function __construct()
    // {
    //     // $this->db =  new Medoo([
    //     //     'database_type' => 'mysql',
    //     //     'database_name' => DBNAME,
    //     //     'server' => 'localhost',
    //     //     'username' => DBUSER,
    //     //     'password' => DBPASS,
    //     //     'charset' => 'utf8',
    //     //     'collation' => 'utf8_general_ci'
    //     // ]);
    //     // return new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
    // }
    public function con()
    {
        return new Medoo([
            'database_type' => 'mysql',
            'database_name' => $_ENV["DBNAME"],
            'server' => $_ENV["DBHOST"],
            'username' => $_ENV["DBUSER"],
            'password' => $_ENV["DBPASS"],
            'charset' => 'utf8',
            'collation' => 'utf8_general_ci'
        ]);
        // return new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
    }
}
