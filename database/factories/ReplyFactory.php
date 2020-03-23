<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Reply;
use App\Model\question;
use App\User;
use Faker\Generator as Faker;

$factory->define(Reply::class, function (Faker $faker) {
	return [
		"body"=>$faker->text,
		"question_id"=>question::all()->random()->id,
		"user_id"=>User::all()->random()->id
	];

});

