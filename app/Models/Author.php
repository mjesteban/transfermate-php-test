<?php

namespace App\Models;

use App\Model;
use Generator;

class Author extends Model
{
    public function all(): Generator
    {
        $query = <<<SQL
        SELECT name, title
            FROM authors a
        INNER JOIN books b
            ON a.id = b.author_id
        SQL;

        $stmt = $this->db->query($query);

        return $this->fetchLazy($stmt);
    }
}
