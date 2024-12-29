<?php 

namespace app\core;

use app\facades\Storage;
use app\services\storage\drivers\LocalStorage;
use app\services\storage\StorageManager;

class App
{
    public static App $app;
    public static string $ROOT_PATH;
    public Router $router;
    public Request $request;
    public Response $response;
    public StorageManager $storageManager;

    public function __construct(string $rootPath)
    {
        self::$app = $this;
        self::$ROOT_PATH = $rootPath;

        Database::connect();
        
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
        
        $this->setupStorageManager();
    }

    protected function setupStorageManager(): void
    {
        $config = Config::get('file_system');
        $defaultDisk = $config['default'] ?? 'local';
        $disks = $config['disks'] ?? [];

        $this->storageManager = new StorageManager();
        foreach ($disks as $key => $disk) {
            $path = $disk['path'] ?? null;
            if ($path) {
                $this->storageManager->addDriver($key, new LocalStorage($path));
            }
        }
        
        $this->storageManager->setDefaultDriver($defaultDisk);
        Storage::setManager($this->storageManager);
    }

    public function run(): void
    {
        $this->router->resolve();
    }
}

