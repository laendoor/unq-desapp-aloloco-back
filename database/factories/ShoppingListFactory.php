<?php

use App\Model\ShoppingList;
use Faker\Generator as Faker;

$factory->define(ShoppingList::class, function(Faker $faker, array $attributes = []) {
    $client = $attributes['client'] ?? null; // required
    $name  = $attributes['name'] ?? $faker->sentence(2);
    $slug = str_slug($name);

    return compact('client', 'name', 'slug');
});

$factory->defineAs(ShoppingList::class, 'wish-list', function () use ($factory) {
    return $factory->raw(ShoppingList::class);
});
