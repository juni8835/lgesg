<?php

namespace App\Controllers;

use app\core\Controller;
use app\core\Request;
use app\core\Response;

namespace App\Controllers;

use app\core\Request;
use app\core\Response;
use app\core\View;
use app\models\Test;

class AdminController
{
    public function dashboard(Request $request, Response $response)
    {
        $data = ['title' => 'Admin Dashboard', 'stats' => [100, 200, 300]];
        render($request->getUri(1), $data);
    }

    public function users(Request $request, Response $response)
    {
        $tests = Test::all();
        render($request->getUri(1), ['users' => $tests]);
    }
}