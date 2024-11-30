<?php

class App{

    public function __construct(){
        $url = $this->parseUrl();
        $controllerName = ucfirst($url[0]). 'Controller';
        $method = $url[1] ?? 'index';

        require_once "../app/controllers/$controllerName.php";
        $controller = new $controllerName;
        call_user_func_array([$controller,$method], array_slice($url,2));
    }

    private function parseUrl(){
        if(isset($_GET['url'])){
            return explode('/',filter_var(rtrim($_GET['url'],'/'),FILTER_SANITIZE_URL));
        }
        return ['User','index']; // Default route
    }
}