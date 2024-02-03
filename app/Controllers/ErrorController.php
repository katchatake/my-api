<?php

namespace App\Controllers;

use Core\Response;

class ErrorController
{
  public function index()
  {
    $res = new Response();
    $res->sendJson(["error"]);
  }
}
