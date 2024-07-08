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
        $router->get('/home/update-image', '\App\Http\Controllers\Admin\Home@updateImage');

        $router->get('/news', '\App\Http\Controllers\Admin\News@index');
        $router->post('/news/listdata', '\App\Http\Controllers\Admin\News@listdata');
        $router->get('/news/add', '\App\Http\Controllers\Admin\News@Add');
        $router->get('/news/edit', '\App\Http\Controllers\Admin\News@Edit');
        $router->post('/news/do-add', '\App\Http\Controllers\Admin\News@doAdd');
        $router->get('/news/do-delete', '\App\Http\Controllers\Admin\News@doDelete');

        $router->post('/news/listdata-category', '\App\Http\Controllers\Admin\News@listdataCategory');
        $router->get('/news/add-category', '\App\Http\Controllers\Admin\News@AddCategory');
        $router->get('/news/edit-category', '\App\Http\Controllers\Admin\News@EditCategory');
        $router->post('/news/do-add-category', '\App\Http\Controllers\Admin\News@doAddCategory');
        $router->get('/news/do-delete-category', '\App\Http\Controllers\Admin\News@doDeleteCategory');

        $router->get('/projects', '\App\Http\Controllers\Admin\Projects@index');
        $router->post('/projects/listdata', '\App\Http\Controllers\Admin\Projects@listdata');
        $router->get('/projects/add', '\App\Http\Controllers\Admin\Projects@Add');
        $router->get('/projects/edit', '\App\Http\Controllers\Admin\Projects@Edit');
        $router->post('/projects/do-add', '\App\Http\Controllers\Admin\Projects@doAdd');
        $router->get('/projects/do-delete', '\App\Http\Controllers\Admin\Projects@doDelete');

        $router->post('/projects/listdata-category', '\App\Http\Controllers\Admin\Projects@listdataCategory');
        $router->get('/projects/add-category', '\App\Http\Controllers\Admin\Projects@AddCategory');
        $router->get('/projects/edit-category', '\App\Http\Controllers\Admin\Projects@EditCategory');
        $router->post('/projects/do-add-category', '\App\Http\Controllers\Admin\Projects@doAddCategory');
        $router->get('/projects/do-delete-category', '\App\Http\Controllers\Admin\Projects@doDeleteCategory');

        $router->post('/home/do-add-static', '\App\Http\Controllers\Admin\Home@doAddStatic');
        $router->post('/home/do-add-staticImage', '\App\Http\Controllers\Admin\Home@doAddStaticImage');
        $router->post('/upload-image', '\App\Http\Controllers\Admin\Home@uploadImage');

        $router->get('/about', '\App\Http\Controllers\Admin\About@index');
        $router->post('/about/do-add', '\App\Http\Controllers\Admin\About@doAdd');

        $router->get('/contact', '\App\Http\Controllers\Admin\Contact@index');
        $router->post('/contact/do-add', '\App\Http\Controllers\Admin\Contact@doAdd');

        $router->get('/services', '\App\Http\Controllers\Admin\Services@index');
        $router->post('/services/listdata', '\App\Http\Controllers\Admin\Services@listdata');
        $router->get('/services/add', '\App\Http\Controllers\Admin\Services@Add');
        $router->get('/services/edit', '\App\Http\Controllers\Admin\Services@Edit');
        $router->post('/services/do-add', '\App\Http\Controllers\Admin\Services@doAdd');
        $router->get('/services/do-delete', '\App\Http\Controllers\Admin\Services@doDelete');

        $router->get('/banner', '\App\Http\Controllers\Admin\Banner@index');
        $router->post('/banner/listdata', '\App\Http\Controllers\Admin\Banner@listdata');
        $router->get('/banner/add', '\App\Http\Controllers\Admin\Banner@Add');
        $router->get('/banner/edit', '\App\Http\Controllers\Admin\Banner@Edit');
        $router->post('/banner/do-add', '\App\Http\Controllers\Admin\Banner@doAdd');
        $router->get('/banner/do-delete', '\App\Http\Controllers\Admin\Banner@doDelete');

        $router->get('/wedo', '\App\Http\Controllers\Admin\WeDo@index');
        $router->post('/wedo/listdata', '\App\Http\Controllers\Admin\WeDo@listdata');
        $router->get('/wedo/add', '\App\Http\Controllers\Admin\WeDo@Add');
        $router->get('/wedo/edit', '\App\Http\Controllers\Admin\WeDo@Edit');
        $router->post('/wedo/do-add', '\App\Http\Controllers\Admin\WeDo@doAdd');
        $router->get('/wedo/do-delete', '\App\Http\Controllers\Admin\WeDo@doDelete');

        $router->get('/numberclient', '\App\Http\Controllers\Admin\NumberClient@index');
        $router->post('/numberclient/listdata', '\App\Http\Controllers\Admin\NumberClient@listdata');
        $router->get('/numberclient/add', '\App\Http\Controllers\Admin\NumberClient@Add');
        $router->get('/numberclient/edit', '\App\Http\Controllers\Admin\NumberClient@Edit');
        $router->post('/numberclient/do-add', '\App\Http\Controllers\Admin\NumberClient@doAdd');
        $router->get('/numberclient/do-delete', '\App\Http\Controllers\Admin\NumberClient@doDelete');

        $router->get('/clients', '\App\Http\Controllers\Admin\Clients@index');
        $router->post('/clients/listdata', '\App\Http\Controllers\Admin\Clients@listdata');
        $router->get('/clients/add', '\App\Http\Controllers\Admin\Clients@Add');
        $router->get('/clients/edit', '\App\Http\Controllers\Admin\Clients@Edit');
        $router->post('/clients/do-add', '\App\Http\Controllers\Admin\Clients@doAdd');
        $router->get('/clients/do-delete', '\App\Http\Controllers\Admin\Clients@doDelete');


        $router->post('/home/listdata-icon', '\App\Http\Controllers\Admin\Home@listdataIcon');
        $router->get('/home/add-icon', '\App\Http\Controllers\Admin\Home@AddIcon');
        $router->get('/home/edit-icon', '\App\Http\Controllers\Admin\Home@EditIcon');
        $router->post('/home/do-add-icon', '\App\Http\Controllers\Admin\Home@doAddIcon');
        $router->get('/home/do-delete-icon', '\App\Http\Controllers\Admin\Home@doDeleteIcon');
    });
});
