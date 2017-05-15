<?php

use App\Model\Client;
use Faker\Generator as Faker;

$factory->define(Client::class, function(Faker $faker, array $attributes = []) {
    $discr    = 'client';
    $email    = $attributes['email']    ?? $faker->email;
    $username = $attributes['username'] ?? $faker->userName;

    return compact('discr', 'email', 'username');
});
