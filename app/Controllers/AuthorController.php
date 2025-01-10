<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\Author;
use App\View;

class AuthorController
{
    public function __construct(private Author $author)
    {
    }

    public function index()
    {
        $authors = $this->author->all();

        foreach ($authors as $author) {
            echo $author['id'] . ': ' . $author['name'] . '<br />';
        }

//        return View::make('authors', compact('authors'));
    }
}
