<?php

namespace App\Service;

use Illuminate\Support\Facades\Storage;

class FileManager
{
    public static function saveCsv(array $list, string $fileName)
    {
        /*Storage::disk('s3')->put($fileName, $file, [
            'visibility' => 'public',
            'mimetype' => 'text/csv'
        ]);*/
    }
}
