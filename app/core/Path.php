<?php

namespace app\core;

class Path
{
    /**
     * Get the base path (server-side absolute path).
     */
    public static function basePath(string $path = ''): string
    {
        return Config::get('app.base_path') . '/' . ltrim($path, '/');
    }

    /**
     * Get the resources path (server-side absolute path).
     */
    public static function resourcesPath(string $path = ''): string
    {
        return self::basePath('resources') . '/' . ltrim($path, '/');
    }

    /**
     * Get the assets path (server-side absolute path).
     */
    public static function storagePath(string $path = ''): string
    {
        return self::basePath('storage') . '/' . ltrim($path, '/');
    }

    /**
     * Get the assets path (server-side absolute path).
     */
    public static function assetsPath(string $path = ''): string
    {
        return self::resourcesPath('assets') . '/' . ltrim($path, '/');
    }

    /**
     * Get the views path (server-side absolute path).
     */
    public static function viewsPath(string $path = ''): string
    {
        return self::resourcesPath('views') . '/' . ltrim($path, '/');
    }

    /**
     * Get the web root URL
     */
    public static function base_url(string $path = ''): string 
    {
        return Config::get('app.base_url').'/'.ltrim($path, '/');
    }

    /**
     * Get the web root-relative URL for public assets.
     * For use in HTML src, href attributes.
     */
    public static function assetUrl(string $path = ''): string
    {
        $path = 'resources/assets/'.ltrim($path, '/');
        return self::base_url($path);
    }

    /**
     * Get the web root-relative URL for images.
     */
    public static function imageUrl(string $path = ''): string
    {
        $path = 'resources/assets/images/'.ltrim($path, '/');
        return self::base_url($path);
    }

    /**
     * Get the web root-relative URL for CSS files.
     */
    public static function cssUrl(string $path = ''): string
    {
        $path = 'resources/assets/css/'.ltrim($path, '/');
        return self::base_url($path);
    }

    /**
     * Get the web root-relative URL for JS files.
     */
    public static function jsUrl(string $path = ''): string
    {
        $path = 'resources/assets/js/'.ltrim($path, '/');
        return self::base_url($path);
    }
    /**
     * Get the web root-relative URL for Vendor files.
     */
    public static function vendorUrl(string $path = ''): string
    {
        $path = 'resources/vendor/'.ltrim($path, '/');
        return self::base_url($path);
    }
}
