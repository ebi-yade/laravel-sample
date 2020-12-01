<?php

namespace App\Entities;

class Book
{
    public ?int $id;
    public int $authorId;
    public string $title;

    public function __construct(?int $id, int $authorId, string $title)
    {
        $this->id = $id;
        $this->authorId = $authorId;
        $this->title = $title;
    }

    public static function new(int $authorId, string $title): self
    {
        return new self(null, $authorId, $title);
    }
}
