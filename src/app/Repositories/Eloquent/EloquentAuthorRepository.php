<?php

namespace App\Repositories\Eloquent;

use App\Models\Author as EloquentAuthor;
use App\Repositories\AuthorRepository;
use App\Entities\Author;

/**
 * {@inheritdoc}
 */
class EloquentAuthorRepository implements AuthorRepository
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
