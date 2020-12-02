<?php

namespace Tests\Controllers;

use Tests\TestCase;
use App\Usecases\{BookUsecase,AuthorNotFoundException};
use App\Entities\Book;
use Mockery;

class BookControllerTest extends TestCase
{
    public function testCreateBook200()
    {
        $givenAuthorId = 10;
        $givenTitle = 'first PHP';
        $wantBookId = 100;

        // arrange
        $bookUsecase = Mockery::mock(BookUsecase::class);
        $bookUsecase
            ->shouldReceive('createBook')
            ->with($givenAuthorId, $givenTitle)
            ->andReturn(new Book($wantBookId, $givenAuthorId, $givenTitle));
            
        // controllerにDIされるUsecaseクラスを指定
        $this->app->instance(BookUsecase::class, $bookUsecase);

        // action
        $resp = $this->post('/api/books', [
            'author_id' => $givenAuthorId,
            'title'     => $givenTitle
        ]);

        // assert
        $resp->assertStatus(200);
        $resp->assertJsonFragment([
            'id'        => $wantBookId,
            'author_id' => $givenAuthorId,
            'title'     => $givenTitle
        ]);
    }

    public function testCreateBook404()
    {
        $givenAuthorId = 10;
        $givenTitle = 'first PHP';

        // arrange
        $bookUsecase = Mockery::mock(BookUsecase::class);
        $bookUsecase
            ->shouldReceive('createBook')
            ->with($givenAuthorId, $givenTitle)
            ->andThrow(AuthorNotFoundException::class, 'authorが見つかりません');
            
        // controllerにDIされるUsecaseクラスを指定
        $this->app->instance(BookUsecase::class, $bookUsecase);

        // action
        $resp = $this->post('/api/books', [
            'author_id' => $givenAuthorId,
            'title'     => $givenTitle
        ]);

        // assert
        $resp->assertStatus(404);
    }
}