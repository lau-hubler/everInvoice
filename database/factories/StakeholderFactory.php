<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Stakeholder;
use Faker\Generator as Faker;

$factory->define(Stakeholder::class, function (Faker $faker) {
    return [
        'name' => $faker->firstName,
        'surname' => $faker->lastName,
        'company' => null,
        'is_company' => 0,
        'document_type_id' => 1,
        'document' => $faker->randomNumber(9),
        'email' => $faker->email,
        'mobile' => $faker->phoneNumber,
    ];
});
