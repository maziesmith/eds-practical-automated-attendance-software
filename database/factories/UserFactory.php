<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\user::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => 'student123', // secret
        'identification' =>  implode("",
            $faker->unique()->randomElements( (array) $array = [
                'C', 'K', 'M', 'O', 'P', '1', '2', '3', '4', '5', '6', '7', '8', '9', '0'
            ], $count = 8, $allowDuplicates = true)) ,
        'role' => 'student'
    ];
});
