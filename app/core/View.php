<?php 

namespace app\core;

use Exception;

class View {
    static string $VIEW_PATH; 
    private string $path = '';
    private array $data = []; 
    private string $layout = 'home';

    public function __construct(string $path, array $data = [])
    {
        self::$VIEW_PATH = Config::get('app.view_path');

        $this->path = $path; 
        $this->data = $data;
    }

    public function setLayout($layout = 'home'): string 
    {
        return $this->layout = $layout;
    }

    public function render(): string
    {
        $content = $this->renderContent(); 
        $layout = $this->renderLayout();

        return str_replace('{{content}}', $content, $layout);
    }

    public function renderLayout(): string
    {
        return $this->renderOnlyView('layouts'.'/'.$this->layout.'.php');
    }

    public function renderContent(): string
    {
        $path = strpos($this->path, '.php') === false
            ? $this->path.'/'.'index.php'
            : $this->path; 
            
        return $this->include($path);
    }

    public function include($path = '')
    {
        ob_start(); 
        $path = base_path($path);
        if (!file_exists($path)) {
            throw new Exception('Cannot include | Path: ' . $path);
        }

        // Extract the data into variables for use in the view
        extract($this->data);

        include $path;
        return ob_get_clean();
    }

    public function renderOnlyView($path = '')
    {
        ob_start(); 
        $path = self::$VIEW_PATH.'/'.Route::normalizeUri($path);
        if (!file_exists($path)) {
            throw new Exception('Cannot include | Path: ' . $path);
        }

        // Extract the data into variables for use in the view
        extract($this->data);

        include_once $path;
        return ob_get_clean();
    }
}