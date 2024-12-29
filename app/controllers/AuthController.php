<?php

namespace App\Controllers;

use app\core\Request;
use app\core\Response;

class AuthController
{
    public function login(Request $request, Response $response)
    {
        
        render($request->getUri(1), [
            'title' => '로그인', 
            'locale' => 'en-us'
        ]);
    }
}