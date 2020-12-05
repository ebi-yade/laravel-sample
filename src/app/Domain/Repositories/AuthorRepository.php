<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\Author;

interface AuthorRepository
{
    /**
     * IDから1件取得もしくはNullを返す
     * 
     * @param int $id
     * @return Author|null
     */
    public function getOrNullById(int $id): ?Author;
}
