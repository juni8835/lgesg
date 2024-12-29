<?php

namespace app\facades;

use app\core\Config;
use app\core\Route;
use Exception;

class Snapshot
{
    /**
     * Load all PHP files from the given directory and combine their content as a snapshot.
     *
     * @param string $directoryPath
     * @param array $excludedPaths Paths to exclude from the snapshot
     * @return string
     * @throws Exception
     */
    public static function load(string $directoryPath, array $excludedPaths = []): string
    {
        // Resolve the absolute path of the directory
        $absolutePath = realpath($directoryPath);

        if (!$absolutePath || !is_dir($absolutePath)) {
            throw new Exception("Invalid directory path: {$directoryPath}");
        }

        $snapshotContent = '';

        // Normalize excluded paths to absolute paths
        $excludedAbsolutePaths = array_filter(
            array_map('realpath', $excludedPaths), // Apply realpath
            fn($path) => $path !== false           // Filter out invalid paths
        );

        // Iterate through all files in the directory (recursively)
        $iterator = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($absolutePath, \FilesystemIterator::SKIP_DOTS)
        );

        foreach ($iterator as $file) {
            $filePath = $file->getPathname();

            // Skip excluded paths (match full path or subdirectories)
            foreach ($excludedAbsolutePaths as $excludedPath) {
                if (strpos($filePath, $excludedPath) === 0) {
                    continue 2; // Skip to the next file
                }
            }

            // Only process PHP files
            if ($file->isFile() && $file->getExtension() === 'php') {
                $fileContent = file_get_contents($filePath);
                if ($fileContent === false) {
                    throw new Exception("Failed to read file: {$filePath}");
                }

                // Format output with clear separation
                $path = '/'.str_replace(base_path(), '', $filePath);
                $snapshotContent .= $path . PHP_EOL; // File path
                $snapshotContent .= str_repeat('-', 50) . PHP_EOL;  // Separator line
                $snapshotContent .= $fileContent . PHP_EOL;        // File content
                $snapshotContent .= PHP_EOL . PHP_EOL;             // Add extra blank line between files
            }
        }

        return $snapshotContent;
    }

    public static function show(): void
    {
        try {
            $snapshot = self::load(
                base_path(),
                Config::get('app.snapshot_exclude_paths')
            );
        
            dd($snapshot);
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}