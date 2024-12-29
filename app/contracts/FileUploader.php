<?php

namespace app\contracts;

interface FileUploader
{
    public function validate($file): bool;

    public function upload($file, $path): string;

    public function putChunk($file, $path, $chunkIndex, $totalChunks): string;
}
