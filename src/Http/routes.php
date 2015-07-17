<?php
/**
 * Created by PhpStorm.
 * User: Gábor
 * Date: 2015.07.16.
 * Time: 16:18
 */

Route::group(['namespace' => 'Ethereal\User\Controllers'], function () {

    Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {

        // Resource route for UserController
        Route::resource(trans('ethereal-user::routes.user.slug'), 'UserController',
            ['middleware' => 'auth',
                'names' => ['index' => 'admin.user.index',
                    'create' => 'admin.user.create',
                    'store' => 'admin.user.store',
                    'show' => 'admin.user.show',
                    'edit' => 'admin.user.edit',
                    'update' => 'admin.user.update',
                    'destroy' => 'admin.user.destroy']]);

        // Resource route for RoleController
        Route::resource(trans('ethereal-user::routes.role.slug'), 'RoleController',
            ['middleware' => 'auth',
                'names' => ['index' => 'admin.role.index',
                    'create' => 'admin.role.create',
                    'store' => 'admin.role.store',
                    'show' => 'admin.role.show',
                    'edit' => 'admin.role.edit',
                    'update' => 'admin.role.update',
                    'destroy' => 'admin.role.destroy']]);
    });


});