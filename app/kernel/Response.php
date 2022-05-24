<?php

namespace App\Kernel;

class Response
{
    /**
     * Подключение представления
     * @param  string $viewName Наименование представления
     * @param  array  $params   Параметры представления
     * @return void             Без явного ответа
     */
    public function view(string $viewName, array $params = []): void {
        /* Импорт переменных из входящего массива */
        if(count($params) > 0){
            extract($params);
        } 

        include "app/views/$viewName";
    }

    /**
     * JSON ответ
     * @param  array  $data       Параметры представления
     * @return void               Без явного ответа
     */
    public function json(array $data = []): void {
        header("Content-Type: application/json");

        $json = json_encode($data);

        if ($json === false) {
            $json = json_encode(["JSON Error"]);
            
            http_response_code(500);
        }
        
        echo $json;
    }
}