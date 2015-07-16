<?php
/**
 * Created by PhpStorm.
 * User: Gábor
 * Date: 2015.07.16.
 * Time: 16:18
 */

Route::group(['namespace' => 'Ethereal\User\Controllers'], function () {

    Route::group(['prefix' => 'admin'], function () {

        // Resource route for UserController
        Route::resource(trans('ethereal-user::routes.user.slug', 'UserController', ['middleware' => 'auth']));

        // Resource route for RoleController
        Route::resource(trans('ethereal-user::routes.role.slug', 'RoleController', ['middleware' => 'auth']));
    });


});