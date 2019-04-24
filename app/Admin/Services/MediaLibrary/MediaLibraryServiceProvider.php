<?php

namespace App\Admin\Services\MediaLibrary;

use Encore\Admin\Form;
use Route;
use Illuminate\Routing\Router;

class MediaLibraryServiceProvider
{
    public static function register()
    {
        Form::extend('mediaLibrary', MediaLibraryFile::class);
        Form::extend('multipleMediaLibrary', MediaLibraryMultipleFile::class);

        Route::group([
            'prefix' => config('admin.route.prefix'),
            'namespace' => config('admin.route.namespace'),
            'middleware' => config('admin.route.middleware'),
        ], function (Router $router) {
            $router
                ->get('media/download/{id}', '\App\Admin\Services\MediaLibrary\MediaLibraryController@download')
                ->name('admin.media.download');
        });
    }
}
