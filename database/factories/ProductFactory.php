<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => 'Product ' . rand(5, 15),
        'vendor_code' => Str::random(12),
        'price' => rand(5, 15),
    ];
});
