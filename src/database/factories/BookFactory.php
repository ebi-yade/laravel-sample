<?php

use App\Models\Book;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Book::class, function (Faker $faker) {
    return [
        'author_id' => factory(App\Models\Author::class)->create()->id,
        'title'     => $faker->name,
    ];
});
