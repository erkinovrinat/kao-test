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

$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'role_id' => null,
        'email' => $faker->safeEmail,
        'password' => $password = bcrypt('123123'),
        'remember_token' => str_random(10),
        'school_id' => random_int(1, 135),
        'class' => random_int(1, 135),
    ];
});

$factory->define(App\Question::class, function (Faker\Generator $faker) {
    return [
        'topic_id' => random_int(1, 6),
        'level_id' => random_int(1, 3),
        'question_text' => $faker->text(50),
        'answer_explanation' => $faker->text(50),
    ];
});

$factory->define(App\QuestionsOption::class, function (Faker\Generator $faker) {
    return [
        'question_id' => random_int(80, 99),
        'option' => $faker->text(10),
        'correct' => random_int(0, 1),
    ];
});
