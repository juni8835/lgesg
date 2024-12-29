<?php 

return [
    'default' => 'local',
    'disks' => [
        'local' => [
            'path' => dirname(__DIR__).'/storage/uploads',
            'max_file_size' => 10 * 10 * 1024
        ],
        'cache' => [
            'path' => dirname(__DIR__).'/storage/cache',
            'max_file_size' => 10 * 10 * 1024
        ],
        'logs' => [
            'path' => dirname(__DIR__).'/storage/logs',
            'max_file_size' => 10 * 10 * 1024
        ],
    ],
];