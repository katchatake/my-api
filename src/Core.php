<?php

namespace Core;

class Core
{
    protected $url;
    protected $method;
    protected $params;
    protected $controller;
    protected $clase;
    protected $args;
    protected $midelware;

    public function __construct($routes)
    {
        // $ruta = explode('/', $_SERVER['REQUEST_URI']);
        $ruta = (!empty($_GET['url']) ? '/' . $_GET['url'] : '/');
        //echo $ruta;
        // echo '<br>';
        // echo '<pre>';
        // echo json_encode($routes);
        $this->searchURL($routes, $ruta);
        //var_dump($this->searchURL($routes, $ruta));
    }

    function findRoute($search_values, $route)
    {
        $statusUniqueUrl = false;
        $route["params"] = [];
        $urlParams = [];
        $urlWithOut = explode('/:', $route['url']);
        // echo "params => ".$urlWithOut[0]."\n";
        $urlExplode = explode('/', $urlWithOut[0]);
        $search_values_temp = $search_values;
        if (count($urlWithOut) >= 2) {
            $urlWithOutTemp = $urlWithOut;
            array_shift($urlWithOutTemp);
            // echo "Entro => ".count($urlWithOutTemp)."\n";
            $params = $urlWithOutTemp;
            // var_dump($params);
            // echo "Count Params => ".count($params)."\n";
            $urlParams = array_splice($search_values_temp, -count($params));
            $route["params"] = array_combine($params, $urlParams);
            // var_dump($urlParams);
        }
        // var_dump("Despues",$urlWithOut);
        // var_dump($search_values,$urlExplode);
        $arr1 = $search_values_temp;
        $arr2 = $urlExplode;

        $arraySearch = '/' . implode('/', $arr1);
        $arrayUrlExplode = '/' . implode('/', $arr2);
        // echo implode('/',$arr1).' ======  '. implode('/',$arr2)."\n";

        $findURL = strcmp($arraySearch, $arrayUrlExplode);
        // echo "checked =>  ".$findURL."\n";
        if ($findURL == 0 && $this->validRequestHTTP($route)) {
            $statusUniqueUrl = $route;
        }
        return $statusUniqueUrl;
    }

    function searchURI($search_value, $routes)
    {
        $search_values = explode('/', $search_value);
        // array_shift($search_values);
        $statusUniqueUrl = false;
        $response = [];
        foreach ($routes["urls"] as $key => $route) {
            $statusUniqueUrl = $this->findRoute($search_values, $route);
            // var_dump($statusUniqueUrl);
            if ($statusUniqueUrl) {
                // $routeFind = $statusUniqueUrl;
                return $statusUniqueUrl;
            }
        }
        if (!is_array($statusUniqueUrl)) {
            $statusGroup = $this->searchURIGroups($search_value, $routes);
            $response = (!is_array($statusGroup)) ? false : $statusGroup;
        }
        return $response;
    }

    function searchURIGroups($search_value, $routes)
    {
        foreach ($routes["groups"] as $key => $route) {
            // echo "URL => ".$search_value."\n";
            // echo "alias => ".$route["alias"]."\n";
            $findURL = strcmp($search_value, $route["alias"]);
            // echo "Similitud => ".$findURL."\n";
            if ($findURL >= 0) {
                $subsURL = substr($search_value, 0, -$findURL);
                $compareURLS = strcmp($subsURL, $route["alias"]);
                // echo "Compare =>  ".$compareURLS."\n";
                if ($compareURLS == 0) {
                    // echo "Existe el alias => ",$search_value." == ".$route["alias"]."\n";
                    $subRouteSearch = substr($search_value, strlen($route["alias"]));
                    $subRouteExplode = explode('/', $subRouteSearch);
                    // echo "==>".$subRouteSearch."\n";
                    foreach ($route["routes"] as $key => $subRoute) {
                        $status = $this->findRoute($subRouteExplode, $subRoute);
                        if ($status) {
                            $status["midleware"] = $route["midleware"];
                            return $status;
                        } else {
                            return false;
                        }
                    }
                }
            }
        }
    }

    function searchURL($routes, $position)
    {
        $route = $this->searchURI($position, $routes);
        // var_dump($route);
        if ($route) {
            // if ($this->checkMiddleware($route)) {
                $this->setURL($route);
            // }else{
            //     $this->setURL($routes["errors"]);
            // }
        } else {
            $this->setURL($routes["errors"]);
        }
    }

    function checkMiddleware($route)
    {
        // var_dump($route["midleware"]);
        $class = explode('::', $route["midleware"]);
        return (method_exists(new $class[0], $class[1])) ? true : false;
        // var_dump($class[0]);
        // if (method_exists(new $class[0],$class[1])) {
        // // if (class_exists($class[0])) {
        //     var_dump("Existe");
        // } else {
        //     var_dump("No Existe");
        // }
    }

    public function validRequestHTTP($request)
    {
        return ($request['method'] === $_SERVER['REQUEST_METHOD']) ? true : false;
    }

    public function setURL($route)
    {
        //var_dump($route);
        $this->method = $route['method'];
        $this->url = $route['url'];
        $this->controller = $route['controller'][0];
        $this->clase = $route['controller'][1];
        $this->params = $route["params"];
    }

    public function getController()
    {
        return $this->controller;
    }

    public function getClase()
    {
        return $this->clase;
    }

    public function send()
    {
        $controller = $this->getController();
        $clase = $this->getClase();
        // var_dump($controller);
        try {
            // $response = call_user_func([
            //     new $controller,
            //     $clase
            // ], $this->params);
            $response = call_user_func_array([
                new $controller,
                $clase
            ], $this->params);
            // try {
            //     if ($response instanceof Response) {
            //         $response->send();
            //     } else {
            //         throw new \Exception("Error Processing Request", 1);
            //     }
            // } catch (\Exception $e) {
            //     echo "Details {$e->getMessage()}";
            // }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
