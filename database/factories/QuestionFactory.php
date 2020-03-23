<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Category;
use App\Model\Question;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Question::class, function (Faker $faker) {
	$title=$faker->sentence;
	return [
		"title"=>$title,
		"slug"=>Str::slug($title,"-"),
		"body"=>$faker->sentence,
		"user_id"=>User::all()->random()->id,
		"category_id"=>Category::all()->random()->id,

	];
});
