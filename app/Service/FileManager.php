<?php

namespace App\Service;

class FileManager
{
    public static function saveCsv(array $list)
    {
        $fp = fopen('php://temp', 'r+b');

        foreach ($list as $row) {
            fputcsv($fp, $row);
        }

        rewind($fp);
        $data = rtrim(stream_get_contents($fp), "\n");
        fclose($fp);

        return $data;
    }
}
