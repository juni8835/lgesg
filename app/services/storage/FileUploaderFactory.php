<?php 

namespace app\services\storage;

use app\core\Config;
use app\services\storage\uploaders\ImageUploader;
use app\services\storage\uploaders\VideoUploader;
use app\services\storage\uploaders\DocumentUploader;
use app\services\storage\uploaders\AudioUploader;
use app\services\storage\uploaders\GeneralUploader;

class FileUploaderFactory
{
    public static function create(string $typeOrExtension)
    {
        // Load file type configuration
        $fileTypes = Config::get('file.types');

        // Determine uploader class by extension
        foreach ($fileTypes as $type => $extensions) {
            if (in_array($typeOrExtension, $extensions, true)) {
                return self::instantiateUploader($type);
            }
        }

        // If no specific type matches, use 'general' as the default
        return self::instantiateUploader('general');
    }

    protected static function instantiateUploader(string $type)
    {
        return match ($type) {
            'image' => new ImageUploader(),
            'video' => new VideoUploader(),
            'document' => new DocumentUploader(),
            'audio' => new AudioUploader(),
            'general' => new GeneralUploader(),
            default => throw new \Exception("Unsupported file type: $type"),
        };
    }
}
