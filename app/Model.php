<?php

declare(strict_types=1);

namespace App;

use Generator;
use PDO;
use PDOStatement;

abstract class Model
{
    protected DB $db;

    public function __construct()
    {
        $this->db = App::db();
    }

    public function fetchLazy(PDOStatement $statement): Generator
    {
        $statement->setFetchMode(PDO::FETCH_OBJ);

        foreach ($statement as $record) {
            yield $record;
        }
    }
}
