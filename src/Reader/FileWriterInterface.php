<?php
declare(strict_types=1);

namespace App\Reader;

interface FileWriterInterface
{
    /**
     * @param string $filePath
     * @param string $content
     *
     * @return void
     *
     */
    public function writeFile(string $filePath, string $content): void;
}
