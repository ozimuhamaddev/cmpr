<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', '\App\Http\Controllers\Frontend\Main@index');
Route::get('/about', '\App\Http\Controllers\Frontend\Main@about');
Route::get('/projects', '\App\Http\Controllers\Frontend\Main@projects');
Route::get('/services', '\App\Http\Controllers\Frontend\Main@services');
Route::get('/news', '\App\Http\Controllers\Frontend\Main@news');
Route::get('/contact', '\App\Http\Controllers\Frontend\Main@contact');
Route::post('/news-list-data', '\App\Http\Controllers\Frontend\Main@newsListData');
Route::get('/news/{value}', [\App\Http\Controllers\Frontend\Main::class, 'newsDetail']);
Route::get('/services/{value}', [\App\Http\Controllers\Frontend\Main::class, 'servicesDetail']);
Route::get('/news/tags/{value}', [\App\Http\Controllers\Frontend\Main::class, 'newsTags']);
Route::get('/news/category/{value}', [\App\Http\Controllers\Frontend\Main::class, 'newsCategory']);
Route::post('/news-category-list-data', '\App\Http\Controllers\Frontend\Main@newsCategoryListData');
Route::post('/news-tags-list-data', '\App\Http\Controllers\Frontend\Main@newsTagsListdata');

$router->group(['prefix' => 'admin-page'], function () use ($router) {
    $router->get('/', '\App\Http\Controllers\Admin\Login@index');
    $router->get('/home', '\App\Http\Controllers\Admin\Home@index');
    $router->get('/about', '\App\Http\Controllers\Admin\Home@about');
    $router->get('/projects', '\App\Http\Controllers\Admin\Home@projects');
    $router->get('/services', '\App\Http\Controllers\Admin\Home@services');
    $router->get('/news', '\App\Http\Controllers\Admin\Home@news');
    $router->get('/contact', '\App\Http\Controllers\Admin\Home@contact');
});
