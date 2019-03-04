<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    $hasher = app()->make('hash');
    return [
    	'uuid' => $faker->uuid,	
        'username' => $faker->userName,
        'email' => $faker->email,
        'password' => $hasher->make('secret')
    ];
});

$factory->define(App\Models\Profile::class, function (Faker\Generator $faker) {
    return [
        // 'user_id'   => $faker->unique()->randomDigitNotNull,
        'user_id'   => function () {
            return factory(App\Models\User::class)->create()->id;
        },
        'uuid'  => $faker->uuid,    
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

$factory->define(App\Models\Education::class, function (Faker\Generator $faker) {
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

$factory->define(App\Models\Family::class, function (Faker\Generator $faker) {
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
