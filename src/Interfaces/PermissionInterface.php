<?php
/**
 * Created by PhpStorm.
 * User: Gábor
 * Date: 2015.06.30.
 * Time: 18:50
 */

namespace Ethereal\User\Interfaces;


interface PermissionInterface
{

    /**
     * The relationship between Permission and Role models.
     *
     * @return mixed
     */
    public function roles();
}