<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Http\Requests\CreateBookRequest;
use App\Domain\Usecases\BookUsecase;
use App\Domain\Usecases\AuthorNotFoundException;

class BookController extends Controller
{
    private BookUsecase $bookUsecase;

    public function __construct(BookUsecase $bookUsecase)
    {
        $this->bookUsecase = $bookUsecase;        
    }

    /**
     * 本を作成
     * 
     * @param CreateBookRequest $request
     * @return array<string,string|int>
     */
    public function createBook(CreateBookRequest $request): array
    {
        $authorId = $request->input('author_id');
        $title = $request->input('title');
    
        try {
            $book = $this->bookUsecase->createBook($authorId, $title);
        } catch (AuthorNotFoundException $e) {
            abort(404, $e->getMessage());
        }

        return [
            'id'        => $book->id,
            'author_id' => $book->authorId,
            'title'     => $book->title,
        ];
    }
}
