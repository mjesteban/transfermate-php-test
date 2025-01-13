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

    public function index(): View
    {
        $authors = $this->author->all();

        return View::make('authors', ['authors' => $authors]);
    }
}
