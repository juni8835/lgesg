<?php 

namespace app\services\storage\uploaders;

use app\contracts\FileUploader;

class DocumentUploader implements FileUploader
{
    protected array $allowedExtensions = ['pdf', 'doc', 'docx', 'xls', 'xlsx'];
    protected int $maxSize = 10 * 1024 * 1024; // 10MB

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
        throw new \Exception("Chunk upload not supported for documents.");
    }
}
