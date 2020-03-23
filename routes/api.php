<?php
Route::apiResource("/question","questionController");
Route::apiResource("/category","categoryController");
Route::apiResource("/{question}/reply","replyController");

Route::post("like/{reply}","likeController@likeIt");
Route::Delete("like/{reply}","likeController@unLikeIt");


Route::group([

	'middleware' => 'api',
	'prefix' => 'auth'

], function ($router) {

	Route::post('login', 'AuthController@login');
	Route::post('signup', 'AuthController@signup');
	Route::post('logout', 'AuthController@logout');
	Route::post('refresh', 'AuthController@refresh');
	Route::post('me', 'AuthController@me');

});
