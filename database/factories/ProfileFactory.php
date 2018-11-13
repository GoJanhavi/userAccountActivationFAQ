<?php

use Faker\Generator as Faker;

$factory->define(App\Profile::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'body'=> $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
    ];
});
