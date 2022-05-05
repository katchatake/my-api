<?php

namespace App\Controllers;

use Core\Response;
use Core\Request;

class HomeController
{
  public function index()
  {
    //return view('home');
    // $query = new UsersModel();
    // $data = $query->getUsers();
    $array = [1, 2, 3, 4, 5, 6, 7, 8, 9];
    $res = new Response();
    $res->sendJson($array);
    // $response->send();
    // return json($id);
    // var_dump($array);
  }
  public function dump()
  {
    $res = new Response();
    $request = new Request();
    // $db = new UsersModel();
    // $res->sendJson([$db->getUsers(),$request->getPost('number')]);
    // var_dump($array);
  }

}
