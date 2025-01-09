<?php

declare(strict_types=1);

namespace App\Controllers;

use App\View;

class AuthorController
{
    public function index(): View
    {
        return View::make('index');
    }
}
