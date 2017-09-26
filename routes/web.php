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


Auth::routes();

Route::get('/', 'Web\HomeController@index')->name('home');

Route::group(['prefix' => 'book'], function () {
    Route::get('/{id}', 'Web\BookController@show')->name('book.show');
});

Route::group(['prefix' => 'plan'], function () {
    Route::get('/search', 'Web\PlanController@searchData');
    Route::get('/', 'Web\PlanController@index')->name('plan.index');
    Route::get('/{id}', 'Web\PlanController@show')->name('plan.show');
});

Route::get('search', 'Web\HomeController@searchData')->name('search');

Route::group(['prefix' => 'user'], function () {
    Route::group(['prefix' => '/dashboard', 'middleware' => 'unauthenticated'], function () {
        Route::get('/', 'Web\UserController@dashboard');
        //Route Update Profile
        Route::get('/edit-profile', 'Web\UserController@editProfile');
        Route::post('/update-profile', 'Web\UserController@updateProfile');
        //Route Update Password
        Route::get('/edit-password', 'Web\UserController@editPassword');
        Route::post('/update-password', 'Web\UserController@updatePassword');
    });
});


Route::get('error', 'Web\HomeController@errorPage');

Route::group(['prefix' => 'subject'], function () {
   Route::get('/get-subject', 'Web\SubjectController@getAllSubjectByFilter');
   Route::get('/get-sort', 'Web\SubjectController@getAllSortByFilter');
});
