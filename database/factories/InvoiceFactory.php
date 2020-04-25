<?php

/** @var Factory $factory */

use App\Invoice;
use App\Stakeholder;
use App\Status;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Invoice::class, function (Faker $faker) {
    return [
        'client_id' => Stakeholder::all()->keyBy('id')->keys()->random(),
        'vendor_id' => Stakeholder::all()->keyBy('id')->keys()->random(),
        'due_date' => $faker->dateTimeBetween('today', '+3 month')->format('Y-m-d'),
        'delivery_date' => $faker->dateTimeBetween('-1 month', 'today')->format('Y-m-d'),
        'invoice_date' => $faker->dateTimeBetween('-3 month', '-1 month')->format('Y-m-d'),
        'status_id' => Status::all()->keyBy('id')->keys()->random(),
    ];
});
