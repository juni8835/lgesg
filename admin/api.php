<?php

use app\models\Test;

include_once $_SERVER['DOCUMENT_ROOT'].'/app/autoload.php';

$data = Test::all();

$data = [$_POST, $_FILES];

echo json_encode($data);