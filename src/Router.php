<?php

namespace Core;
//TODO:RouterCasiListo
class Router
{
    protected $urls = ['urls' => [], 'groups' => [], 'errors' => [
        'url' => '/error',
        'method' => 'GET',
        'controller' => ['App\Controllers\ErrorController', 'index'],
        'params' => []
    ]];
    protected $stat = -1;

    public function setRoute($url, $method, $midleware, $controller)
    {
        // if ($this->getStat() == -1) {
            array_push($this->urls['urls'], [
                'url' => $url,
                'method' => $method,
                ($midleware == '') ?: 'midleware' => $midleware,
                'controller' => $controller,
            ]);
        // } else {
        //     array_push($this->urls['groups'][$this->getStat()]['routes'], [
        //         'url' => $url,
        //         'method' => $method,
        //         'controller' => $controller,
        //     ]);
        //     $this->setStat(-1);
        // }
    }
    public function setGroupRoute($url, $method, $midleware, $controller)
    {
        if ($this->getStat() != -1) {
            array_push($this->urls['groups'][$this->getStat()]['routes'], [
                'url' => $url,
                'method' => $method,
                'controller' => $controller,
            ]);
            // $this->setStat(-1);
        }
    }
    public function setStat($val)
    {
        $this->stat = $val;
    }
    public function getStat()
    {
        return $this->stat;
    }
    public function setGroup($url, $midleware, $functions)
    {
        array_push($this->urls['groups'], [
            'alias' => $url,
            ($midleware == '') ?: 'midleware' => $midleware,
            'routes' => []
        ]);

        foreach ($this->urls['groups'] as $key => $urls) {
            $this->setStat((array_search($url, $urls)) ? $key : null);
        }
        //var_dump($this->stat);
        $functions($route = $this);
        // var_dump($functions);
        //var_dump(['function'=>$functions($this->setRoute())]);

    }
    function getRoutes()
    {
        return $this->urls;
    }
}
