<?php
/**
 * Created by PhpStorm.
 * User: Gábor
 * Date: 2015.06.30.
 * Time: 14:21
 */

namespace Ethereal\User\Providers;


use Ethereal\User\User;
use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bindShared('user', function () {
            return new User;
        });

        $this->app->bindShared('role', function () {
            return new Role;
        });

        /**
         * Package merge config
         */
        $this->mergeConfigFrom(
            __DIR__.'/../../config/ethereal-user.php', 'ethereal-user'
        );
    }

    /**
     *
     */
    public function boot()
    {
        /**
         * Package translations
         */
        $this->loadTranslationsFrom(__DIR__ . '/../../resources/lang', 'ethereal-user');

        /**
         * Package routes
         */
        if (!$this->app->routesAreCached()) {
            require __DIR__ . '/../Http/routes.php';
        }

        /**
         * Package views
         */
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'ethereal-user');

        $this->publishes([
            __DIR__ . '/../../resources/views' => base_path('resources/views/vendor/ethereal-user'),
        ],'views');

        /**
         * Package config
         */
        $this->publishes([
            __DIR__ . '/../../config/ethereal-user.php' => config_path('ethereal-user.php'),
        ], 'config');

        /**
         * Package migrations
         */
        $this->publishes([
            __DIR__.'/../../database/migrations/' => database_path('/migrations')
        ], 'migrations');
    }
}