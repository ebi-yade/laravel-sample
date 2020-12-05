<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\Book;

interface BookRepository
{
    /**
     * 新規作成
     * 
     * @param Book $book 新規作成する本
     * @return Book 作成された本
     */
    public function create(Book $book): Book;
}
