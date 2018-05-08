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
Route::group(['middleware' => 'auth'], function(){
    Route::resource('quotes', 'QuoteController', ['except' => ['index', 'show']]);

    Route::resource('quote_comments', 'QuoteCommentController');
    // Route::post('quote_comments', 'QuoteCommentController@store');  
    // Route::get('quote_comments/{id}/edit', 'QuoteCommentController@edit');
    // Route::put('quote_comments/{id}', 'QuoteCommentController@update');  
    // Route::delete('quote_comments/{id}', 'QuoteCommentController@destroy'); 

    Route::get('/like/{data_type}/{data_likeable_id}', 'LikeController@like'); 
    Route::get('/unlike/{data_type}/{data_likeable_id}', 'LikeController@unlike'); 

    Route::get('/notifications', 'UserController@notification');     
});

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', 'HomeController@welcome')->name('Welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/profile/{id?}', 'UserController@profile');

Route::get('/quotes/random', 'QuoteController@random');
Route::get('/quotes/tag/{tag}', 'QuoteController@tag');
// Route::get('/quotes/create', 'QuoteController@create');

Route::resource('quotes', 'QuoteController', ['only' => ['index', 'show']]);

