<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Profile::class, function (Faker $faker) {
    return [
        // 'user_id'   => $faker->unique()->randomDigitNotNull,
        'user_id'   => function () {
            return factory(App\Models\User::class)->create()->id;
        },
        // 'uuid'  => $faker->uuid,    
        'fullname' => $faker->name,
        'gender' => rand(0,1) ? 'male' : 'female',
        'birth_place' => $faker->city,
        'birth_date' => $faker->date,
        'address' => $faker->address,
        'city' => $faker->city,
        'province' => $faker->country,
        'phone' => $faker->e164PhoneNumber,
        'wa' => $faker->e164PhoneNumber,
        'fb' => $faker->url,
        'hobby' => $faker->word,
        'dream' => $faker->sentence,
        'idol' => $faker->name,
        'quran' => $faker->numberBetween(0,30),
        'photo' => $faker->imageUrl,
    ];
});
