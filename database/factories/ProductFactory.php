<?php

use App\Model\Offer;
use App\Model\Price;
use App\Model\Product;
use App\Model\ProductCategory;
use App\Model\WishedProduct;
use Faker\Generator as Faker;

$factory->define(Product::class, function(Faker $faker, array $attributes = []) use ($factory) {
    $name  = $attributes['name']  ?? $faker->sentence(2);
    $brand = $attributes['brand'] ?? $faker->sentence(2);
    $image = $attributes['image'] ?? $faker->imageUrl(400, 400, 'food');
    $stock = $attributes['stock'] ?? $faker->numberBetween(1, 10);
    $price_attrs = $attributes['price'] ?? $factory->raw(Price::class);
    $price = new Price($price_attrs['value'], $price_attrs['digits']);

    return compact('name', 'brand', 'stock', 'image', 'price');
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


/*
 * Product Category
 */

$factory->define(ProductCategory::class, function (Faker $faker, array $attributes = [])  {
    $name = $attributes['name'] ?? $faker->name;
    $slug = str_slug($name);

    return compact('slug', 'name');
});

/*
 * Offer
 */

$factory->define(Offer::class, function (Faker $faker, array $attributes = [])  {
    $category   = $attributes['category']   ?? null; // required
    $percentage = $attributes['percentage'] ?? $faker->numberBetween(1, 100);
    $validFrom  = $attributes['valid_from'] ?? $faker->dateTimeInInterval('-10 days', '+5 days');
    $validTo    = $attributes['valid_to']   ?? $faker->dateTimeInInterval('+10 days', '+5 days');

    return compact('category', 'percentage', 'validFrom', 'validTo');
});

/*
 * Price
 */

$factory->define(Price::class, function (Faker $faker, array $attributes = [])  {
    $value  = $attributes['value']  ?? $faker->numberBetween(1, 100);
    $digits = $attributes['digits'] ?? $faker->numberBetween(1, 10);

    return compact('value', 'digits');
});

