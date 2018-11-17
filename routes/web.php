<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Profile Routes
Route::get('/user/{user_id}/profile/{profile_id}', 'ProfileController@show')->name('profile.show');
Route::get('/user/{user_id}/profile', 'ProfileController@create')->name('profile.create');
Route::post('/user/{user_id}/profile/', 'ProfileController@store')->name('profile.store');
Route::get('/user/{user_id}/profile/{profile_id}/edit', 'ProfileController@edit')->name('profile.edit');
Route::patch('/user/{user_id}/profile/{profile_id}', 'ProfileController@update')->name('profile.update');

//Question Routes
Route::resources(['question' => 'QuestionController',]);

//Answer Routes
Route::get('/question/{question_id}/answer/create', 'AnswerController@create')->name('answer.create');
Route::get('/question/{question_id}/answer/{answer_id}', 'AnswerController@show')->name('answer.show');
Route::get('/question/{question_id}/answer/{answer_id}/edit', 'AnswerController@edit')->name('answer.edit');
Route::post('/question/{question_id}/answer/', 'AnswerController@store')->name('answer.store');
Route::patch('/question/{question_id}/answer/{answer_id}', 'AnswerController@update')->name('answer.update');
