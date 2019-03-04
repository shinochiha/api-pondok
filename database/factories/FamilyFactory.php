<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Family::class, function (Faker $faker) {
    return [
        'profile_id'   => $faker->unique()->randomDigitNotNull,    
        'living_parent' => (string)rand(0,5),
        'guardian' => $faker->firstName,
        'parent_phone' => $faker->e164PhoneNumber,
        'father_name' => $faker->name('male'),
        'mother_name' => $faker->name('female'),
        'father_job' => $faker->jobTitle,
        'mother_job' => $faker->optional($weight = 0.5, $default = 'Housewife')->jobTitle,
        'parent_income' => $faker->randomNumber(7),
        'total_sibling' => $faker->randomDigit,
    ];
});
