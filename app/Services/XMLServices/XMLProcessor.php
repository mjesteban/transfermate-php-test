<?php

declare(strict_types=1);

namespace App\Services\XMLServices;

use App\App;
use App\DB;
use App\Exceptions\FileNotFoundException;
use DOMDocument;
use Exception;
use RuntimeException;
use XMLReader;

class XMLProcessor
{
    private DB $db;
    private string $schema;
    private XMLReader $parser;
    private array $buffer = [];

    public function __construct()
    {
        $this->parser = new XMLReader();
        $this->db = App::db();
        $this->schema = __DIR__.'/../../../config/books-format.xsd';
    }

    public function processFile(string $filePath): void
    {
        if (!$this->isUTF8($filePath)) {
            throw new RuntimeException("File $filePath is not encoded in UTF-8.");
        }

        $this->parser->open($filePath, 'utf-8');
        try {
            if ($this->parser->setSchema($this->getSchema())) {
                while ($this->parser->read()) {
                    if ($this->parser->nodeType == XMLReader::ELEMENT && $this->parser->localName === 'book') {
                        $this->processBook();
                    }
                }
            }
        } catch (Exception $exception) {
            echo $exception->getMessage();
        } finally {
            $this->parser->close();
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

    private function processBook(): void
    {
        $author = '';
        $title = '';

        while ($this->parser->read()) {
            if ($this->parser->nodeType == XMLReader::ELEMENT && $this->parser->localName === 'author') {
                $this->parser->read();
                $author = $this->parser->value;
            }

            if ($this->parser->nodeType == XMLReader::ELEMENT && $this->parser->localName === 'name') {
                $this->parser->read();
                $title = $this->parser->value;
            }

            if ($this->parser->nodeType == XMLReader::END_ELEMENT && $this->parser->localName === 'book') {
                break;
            }
        }

        if ($author && $title) {
            $this->save($author, $title);
        }
    }

    private function save(string $author, string $title): void
    {
        try {
            $this->db->beginTransaction();

            $insert = $this->db->prepare(
                <<<SQL
                    WITH author AS (
                        INSERT INTO authors (name)
                        VALUES (:name)
                        ON CONFLICT (name) DO NOTHING
                        RETURNING id
                    ),
                    existing_author AS (
                        SELECT id FROM authors WHERE name = :name
                    )
                    INSERT INTO books (title, author_id)
                        SELECT :title, COALESCE(author.id, existing_author.id)
                        FROM author
                        LEFT JOIN existing_author ON true
                SQL
            );

            $insert->execute([$author, $title]);

            $this->db->commit();
        } catch (Exception $exception) {
            $this->db->rollBack();
            echo $exception->getMessage();
        }
    }
}