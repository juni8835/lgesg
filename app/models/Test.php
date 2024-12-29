<?php

namespace app\models;

use app\core\Model;
use PDO;

class Test extends Model
{
    protected string $table = 'tests';
    protected array $fillable = [
        'label',
        'contents'
    ];

}
