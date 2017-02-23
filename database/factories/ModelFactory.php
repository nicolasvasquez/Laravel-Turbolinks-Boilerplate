<?php

$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => $password ?: $password = 'secret',
        'remember_token' => str_random(10),
        'api_token' => str_random(60),
    ];
});

$factory->define(Spatie\Permission\Models\Role::class, function (Faker\Generator $faker) {
    return [
        'name' => str_slug($faker->name),
        'label' => $faker->sentence,
    ];
});
$factory->define(Spatie\Permission\Models\Permission::class, function (Faker\Generator $faker) {
    return [
        'name' => str_slug($faker->name),
        'label' => $faker->sentence,
    ];
});
