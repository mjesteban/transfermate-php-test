<?php

declare(strict_types=1);

namespace App\Services\XMLServices;

use DirectoryIterator;
use Generator;
use RuntimeException;

class DirectoryScanner
{
    public function checkDirectory(string $dir): void
    {
        if (!is_dir($dir)) {
            throw new RuntimeException("Directory does not exist: $dir");
        }
    }

    public function scanDirectory(string $directory): Generator
    {
        foreach (new DirectoryIterator($directory) as $file) {
            if ($file->isDot()) {
                continue;
            }

            if ($file->isDir()) {
                yield from $this->scanDirectory($file->getRealPath());
            } elseif ($file->isFile() && $file->getExtension() === 'xml') {
                yield $file->getRealPath();
            }
        }
    }
}