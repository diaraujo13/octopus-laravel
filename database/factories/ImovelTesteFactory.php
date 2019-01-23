<?php

use Faker\Generator as Faker;

$factory->define(App\Imovel::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'endereco' => $faker->address,
        'valor' =>  $faker->randomFloat(2, 100000),

        'photo'=> 'https://picsum.photos/200/300'
    ];
});
