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
    }

    /**
     *
     */
    public function boot()
    {
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