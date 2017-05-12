<?php

use Faker\Generator as Faker;
use App\Model\Product\Product;

$factory->define(Product::class, function(Faker $faker, array $attributes = []) {
    $name  = $attributes['name']  ?? $faker->sentence(2);
    $brand = $attributes['brand'] ?? $faker->sentence(2);
    $image = $attributes['image'] ?? $faker->imageUrl(300, 400, 'food');

    return compact('name', 'brand', 'image');
});

$factory->defineAs(Product::class, 'french-fries', function () use ($factory) {
    return $factory->raw(Product::class, ['name' => 'Papas Fritas']);
});

$factory->defineAs(Product::class, 'soda', function () use ($factory) {
    return $factory->raw(Product::class, ['name' => 'Gaseosa']);
});

$factory->defineAs(Product::class, 'milk', function () use ($factory) {
    return $factory->raw(Product::class, ['name' => 'Leche']);
});
