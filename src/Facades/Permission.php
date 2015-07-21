<?php
/**
 * Created by PhpStorm.
 * User: Gábor
 * Date: 2015.07.18.
 * Time: 20:39
 */

namespace Ethereal\User\Facades;


use Illuminate\Support\Facades\Facade;

class Permission extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'permission';
    }
}