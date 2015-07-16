<?php
/**
 * Created by PhpStorm.
 * User: Gábor
 * Date: 2015.07.16.
 * Time: 18:16
 */

namespace Ethereal\User\Facades;


use Illuminate\Support\Facades\Facade;

class Role extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'role';
    }
}