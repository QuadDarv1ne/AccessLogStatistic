<?php

namespace App\Kernel;
class Controller 
{
    protected Response $_response;

    public function __construct()
    {$this->_response = new Response();}
    public function index(){}
}