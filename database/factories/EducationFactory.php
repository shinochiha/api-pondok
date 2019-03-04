<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Education::class, function (Faker $faker) {
    return [
        // 'profile_id'   => $faker->unique()->randomDigitNotNull,    
        'profile_id'   => function () {
            return factory(App\Models\Profile::class)->create()->id;
        },    
        'pre_elementary' => $faker->word,
        'elementary' => $faker->domainWord,
        'junior_high' => $faker->streetName,
        'senior_high' => $faker->company,
        'other_education' => $faker->streetAddress,
        'latest_major' => $faker->sentence,
    ];
});
