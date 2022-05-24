<?php 
require_once './app/autoload.php';
require_once './app/route.php';

ini_set('display_errors', 1); # Оповещение при возникновении ошибок
Autoload::run();
Route::run();