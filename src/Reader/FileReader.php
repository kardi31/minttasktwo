<?php
declare(strict_types=1);

namespace App\Reader;

use Symfony\Component\HttpFoundation\File\Exception\FileException;

class FileReader implements FileReaderInterface
{
    /**
     * @inheritDoc
     * @throws FileException
     */
    public function readFile(string $filePath): string
    {
        try {
            $content = file_get_contents($filePath);

            if (!$content) {
                throw new FileException(sprintf('Invalid file %s', $filePath));
            }

            return $content;
        } catch (\Exception $e) {
            throw new FileException(sprintf('Invalid file %s', $filePath));
        }
    }
}
