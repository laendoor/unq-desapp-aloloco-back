<?php

use App\Model\ShoppingList;
use Doctrine\Common\Collections\ArrayCollection;
use Faker\Generator as Faker;

$factory->define(ShoppingList::class, function(Faker $faker, array $attributes = []) {
    $user  = $attributes['user'] ?? null; // required
    $name  = $attributes['name'] ?? $faker->sentence(2);
    $slug = str_slug($name);
    $wishedProducts = $attributes['name'] ?? new ArrayCollection;

    return compact('user', 'name', 'slug', 'wishedProducts');
});

$factory->defineAs(ShoppingList::class, 'wish-list', function () use ($factory) {
    return $factory->raw(ShoppingList::class);
});
