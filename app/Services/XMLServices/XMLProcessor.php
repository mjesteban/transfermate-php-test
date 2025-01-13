<?php

declare(strict_types=1);

namespace App\Services\XMLServices;

use App\Exceptions\FileNotFoundException;
use DOMDocument;
use Exception;
use RuntimeException;
use XMLReader;

class XMLProcessor
{
    public array $booksBuffer = [];
    private string $schema;
    private XMLReader $xmlReader;

    public function __construct()
    {
        $this->xmlReader = new XMLReader();
        $this->schema = __DIR__.'/../../../config/books-format.xsd';
    }

    public function processFile(string $filePath): void
    {
        if (!$this->isUTF8($filePath)) {
            throw new RuntimeException("File $filePath is not encoded in UTF-8.");
        }

        $this->xmlReader->open($filePath, 'utf-8');
        try {
            if ($this->xmlReader->setSchema($this->getSchema())) {
                while ($this->xmlReader->read()) {
                    if ($this->xmlReader->nodeType == XMLReader::ELEMENT && $this->xmlReader->localName === 'book') {
                        $this->extractInNodes();
                    }
                }
            }
        } catch (Exception $exception) {
            echo $exception->getMessage();
        } finally {
            $this->xmlReader->close();
        }
    }

    private function isUTF8(string $file): bool
    {
        $xml = new DOMDocument();
        $xml->load($file, LIBXML_ERR_ERROR);

        return $xml->encoding === 'UTF-8';
    }

    private function getSchema(): string
    {
        if (!file_exists($this->schema)) {
            throw new FileNotFoundException();
        }

        return $this->schema;
    }

    private function extractInNodes(): void
    {
        $author = '';
        $title = '';

        while ($this->xmlReader->read()) {
            if ($this->xmlReader->nodeType == XMLReader::ELEMENT && $this->xmlReader->localName === 'author') {
                $this->xmlReader->read();
                $author = $this->xmlReader->value;
            }

            if ($this->xmlReader->nodeType == XMLReader::ELEMENT && $this->xmlReader->localName === 'name') {
                $this->xmlReader->read();
                $title = $this->xmlReader->value;
            }

            if ($this->xmlReader->nodeType == XMLReader::END_ELEMENT && $this->xmlReader->localName === 'book') {
                break;
            }
        }

        if ($author && $title) {
            $this->booksBuffer[] = ['author' => $author, 'title' => $title];
        }
    }
}