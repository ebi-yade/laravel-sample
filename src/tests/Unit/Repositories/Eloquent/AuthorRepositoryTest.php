<?php

namespace Tests\Unit\Repositories\Eloquent;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\Author as EloquentAuthor;
use App\Repositories\Eloquent\AuthorRepository;
use App\Entities\Author;

class AuthorRepositoryTest extends TestCase
{
    use DatabaseTransactions;

    private AuthorRepository $repository;

    public function setUp(): void
    {
        parent::setUp();
        $this->repository = new AuthorRepository(new EloquentAuthor());
    }

    public function testGetOrNullByIdReturnsAuthor()
    {
        // arrange
        factory(EloquentAuthor::class)->create(['name' => 'murata0'])->id;
        $target_id = factory(EloquentAuthor::class)->create(['name' => 'murata1'])->id;
        factory(EloquentAuthor::class)->create(['name' => 'murata2'])->id;

        // action
        $author = $this->repository->getOrNullById($target_id);

        // assert
        $this->assertInstanceOf(Author::class, $author);
        $this->assertSame('murata1', $author->name);
    }

    public function testGetOrNullByIdReturnsNull()
    {
        // action
        $author = $this->repository->getOrNullById(4);

        // assert
        $this->assertNull($author);
    }
}
