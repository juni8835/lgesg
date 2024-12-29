<?php

namespace App\Controllers;

use app\core\Request;
use app\core\Response;

class HomeController
{
    public function index(Request $request, Response $response)
    {
        $data = ['title' => 'Home Page', 'message' => 'Welcome to the home page!'];
        render($request->getUri(1), $data);
    }
}