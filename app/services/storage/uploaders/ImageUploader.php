<?php 

namespace app\services\storage\uploaders;

use app\contracts\FileUploader;

class ImageUploader implements FileUploader
{
    protected array $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    protected int $maxSize = 5 * 1024 * 1024; // 5MB

    public function validate($file): bool
    {
        $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if (!in_array($extension, $this->allowedExtensions)) {
            throw new \Exception("Invalid file extension: $extension");
        }

        if ($file['size'] > $this->maxSize) {
            throw new \Exception("File size exceeds limit of {$this->maxSize} bytes");
        }

        if ($file['size'] == 0) {
            throw new \Exception("File is empty");
        }

        return true;
    }

    public function upload($file, $path): string
    {
        $this->validate($file);

        $destination = $path . '/' . $file['name'];
        move_uploaded_file($file['tmp_name'], $destination);

        return $destination;
    }

    public function putChunk($file, $path, $chunkIndex, $totalChunks): string
    {
        $chunkPath = $path . '/' . $file['name'] . ".part{$chunkIndex}";
        move_uploaded_file($file['tmp_name'], $chunkPath);

        // 청크 병합 완료
        if ($chunkIndex + 1 == $totalChunks) {
            $finalPath = $path . '/' . $file['name'];
            $finalFile = fopen($finalPath, 'wb');
            for ($i = 0; $i < $totalChunks; $i++) {
                $chunk = fopen($path . '/' . $file['name'] . ".part{$i}", 'rb');
                stream_copy_to_stream($chunk, $finalFile);
                fclose($chunk);
                unlink($path . '/' . $file['name'] . ".part{$i}");
            }
            fclose($finalFile);

            return $finalPath;
        }

        return $chunkPath;
    }
}
