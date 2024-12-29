<?php 

use app\core\App;
use app\core\Config;
use app\core\Path;

function app(): App
{
    return App::$app;
}
function base_path(string $path = ''): string
{
    return Path::basePath($path);
}

function storage_path(string $path = ''): string 
{
    return Path::storagePath($path); 
}

function base_url(string $path = ''): string
{
    return Path::base_url($path);
}

function resources_path(string $path = ''): string
{
    return Path::resourcesPath($path);
}

function views_path(string $path = ''): string
{
    return Path::viewsPath($path);
}

function asset_url(string $path = ''): string
{
    return Path::assetUrl($path);
}

function vendor_url(string $path = ''): string
{
    return Path::vendorUrl($path);
}

function image_url(string $path = ''): string
{
    return Path::imageUrl($path);
}

function css_url(string $path = ''): string
{
    return Path::cssUrl($path);
}

function js_url(string $path = ''): string
{
    return Path::jsUrl($path);
}


