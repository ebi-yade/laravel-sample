<?php

namespace Tests\Unit\Repositories\Eloquent;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\Book as EloquentBook;
use App\Repositories\Eloquent\BookRepository;
use App\Entities\Book;

class BookRepositoryTest extends TestCase
{
    use DatabaseTransactions;

    private BookRepository $repository;

    public function setUp(): void
    {
        parent::setUp();
        $this->repository = new BookRepository(new EloquentBook());
    }

    public function testCreateThenSavedInDB()
    {
        // arrange
        $book = Book::new(10, 'first Laravel');

        // action
        $createdBook = $this->repository->create($book);

        // assert
        // Returned Value
        $this->assertGreaterThan(0, $createdBook->id);
        $this->assertSame(10, $createdBook->authorId);
        $this->assertSame('first Laravel', $createdBook->title);

        // DB
        $this->assertDatabaseHas('books', [
            'author_id' => 10,
            'title'     => 'first Laravel'
        ]);
    }

    public function testCreateThenIncrementID()
    {
        // action
        $createdBook1 = $this->repository->create(Book::new(10, 'dummy1'));
        $createdBook2 = $this->repository->create(Book::new(20, 'dummy2'));
        $createdBook3 = $this->repository->create(Book::new(30, 'dummy3'));

        // assert
        $this->assertSame($createdBook1->id + 1, $createdBook2->id);
        $this->assertSame($createdBook2->id + 1, $createdBook3->id);
    }
}
