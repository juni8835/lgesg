<?php

use app\core\Route;
use App\Controllers\HomeController;
use App\Controllers\AuthController;


// Define web routes
Route::get('/index.php', [HomeController::class, 'index']);

Route::get('/pages/auth/login.php', [AuthController::class, 'login']);