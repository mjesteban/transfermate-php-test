<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\Author;
use App\Services\XmlParseService;
use App\View;

class AuthorController
{
    public function __construct(private Author $author)
    {
    }

    public function index()
    {
        $xmlParse = new XmlParseService();
        $xmlParse->parse();
        exit;
        $authors = $this->author->all();

        foreach ($authors as $author) {
            var_dump($author);
        }
    }
}
