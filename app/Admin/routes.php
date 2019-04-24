<?php

use App\Admin\Services\MediaLibrary\MediaLibraryServiceProvider;
use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix' => config('admin.route.prefix'),
    'namespace' => config('admin.route.namespace'),
    'middleware' => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');

    $router->resource('companies', 'CompaniesController');

});

MediaLibraryServiceProvider::register();
