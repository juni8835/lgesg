<?php 

return [
    'name' => 'LG ESG 아카데미',
    'env' => 'production',
    'debug' => true,
    'base_path' => dirname(__DIR__),
    'view_path' => dirname(__DIR__).'/resources/views',
    'base_url' => '',
    'locale' => 'ko',
    'snapshot_exclude_paths' => [
        dirname(__DIR__).'/admin',
        dirname(__DIR__).'/index.php',
        dirname(__DIR__).'/pages',
        dirname(__DIR__).'/storage',
        dirname(__DIR__).'/resources',
        dirname(__DIR__).'/views',
    ],
];