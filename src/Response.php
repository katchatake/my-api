<?php

namespace Core;

class Response
{
  protected $view; //array, json, pdf..
  protected $type;
  protected $data;

  // public function __construct($view, $type, $data = [])
  // {
  //   $this->view = $view; //home, contact
  //   $this->data = $data;
  //   $this->type = $type;
  // }

  public function getView()
  {
    return $this->view;
  }

  public function getType()
  {
    return $this->type;
  }
  public function getData()
  {
    return $this->data;
  }
  public function sendJson($data)
  {
    header('Content-Type: application/json;charset=utf-8');
    echo json_encode($data);
  }

//   public function send()
//   {
//     $view = $this->getView();
//     $type = $this->getType();
//     $data = $this->getData();
//     switch ($type) {
//       case 'html':
//         $content = file_get_contents(viewPath($view));
//         require viewPath('layout');
//         break;
//       case 'json':
//         viewJSON($data);
//         break;
//       case 'html5':
//         require viewPathHtml($view);
//         break;
//       default:
//         # code...
//         break;
//     }
//   }
}
