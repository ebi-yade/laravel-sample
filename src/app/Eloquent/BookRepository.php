<?php

namespace App\Eloquent;

use App\Models\Book as EloquentBook;
use App\Domain\Repositories\BookRepository as IBookRepository;
use App\Domain\Entities\Book;

/**
 * {@inheritdoc}
 */
class BookRepository implements IBookRepository
{
    private EloquentBook $eloquentBook;

    public function __construct(EloquentBook $eloquentBook)
    {
        $this->eloquentBook = $eloquentBook;
    }

    public function create(Book $book): Book
    {
        $bookData = $this->eloquentBook->create([
            'author_id' => $book->authorId,
            'title'     => $book->title
        ]);

        // Eloquent Modelをエンティティに詰め替える
        return new Book(
            $bookData->id,
            $bookData->author_id,
            $bookData->title,
        );
    }
}
