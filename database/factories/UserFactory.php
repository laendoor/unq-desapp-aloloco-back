<?php

use App\Model\User;
use Faker\Generator as Faker;

$factory->define(User::class, function(Faker $faker, array $attributes = []) {
    $email    = $attributes['email']    ?? $faker->email;
    $username = $attributes['username'] ?? $faker->userName;

    return compact('email', 'username');
});
