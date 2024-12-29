<?php 

namespace app\contracts; 

interface StorageInterface 
{
    public function put(string $path, $content): string;

    public function get(string $path): string;

    public function delete(string $path): bool;

    public function download(string $path): mixed;
}