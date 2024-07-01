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
    $router->get('/', '\App\Http\Controllers\Admin\AuthController@index');
    $router->get('/logout', '\App\Http\Controllers\Admin\AuthController@Logout');
    $router->post('/do-login', '\App\Http\Controllers\Admin\AuthController@DoLogin');

    Route::middleware(['check.session'])->group(function () use ($router) {
        $router->get('/home', '\App\Http\Controllers\Admin\Home@index');
        $router->get('/services', '\App\Http\Controllers\Admin\Home@services');
        $router->get('/contact', '\App\Http\Controllers\Admin\Home@contact');
        $router->post('/home/listdata', '\App\Http\Controllers\Admin\Home@listdata');
        $router->get('/home/do-status', '\App\Http\Controllers\Admin\Home@doStatus');
        $router->get('/home/update-static', '\App\Http\Controllers\Admin\Home@updateStatic');
        $router->get('/home/update-static', '\App\Http\Controllers\Admin\Home@updateStatic');

        $router->get('/news', '\App\Http\Controllers\Admin\News@index');
        $router->post('/news/listdata', '\App\Http\Controllers\Admin\News@listdata');
        $router->get('/news/add', '\App\Http\Controllers\Admin\News@Add');
        $router->get('/news/edit', '\App\Http\Controllers\Admin\News@Edit');
        $router->post('/news/do-add', '\App\Http\Controllers\Admin\News@doAdd');

        $router->get('/projects', '\App\Http\Controllers\Admin\Projects@index');
        $router->post('/projects/listdata', '\App\Http\Controllers\Admin\Projects@listdata');
        $router->get('/projects/add', '\App\Http\Controllers\Admin\Projects@Add');
        $router->get('/projects/edit', '\App\Http\Controllers\Admin\Projects@Edit');
        $router->post('/projects/do-add', '\App\Http\Controllers\Admin\Projects@doAdd');

        $router->post('/home/do-add-static', '\App\Http\Controllers\Admin\Home@doAddStatic');
        $router->post('/upload-image', '\App\Http\Controllers\Admin\Home@uploadImage');

        $router->get('/about', '\App\Http\Controllers\Admin\About@index');
        $router->post('/about/do-add', '\App\Http\Controllers\Admin\About@doAdd');

        $router->get('/contact', '\App\Http\Controllers\Admin\Contact@index');
        $router->post('/contact/do-add', '\App\Http\Controllers\Admin\Contact@doAdd');
    });
});
