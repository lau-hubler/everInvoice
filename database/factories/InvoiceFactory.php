<?php

/** @var Factory $factory */

use App\Invoice;
use App\Stakeholder;
use App\Status;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Invoice::class, function (Faker $faker) {
    return [
        'code' => $faker->randomNumber(6),
        'vendor_id' => Stakeholder::all()->keyBy('id')->keys()->random(),
        'client_id' => Stakeholder::all()->keyBy('id')->keys()->random(),
        'due_date' => $faker->dateTimeThisYear('-1 month')->format('Y-m-d'),
        'delivery_date' => $faker->dateTimeThisYear->format('Y-m-d'),
        'invoice_date' => $faker->dateTimeThisYear('+3 months')->format('Y-m-d'),
        'status_id' => Status::all()->keyBy('id')->keys()->random(),
    ];
});
