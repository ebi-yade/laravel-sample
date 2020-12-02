<?php

use App\Models\Author;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Author::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
    ];
});
