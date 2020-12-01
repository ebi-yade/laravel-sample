<?php

namespace App\Usecases;

use App\Repositories\AuthorRepository;
use App\Repositories\BookRepository;
use App\Entities\Book;
use Exception;

class AuthorNotFoundException extends Exception {}

class BookUsecase
{
    private AuthorRepository $authorRepository;
    private BookRepository $bookRepository;

    public function __construct(AuthorRepository $authorRepository, BookRepository $bookRepository)
    {
        $this->authorRepository = $authorRepository;
        $this->bookRepository = $bookRepository;
    }

    /**
     * 本を作成する
     * 
     * @param int $authorId
     * @param string $title
     * @return Book
     */
    public function createBook(int $authorId, string $title): Book
    {
        $author = $this->authorRepository->getOrNullById($authorId);
        if (is_null($author)) {
            throw new AuthorNotFoundException('ID: ' . $authorId . 'のAuthorが存在しません');
        }

        $newBook = Book::new($authorId, $title);
        $createdBook = $this->bookRepository->create($newBook);
        return $createdBook;
    }
}