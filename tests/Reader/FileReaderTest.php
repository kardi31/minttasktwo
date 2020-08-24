<?php
declare(strict_types=1);

namespace App\Tests\Reader;

use App\Reader\FileReader;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class FileReaderTest extends TestCase
{
    /**
     * @var FileReader
     */
    private $fileReader;

    public function setUp()
    {
        $this->fileReader = new FileReader();
    }

    public function testReadReturnsValidData()
    {
        $content = $this->fileReader->readFile(
            sprintf('%s/../samplefiles/sample.json',
                __DIR__
            )
        );

        $this->assertIsString($content);
        $this->assertJson($content);
    }

    public function testReadThrowsExceptionForMissingFile()
    {
        $this->expectException(FileException::class);
        $this->fileReader->readFile(
            sprintf('%s/../samplefiles/notexisting.json',
                __DIR__
            )
        );
    }
}

