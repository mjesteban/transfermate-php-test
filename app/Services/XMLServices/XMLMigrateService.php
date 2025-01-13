<?php

declare(strict_types=1);

namespace App\Services\XMLServices;

use App\App;
use App\DB;
use Exception;

class XMLMigrateService
{
    protected DB $db;

    public function __construct(
        private readonly DirectoryScanner $scanner,
        private readonly XMLProcessor $processor
    ) {
        $this->db = App::db();
    }

    public function migrate(string $dir)
    {
        try {
            $this->scanner->checkDirectory($dir);
            $files = $this->scanner->scanDirectory($dir);

            foreach ($files as $file) {
                $this->processor->processFile($file);
            }

            $this->createMany($this->processor->booksBuffer);

        } catch (Exception $exception) {
            echo $exception->getMessage();
        }
    }

    private function createMany(array $books): void
    {
        try {
            $this->db->beginTransaction();

            $authorValues = [];
            $bookValues = [];
            $params = [];

            foreach ($books as $index => $book) {
                $authorValues[] = "(:name{$index})";
                $bookValues[] = "(:title{$index}, 
                    COALESCE(
                        (SELECT id FROM new_author WHERE name = :name{$index}), 
                        (SELECT id FROM existing_author WHERE name = :name{$index})
                ))";
                $params[":name{$index}"] = $book['author'];
                $params[":title{$index}"] = $book['title'];
            }

            $authorValues = implode(', ', $authorValues);
            $bookValues = implode(', ', $bookValues);

            $sql = <<<SQL
                WITH
                new_author AS (
                    INSERT INTO authors (name) VALUES {$authorValues}
                        ON CONFLICT (name) DO NOTHING
                        RETURNING id, name
                ),
                existing_author AS (
                    SELECT id, name FROM authors WHERE name IN ({$authorValues})
                )
                INSERT INTO books (title, author_id)
                VALUES {$bookValues}
                    ON CONFLICT (title, author_id) DO NOTHING
            SQL;

            $insert = $this->db->prepare($sql);
            $insert->execute($params);

            $this->db->commit();
        } catch (Exception $exception) {
            $this->db->rollBack();
            echo $exception->getMessage();
        }
    }
}