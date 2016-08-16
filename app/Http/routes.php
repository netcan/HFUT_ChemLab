<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
use App\Category;
use App\Article;

Route::get('/', 'HomeController@index');

Route::auth();

Route::group(['middleware'=>['auth', 'manage'], 'namespace'=>'Admin', 'prefix'=>'admin'], function () {
    Route::group(['prefix'=>'resources'], function () {
        Route::get('/', function() {
            return view('admin.resources')->with('categories_count', \App\Category::all()->count())->with('articles_count', \App\Article::all()->count());
        });
        Route::resource('categories', 'CategoryController');
        Route::get('articles', 'ArticleController@index');
    });
    Route::resource('questions', 'QuestionController');
});

Route::resource('article', Admin\ArticleController::class, ['except' => [
    'index',
]]);
Route::get('categories/{cid?}', 'Admin\CategoryController@list');


Route::get('/home', 'HomeController@index');
