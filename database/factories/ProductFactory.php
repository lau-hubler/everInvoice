<?php

declare(strict_types=1);

/** @var Factory $factory */
use App\Category;
use App\Product;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'code' => strtoupper($faker->bothify('???###')),
        'name' => $faker->sentence(2, false),
        'description' => $faker->sentence(6, true),
        'price' => $faker->randomFloat(2, 0, 50),
        'category_id' => Category::all()->keyBy('id')->keys()->random(),
    ];
});
