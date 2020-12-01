<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Http\Requests\CreateBookRequest;
use App\Usecases\BookUsecase;
use App\Usecases\AuthorNotFoundException;

class BookController extends Controller
{
    /**
     * @var BookUsecase
     */
    private $bookUsecase;

    public function __construct(BookUsecase $bookUsecase)
    {
        $this->bookUsecase = $bookUsecase;        
    }

    /**
     * @group Book
     * 本を作成
     * 
     * @response {
     *   "id": 10,
     *   "author_id": 20,
     *   "title": "PHP入門",
     * }
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
