<?php

$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Models\Service::class, function (Faker\Generator $faker) {

    return [
        'topic' => $faker->name,
        'at' => $faker->dateTimeBetween('now', '+2 months'),
        'speaker_id' => 1,
        'venue_id' => 1,
        'type_id' => 1,
    ];
});

$factory->define(App\Models\Soul::class, function (Faker\Generator $faker) {

    return [
        'cellgroup_id' => $faker->numberBetween(1, 4),
        'baptism_id' => null,
        'baptism_serial' => null,
        'is_active' => 1,
        'nric' => $faker->creditCardNumber,
        'nric_fullname' => $faker->firstName,
        'birthday' => $faker->dateTime('now'),
        'nickname' => $faker->firstName,
        'email' => $faker->email,
        'contact' => $faker->phoneNumber,
        'contact2' => $faker->phoneNumber,
        'address1' => $faker->streetName,
        'address2' => $faker->streetAddress,
        'postal_code' => $faker->postcode,
    ];
});

