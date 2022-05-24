<?php

class Route
{    static function run(): void {
     $defaultControllerName = 'Main';
     $defaultActionName = 'index';

        $requestUri = isset($_SERVER['REQUEST_URI']) ? explode('/', $_SERVER['REQUEST_URI']) : [];
        $controllerName = empty($requestUri[1]) ? $defaultControllerName : $requestUri[1];
        $actionName = empty($requestUri[2]) ? $defaultActionName : $requestUri[2];

        $controllerFileName = "{$controllerName}Controller.php";
        $controllerFilePath = __DIR__."/controllers/$controllerFileName";

        if(file_exists($controllerFilePath)){
            include $controllerFilePath;

            $controllerСlass = "App\\Controllers\\{$controllerName}Controller";
            $controllerObj = new $controllerСlass;

            if(method_exists($controllerObj, $actionName)){
                $controllerObj->$actionName();
            } else {
                die('method_exists');
                Route::ErrorPage404();
            }
        } else {
            echo __DIR__;
            die("file_exists: $controllerFilePath");
            Route::ErrorPage404();
        }
    }

    static function ErrorPage404()
    { die("Error 404 - Page not found\n"); } #Вывод ошибку 404 в коде }