<?php

namespace App\Http\Controller;

class TestController extends BasicController
{
    public function index()
    {        
        echo 'Hello, Eogee!This is final controller to test the middleware.';
    }
}