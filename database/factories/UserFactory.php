<?php

use App\Model\User;
use Faker\Generator as Faker;

$factory->define(User::class, function(Faker $faker, array $attributes = []) {
    $email    = $attributes['email']    ?? $faker->email;
    $username = $attributes['username'] ?? $faker->userName;
    $address  = $attributes['address']  ?? "Roque Sáenz Peña 352, B1876BXD Bernal, Buenos Aires";

    return compact('email', 'username', 'address');
});
