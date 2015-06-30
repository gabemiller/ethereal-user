<?php
/**
 * Created by PhpStorm.
 * User: Gábor
 * Date: 2015.06.30.
 * Time: 18:49
 */

namespace Ethereal\User\Interfaces;


interface UserInterface
{
    /**
     * This method tells if the User has the Role or not.
     *
     * @param $role \Ethereal\User\Role
     * @return boolean
     */
    public function hasRole($role);

    /**
     * The relationship between User and Role models
     *
     * @return mixed
     */
    public function roles();
}