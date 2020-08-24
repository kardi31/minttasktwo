<?php
declare(strict_types=1);

namespace App\Reader;

use Symfony\Component\HttpFoundation\File\Exception\FileException;

class FileWriter implements FileWriterInterface
{
    /**
     * @inheritDoc
     * @throws FileException
     */
    public function writeFile(string $filePath, string $content): void
    {
        try {
            $content = file_put_contents($filePath, $content);

            if ($content === false) {
                throw new FileException(sprintf('Unable to write file %s', $filePath));
            }
        } catch (\Exception $e) {
            throw new FileException(sprintf('Unable to write file %s', $filePath));
        }
    }
}
