<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class PortfolioFileService
{
    private const DISK = 'public';
    private const DIR  = 'portfolio';

    /**
     * Store an uploaded file and return its relative path.
     */
    public function store(UploadedFile $file): string
    {
        return $file->store(self::DIR, self::DISK);
    }

    /**
     * Delete a previously stored file by its relative path.
     * Silently ignores missing files.
     */
    public function delete(string $path): void
    {
        Storage::disk(self::DISK)->delete($path);
    }
}

