<?php
/**
 * Created by PhpStorm.
 * User: Gábor
 * Date: 2015.07.18.
 * Time: 20:17
 */

namespace Ethereal\User\Interfaces;


interface PermissionInterface
{

    /**
     * Relationship between Role and Permission models
     *
     * @return mixed
     */
    public function roles();

}