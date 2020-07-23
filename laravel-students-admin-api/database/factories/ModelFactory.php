<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

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

$factory->define(Students::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'birthdate' => $faker->dateTimeBetween('1970-01-01', '2006-12-31')->format('d/m/Y'),
    ];
});

$factory->define(Courses::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(20, true),
        'description' => $faker->sentence(),
    ];
});

$factory->define(Enrollments::class, function (Faker $faker) {
    return [
        'student_id' => App\Students::all()->random()->student_id,
        'course_id' => App\Courses::all()->random()->course_id,
        'enrollment_date' => now(),
    ];
});
