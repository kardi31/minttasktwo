<?php
declare(strict_types=1);

namespace App\Reader;

interface FileReaderInterface
{
    /**
     * @param string $filePath
     *
     * @return string
     */
    public function readFile(string $filePath): string;
}
