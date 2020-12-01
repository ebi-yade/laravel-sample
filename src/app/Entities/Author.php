<?php

namespace App\Entities;

class Author
{
    public ?int $id;
    public string $name;

    public function __construct(?int $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public static function new(string $name): self
    {
        return new self(null, $name);
    }
}
