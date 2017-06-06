<?php

use App\Model\Product\StockedProduct;
use App\Model\Product\WishedProduct;
use Faker\Generator as Faker;
use App\Model\Product;

$factory->define(Product::class, function(Faker $faker, array $attributes = []) {
    $name  = $attributes['name']  ?? $faker->sentence(2);
    $brand = $attributes['brand'] ?? $faker->sentence(2);
    $image = $attributes['image'] ?? $faker->imageUrl(400, 400, 'food');
    $stock = $attributes['stock'] ?? $faker->numberBetween(1, 10);

    return compact('name', 'brand', 'stock', 'image');
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

/*
 * Wished Products
 */

$factory->define(WishedProduct::class, function (Faker $faker, array $attributes = []) use ($factory) {
    $product  = $attributes['product'] ?? $factory->raw(Product::class);
    $quantity = $attributes['quantity'] ?? $faker->numberBetween(1, 10);

    return compact('product', 'quantity');
});

