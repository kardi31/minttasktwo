<?php
declare(strict_types=1);

namespace App\Repository;

use App\Reader\FileReaderInterface;
use App\Reader\FileWriterInterface;

class UserRepository
{
    private const FILEPATH = 'private/userlist.yml';

    /**
     * @var FileReaderInterface
     */
    protected $fileReader;

    /**
     * @var FileWriterInterface
     */
    protected $fileWriter;

    /**
     * @var string
     */
    private $filePath;

    /**
     * @param FileReaderInterface $fileReader
     * @param FileWriterInterface $fileWriter
     * @param string              $projectPath
     */
    public function __construct(FileReaderInterface $fileReader, FileWriterInterface $fileWriter, string $projectPath)
    {
        $this->fileReader = $fileReader;
        $this->filePath = sprintf('%s/%s',
            $projectPath,
            self::FILEPATH
        );
        $this->fileWriter = $fileWriter;
    }

    /**
     * @return array
     */
    public function getList(): array
    {
        $content = $this->fileReader->readFile($this->filePath);

        return json_decode($content, true);
    }

    /**
     * @param string $username
     * @return array|null
     */
    public function findByUsername(string $username): ?array
    {
        $content = $this->fileReader->readFile($this->filePath);
        $jsonData = json_decode($content, true);

        $key = array_search($username, array_column($jsonData, 'username'));
        if ($key === false) {
            return null;
        }

        return $jsonData[$key];
    }

    /**
     * @param string $username
     * @param bool   $disabled
     * @return void
     */
    public function setUserDisabled(string $username, bool $disabled): void
    {
        $content = $this->fileReader->readFile($this->filePath);
        $jsonData = json_decode($content, true);

        $key = array_search($username, array_column($jsonData, 'username'));
        if ($key === false) {
            return;
        }

        $jsonData[$key]['disabled'] = $disabled;
        $this->fileWriter->writeFile($this->filePath, json_encode($jsonData));
    }
}
