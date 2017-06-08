<?php

use App\Model\User;
use App\Model\Client;
use Faker\Generator as Faker;

$factory->define(User::class, function(Faker $faker, array $attributes = []) {
    $email = $attributes['email'] ?? $faker->email;

    return compact('email');
});

$factory->define(Client::class, function(Faker $faker, array $attributes = []) {
    $discr    = 'client';
    $email    = $attributes['email']    ?? $faker->email;
    $username = $attributes['username'] ?? $faker->userName;

    return compact('discr', 'email', 'username');
});
