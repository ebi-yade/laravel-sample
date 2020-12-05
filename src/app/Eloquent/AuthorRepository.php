<?php

namespace App\Eloquent;

use App\Models\Author as EloquentAuthor;
use App\Domain\Repositories\AuthorRepository as IAuthorRepository;
use App\Domain\Entities\Author;

/**
 * {@inheritdoc}
 */
class AuthorRepository implements IAuthorRepository
{
    private EloquentAuthor $eloquentAuthor;

    public function __construct(EloquentAuthor $eloquentAuthor)
    {
        $this->eloquentAuthor = $eloquentAuthor;
    }

    public function getOrNullById(int $id): ?Author
    {
        $authorData = $this->eloquentAuthor->find($id);

        return is_null($authorData) ? null : new Author(
            $authorData->id,
            $authorData->name
        );
    }
}
