<?php

declare(strict_types=1);

namespace App\Services\XMLServices;

use Exception;

class XMLMigrateService
{
    private DirectoryScanner $scanner;
    private XMLProcessor $processor;

    public function __construct(DirectoryScanner $scanner, XMLProcessor $processor)
    {
        $this->scanner = $scanner;
        $this->processor = $processor;
    }

    public function migrate(string $dir)
    {
        try {
            $this->scanner->checkDirectory($dir);
            $files = $this->scanner->scanDirectory($dir);

            foreach ($files as $file) {
                $this->processor->processFile($file);
            }
        } catch (Exception $exception) {
            echo $exception->getMessage();
        }
    }
}