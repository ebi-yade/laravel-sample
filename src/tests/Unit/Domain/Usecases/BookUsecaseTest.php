<?php

namespace Tests\Unit\Usecases;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Domain\Usecases\{
    BookUsecase,
    AuthorNotFoundException
};
use App\Domain\Repositories\{
    AuthorRepository,
    BookRepository
};
use App\Domain\Entities\{
    Book,
    Author
};
use Hamcrest\Matchers;
use Mockery;

class BookUsecaseTest extends TestCase
{
    public function testCreateBookSucceed()
    {
        $givenAuthorId = 10;
        $givenTitle    = 'first PHP';
        $wantBook      = new Book(2, $givenAuthorId, $givenTitle);

        // arrange
        $authorRepository = Mockery::mock(AuthorRepository::class);
        $authorRepository
            ->shouldReceive('getOrNullById')
            ->with($givenAuthorId)
            ->andReturn(new Author($givenAuthorId, 'murata'));

        $bookRepository = Mockery::mock(BookRepository::class);
        $bookRepository
            ->shouldReceive('create')
            ->with(Matchers::equalTo(Book::new($givenAuthorId, $givenTitle)))
            ->andReturn($wantBook)
            ->once();

        // action
        $usecase = new BookUsecase($authorRepository, $bookRepository);
        $createdBook = $usecase->createBook($givenAuthorId, $givenTitle);

        // arrange
        $this->assertSame($wantBook, $createdBook);
    }

    public function testCreateBookThrowExceptionWhenAuthorNotExists()
    {
        $givenAuthorId = 10;
        $givenTitle    = 'first PHP';

        // arrange
        $authorRepository = Mockery::mock(AuthorRepository::class);
        $authorRepository
            ->shouldReceive('getOrNullById')
            ->with($givenAuthorId)
            ->andReturn(null);

        $bookRepository = Mockery::mock(BookRepository::class);
        $bookRepository
            ->shouldReceive('create')
            ->never();

        // expect
        $this->expectException(AuthorNotFoundException::class);
        $this->expectExceptionMessage('ID: 10のAuthorが存在しません');

        // action
        $usecase = new BookUsecase($authorRepository, $bookRepository);
        $usecase->createBook($givenAuthorId, $givenTitle);
    }
}
