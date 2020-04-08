<?php

/** @var Factory $factory */

use App\Invoice;
use App\Order;
use App\Product;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Order::class, function (Faker $faker) {
    static $combinations;
    $combinations = $combinations ?: [[]];
    do {
        $invoiceIdFactory = Invoice::all()->keyBy('id')->keys()->random();
        $productIdFactory = Product::all()->keyBy('id')->keys()->random();
    } while (in_array([$invoiceIdFactory, $productIdFactory], $combinations));
    $combinations[] = [$invoiceIdFactory, $productIdFactory];

    return [
        'invoice_id' => $invoiceIdFactory,
        'product_id' => $productIdFactory,
        'quantity' =>  $faker->numberBetween(1, 20),
        'unit_price' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 50),
        'product_iva' => $faker->randomFloat($nbMaxDecimals = 4, $min = 0, $max = 0.5000),
    ];
});
